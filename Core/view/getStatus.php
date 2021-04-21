<?php
#if ( ! defined( 'ABSPATH' ) ) exit;

require_once( "../vendor/autoload.php" );

use TodoPago\Sdk;

$merchant = sanitize_text_field($_POST['merchant']);

$modo = sanitize_text_field($_POST['modo']);

$operationId = sanitize_text_field(strval( $_POST['id'] ));

$stylesheet = sanitize_text_field($_POST['css']);

$merchantId = sanitize_text_field($merchant['merchantId']);

http_response_code( 200 );

$http_header    = $merchant['httpHeader'];
$header_decoded = json_decode( html_entity_decode( $http_header, true ) );
$http_header    = ( ! empty( $header_decoded ) ) ? $header_decoded : array( "authorization" => $http_header );

$connector = new Sdk( $http_header, $modo );

//opciones para el método getStatus 
$optionsGS = array( 'MERCHANT' => $merchantId, 'OPERATIONID' => $operationId );

$status = $connector->getStatus( $optionsGS );

if ( array_key_exists( 'Operations', $status ) ) {
	$refunds = $status['Operations']['REFUNDS'];
}

if ( isset( $refunds ) ) {
	$auxArray = array(
		"REFUND" => $refunds
	);
}
$auxColection = '';
if ( isset( $refunds ) && $refunds !== null ) {
	$aux          = 'REFUND';
	$auxColection = 'REFUNDS';
}

$rta = '<table>';
if ( isset( $status['Operations'] ) && is_array( $status['Operations'] ) ) {
	$rta .= printGetStatus( $status['Operations'] );
} else {
	$rta .= '<tr><td>No hay operaciones para esta orden.<td></tr>';
}
$rta .= '</table>';


function printGetStatus( $array, $indent = 0 ) {
	$rta = '';
	foreach ( $array as $key => $value ) {
		if ( $key !== 'nil' && $key !== "@attributes" ) {
			if ( is_array( $value ) ) {
				$rta .= str_repeat( "-", $indent ) . "$key: <br/>";
				$rta .= printGetStatus( $value, $indent + 2 );
			} else {
				$rta .= str_repeat( "-", $indent ) . "$key: $value <br/>";
			}
		}
	}

	return $rta;
}

?>
<style type="text/css">
.get-status-content {
    background-color: white;
    width: 500px;
    height: 500px;
    margin: auto;
    margin-top: 50px;
    overflow-Y: scroll;
    color: black;
    z-index: 2010;
    padding: 4px;
    box-shadow: 10px 5px 5px black;
}

h2 {
    color: black
}

.separador {
    height: 1px;
    left: 20%;
    width: 80%;
    margin-bottom: 10px;
    background-color: dimgray;
}

.tp-close {
    color: black;
    float:right;
    cursor: pointer;
}
</style>
<div class="get-status-content">
    <div class="tp-close">X</div>
    <img src="images/logo.png" alt="Todopago"/<br>
    <h2>Estado de la operacion</h2>
    <div class="separador"></div>
	<?php echo $rta; ?>
</div>
