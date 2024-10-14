<div class="container mt-5">
    <h2 class="mb-4">Resumen de Factura</h2>

    <?php
    // Llamada a la función showFactura() y obtención de los datos
    use Controller\FacturaController\Factura;
    $controller = new Factura;
    $facturaDetalles = $controller->showFactura();
    $totalPagado = 0;

    if (!empty($facturaDetalles)): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre del Cliente</th>
                    <th>Apellido del Cliente</th>
                    <th>Teléfono</th>
                    <th>ID Factura</th>
                    <th>Fecha de Factura</th>
                    <th>Producto Comprado</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($facturaDetalles as $detalle) {
                    $subtotal = $detalle['CANTIDAD'] * $detalle['PRECIOPRODUCTO'];
                    $totalPagado += $subtotal; // Sumar el subtotal al total pagado
                    echo "
                    <tr>
                        <td>{$detalle['IDCLIENTE']}</td>
                        <td>{$detalle['CLIENTENOMBRE']}</td>
                        <td>{$detalle['CLIENTEAPELLIDO']}</td>
                        <td>{$detalle['TELEFONO']}</td>
                        <td>{$detalle['IDFACTURA']}</td>
                        <td> {$detalle['FECHAFACTURA']}</td>
                        <td>{$detalle['PRODUCTOCOMPRADO']}</td>
                        <td>{$detalle['CANTIDAD']}</td>
                        <td>Q{$detalle['PRECIOPRODUCTO']}</td>
                        <td>Q{$detalle['SUBTOTAL']}</td>
                    </tr>";
                }
                ?>
                <th colspan="9" class="text-end">total</th>
                
                    <th>
                        <?php
                        echo $totalPagado;
                        ?>
                    </th>
                
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            No se encontraron detalles de la factura.
        </div>
    <?php endif; ?>

</div>