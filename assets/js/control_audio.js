$(document).ready(function () {
    // Obtener referencia al elemento de audio y botones de reproducción
    let audio = $('#audioPlayer')[0]; // Convertimos el objeto jQuery en un elemento de DOM
    let playButton = $('#playPauseButton');
    let stopButton = $('#stopButton');
    audio.volume = 0.1;

    // Función para reproducir el audio
    function playAudio() {
        audio.play();
        updatePlayButton(true);
        localStorage.setItem('audioPlaybackState', 'escuchando_musica'); // Guardar el estado de reproducción
    }

    // Función para pausar el audio
    function pauseAudio() {
        audio.pause();
        updatePlayButton(false);
        localStorage.setItem('audioPlaybackState', 'musica_pausada'); // Guardar el estado de reproducción
        localStorage.setItem('audioProgress', audio.currentTime); // Guardar el progreso de reproducción
    }

    function pausadoForzado() {
        audio.pause();
        updatePlayButton(false);
        localStorage.setItem('audioPlaybackState', 'musica_pausada_por_cliente'); // Guardar el estado de reproducción
        localStorage.setItem('audioProgress', audio.currentTime); // Guardar el progreso de reproducción
    }


    // Función para detener el audio y pausarlo
    function stopAudio() {
        audio.pause();
        audio.currentTime = 0; // Reiniciar la reproducción al principio
        updatePlayButton(false);
        localStorage.setItem('audioPlaybackState', 'prohibido_escuchar_musica'); // Guardar el estado de reproducción
        localStorage.removeItem('audioProgress'); // Eliminar el progreso de reproducción
    }

    // Establecer el estado del botón de reproducción cuando el audio se inicia automáticamente
    audio.addEventListener('playing', function () {
        updatePlayButton(true);
    });

    // Establecer el estado del botón de reproducción cuando el audio se pausa automáticamente
    audio.addEventListener('pause', function () {
        updatePlayButton(false);
    });

    // Agregar evento de clic al botón de reproducción
    playButton.on('click', function () {
        if (audio.paused) {
            playAudio();
        } else {
            pausadoForzado();
        }
    });

    // Agregar evento de clic al botón de parada
    stopButton.on('click', function () {
        stopAudio();
    });

    // Función para actualizar el estilo del botón de reproducción según el estado del audio
    function updatePlayButton(isPlaying) {
        if (isPlaying) {
            playButton.css('background-image', 'url(assets/images/iconos/icono_pause_2.png)'); // Cambiar el fondo a la imagen de pausa
        } else {
            playButton.css('background-image', 'url(assets/images/iconos/icono_play_1.png)'); // Cambiar el fondo a la imagen de reproducción
        }
    }

    // Recuperar el estado de reproducción almacenado en el almacenamiento local
    let playbackState = localStorage.getItem('audioPlaybackState');
    if (playbackState === 'escuchando_musica') {
        playAudio(); // Si el estado de reproducción estaba en "escuchando_musica", iniciar la reproducción
    } else if (playbackState === 'musica_pausada') {
        let storedProgress = localStorage.getItem('audioProgress'); // Obtener el progreso de reproducción almacenado
        if (storedProgress) {
            audio.currentTime = parseFloat(storedProgress); // Restaurar el progreso de reproducción
        }
        pauseAudio(); // Pausar la reproducción
    }

    // Detectar cuando se está a punto de abandonar la página
    $(window).on('beforeunload', function () {
        // Verificar si el estado de reproducción es "escuchando_musica"
        let playbackState = localStorage.getItem('audioPlaybackState');
        if (playbackState === 'escuchando_musica') {
            // Pausar el audio y guardar el estado de reproducción en el almacenamiento local
            pauseAudio();
        }
    });
    // Verificar el estado de reproducción al cargar una nueva vista
    $(window).on('load', function () {
        let playbackState = localStorage.getItem('audioPlaybackState');
        console.log("playbackState : ", playbackState);
        if (playbackState === 'escuchando_musica') {
            playAudio(); // Si el estado de reproducción estaba en "escuchando_musica", iniciar la reproducción
        } else if (playbackState === 'musica_pausada') {
            let storedProgress = localStorage.getItem('audioProgress'); // Obtener el progreso de reproducción almacenado
            if (storedProgress) {
                audio.currentTime = parseFloat(storedProgress); // Restaurar el progreso de reproducción
            }
            playAudio(); // Reproducir la música desde el último punto de pausa
        } else if (playbackState === 'musica_pausada_por_cliente') {
            pauseAudio();
        }
        else if (playbackState === 'prohibido_escuchar_musica') {
            stopAudio();
        } else {
            pauseAudio(); // Pausar la reproducción si el estado es desconocido
        }
    });

});
