<?php
namespace Controller\PaymentController;
use Controller\FacturaController\Factura;
use Controller\ClienteController\ClienteC;



class Payment
{
    // Datos que serán enviados al Servlet
    public function payment()
    {
        if (!empty($_POST['numeroTarjeta']) && !empty($_POST['vencimiento']) && !empty($_POST['cvv'])) {
            // instancia a cliente y factura
            $AddCliente = new ClienteC;
            $addfactura = new Factura;
            // datos del formulario de tarjeta
            $nombre = $_POST['nombre'];
            $numeroTarjeta = $_POST['numeroTarjeta'];
            $vencimiento = $_POST['vencimiento'];
            $cvv = $_POST['cvv'];
            // datos del formulario del cliente 
            $nombreCl = $_POST['nombreCl'];
            $apellido = $_POST['apellido'];
            $tel = $_POST['telefono'];
            // forma de pago para la factura
            $MetodoPago = $_POST['metodoPago'];
            // datos de los productos dentro del carrito para los detalles de la factura 
            if (isset($_POST['productos'])) {
                $productos = $_POST['productos'];

                // Recorrer todos los productos
            }

            // URL del Servlet
            $url = 'http://localhost:8090/Proyecto/procesarPago';

            // Datos del pago a enviar al Servlet
            $data = array(
                'nombre' => $nombre,
                'numeroTarjeta' => $numeroTarjeta,
                'vencimiento' => $vencimiento,
                'cvv' => $cvv
            );

            // Iniciar cURL
            $ch = curl_init($url);

            // Configuración de la solicitud cURL
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Ejecutar la solicitud y obtener la respuesta
            $response = curl_exec($ch);

            // Cerrar cURL
            curl_close($ch);

            // Mostrar la respuesta del Servlet
// Decodificar la respuesta JSON
            $jsonResponse = json_decode($response, true);

            // Verificar el estado del pago
            if ($jsonResponse['paymentStatus'] == 'true') {

                $AddCliente->inCliente($nombreCl, $apellido, $tel);
                if ($AddCliente == true) {
                    $addfactura->inFactura($MetodoPago);
                    if ($addfactura == true) {
                        $addfactura->indetalles($productos);
                    }
                }
                $tarjetaEnmascarada = '**** **** **** ' . substr($numeroTarjeta, -4);

                header("Location: ?action=paymentsuces&tarjeta=' . $tarjetaEnmascarada" );
            } else {
                echo "Pago fallido. " . (isset($jsonResponse['error']) ? $jsonResponse['error'] : "Verifica la información.");
            }
        }
        echo "<h1>hay algo malo muuuy malo</h1>";
    }
}