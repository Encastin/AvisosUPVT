<?php
include('php/conexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('php/estilos.php');
    ?>

    <title>Nuevo Aviso</title>

    <script>
        function guardar() {
            if (confirm('Se guardará este aviso, ¿desea continuar?'))
                return true;
            else
                return false;
        }
    </script>
    <style>
        .formulario {
            position: absolute;
            left: 30px;
            top: 30px;
            right: 30px;
        }

        body {
            background: #E9ECF4;
            color: #000;
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>
    <div class="formulario">

        <form action="nuevoaviso1.php" method="POST" enctype="multipart/form-data">

            <!-- Nombre del Fomulario -->
            <h2>Nuevo Aviso</h2>
            <hr>

            <!-- Input de Título -->
            <div class="form-group">
                <label><strong>Título</strong></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-fonts"></i></span>
                    <input type="text" class="form-control" name="titulo" placeholder="Introducir título del aviso">
                </div>
            </div>

            <!-- Input de Descripción -->
            <div class="form-group">
                <label><strong>Descripción</strong></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-blockquote-left"></i></span>
                    <textarea class="form-control" name="descripcion" rows="5" placeholder="Introducir descripción del aviso"></textarea>
                </div>
            </div>

            <!-- Input de Archivo / Imágen -->
            <div class="form-group">
                <label><strong>Archivo / Imágen</strong></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-file-earmark-richtext"></i></span>
                    <input name="archivo" class="form-control" type="file">
                </div>
            </div>

            <!-- Botón Guardar -->
            <div style="padding-top: 10px;">
                <button onclick="return guardar();" type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>