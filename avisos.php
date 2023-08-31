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


	<script>
		function redirigir() {
			window.location.href = 'http://localhost/AvisosUPVT/';
		}
	</script>

</head>

<?php
$idAvisos = $_REQUEST['idAvisos'];
?>

<body>
	<div class="contenedor">

		<?php
		include("php/header.php");

		$query = mysql_query("SELECT * FROM avisos WHERE idAvisos = $idAvisos AND status = 1");
		if (mysql_num_rows($query) != 0) {
			while ($dato = mysql_fetch_array($query)) {
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

				$ext = explode(".", $archivo)[1];
			}
		?>

			<main class="contenido">

				<h2 style="text-align: center;"><button class="btn btn-secondary btn-sm" onclick="redirigir();" style="float: left;"><span><i class="bi bi-house-door-fill"></i></span></button><strong><?php echo ($titulo); ?></strong></h2>
				<p style="font-size: smaller; font-style:italic; text-align:center; color:darkgray;">PUBLICADO: <?php echo ($fecha); ?></p>
				<hr>

				<?php
				if ($ext == 'pdf') {
				?>
					<p style="text-align: center;">
						<embed src="avisos/<?php echo $archivo; ?>#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="600px" height="760px">
					</p>
				<?php
				} else {
					// } elseif ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif' || $ext == 'webp') {
				?>
					<p style="text-align: center;">
						<img src="avisos/<?php echo $archivo; ?>" alt="<?php echo $titulo; ?>" width="600px">
					</p>
				<?php
				}
				?>

			</main>

			<aside class="sidebar">
				<table class="table" width="100%" style="color: #FFFFFF;">
					<tr>
						<th colspan="3" style="text-align: center; background-color: #7C0012; color: #FFFFFF;">DESCRIPCIÓN</th>
					</tr>
					<tr>
						<td colspan="3" style="background-color: #9D071E; color: #FFFFFF;">
							<?php echo ($descripcion); ?>
							<br><br><br><br>
						</td>
					</tr>
					<tr>
						<th colspan="3" style="text-align: center; background-color: #7C0012; color: #FFFFFF;">MÁS AVISOS</th>
					</tr>
					<tr>
						<th style="text-align: center; background-color: #AF0017; color: #FFFFFF;">AVISO</th>
						<th style="text-align: center; background-color: #AF0017; color: #FFFFFF;">PUBLICADO</th>
						<th style="text-align: center; background-color: #AF0017; color: #FFFFFF;">VER</th>
					</tr>
					<?php
					$query = mysql_query("SELECT * FROM avisos WHERE status = 1 and idAvisos != $idAvisos ORDER BY fecha DESC limit 5");
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
							<th style='text-align:center; background-color: #9D071E; color: #FFFFFF;'>$titulo</th>
							<td style='text-align:center; background-color: #9D071E; color: #FFFFFF;' width='20%'>$fecha</td>
							<td style='text-align:center; background-color: #9D071E; color: #FFFFFF;'><a href='avisos.php?idAvisos=$idAvisos'><button type='button' class='btn btn-success btn-sm'>Ver</button></a></td>
							</tr>");
					}
					?>
					<tr>
						<td colspan="4" style="text-align: center;font-size: smaller; font-style:italic; color:darkgray ; background-color: #9D071E; color: #FFFFFF;">Fin de los avisos</td>
					</tr>
					</tbody>
				</table>
			</aside>

		<?php
		} else {
		?>
			<main class="contenido">
				<h2 style="text-align: center;">
					<button class="btn btn-secondary btn-sm" onclick="redirigir();" style="float: left;"><span><i class="bi bi-house-door-fill"></i></span></button>
					<strong>Aviso no encontrado o no está disponible.</strong>
				</h2>
				<hr>
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
		<?php
		}
		?>

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