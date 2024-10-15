<div class="container mt-5">
    <h2 class="text-center mb-4">Buscar ordenes</h2>

    <!-- Formulario de búsqueda -->
    <form  method="GET" class="d-flex justify-content-center">
        <input type="hidden" name="action" value="pedidos"> <!-- Campo oculto para 'action' -->
        <div class="input-group mb-3" style="max-width: 500px;">
            <input type="text" class="form-control" placeholder="Ingrese el ID de factura..." name="idFactura"
                aria-label="Buscar orden" aria-describedby="button-buscar" required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="button-buscar">Buscar</button>
            </div>
        </div>
    </form>

</div>