<a name="inicio"></a>
# Todo Pago - Módulo para WooCommerce
### Versión 1.15.0

Plug in para la integración con gateway de pago <strong>Todo Pago</strong>
- [Todo Pago - Módulo para WooCommerce](#todo-pago---módulo-para-woocommerce)
    - [Versión 1.15.0](#versión-1150)
  - [Consideraciones Generales](#consideraciones-generales)
  - [Instalación](#instalación)
  - [Configuración](#configuración)
      - [Activación](#activación)
      - [Configuración plug in](#configuración-plug-in)
      - [Formulario Hibrido](#formulario-hibrido)
      - [Obtener datos de configuración](#obtener-datos-de-configuración)
      - [Configuración de Máximo de Cuotas](#configuración-de-máximo-de-cuotas)
  - [Prevención de Fraude](#prevención-de-fraude)
      - [Consideraciones Generales (para todas las verticales, por defecto RETAIL)](#consideraciones-generales-para-todas-las-verticales-por-defecto-retail)
      - [Consideraciones para vertical RETAIL](#consideraciones-para-vertical-retail)
      - [Nuevos Atributos en los productos](#nuevos-atributos-en-los-productos)
  - [Características](#características)
      - [Consulta de Transacciones](#consulta-de-transacciones)
      - [Devoluciones](#devoluciones)

<a name="consideracionesgenerales"></a>
## Consideraciones Generales
El plug in de pagos de <strong>Todo Pago</strong>, provee a las tiendas WooCommerce de un nuevo m&eacute;todo de pago, integrando la tienda al gateway de pago.
La versión de este plug in esta testeada en PHP 5.3 en adelante y WordPress 3.7.5 con WooCommerce 2.3.5 en adelante y 3 en adelante.

<a name="instalacion"></a>
## Instalación
1. Descomprimir el archivo woocommerce-plugin-master.zip. 
2. Copiar carpeta woocommerce-plugin-master al directorio de plugins de wordpress ("raíz de wordpress"/wp-content/plugins). 
3. Renombrarla woocommerce-plugin-master por woocommerce-plugin.

Observaciones:

1. Descomentar: <em>extension=php_soap.dll</em> del php.ini, ya que para la conexión al gateway se utiliza la clase <em>SoapClient</em> del API de PHP.
Descomentar: <em>extension=php_openssl.dll</em> del php.ini 
2. En caso de tener conflictos con Jquery por los diferentes temas, descomentar la siguiente linea que se encuentra al final del index.php
```php
  // add_action('init', 'my_init');
```

[<sub>Volver a inicio</sub>](#inicio)

<a name="configuracion"></a>
## Configuración

<a name="activacion"></a>
#### Activación
La activación se realiza como cualquier plugin de Wordpress: Desde Plugins -> Plugins instalados -> activar el plugin de nombre <strong>Todo Pago para WooCommerce</strong>.

<a name="confplugin"></a>
#### Configuración plug in
Para llegar al menu de configuración del plugin ir a: <em>WooCommerce -> Ajustes</em> y seleccionar Finalizar Compra de la solapa de configuraciones que aparece en la parte superior. Entre los medios de pago aparecerá la opción de nombre <strong>Todopago</strong>.<br />
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/1-%20header%20gateway.png)</br>
<sub></br><em>Menú principal</em></br></sub>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/2-%20configuracion%20general.png)</br>
<sub></br><em>Menú ambiente</em></br></sub>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/3-%20configuracion%20developers.PNG)</br>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/4-%20configuracion%20produccion.png)</br>
<sub></br><em>Meenú estados y menú servicios</em></br></sub>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/5-%20configuracion%20estados.png)</br>
- Estado de transacción iniciada: Se setea luego de completar los datos de facturación y presionar el botón "Realizar el pedido".
- Estado de transacción aprobada: Se setea luego de volver del formulario de pago de Todo Pago y se obtiene una confirmación del pago.
- Estado de transacción rechazada: Se setea luego de volver del formulario de pago de Todo Pago y se obtiene un rechazo del pago.

- Para versiones de Woocommerce anteriores a 3.x , la opción "Estado cuando la transacción ha sido iniciada" debe de estar seteada en "Pendiente de pago".

- Es necesario configurar checkout como sitio de checkout para poder llegar a los formularios.

***Configuariones timeout***
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/16-opciones_timeout.png)</br>

***Redirección final de transacción (a partir de v 1.4.2)***
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/woocommerce_1.4.2.png)</br>


***Configuración checkout Woo***

![imagen_de_configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/17-checkout.png)


[<sub>Volver a inicio</sub>](#inicio)

<a name="formHibrido"></a>
#### Formulario Hibrido
En la configuracion del plugin tambien estara la posibilidad de mostrarle al cliente el formulario de pago de TodoPago integrada en el sitio. 
Para esto , en la configuracion se debe seleccionar la opcion Integrado en el campo de seleccion de fromulario
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/10-%20formulario%20hibrido.png)</br>
<sub></br>Del lado del cliente el formulario se verá así:</br></sub> 
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/11_formulario_hibrido3ver2.png)
</br>El formulario tiene dos formas de pago, ingresando los datos de una tarjeta ó utilizando la billetera de Todopago. Al ir a "Pagar con Billetera" desplegara una ventana que permitira ingresar a billetera y realizar el pago.</br>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/15_billetera%20virtual3.png)

[<sub>Volver a inicio</sub>](#inicio)

<a name="getcredentials"></a>
#### Obtener datos de configuración
Se puede obtener los datos de configuración del plugin con solo loguearte con tus credenciales de Todopago. </br>
a. Ir a la opción Obtener credenciales</br>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/9-credenciales.png) </br>
b. Loguearse con el mail y password de Todopago.</br>3
c. Los datos se cargarán automáticamente en los campos Merchant ID y Security code en el ambiente correspondiente y solo hay que hacer click en el botón guardar datos y listo.</br>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/3-%20configuracion%20developers.PNG)</br>
[<sub>Volver a inicio</sub>](#inicio)

<a name="maxcuotas"></a>
#### Configuración de Máximo de Cuotas
Se puede configurar la cantidad máxima de cuotas que ofrecerá el formulario de TodoPago con el campo cantidad máxima de cuotas. Para que se tenga en cuenta este valor se debe habilitar el campo Habilitar máximo de cuotas y tomará el valor fijado para máximo de cuotas. En caso que esté habilitado el campo y no haya un valor puesto para las cuotas se tomará el valor 12 por defecto.
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/13-%20cuotas.png)</br>

[<sub>Volver a inicio</sub>](#inicio)

<a name="cybersource"></a>
## Prevención de Fraude
- [Consideraciones Generales](#cons_generales)
- [Consideraciones para vertical RETAIL](#cons_retail)

<a name="cons_generales"></a>
#### Consideraciones Generales (para todas las verticales, por defecto RETAIL)
El plugin, toma valores est&aacute;ndar del framework para validar los datos del comprador. Principalmente se utiliza una instancia de la clase <em>WC_Order</em>.

```php
   $order = new WC_Order($order_id);
-- Ciudad de Facturación: $order -> billing_city;
-- País de facturación: $order -> billing_country;
-- Identificador de Usuario: $order -> customer_user;
-- Email del usuario al que se le emite la factura: $order -> billing_email;
-- Nombre de usuario el que se le emite la factura: $order -> billing_first_name;
-- Apellido del usuario al que se le emite la factura: $order -> billing_last_name;
-- Teléfono del usuario al que se le emite la factura: $order -> billing_phone;
-- Provincia de la dirección de facturación: $this -> getStateCode($order -> billing_state);
-- Domicilio de facturación: $order -> billing_address_1;
-- Complemento del domicilio. (piso, departamento): $order -> billing_address_2;
-- Moneda: 'ARS'; //Moneda Fija
-- Total:  $order -> order_total;
-- IP de la pc del comprador: $order -> customer_ip_address;
```
<a name="cons_retail"></a> 
#### Consideraciones para vertical RETAIL
Las consideración para el caso de empresas del rubro <strong>RETAIL</strong> son similares a las <em>consideraciones generales</em> ya que se obtienen del mismo objeto de clase WC_Orden
```php
-- Ciudad de envío de la orden: $order -> shipping_city;
-- País de envío de la orden: $order -> shipping_country;
-- Mail del destinatario: $order -> shipping_email;
-- Nombre del destinatario: $order -> shipping_first_name;
-- Apellido del destinatario: $order -> shipping_last_name;
-- Número de teléfono del destinatario: $order -> shipping_phone;
-- Código postal del domicio de envío: $order -> shipping_postcode;
-- Provincia de envío: getStateCode($order -> shipping_state);
-- Domicilio de envío: $order -> billing_address_1;
```
 
<a name="prevfraudedatosadicionales" ></a>
#### Nuevos Atributos en los productos
Para efectivizar la prevenciín de fraude se han creado nuevos atributos de producto dentro de la categoria <em>"Prevenci&oacute;n de Fraude"</em>.
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/12-%20prevencion%20fraude.PNG)

__Estos campos no son obligatorios aunque si requeridos para Control de Fraude__
[<sub>Volver a inicio</sub>](#inicio)

<a name="features"></a>
## Características
 - [Consulta de transacciones](#constrans)
 - [Devoluciones](#devoluciones)
 
<a name="constrans" ></a>
#### Consulta de Transacciones
Se puede consultar <strong>on line</strong> las características de la transacci&oacute;n en el sistema de Todo Pago al hacer click en el número de orden en la parte de Status de las Operaciones.<br />
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/6-%20status%20de%20las%20operaciones.png)</br>
![imagen de configuracion](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/7-%20detalle%20status.png)</br>

[<sub>Volver a inicio</sub>](#inicio)

<a name="devoluciones"></a>
#### Devoluciones
Es posible realizar devoluciones o reembolsos mediante el procedimiento habitual de WooCommerce. Para ello dirigirse en el menú a WooCommerce->Pedidos, "Ver" la orden deseada (Esta debe haber sido realizada con TodoPago) y encontrará una sección con el título **Pedido Productos**, dentro de esta hay un botón *Reembolso* al hacer click ahí nos solicitará el monto a reembolsar y nos dará la opción de *Reembolsar con TodoPago*.<br />
![Devolución](https://raw.githubusercontent.com/TodoPago/imagenes/master/woocommerce/8-%20devoluciones.PNG)<br/>

[<sub>Volver a inicio</sub>](#inicio)


