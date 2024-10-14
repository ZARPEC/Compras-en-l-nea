<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Tarjeta de confirmación de pago -->
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-success"><i class="fas fa-check-circle"></i> ¡Pago Exitoso!</h1>
                    <p class="card-text">Gracias por tu compra, <strong id="nombreCliente">Juan Pérez</strong>.</p>
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
                            <p><strong>Número de Tarjeta:</strong> **** **** **** 1111</p>
                        </div>
                        <div class="col-md-6 text-left">
                            <p><strong>Total Pagado:</strong> Q<span id="totalPagado">0.00</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-left">
                            <p><strong>Fecha de Pago:</strong> 12/10/2024</p>
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