<?php
include('php/conexion.php');
include('php/datetime.php');
include('php/acentos.php');

// Obtendiendo datos
$titulo = strtoupper(eliminartildes(trim($_REQUEST['titulo'])));
$descripcion = strtoupper(eliminartildes(trim($_REQUEST['descripcion'])));
$archivo = $_FILES['archivo']['size'];

$max = 10 * 1024 * 1024;

if (!empty($_FILES['archivo'])) {

    echo ('Encontré archivo!!! :)');

    // ----------------------------- archivo -----------------------------
    $query = mysql_query("SELECT * FROM avisos ORDER BY fecha DESC");
    $numero = mysql_num_rows($query) + 1;

    if (!empty($_FILES['archivo']['name'])) {

        // Renombrando el archivo
        $nombref = $_FILES['archivo']['name'];
        $ext = end(explode(".", $_FILES['archivo']['name']));
        $ruta = $_FILES['archivo']['tmp_name'];
        $nombreArchivo = "AVISO_$numero.";
        $nombreDocumento = $nombreArchivo .= $ext;
        $destino = "avisos/" . $nombreArchivo;

        echo ("<br>ruta: $ruta");
        echo ("<br>$nombreDocumento");
        echo ("<br>$destino");

        // Creando el registro en la BD
        if (copy($ruta, $destino)) {
            mysql_query("INSERT INTO avisos VALUES ('NULL','$titulo', '$descripcion', '$nombreDocumento','1','$hoy')");
            echo ('<br>Guardado!!! :)');
        } else {
?>
            <script>
                alert("Problemas al guardar el archivo, por favor vuelve a intentarlo.");
                history.back();
            </script>
    <?php
        }

        echo ('<br>NO guardado 1');
    }
    echo ('<br>NO guardado 2');

    ?>
    <script language="javascript">
        window.opener.document.location.reload();
        self.close();
    </script>

<?php
} else {
    echo ('NO encontré archivo :(');
    $archivo = 'N/A';
    mysql_query("INSERT INTO avisos VALUES ('NULL','$titulo', '$descripcion', '$archivo','1','$hoy')");
?>

    <script language="javascript">
        window.opener.document.location.reload();
        self.close();
    </script>

<?php
}
?>