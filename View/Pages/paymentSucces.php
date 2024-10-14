<?php
use Controller\FacturaController\Factura;
$factura = new Factura;
$tarjetaEnmascarada = isset($_GET['tarjeta']) ? $_GET['tarjeta'] : '**** **** **** ****';

$totalPagado = 0;
$fecha = '';

$facturaDetalles = $factura->showFactura();


if (!empty($facturaDetalles)) {
    foreach ($facturaDetalles as $detalle) {
        $fecha = $detalle['FECHAFACTURA']; // Asignamos la fecha (asume que la fecha es la misma para todos los productos)
        $subtotal = $detalle['CANTIDAD'] * $detalle['PRECIOPRODUCTO']; // Calculamos el subtotal
        $totalPagado += $subtotal; // Sumamos el subtotal al total pagado
    }
} else {
    echo "algo malooooo";
}


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Tarjeta de confirmación de pago -->
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-success"><i class="fas fa-check-circle"></i> ¡Pago Exitoso!</h1>
                    <p class="card-text">Gracias por tu compra</p>
                    <p class="card-text">Tu pago ha sido procesado correctamente.</p>
                    <hr>

                    <!-- Resumen del carrito -->
                    <h4>Resumen del Pedido</h4>
                    <div id="carritoResumen">
                        <!-- Los productos del carrito se mostrarán aquí -->
                    </div>

                    <!-- Total -->
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <p><strong>Número de Tarjeta:</strong><?php $tarjetaEnmascarada ?></p>
                        </div>
                        <div class="col-md-6 text-left">
                            <p><strong>Total Pagado:</strong> Q<span id="totalPagado"><?php echo number_format($totalPagado, 2); ?></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-left">
                            <p><strong>Fecha de Pago:</strong> <?php echo $fecha ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    vaciarCarrito() 
</script>