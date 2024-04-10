<style>
    .custom-file-upload {
        display: inline-block;
        font-size: 12px;
    }

    .file-input {
        display: none;
    }

    .file-label {
        background-color: #4CAF50;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    .file-input:hover+.file-label {
        background-color: #45a049;
    }

    .vista-previa {
        margin-top: 10px;
    }

    .vista-previa img,
    .vista-previa video {
        max-width: 100%;
        height: auto;
    }
</style>

<div id="kt_app_content_container" class="app-container container-fluid" style="height:100vh;min-height: 100vh;">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" onkeyup="filtrar_por_nombre()" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" id="buscar_elemento_por_nombre" placeholder="Buscar">
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_stacked_1">
                        Añadir un nuevo elemento
                    </button>
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.8906px;">
                                    <!--<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1">
                                    </div>-->
                                </th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 172.5px;">Nombre</th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 172.5px;">Elemento ref id</th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 213.438px;">Elemento ref clase</th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1" aria-label="Payment Method: activate to sort column ascending" style="width: 172.5px;">Tipo</th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1" aria-label="Created Date: activate to sort column ascending" style="width: 224.047px;">lugar_web</th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1" aria-label="Created Date: activate to sort column ascending" >Estado</th>
                                <!-- <th class="text-end min-w-70px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 132.531px;">Acciones</th>-->
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            <?php if (count($info_elementos) > 0) :
                                foreach ($info_elementos as $elemento) :

                            ?>
                                    <tr class="odd filtrar_elementos" nombre="<?php echo $elemento['titulo_elemento'] ?? '' ?>">
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" elemento_id="<?php echo $elemento['id'] ?? '' ?>" type="checkbox" value="1" id="check_box_elemento_<?php echo $elemento['id'] ?? '' ?>" onclick="mostrar_tr_elemento_anidado('<?php echo $elemento['id'] ?? '' ?>')">
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $elemento['titulo_elemento'] ?? '' ?>
                                        </td>
                                        <td>
                                            <?php echo $elemento['ref_elemento_id'] ?? '' ?>
                                        </td>
                                        <td>
                                            <?php echo $elemento['ref_elemento_clase'] ?? '' ?>
                                        </td>
                                        <td>
                                            <?php echo $elemento['tipo'] ?? '' ?>
                                        </td>
                                        <td>
                                            <?php echo $elemento['lugar_web'] ?? '' ?>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                                <input class="form-check-input" onchange="modificar_estado_elemento('<?php echo $elemento['id'] ?? '' ?>')" id="check_activo_elemento_<?php echo $elemento['id'] ?? '' ?>" type="checkbox" value="" <?php echo isset($elemento['activo']) && $elemento['activo']  ? 'checked' : '' ?> />
                                            </div>
                                        </td>
                                        <!--<td><?php echo isset($elemento['created_at']) ? explode(' ', $elemento['created_at'])[0]  : '' ?></td>-->

                                        <!--<td class="text-end">
                                            <button type="button" class=" btn btn-danger btn-sm px-3" onclick="eliminar_elemento('<?php echo $elemento['id'] ?? '' ?>')">Eliminar</button>
                                        </td>-->
                                    </tr>
                                    <tr class="tr-anidado-elemento-contenido" id="tr_anidado_elemento_<?php echo $elemento['id'] ?? '' ?>" style="display:none" elementoid="<?php echo $elemento['id'] ?? '' ?>">
                                        <td colspan="12">
                                            <div class="container">
                                                <form id="mostrar_info_elemento_media_<?php echo $elemento['id'] ?? '' ?>" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-7">
                                                            <label class="required fs-6 fw-semibold mb-2">Contenido <?php echo $elemento['titulo_elemento'] ?? '' ?></label>
                                                            <?php if ($elemento['tipo'] == 'texto') : ?>
                                                                <div class="py-5" data-bs-theme="light">
                                                                    <textarea class="form-control" id="text_area_tabla_elemento_<?php echo $elemento['id'] ?? '' ?>" name="text_area_tabla_elemento" style="width:100%" rows="8"><?php echo $elemento['contenido'] ?? '' ?></textarea>
                                                                </div>
                                                            <?php elseif ($elemento['tipo'] == 'img') : ?>
                                                                <div class="preview-container" style="cursor:pointer;width: 100px;" onclick="fn_modificar_archivo('<?php echo $elemento['id'] ?? '' ?>','img')">
                                                                    <img id="img_src_elemento_<?php echo $elemento['id'] ?? '' ?>" src="<?php echo $elemento['contenido'] ?? ''; ?>" alt="Imagen" class="preview-image" style="width:100%" />
                                                                </div>
                                                            <?php elseif ($elemento['tipo'] == 'video') : ?>
                                                                <div class="preview-container" style="cursor:pointer;" onclick="fn_modificar_archivo('<?php echo $elemento['id'] ?? '' ?>','video')">
                                                                    <!-- Aquí puedes agregar un reproductor de video, por ejemplo: -->
                                                                    <video width="80" height="80" controls>
                                                                        <source id="video_src_elemento_<?php echo $elemento['id'] ?? '' ?>" src="<?php echo $elemento['contenido'] ?? ''; ?>" type="video/mp4">
                                                                        Tu navegador no admite el elemento de video.
                                                                    </video>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                    <?php if ($elemento['tipo'] == 'texto') : ?>
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <button type="button" class="btn btn-success btn-sm" onclick="editar_contenido_elemento('<?php echo $elemento['id'] ?? '' ?>')">Guardar contenido</button>

                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                            <?php
                                endforeach;
                            endif ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form id="elemento_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Formulario elemento web</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-4 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Es un banner</label>
                                    <select class="required form-select form-select-solid" name="select_es_banner" id="select_es_banner">
                                        <option value="">Seleccionar tipo</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Nombre</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Nombre del elemento" name="nombre_elemento" id="nombre_elemento">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Identificador</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ref o id del elemento" name="ref_elemento_id" id="ref_elemento_id">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Clase</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Clase del elemento" name="ref_elemento_clase" id="ref_elemento_clase">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Tipo</label>
                                    <select class="required form-select form-select-solid" name="select_tipo" id="select_tipo" onchange="mostrar_campos_segun_tipo()">
                                        <option value="">Seleccionar tipo</option>
                                        <option value="texto">Tag texto</option>
                                        <option value="img">Tag imagen</option>
                                        <option value="video">Tag video</option>
                                        <!--<option value="div_neutro">Tag div neutro</option>-->
                                    </select>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Estado</label>
                                    <select class="form-select form-select-solid" name="select_estado" id="select_estado">
                                        <option value="">Seleccionar estado</option>
                                        <option value="1">Activo</option>
                                        <option value="0" selected>No activo</option>
                                    </select>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Lugar WEB</label>
                                    <select class="form-select form-select-solid" name="select_lugar_web" id="select_lugar_web">
                                        <option value="">Seleccionar vista</option>
                                        <option value="portada">Portada</option>
                                        <option value="blog">Blog</option>
                                        <option value="servicios">Servicios</option>
                                        <option value="sobre_nosotros">Sobre nosotros</option>
                                        <option value="contacto">Contacto</option>
                                    </select>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row elemento-texto" style="display: none;">
                                <div class="col-md-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Contenido de Texto</label>
                                    <textarea class="form-control" id="text_area_elemento_html" name="text_area_elemento_html" style="width:100%" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="row elemento-imagen" style="display: none;">
                                <div class="col-md-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2 d-block">Subir Imagen</label>
                                    <div class="custom-file-upload">
                                        <label for="campo_imagen" class="file-label">Seleccionar archivo</label>
                                        <input type="file" id="campo_imagen" class="file-input" name="campo_imagen" accept="image/*">
                                    </div>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                    <div class="vista-previa" id="vista_previa_imagen"></div>
                                </div>
                            </div>

                            <div class="row elemento-video" style="display: none;">
                                <div class="col-md-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2 d-block">Subir Video</label>
                                    <div class="custom-file-upload">
                                        <label for="campo_video" class="file-label">Seleccionar archivo</label>
                                        <input type="file" id="campo_video" class="file-input" name="campo_video" accept="video/*">
                                    </div>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                    <div class="vista-previa" id="vista_previa_video"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success btn-sm" onclick="guardar_nuevo_elemento()">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





</div>