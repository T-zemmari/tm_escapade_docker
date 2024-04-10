<style>
    .custom_text_font_size {
        font-size: 13px;
    }

    #name::placeholder {
        font-size: 12px;
    }

    #email::placeholder {
        font-size: 12px;
    }

    #phone::placeholder {
        font-size: 12px;
    }

    #subject::placeholder {
        font-size: 12px;
    }

    #message::placeholder {
        font-size: 12px;
    }

    #fecha_ini::placeholder {
        font-size: 12px;
    }

    #fecha_fin::placeholder {
        font-size: 12px;
    }

    #asunto::placeholder {
        font-size: 12px;
    }

    #total_ninyos_menores_de_12::placeholder {
        font-size: 12px;
    }

    #total_viajeros::placeholder {
        font-size: 12px;
    }

    input[type="date"] {
        font-size: 12px;
    }

    .custom-class-p {
        margin: 0px !important;
    }

    .contendor-info-contact {
        /* border-right: 1px solid #dee2e6;
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6; */
        padding: 30px;

    }

    .contenedor_formulario_contacto {
        background-image: url('assets/images/custom_img/bk_ground_10.jpg');
    }

    .custom_todo_blanco {
        color: #fff !important;
    }


    @media(max-width:748px) {
        .contenedor_formulario_contacto {
            min-height: 220vh;
        }

        .custom-style-button-contacto-enviar {
            width: 100% !important;
        }
    }
</style>

<div class="contact_section">
    <?php if ($mensaje_enviar_email != '') : ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="alert <?= $email_error ? 'alert-danger' : 'alert-success' ?>"><?= $mensaje_enviar_email ?></div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <section class="py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-4 gy-md-5 gy-lg-0 align-items-md-center">
                <div class="col-12 col-lg-6">
                    <div class="border overflow-hidden">

                        <form method="post" id="formulario_presupuesto">
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label for="name" class="form-label custom_todo_blanco">Nombre completo | razon social <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom_text_font_size" id="name" placeholder="Nombre" name="name" required value="<?= $_POST['name'] ?? '' ?>">
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label for="email" class="form-label mt-2 custom_todo_blanco">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control custom_text_font_size" id="email" placeholder="Correo Electrónico" name="email" required value="<?= $_POST['email'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label mt-2 custom_todo_blanco">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                            </svg>
                                        </span>
                                        <input type="tel" class="form-control custom_text_font_size" id="phone" placeholder="Número de Teléfono" name="phone" required value="<?= $_POST['phone'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="asunto" class="form-label mt-2 custom_todo_blanco">Asunto <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom_text_font_size" readonly id="asunto" name="asunto" placeholder="Asunto" required value="<?= $_GET['referencia'] ?? '' ?>">
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label mt-2 custom_todo_blanco">Mensaje <span class="text-danger">*</span></label>
                                    <textarea class="form-control custom_text_font_size" id="message" rows="3" id="comment" name="message" placeholder="Mensaje" required><?= $_POST['message'] ?? '' ?></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="" class="form-label mt-2 custom_todo_blanco">Fecha prevista para el viaje<span class="text-danger">:</span></label>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <label for="fecha_desde" class="form-label mt-2 custom_todo_blanco">Desde<span class="text-danger"></span></label>
                                    <input type="date" class="form-control custom_text_font_size" placeholder="" id="fecha_desde" name="fecha_desde" value="<?= $_POST['fecha_desde'] ?? '' ?>">
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <label for="fecha_hasta" class="form-label mt-2 custom_todo_blanco">Hasta<span class="text-danger"></span></label>
                                    <input type="date" class="form-control custom_text_font_size" placeholder="" id="fecha_hasta" name="fecha_hasta" value="<?= $_POST['fecha_hasta'] ?? '' ?>">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label mt-2 custom_todo_blanco">Viajeros<span class="text-danger">:</span></label>

                                </div>
                                <div class="col-xl-6 col-md-12 col-sm-12">
                                    <label for="total_viajeros" class="form-label mt-2 custom_todo_blanco">Total viajeros<span class="text-danger"></span></label>
                                    <input type="number" class="form-control custom_text_font_size" id="total_viajeros" placeholder="Total viajeros" name="total_viajeros" value="<?= $_POST['total_viajeros'] ?? '' ?>">
                                </div>
                                <div class="col-xl-6 col-md-12 col-sm-12">
                                    <label for="total_ninyos_menores_de_12" class="form-label mt-2 custom_todo_blanco">Total menores de 12 años<span class="text-danger"></span></label>
                                    <input type="numbre" class="form-control custom_text_font_size" id="total_ninyos_menores_de_12" placeholder="Menores de 12 años" name="total_ninyos_menores_de_12" value="<?= $_POST['total_niños_menores_de_12'] ?? '' ?>">
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-success btn-sm custom-style-button-contacto-enviar" style="width:100%;margin-top:10px;border:black 1px solid ;border-radius:unset !important" name="enviar_email" onclick="enviar_datos_presupuesto()">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-12 col-lg-6 contendor-info-contact">
                    <div class="row justify-content-xl-center">
                        <div class="col-12 col-xl-11">
                            <div class="row mb-sm-4 mb-md-5 mt-5">
                                <div class="col-12 col-sm-6">
                                    <div class="mb-4 mb-sm-0">
                                        <div class="mb-3 text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="mb-2 custom_todo_blanco">Teléfono</h4>
                                            <p class="mb-2 custom-class-p custom_todo_blanco">Puede llamarnos directamente.</p>
                                            <hr class="w-75 mb-3 border-dark-subtle">
                                            <p class="mb-0 custom-class-p">
                                                <a class="link-secondary text-decoration-none custom_todo_blanco" href="tel:+34670645462">(+34) 670645462</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="mb-4 mb-sm-0">
                                        <div class="mb-3 text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                                                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="mb-2 custom_todo_blanco">Email</h4>
                                            <p class="mb-2 custom-class-p custom_todo_blanco">O si prefiere puede escribirnos.</p>
                                            <hr class="w-75 mb-3 border-dark-subtle">
                                            <p class="mb-0 custom-class-p">
                                                <a class="link-secondary text-decoration-none custom_todo_blanco" href="mailto:info@tmescapade.com">info@tmescapade.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-3 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z" />
                                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="mb-2 custom_todo_blanco">Nuestro horario</h4>
                                    <p class="mb-2 custom_todo_blanco">Explore nuestras horas de atención comercial.</p>
                                    <hr class="w-50 mb-3 border-dark-subtle">
                                    <div class="d-flex mb-1">
                                        <p class="text-secondary fw-bold mb-0 me-5 custom_todo_blanco">Lun - Vie</p>
                                        <p class="text-secondary mb-0 custom_todo_blanco">9am - 5pm</p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-secondary fw-bold mb-0 me-5 custom_todo_blanco">Sab - Dom</p>
                                        <p class="text-secondary mb-0 custom_todo_blanco">9am - 2pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>