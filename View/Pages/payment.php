<?php
use Controller\PaymentController\Payment;
$pay = new Payment;
use Controller\ClienteController\ClienteC;
$cliente = new ClienteC;
use Controller\FacturaController\Factura;
$factura = new Factura;
?>
<div class="container mt-5">
    <h2 class="mb-4">Resumen del Pedido</h2>

    <!-- Resumen del carrito de compras -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Los productos del carrito se llenarán aquí -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Subtotal:</td>
                    <td id="subtotal">Q0.00</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td id="total">Q0.00</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Formulario de Datos de Envío y Pago -->
    <form method="post" id="checkout-form">
        <!-- Datos de Envío -->
        <h4 class="mt-4">Datos de Envío</h4>
        <div class="mb-3">
            <label for="nombreCl" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreCl" name="nombreCl" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" maxlength="8" required>
        </div>
        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <select class="form-select" id="departamento" name="departamento" required>
                <option value="" disabled selected>Seleccione un departamento</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="municipio" class="form-label">Municipio</label>
            <select class="form-select" id="municipio" name="municipio" required>
                <option value="" disabled selected>Seleccione un municipio</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección de Envío</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <!-- Método de Pago -->
        <h4 class="mt-4">Método de Pago</h4>
        <div class="mb-3">
            <select class="form-select" id="metodo-pago" name="metodoPago" required>
                <option value="" disabled selected>Selecciona un método de pago</option>
                <option value="1">Tarjeta de Crédito/Débito</option>
            </select>
        </div>

        <!-- Datos de Tarjeta de Crédito -->
        <div id="payment-details" ">
            <div class=" mb-3">
            <label for="nombreTarjeta" class="form-label">Nombre en la Tarjeta</label>
            <input type="text" class="form-control" id="nombreTarjeta" name="nombreTarjeta">
        </div>

        <div class="mb-3">
            <label for="numeroTarjeta" class="form-label">Número de Tarjeta</label>
            <input type="text" class="form-control" id="numeroTarjeta" name="numeroTarjeta">
        </div>

        <div class="mb-3">
            <label for="vencimiento" class="form-label">Fecha de Vencimiento (MM/AA)</label>
            <input type="text" class="form-control" id="vencimiento" name="vencimiento">
        </div>

        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv">
        </div>
</div>

<!-- Botón de Finalizar Compra -->
<div class="d-grid gap-2 mt-4">
    <button type="submit" class="btn btn-primary btn-lg">Finalizar Compra</button>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$pay->payment();
}

?>
</form>
</div>
<script src="Assets/JS/DepartamentoCargar.js"></script>