<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SrEnvio - Sobrepesos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 pt-3">				
				<?php 
					foreach($json as $p):
				?>
				<div class="card card-body bg-light mb-3">
					<h4 class="text-center">Paquete: <small>#<?php echo $p->tracking_number ?></small></h4>					
					<table class="table table-dark">
						<tr>
							<th colspan="3" class="text-center">
								Información proporcionada por el cliente
							</th>
						</tr>
						<tr>
							<th class="text-center">Peso</th>
							<th class="text-center">Peso volumétrico</th>
							<th class="text-center">Peso total</th>
						</tr>
						<tr>
							<td class="text-center"><?php echo $peso[$p->tracking_number] ?>KG</td>
							<td class="text-center"><?php echo $peso_volumetrico[$p->tracking_number] ?>KG</td>
							<td class="text-center"><?php echo $peso_total[$p->tracking_number] ?>KG</td>
						</tr>
					</table>
					
					<table class="table table-dark">
						<tr>
							<th colspan="3" class="text-center">
								Información proporcionada por Fedex
							</th>
						</tr>
						<tr>
							<th class="text-center">Peso</th>
							<th class="text-center">Peso volumétrico</th>
							<th class="text-center">Peso total</th>
						</tr>
						<tr>
							<td class="text-center"><?php echo $peso_fedex[$p->tracking_number]['valor'] ?>KG</td>
							<td class="text-center"><?php echo $peso_fedex_volumetrico[$p->tracking_number] ?>KG</td>
							<td class="text-center"><?php echo $peso_fedex_total[$p->tracking_number] ?>KG</td>
						</tr>
					</table>

					<?php 
						if($sobrepeso[$p->tracking_number] > 0):
					?>
					<p class="text-right text-danger"><i class="fas fa-exclamation-triangle"></i> Sobrepeso de <?php echo $sobrepeso[$p->tracking_number] ?>KG</p>
					<?php

						else:
					?>
					<p class="text-right text-success"><i class="fas fa-check"></i> No hay sobrepeso</p>
					<?php
						endif;
					?>					
				</div>
				<?php
					endforeach;
				?>				
			</div>
		</div>
	</div>
	
</body>
</html>