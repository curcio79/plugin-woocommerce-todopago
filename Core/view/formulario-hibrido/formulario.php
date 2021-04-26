<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
$urlPath = dirname( plugins_url().'/'.plugin_basename( __FILE__ ) ).'/';


?>
<link href="<?php echo $urlPath.'/flexbox.css'; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo $urlPath.'/form_todopago.css'; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo $urlPath.'/queries.css'; ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $urlPath.'/script-min.js'; ?>"></script>


<div class="progress">
    <div class="progress-bar progress-bar-striped active" id="loading-hibrid">
    </div>
</div>

<div class="tp_wrapper" id="tpForm">
    <section class="tp-total tp-flex">
        <div>
            <strong>Total a pagar $<?php echo $amount; ?></strong>
        </div>
        <div>
            Elegí tu forma de pago
        </div>
    </section>

    <section class="billetera_virtual_tp tp-flex tp-flex-responsible">
        <div class="tp-flex-grow-1 tp-bloque-span texto_ccbilletera_virtual text_size_billetera">
            <p>Pagá con tu <strong>Billetera Virtual Todo Pago</strong></p>
            <p>y evitá cargar los datos de tu tarjeta</p>
        </div>
        <div class="tp-flex-grow-1 tp-bloque-span">
            <button id="btn_billetera" title="Iniciar Sesión" class="tp_btn tp_btn_sm text_size_billetera">
                Iniciar Sesión
            </button>
        </div>
    </section>

    <section class="billeterafm_tp">
        <div class="field field-payment-method">
            <label for="formaPagoCbx" class="text_small">Forma de Pago</label>
            <div class="input-box">
                <select id="formaPagoCbx" class="tp_form_control"></select>
                <label class="tp-error" id="formaPagoCbxError"></label>
            </div>
        </div>
    </section>

    <section class="billetera_tp" id="tp-tarjetas">
        <div class="tp-row">
            <p>
                Con tu tarjeta de crédito o débito
            </p>
        </div>
        <!-- Número de tarjeta y banco -->
        <div class="tp-bloque-full tp-flex tp-flex-responsible tp-main-col">
            <!-- Tarjeta -->
            <div class="tp-flex-grow-1">
                <label for="numeroTarjetaTxt" class="text_small">Número de Tarjeta</label>
                <input id="numeroTarjetaTxt" class="tp_form_control" maxlength="19" title="Número de Tarjeta"
                       min-length="14" autocomplete="off">
                <img src="<?php echo $form_dir; ?>/images/empty.png" id="tp-tarjeta-logo"
                     alt=""/>
                <!-- <span class="error" id="numeroTarjetaTxtError"></span> -->
                <label id="numeroTarjetaLbl" class="tp-error"></label>
            </div>
            <!-- Banco -->
            <div class="tp-flex-grow-1">
                <label for="bancoCbx" class="text_small">Banco</label>
                <select id="bancoCbx" class="tp_form_control" placeholder="Selecciona banco"></select>
                <span class="tp-error" id="bancoCbxError"></span>
            </div>
            <div class="tp_col tp-bloque-span payment-method">
                <label for="medioPagoCbx" class="text_small">Medio de Pago</label>
                <select id="medioPagoCbx" class="tp_form_control" placeholder="Mediopago"></select>
                <span class="tp-error" id="medioPagoCbxError"></span>
            </div>
        </div>
        <div class="tp-row tp-bloque-full tp-flex tp-flex-responsible tp-main-col" id="pei-block">
            <section class="tp-row" id="peibox">
                <label id="peiLbl" for="peiCbx" class="text_small right">Pago con PEI</label>
                <label class="switch" id="switch-pei">
                    <input type="checkbox" id="peiCbx">
                    <span class="slider round"></span>
                    <span id="slider-text"></span>
                </label>
            </section>
        </div>

        <!--div class="tp_row">
            <div class="tp_col tp-bloque-span">
                <label for="medioPagoCbx" class="text_small">Medio de Pago</label>
                <select id="medioPagoCbx" class="tp_form_control" placeholder="Mediopago"></select>
                <span class="error" id="medioPagoCbxError"></span>
            </div>
        </div-->

        <!-- Vencimiento + DNI-->
        <div class="tp-bloque-full tp-flex tp-flex-row tp-flex-responsible tp-flex-space-between tp-main-col">
            <!-- vencimiento -->
            <div class="tp-flex-grow-1 tp-flex tp-flex-col">
                <!-- títulos -->
                <div class="tp-row tp-flex tp-flex-space-between tp-title">
                    <div class="tp-flex-grow-1">
                        <label for="mesCbx" class="text_small">Vencimiento</label>
                    </div>
                    <div class="tp-flex-grow-1 tp-title-right">
                        <label for="codigoSeguridadTxt" class="text_small"></label>
                    </div>
                    <div class="tp-flex-grow-1 tp-title-right">
                        <label id="codigoSeguridadTexto" for="codigoSeguridadTxt" class="text_small">Código de
                            Seguridad</label>
                    </div>
                </div>
                <!-- inputs -->
                <div class="tp-row tp-flex tp-flex-space-between tp-input-row" id="tp-inputs-card">
                    <div class="tp-flex-grow-1">
                        <select id="mesCbx" maxlength="2" class="tp_form_control" placeholder="Mes"></select>
                    </div>
                    <div class="tp-flex-grow-1">
                        <select id="anioCbx" maxlength="2" class="tp_form_control"></select>
                    </div>
                    <div class="tp-flex-grow-1">
                        <input id="codigoSeguridadTxt" class="tp_form_control" maxlength="4"
                               autocomplete="off"/>
                    </div>
                    <div class="tp-cvv-helper-container">
                        <div class="tp-anexo clave-ico" id="tp-cvv-caller"></div>
                        <div id="tp-cvv-helper">
                            <p>
                                Para Visa, Master, Cabal y Diners, los 3 dígitos se encuentran en el
                                <strong>dorso</strong>
                                de
                                tu tarjeta. (izq)
                            </p>
                            <p>
                                Para Amex, los 4 dígitos se encuentran en el frente de tu tarjeta. (der)
                            </p>
                            <img id="tp-cvv-helper-img" alt="ilustración tarjetas"
                                 src="<?php echo $form_dir; ?>/images/clave-ej.png">
                        </div>
                    </div>
                </div>
                <!-- warnings -->
                <div class="tp-row tp-flex tp-error-title">
                    <label id="fechaLbl" class="left tp-error"></label>
                    <label class="left tp-error"></label>
                    <label id="codigoSeguridadLbl" class="left tp-label spacer tp-error"></label>
                </div>
            </div>
            <!-- DNI -->
            <div class="tp-flex-grow-1 tp-flex tp-flex-col">
                <!-- títulos -->
                <div class="tp-row tp-flex tp-flex-space-between tp-title">
                    <div class="tp-flex-1">
                        <label for="tipoDocCbx" class="text_small">Tipo</label>
                    </div>
                    <div class="tp-flex-3 tp-title-right">
                        <label id="tp-dni-numero-title" for="NumeroDocCbx" class="text_small">Número</label>
                    </div>
                </div>
                <!-- inputs -->
                <div class="tp-row tp-flex tp-input-row">
                    <div class="tp-flex-1">
                        <select id="tipoDocCbx" class="tp_form_control"></select>
                    </div>
                    <div class="tp-flex-3" id="tp-dni-numero">
                        <input id="nroDocTxt" maxlength="10" type="text" class="tp_form_control"
                               autocomplete="off"/>
                    </div>
                </div>
                <!-- warnings -->
                <div class="tp-row tp-flex tp-error-title">
                    <label class="tp-error tp-flex-1"></label>
                    <label class="tp-error tp-flex-3" id="nroDocLbl"></label>
                </div>
            </div>
        </div>


        <!-- Nombre y Apellido, y Mail -->
        <div class="tp-bloque-full tp-flex tp-flex-responsible tp-main-col">
            <!-- Nombre y Apellido -->
            <div class="tp-flex-grow-1 tp-flex tp-flex-col">
                <!-- títulos -->
                <div class="tp-row tp-flex tp-flex-space-between tp-title">
                    <label for="nombreTxt" class="text_small">Nombre y Apellido</label>
                </div>
                <!-- inputs -->
                <div class="tp-row tp-flex tp-input-row">
                    <input id="nombreTxt" class="tp_form_control" autocomplete="off" placeholder="" maxlength="50">
                </div>
                <!-- warnings -->
                <div class="tp-row tp-flex tp-error-title">
                    <label id="nombreLbl" class="tp-error"></label>
                </div>
            </div>
            <div class="tp-flex-grow-1 tp-flex tp-flex-col">
                <!-- títulos -->
                <div class="tp-row tp-flex tp-title">
                    <label for="emailTxt" class="text_small">Email</label>
                </div>
                <!-- inputs -->
                <div class="tp-flex-grow-1">
                    <input id="emailTxt" type="email" class="tp_form_control tp-input-row"
                           placeholder="nombre@mail.com"
                           data-mail=""
                           autocomplete="off"/>
                </div>
                <!-- warnings -->
                <div class="tp-row tp-flex tp-error-title">
                    <label id="emailLbl" class="left tp-label spacer tp-error"></label>
                </div>
            </div>
        </div>

        <!-- Cantidad de cuotas y CFT -->
        <div class="tp-bloque-full tp-flex tp-flex-responsible tp-main-col">
            <!-- Cantidad de cuotas -->
            <div class="tp-flex-grow-1 tp-flex tp-flex-col">
                <!-- titulos -->
                <div class="tp-row tp-flex tp-flex-space-between tp-title">
                    <label for="promosCbx" class="text_small">Cantidad de cuotas</label>
                </div>
                <!-- inputs -->
                <div class="tp-row tp-flex tp-input-row">
                    <select id="promosCbx" class="tp_form_control"></select>
                </div>
                <!-- errores -->
                <div class="tp-row">
                    <div class="tp-flex-grow-1">
                        <label class="tp-error" id="promosCbxError"></label>
                    </div>
                </div>
            </div>
            <!--  CFT -->
            <div class="tp-flex-grow-1 tp-flex tp-flex-col">
                <!-- títulos -->
                <div class="tp-row tp-flex tp-flex-space-between tp-title">
                    <label></label>
                </div>
                <!-- select -->
                <div class="tp-row tp-input-row">
                    <div class="promos-lbl-container tp-flex">
                        <label id="promosLbl" class="left"></label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Token de PEI -->
        <div class="tp-bloque-full tp-flex tp-flex-responsible tp-main-col">
            <div class="tp-flex-grow-1">
                <label id="tokenPeiLbl" for="tokenPeiTxt" class="text_small"></label>
                <input id="tokenPeiTxt" class="tp_form_control tp-input-row"/>
            </div>
            <div class="tp-flex-grow-1">
            </div>
        </div>

        <!-- Pagar -->
        <div class="tp_row">
            <div class="tp_col tp_span_2_of_2">
                <button id="btn_ConfirmarPago" class="tp_btn" title="Pagar" class="button"><span>Pagar</span>
                </button>
            </div>
            <div class="tp_col tp_span_2_of_2">
                <div class="confirmacion">
                    Al confirmar el pago acepto los <a
                            href="https://www.todopago.com.ar/terminos-y-condiciones-comprador" target="_blank"
                            title="Términos y Condiciones" id="tycId"
                            class="tp_color_text">Términos
                        y Condiciones</a> de Todo Pago.
                </div>
            </div>
        </div>
    </section>
    <div class="tp_row">
        <div id="tp-powered">
            Powered by <img id="tp-powered-img" src="<?php echo $form_dir; ?>/images/tp_logo_prod.png"/>
        </div>
    </div>
</div>


<script language="javascript">
    var tpformJquery = $.noConflict();
    var urlScript = "<?php echo $env_url; ?>";
    //securityRequesKey, esta se obtiene de la respuesta del SAR
    var urlSuccess = "<?php echo $return_URL_SUCCESS ?>";
    var urlError = "<?php echo $return_URL_ERROR?>";
    var security = "<?php echo $responseSAR->PublicRequestKey; ?>";
    var mail = "<?php echo $email; ?>";
    var completeName = "<?php echo $nombre_completo; ?>";
    var defDniType = 'DNI';
    var medioDePago = document.getElementById('medioPagoCbx');
    var tarjetaLogo = document.getElementById('tp-tarjeta-logo');
    var poweredLogo = document.getElementById('tp-powered-img');
    var numeroTarjetaTxt = document.getElementById('numeroTarjetaTxt')
    var btnBilletera = document.getElementById('btn_billetera');
    var todoPagoSection = document.getElementById('tp-tarjetas');
    var poweredLogoUrl = "<?php echo $form_dir;?>/images/";
    var emptyImg = "<?php echo $form_dir;?>/images/empty.png";
    var peiCbx = tpformJquery("#peiCbx");
    var switchPei = tpformJquery("#switch-pei");
    var sliderText = tpformJquery("#slider-text");
    var helperCaller = tpformJquery("#tp-cvv-caller");
    var helperPopover = tpformJquery("#tp-cvv-helper");
    var tipoDePago = "<?php echo $paymentMethod; ?>"


</script>
<script type="text/javascript" src="<?php echo "$urlPath/code-min.js"; ?>"></script>
