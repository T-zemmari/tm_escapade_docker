<style>
    .container_custom_guirep {
        width: 180px;
        height: 180px;
        background: #0f117a;
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #app_custom_guirep {
        width: 80px;
        height: 80px;
        position: relative;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    #app_custom_guirep:active {
        transform: scale(0.9);
    }

    .pause_custom_guirep,
    .play_custom_guirep {
        width: 100%;
        height: 100%;
        cursor: pointer;
        position: absolute;
    }

    .line {
        position: absolute;
        width: 6px;
        height: 50%;
        background: #ffffff;
        border-radius: 5px;
        transition: all 400ms cubic-bezier(0.8, 0, 0.33, 1);
    }

    .pause_custom_guirep .line_1 {
        margin: 25% 0;
        left: 28%;
    }

    .pause_custom_guirep .line_2 {
        margin: 100% -16%;
        right: 45%;
        transition-delay: 200ms;
    }

    .pause_custom_guirep.active .line {
        opacity: 1;
    }

    .pause_custom_guirep.active .line_1 {
        margin: 25% 0;
        left: 28%;
    }

    .pause_custom_guirep.active .line_2 {
        margin: 25% 0;
        right: 28%;
    }

    .play_custom_guirep .line {
        margin: 25% 0;
    }

    .play_custom_guirep .line_1 {
        left: 28%;
    }

    .play_custom_guirep .line_2 {
        height: 56%;
        left: 60%;
        transform: rotate(-55deg) translateY(-128px) translateX(16px);
        transition-delay: 100ms;
    }

    .play_custom_guirep .line_3 {
        height: 56%;
        left: 60%;
        transform: rotate(55deg) translateY(-128px) translateX(16px);
        transition-delay: 200ms;
    }

    .play_custom_guirep.active .line {
        opacity: 1;
        height: 62%;
        margin: 20% 0;
    }

    .play_custom_guirep.active .line_1 {
        left: 28%;
        transform: translateY(-2px);
    }

    .play_custom_guirep.active .line_2 {
        height: 56%;
        left: 63%;
        transform: rotate(-55deg) translateY(-16.5px) translateX(2px);
    }

    .play_custom_guirep.active .line_3 {
        height: 56%;
        left: 63%;
        transform: rotate(55deg) translateY(16px) translateX(2px);
    }
</style>

<div class="container_custom_guirep">
    <div id="app_custom_guirep">
        <div class="pause_custom_guirep">
            <div class="line line_1"></div>
            <div class="line line_2"></div>
        </div>
        <div class="play_custom_guirep active">
            <div class="line line_1"></div>
            <div class="line line_2"></div>
            <div class="line line_3"></div>
        </div>
    </div>
</div>

<script>
    let pause_custom_guirep = document.querySelector('.pause_custom_guirep');
    let play_custom_guirep = document.querySelector('.play_custom_guirep');
    let btn = document.querySelector('#app_custom_guirep');

    btn.addEventListener('click', () => {
        if (play_custom_guirep.classList.contains("active")) {
            play_custom_guirep.classList.remove("active");
            pause_custom_guirep.classList.add("active");
        } else {
            pause_custom_guirep.classList.remove("active");
            play_custom_guirep.classList.add("active");
        }
    })
</script>