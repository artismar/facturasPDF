<?php
    $title = 'Formulario factura';
    $seguro = true;
    include_once 'estructura/cabecera.php';
?>

<div class="container">
    <!-- Titulo/texto pre formulario -->
    <div class="row mt-5">
        <div class="col">
            <h1>Crear factura.</h1>
            <p>Carga los datos para generar la factura en PDF</p>
            <hr>
        </div>
    </div>
    <!-- Formulario -->
    <form class="needs-validation" action="accion/generarFactura.php" method="POST" novalidate>
        <!-- Datos cliente -->
        <div class="row mt-5">
            <h4 class="mb-3">Datos del cliente:</h4>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Nombre" pattern="[a-zA-Z]{3,20}" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" placeholder="Apellido" pattern="[a-zA-Z]{3,20}" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente" placeholder="Numero tel/cel" pattern="[0-9]{3,20}" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <input type="text" class="form-control" id="direccionCliente" name="direccionCliente" placeholder="Direccion" pattern="[a-zA-Z0-9 ]{3,30}" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="localidadCliente" name="localidadCliente" placeholder="Localidad" pattern="[a-zA-Z ]{3,20}" required>
                </div>
                <div class="col">
                <input type="text" class="form-control" id="CPCliente" name="CPCliente" placeholder="Codigo Postal" pattern="[0-9]{3,5}" required>
                </div>
                <div class="col">
                <input type="mail" class="form-control" id="mailCliente" name="mailCliente" placeholder="Mail" required>
                </div>
            </div>
        </div>
        <!-- Datos facturacion -->
        <div class="row mt-5">
            <h4 class="mb-3">Datos de facturacion:</h4>
            <div class="row">
                <div class="col-2">
                    <input type="text" class="form-control" id="nroFactura" name="nroFactura" placeholder="Nro Factura" pattern="[0-9]{1,5}" required>
                </div>
                    <label class="col-2 col-form-label ps-3" for="fechaFactura">Fecha de facturación:</label>
                <div class="col-8">
                    <input type="date" class="form-control" id="fechaFactura" name="fechaFactura" required>
                </div>
            </div>
        </div>
        <!-- Articulos -->
        <div class="row mt-5">
            <h4>Articulos a facturar:</h4>
            <div id="camposProductos" class="row mt-3">
                <table class="table table-bordered table-hover" id="tablaItems">	
                    <tr>
                        <th width="15%">Item</th>
                        <th width="53%">Descripcion</th>
                        <th width="15%">Cantidad</th>
                        <th width="15%">Precio</th>								
                        <th width="2%"></th>
                    </tr>							
                    <tr>
                        <td><input type="text" name="itemProducto[]" id="itemProducto_1" class="form-control" pattern="[0-9]{1,8}" required></td>
                        <td><input type="text" name="descProducto[]" id="descProducto_1" class="form-control" patternt="[a-zA-Z0-9 ]{1,30}" required></td>			
                        <td><input type="number" name="cantidad[]" id="cantidad_1" class="form-control" min="0" required></td>
                        <td><input type="number" name="precio[]" id="precio_1" class="form-control" min="0" required></td>
                        <td><button type="button" class="btn btn-outline-danger borrar disabled"><i class="far fa-trash-alt"></i></button></td>
                    </tr>						
                </table>
            </div>
            <div class="row mt-2">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <button type="button" class="btn btn-outline-success addRows"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col d-grid gap-2 mt-5">
                    <button class="btn btn-primary" type="submit">Generar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
    include_once 'estructura/pie.php';
?>