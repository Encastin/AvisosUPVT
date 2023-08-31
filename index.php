<?php
include("php/conexion.php");
include("php/datetime.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include('php/estilos.php');
	?>

	<title>Avisos UPVT</title>

</head>

<body>
	<div class="contenedor">

		<?php
		include("php/header.php");
		?>

		<main class="contenido">

			<table class="table table-striped" width="100%">
				<tbody>
					<tr>
						<th width='5%' style='text-align:center'>#</th>
						<th style='text-align:center'>AVISO</th>
						<th width='20%' style='text-align:center'>PUBLICADO</th>
						<th style='text-align:center'>VER</th>
					</tr>
					<?php
					$i = 1;
					$query = mysql_query("SELECT * FROM avisos WHERE status = 1 ORDER BY fecha DESC");
					while ($dato = mysql_fetch_array($query)) {
						$idAvisos = $dato['idAvisos'];
						$titulo = $dato['titulo'];
						$descripcion = $dato['descripcion'];
						$archivo = $dato['archivo'];
						$fecha = date("Y/m/d", strtotime($dato['fecha']));

						if ($fecha == date("Y/m/d", strtotime($hoy))) {
							$fecha = 'HOY';
						} elseif ($fecha == date("Y/m/d", strtotime($hoy . "- 1 days"))) {
							$fecha = 'AYER';
						} else {
							$fecha = date("d/m/Y", strtotime($dato['fecha']));
						}

						echo ("<tr>
							<td width='5%' style='text-align:center'>$i</td>
							<th style='text-align:center'>$titulo</th>
							<td width='20%' style='text-align:center'>$fecha</td>
							<td style='text-align:center'><a href='avisos.php?idAvisos=$idAvisos'><button type='button' class='btn btn-success btn-sm'>Ver</button></a></td>
							</tr>");

						$i++;
					}
					?>
					<tr>
						<td colspan="4" style="text-align: center;font-size: smaller; font-style:italic; color:darkgray">Fin de los avisos</td>
					</tr>
				</tbody>
			</table>
		</main>

		<aside class="sidebar">
			<?php
			// Barra lateral derecha
			include("php/sidebar.php");
			?>
		</aside>

		<div class="widget-1">
			<br>
			<p>
				<a href="https://sgei.mx" target="_blank">
					<img src="images/sgei.png" alt="SGEI - UPVT" width="150">
				</a>
			</p>
		</div>

		<div class="widget-2">
			<p>
				<a href="http://189.195.154.210/TOLUCA/servicios" target="_blank">
					<img src="images/SGCE.png" alt="SGCE - UPVT" width="200px">
				</a>
			</p>
		</div>

		<?php
		// PIE DE PÁGINA
		include("php/footer.php");
		?>

	</div>
</body>

</html>