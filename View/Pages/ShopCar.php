<div class="container mt-5">
        <h2 class="mb-4">Carrito de Compras</h2>

        <!-- Tabla del carrito de compras -->
        <div class="row">
            <div class="col-lg-8">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Aquí se mostrarán los productos del carrito -->
                    </tbody>
                </table>
            </div>

            <!-- Resumen del pedido -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Resumen del Pedido</h4>
                        <hr>
                        <p><strong>Subtotal:</strong> <span id="subtotal">Q0.00</span></p>
                        <h5><strong>Total:</strong> <span id="total">Q0.00</span></h5>
                        <hr>
                        <a href="?action=payment"><button  class="btn btn-primary btn-lg w-100">Finalizar Compra</button></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>