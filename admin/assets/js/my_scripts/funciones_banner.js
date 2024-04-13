$(document).ready(function () {
  console.log("FUNCIONES BANNER");
  $(".image-popup-link").magnificPopup({
    type: "image",
  });
});

function guardar_banner() {
  // Obtener los valores de los campos del formulario

  let fechaInicio = $("#fecha_inicio").val();
  let fechaFin = $("#fecha_fin").val();
  let texto = $("#texto").val();
  let elementosWeb = $("#elementos_web").val();
  let bannerEscritorio = $("#banner_escritorio")[0].files[0];
  let bannerMovil = $("#banner_movil")[0].files[0];
  let selectOrden = $("#select_orden").val();
  let link = $("#link").val();
  let mostrarTemporizador = 0;

  // Crear un objeto FormData

  let formData = new FormData();

  if ($("#mostrar_temporizador").is(":checked")) {
    mostrarTemporizador = 1;
  }

  // Agregar los datos al objeto FormData

  formData.append("fechaInicio", fechaInicio);
  formData.append("fechaFin", fechaFin);
  formData.append("texto", texto);
  formData.append("elementosWeb", elementosWeb);
  formData.append("selectOrden", selectOrden);
  formData.append("link", link);
  formData.append("mostrarTemporizador", mostrarTemporizador);

  if (bannerEscritorio) {
    formData.append("bannerEscritorio", bannerEscritorio);
  }

  if (bannerMovil) {
    formData.append("bannerMovil", bannerMovil);
  }

  formData.append("accion", "nuevo_banner");

  // Realizar la petición AJAX

  $.ajax({
    url: "/admin/controlador/ajax/funciones_banner.php",
    type: "POST",
    data: formData,
    accion: "nuevo_banner",
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(response);
      let respuesta = JSON.parse(response);
      if (respuesta) {
        console.log("nuevo_banner", respuesta);
        if (respuesta.status != "success") {
          Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
            icon: "error",
          });
        } else {
          window.location.reload();
        }
      }
    },
    error: function (error) {
      console.error("error", error);
    },
  });
}

function modificar_estado_banner(banner_id, ref_elemento_id) {
  let estado = 0;
  if ($(`#check_activo_banner_${banner_id}`).is(":checked")) estado = 1;

  let data = {
    id: banner_id,
    estado: estado,
    ref_elemento_id: ref_elemento_id,
  };
  console.log("data", data);
  $.post(
    "/admin/controlador/ajax/funciones_banner.php",
    {
      data: data,
      accion: "modificar_estado_banner",
    },
    function (response) {
      console.log("response modificar_estado_banner", response);
      let respuesta = JSON.parse(response);
      if (respuesta) {
        console.log("Respuesta modificar_estado_banner", respuesta);
        let status = respuesta.status;
        let modificado = respuesta.modificado;
        let estado = respuesta.estado;

        if (status == "success") {
          Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>El banner esta ${
              estado == 1 ? "Activado" : "Desactivado"
            }</strong></h4>`,
            icon: "success",
          });
        }
        if (status == "error" || modificado == false) {
          Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>No ha sido posible modificar el estado del banner</strong></h4>`,
            icon: "error",
          });
        }
      }
    }
  );
}

function modificar_banner(id) {
  console.log("modificar_estado_banner", id);

  Swal.fire({
    html: `<h4 style="margin-top:25px"><strong>¿ Seguro que quieres modificar ?</strong></h4>`,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Modificar",
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
    }
  });
}

function fn_eliminar_banner(id) {
  console.log("eliminar_banner", id);

  Swal.fire({
    html: `<h4 style="margin-top:25px"><strong>¿ Seguro que quieres eliminar ?</strong></h4>`,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Eliminar",
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "/admin/controlador/ajax/funciones_banner.php",
        {
          accion: "eliminar_banner",
          banner_id: id,
        },
        function (result) {
          let respuesta = JSON.parse(result);
          if (respuesta) {
            if (respuesta.status != "success") {
              Swal.fire({
                html: `<h4 style="margin-top:25px"><strong>No ha sido posible eliminar el  banner</strong></h4>`,
                icon: "error",
              });
            } else {
              Swal.fire({
                html: `<h4 style="margin-top:25px"><strong>Banner eliminado con exito</strong></h4>`,
                icon: "success",
              });
              $(`#tr_banner_${id}`).hide();
            }
          }
        }
      );
    }
  });
}
