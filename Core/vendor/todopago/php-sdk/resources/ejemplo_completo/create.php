<?php
session_start();
include_once dirname(__FILE__)."/FlatDb.php";
include("includes/head.php");

if($_POST) {
	$orders_db = new FlatDb();
	$orders_db->openTable('ordenes');

	$merchantId = sanitize_text_field($_SESSION['merchandid']);
	$security = sanitize_text_field($_SESSION['security']);
	$operationid = sanitize_text_field($_POST['operacion']);

	$data["comercio"] = array (
	    'Security'=> $security,
	    'EncodingMethod'=>'XML',
	    'Merchant'=>sanitize_text_field($_POST['merchant']),
	); 

	$data["operacion"]=array(
		'MERCHANT'=>sanitize_text_field($_POST['merchant']),
	    'OPERATIONID'=> sanitize_text_field($_POST['operacion']),
	    'CURRENCYCODE'=> 32,
	    'AMOUNT'=>sanitize_text_field($_POST['amount']),
		'MININSTALLMENTS'=>sanitize_text_field($_POST['MININSTALLMENTS']),
		'MAXINSTALLMENTS'=>sanitize_text_field($_POST['MAXINSTALLMENTS']),
	    'EMAILCLIENTE'=>sanitize_text_field($_POST['email']),   
	    'CSBTCITY'=>sanitize_text_field($_POST['CSBTCITY']),   
	    'CSBTCOUNTRY'=>sanitize_text_field($_POST['CSBTCOUNTRY']),
	    'CSBTCUSTOMERID'=>sanitize_text_field($_POST['CSBTCUSTOMERID']),
	    'CSBTIPADDRESS'=>sanitize_text_field($_POST['CSBTIPADDRESS']),
	    'CSBTEMAIL'=>sanitize_text_field($_POST['CSBTEMAIL']),
	    'CSBTFIRSTNAME'=>sanitize_text_field($_POST['CSBTFIRSTNAME']),
	    'CSBTLASTNAME'=>sanitize_text_field($_POST['CSBTLASTNAME']),
	    'CSBTPHONENUMBER'=>sanitize_text_field($_POST['CSBTPHONENUMBER']),    
	    'CSBTPOSTALCODE'=>sanitize_text_field($_POST['CSBTPOSTALCODE']),
	    'CSBTSTATE'=>sanitize_text_field($_POST['CSBTSTATE']),
	    'CSBTSTREET1'=>sanitize_text_field($_POST['CSBTSTREET1']),
	    'CSBTSTREET2'=>sanitize_text_field($_POST['CSBTSTREET2']),
	    'CSPTCURRENCY'=>sanitize_text_field($_POST['CSPTCURRENCY']),
	    'CSPTGRANDTOTALAMOUNT'=>sanitize_text_field($_POST['CSPTGRANDTOTALAMOUNT']),
	    'CSMDD7'=>sanitize_text_field($_POST['CSMDD7']),
	    'CSMDD8'=>sanitize_text_field($_POST['CSMDD8']),
	    'CSMDD9'=>sanitize_text_field($_POST['CSMDD9']),
	    'CSMDD10'=>sanitize_text_field($_POST['CSMDD10']),
	    'CSMDD11'=>sanitize_text_field($_POST['CSMDD11']),
	    'CSSTCITY'=>sanitize_text_field($_POST['CSSTCITY']), 
	    'CSSTCOUNTRY'=>sanitize_text_field($_POST['CSSTCOUNTRY']),
	    'CSSTEMAIL'=>sanitize_text_field($_POST['CSSTEMAIL']),
	    'CSSTFIRSTNAME'=>sanitize_text_field($_POST['CSSTFIRSTNAME']),
	    'CSSTLASTNAME'=>sanitize_text_field($_POST['CSSTLASTNAME']),
	    'CSSTPHONENUMBER'=>sanitize_text_field($_POST['CSSTPHONENUMBER']),
	    'CSSTPOSTALCODE'=>sanitize_text_field($_POST['CSSTPOSTALCODE']),
	    'CSSTSTATE'=>sanitize_text_field($_POST['CSSTSTATE']),
	    'CSSTSTREET1'=>sanitize_text_field($_POST['CSSTSTREET1']),
	    'CSMDD12'=>sanitize_text_field($_POST['CSMDD12']),
	    'CSMDD13'=>sanitize_text_field($_POST['CSMDD13']),
	    'CSMDD14'=>sanitize_text_field($_POST['CSMDD14']),
	    'CSMDD15'=>sanitize_text_field($_POST['CSMDD15']),
	    'CSMDD16'=>sanitize_text_field($_POST['CSMDD16']),
	    'CSITPRODUCTCODE'=>sanitize_text_field($_POST['CSITPRODUCTCODE']),
	    'CSITPRODUCTDESCRIPTION'=>sanitize_text_field($_POST['CSITPRODUCTDESCRIPTION']),
	    'CSITPRODUCTNAME'=>sanitize_text_field($_POST['CSITPRODUCTNAME']),
	    'CSITPRODUCTSKU'=>sanitize_text_field($_POST['CSITPRODUCTSKU']),
	    'CSITTOTALAMOUNT'=>sanitize_text_field($_POST['CSITTOTALAMOUNT']),
	    'CSITQUANTITY'=>sanitize_text_field($_POST['CSITQUANTITY']),
	    'CSITUNITPRICE'=>sanitize_text_field($_POST['CSITUNITPRICE']),
	    'URL_OK'=>sanitize_text_field($_POST['URL_OK']),
	    'URL_ERROR'=>sanitize_text_field($_POST['URL_ERROR']),

	);

	$orders_db->insertRecord(array("id" => $operationid, "data" => json_encode($data), "merchantId" => $merchantId, "security" => $security, "authorizationhttp"=>$_POST["authorizationhttp"], "status" => "PENDIENTE",  "params_SAR" => 0, "response_SAR"=>"", "params_GAA"=>0, "response_GAA"=>0, "public_request_key"=>0, "mode"=>$_SESSION["mode"], "sar"=>0, "pago"=>0, "gaa"=>0, "refound"=>0, "answer_key"=>0));	
	header("Location: list.php");
}
$operationid="sdk_php".rand(99999,9999999);


?>
	<div class="w-section"></div>
	<div id="m-status" style="margin-bottom: 300px">

	<div class="block">
	<form id="activeform" method="POST" action="create.php" enctype="multipart/form-data">
		<table id="tablelist" class="full tablesorter">
			<tbody>
				<tr>
			  	   <td><strong>Merchant</strong></td><td><input type="text" name="merchant" value="<?php echo $_SESSION["merchandid"]; ?>" /></td>
			  	</tr>
				
				<tr>
			  	   <td><strong>Security</strong></td><td><input type="text" name="security" value="<?php echo $_SESSION["security"]; ?>" /></td>
			  	</tr>
				
				<tr>
			  	   <td><strong>Authorizationhttp</strong></td><td><input type="text" name="authorizationhttp" value="<?php echo $_SESSION["apikey"]; ?>" /></td>
			  	</tr>

				<tr>
				  <td><strong>Operacion</strong></td><td><input type="text" name="operacion" value="<?php echo $operationid; ?>" /></td>
				</tr>
				
				<tr>
				  <td><strong>Monto</strong></td><td><input type="text" name="amount" value="50.00" /></td>
				</tr>

				<tr>
				  <td><strong>Cuotas mínimas</strong></td><td><input type="text" name="MININSTALLMENTS" value="3" /></td>
				</tr>

				<tr>
				  <td><strong>Cuotas máximas</strong></td><td><input type="text" name="MAXINSTALLMENTS" value="8" /></td>
				</tr>


				<tr>
					<td>
						<strong>URL_OK</strong></td><td><input type="text" name="URL_OK" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'/../ok.php?OPERATIONID='.$operationid; ?>" />
					</td>
				</tr>


				<tr>
					<td>
						<strong>URL_ERROR</strong></td><td><input type="text" name="URL_ERROR" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'/../error.php?OPERATIONID='.$operationid; ?>" />
					</td>
				</tr>				


				<tr>
					<td>
						<strong>Provincia de envío</strong></td><td><input type="text" name="CSSTSTATE" value="D" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Domicilio de envío</strong></td><td><input type="text" name="CSSTSTREET1" value="San Martín 123" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Shipping DeadLine</strong></td><td><input type="text" name="CSMDD12" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Método de Despacho</strong></td><td><input type="text" name="CSMDD13" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Customer requires Tax Bill?</strong></td><td><input type="text" name="CSMDD14" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Customer Loyality Number</strong></td><td><input type="text" name="CSMDD15" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Coupon Code</strong></td><td><input type="text" name="CSMDD16" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Ciudad de facturación</strong></td><td><input type="text" name="CSBTCITY" value="Villa General Belgrano" />
					</td>
				</tr>	

				<tr>
					<td>
						<strong>País de facturación</strong></td><td><input type="text" name="CSBTCOUNTRY" value="AR" />
					</td>
				</tr>					

				<tr>
					<td>
						<strong>Identificador del usuario al que se le emite la factura</strong></td><td><input type="text" name="CSBTCUSTOMERID" value="453458" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>IP</strong></td><td><input type="text" name="CSBTIPADDRESS" value="192.0.0.4" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Mail</strong></td><td><input type="text" name="CSBTEMAIL" value="midirecciondemail@hotmail.com" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Nombre</strong></td><td><input type="text" name="CSBTFIRSTNAME" value="Juan" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Apellido</strong></td><td><input type="text" name="CSBTLASTNAME" value="Perez" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Teléfono</strong></td><td><input type="text" name="CSBTPHONENUMBER" value="541160913988"></td><td />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Código Postal</strong></td><td><input type="text" name="CSBTPOSTALCODE" value="C1010AAP" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Provincia</strong></td><td><input type="text" name="CSBTSTATE" value="B" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Domicilio de facturación</strong></td><td><input type="text" name="CSBTSTREET1" value="Cerrito 740" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Complemento del domicilio</strong></td><td><input type="text" name="CSBTSTREET2" value="Piso 8" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Moneda</strong></td><td><input type="text" name="CSPTCURRENCY" value="ARS" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Cantidad total de la transaccion</strong></td><td><input type="text" name="CSPTGRANDTOTALAMOUNT" value="125.38" />
					</td>
				</tr>


				<tr>
					<td>
						<strong>Fecha registro comprador</strong></td><td><input type="text" name="CSMDD7" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Invitado o no</strong></td><td><input type="text" name="CSMDD8" value="Y" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Password</strong></td><td><input type="text" name="CSMDD9" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Histórica de compras del comprador</strong></td><td><input type="text" name="CSMDD10" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Customer Cell Phone</strong></td><td><input type="text" name="CSMDD11" value="" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Ciudad de enví­o de la orden</strong></td><td><input type="text" name="CSSTCITY" value="rosario" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>País de envío de la orden</strong></td><td><input type="text" name="CSSTCOUNTRY" value="AR" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Correo electrónico del comprador</strong></td><td><input type="text" name="CSSTEMAIL" value="jose@gmail.com" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Nombre del destinatario</strong></td><td><input type="text" name="CSSTFIRSTNAME" value="Jose" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Apellido del destinatario</strong></td><td><input type="text" name="CSSTLASTNAME" value="Perez" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Número de teléfono del destinatario</strong></td><td><input type="text" name="CSSTPHONENUMBER" value="541155893737" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Código Postal</strong></td><td><input type="text" name="CSSTPOSTALCODE" value="1414" />
					</td>
				</tr>

				<tr>
				  <td><strong>Email</strong></td><td><input type="text" name="email" value="email@example.com" /></td>

				<tr>
					<td>
						<strong>CSITUNITPRICE</strong></td><td><input type="text" name="CSITUNITPRICE" value="1254.40" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Cantidad productos</strong></td><td><input type="text" name="CSITQUANTITY" value="1" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>CSITTOTALAMOUNT</strong></td><td><input type="text" name="CSITTOTALAMOUNT" value="1254.40" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Código producto</strong></td><td><input type="text" name="CSITPRODUCTSKU" value="LEVJNSL36GN" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Nombre del producto</strong></td><td><input type="text" name="CSITPRODUCTNAME" value="NOTEBOOK L845 SP4304LA DF TOSHIBA" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Descripción del producto</strong></td><td><input type="text" name="CSITPRODUCTDESCRIPTION" value="NOTEBOOK L845 SP4304LA DF TOSHIBA" />
					</td>
				</tr>

				<tr>
					<td>
						<strong>Código de producto</strong><div class="clearfix"></div>
						<strong>Disponibles:</strong><div class="clearfix"></div>
						<ul>
							<li>adult_content</li>
							<li>coupon</li>
							<li>default</li>
							<li>electronic_good</li>
							<li>electronic_software</li>
							<li>gift_certificate</li>
							<li>handling_only</li>
							<li>service</li>
							<li>shipping_and_handling</li>
							<li>shipping_only</li>
							<li>subscription</li>
						</ul>

					</td>
					<td>
						<input type="text" name="CSITPRODUCTCODE" value="electronic_good" />
					</td>
				</tr>

				</tbody>
			<tfoot>
			  <tr>
				<td colspan="2"><a href="list.php" class="btn error site">Cancelar</a>&nbsp;&nbsp;&nbsp;<a href="create.php" onclick="$('#activeform').submit();return false;" class="btn site" id="send">Enviar</a></td>
			  </tr>
			</tfoot>
		</table>


	</form>
	</div>
</div>

<?php include("includes/foot.php"); ?>