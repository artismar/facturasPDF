    <div class="espacio-footer">
        
    </div>
    <footer class="footer container-fluid bg-secondary mt-5">
        <div>
            <p>© Creador de facturas PDF | Trabajo Librerias</p>
        </div>
    </footer>
    <?php
    if (!isset($accion)){
        echo '<script src="js/bootstrap/bootstrap.bundle.min.js"></script>';
        echo '<script src="js/validacion.js"></script>';
        echo '<script src="js/formulario.js"></script>';
    } else{
        echo '<script src="../js/bootstrap/bootstrap.bundle.min.js"></script>';
        echo '<script src="../js/validacion.js"></script>';
        echo '<script src="../js/formulario.js"></script>';
    }
    ?>
</body>
</html>