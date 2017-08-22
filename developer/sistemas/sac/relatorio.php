<div class="bloco1">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
$grafico 	= new Read; 
//DataSimples
//Timestamp
$datai = filter_input(INPUT_GET,'datai');
$dataf = filter_input(INPUT_GET,'dataf');

if($datai <> '' && $dataf <> '' ){
		$datai = data_sql($datai).'00:00:01';
		$dataf = data_sql($dataf).'23:59:59';
		$read->FullRead("	SELECT 
							count(sg_assunto) as 't_assunto', 
							count(sg_motivo) as 't_motivo', 
							count(sg_departamento) as 't_departamento', 
							count(sg_contato) as 't_contato', 
							count(sg_cliente) as 't_cliente'
							from sac_registro WHERE sg_data >= '".$datai."' and sg_data <= '".$dataf."'");
	
	if ($read->getRowCount() >= 1){foreach ($read->getResult() as $result) {extract($result);}}?>
	 	<h2>Ocorrências</h2>
		<div class="col-lg-12 border">
			<table class="list">
				<tbody id="rec">
					<tr>
						<td>Assunto</td>
						<td>Motivo</td>
						<td>Departamento</td>
						<td>Contato</td>
						<td>Cliente</td>
					</tr>
					<tr>
						<td><?php echo $t_assunto;?></td>
						<td><?php echo $t_motivo;?></td>
						<td><?php echo $t_departamento;?></td>
						<td><?php echo $t_contato;?></td>
						<td><?php echo $t_cliente;?></td>
					</tr>
				</tbody>
			</table>
		</div> 
	<div class="clear"></div>
<div class="row">
<?php /*ASSUNTO*/
	$grafico->FullRead("SELECT sg.sg_assunto, scg.id ,scg.assunto, sg.sg_data FROM sac_registro as sg INNER JOIN sac_configuracao as scg ON sg.sg_assunto=scg.id WHERE sg.sg_data >= '".$datai."' and sg.sg_data <= '".$dataf."' group by scg.assunto");	
	if($grafico->getRowCount() >= 1){?>
		<div class="col-lg-6 ">
			<h2>Assunto</h2>
			<div class="border">
				<div>
					<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
					var data = google.visualization.arrayToDataTable([					
					['Task', 'Hours per Day'],
					<?php foreach ($grafico->getResult() as $resultGrafico) {extract($resultGrafico);
						$grafico->FullRead("SELECT * FROM sac_registro where sg_assunto = '".$id."' ");
						$total = $grafico->getRowCount();
					?>
						['<?php echo $assunto;?>',<?php echo $total;?>],
						
					<?php } ?>					
					]);

					var options = {	title: '',is3D: true,};

					var chart = new google.visualization.PieChart(document.getElementById('piechart_3d1'));
					chart.draw(data, options);
					}
					</script>
					<div id="piechart_3d1" style="width: 636px; height: 359px;"></div>
				</div>
			</div>
		</div>
<?php } ?>

<?php
/*MOTIVO*/
	$grafico->FullRead("SELECT sg.sg_motivo, scg.id,scg.motivo, sg.sg_data FROM sac_registro as sg INNER JOIN sac_configuracao as scg ON sg.sg_motivo=scg.id WHERE sg.sg_data >= '".$datai."' and sg.sg_data <= '".$dataf."' group by scg.motivo");	
	if($grafico->getRowCount() >= 1){?>
		<div class="col-lg-6 ">
			<h2>Motivo</h2>
			<div class="border">
				<div>
					<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
					var data = google.visualization.arrayToDataTable([					
					['Task', 'Hours per Day'],
					<?php foreach ($grafico->getResult() as $resultGrafico) {extract($resultGrafico);
						$grafico->FullRead("SELECT * FROM sac_registro where sg_motivo = '".$id."' ");
						$total = $grafico->getRowCount();
					?>
						['<?php echo $motivo;?>', <?php echo $total;?>],
						
					<?php } ?>					
					]);

					var options = {	title: '',is3D: true,};

					var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
					chart.draw(data, options);
					}
					</script>
					<div id="piechart_3d2" style="width: 636px; height: 359px;"></div>
				</div>
			</div>
		</div>
<?php } ?>

<?php
/*DEPARTAMENTO*/
	$grafico->FullRead("SELECT sg.sg_departamento, scg.id,scg.departamento, sg.sg_data FROM sac_registro as sg INNER JOIN sac_configuracao as scg ON sg.sg_departamento=scg.id WHERE sg.sg_data >= '".$datai."' and sg.sg_data <= '".$dataf."' group by sg_departamento");	
	if($grafico->getRowCount() >= 1){?>
		<div class="col-lg-6 ">
			<h2>Departamento</h2>
			<div class="border">
				<div>
					<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
					var data = google.visualization.arrayToDataTable([					
					['Task', 'Hours per Day'],
					<?php foreach ($grafico->getResult() as $resultGrafico) {extract($resultGrafico);
						$grafico->FullRead("SELECT * FROM sac_registro where sg_departamento = '".$id."' ");
						$total = $grafico->getRowCount();
					?>
						['<?php echo $departamento;?>', <?php echo $total;?>],
						
					<?php } ?>										
					]);

					var options = {	title: '',is3D: true,};

					var chart = new google.visualization.PieChart(document.getElementById('piechart_3d3'));
					chart.draw(data, options);
					}
					</script>
					<div id="piechart_3d3" style="width: 636px; height: 359px;"></div>
				</div>
			</div>
		</div>
<?php } ?>

<?php
/*CONTATO*/
	$grafico->FullRead("SELECT sg.sg_contato, scg.id,scg.contato, sg.sg_data FROM sac_registro as sg INNER JOIN sac_configuracao as scg ON sg.sg_contato=scg.id WHERE sg.sg_data >= '".$datai."' and sg.sg_data <= '".$dataf."' group by scg.contato");	
	if($grafico->getRowCount() >= 1){?>
		<div class="col-lg-6 ">
			<h2>Contato</h2>
			<div class="border">
				<div>
					<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
					var data = google.visualization.arrayToDataTable([					
					['Task', 'Hours per Day'],
					<?php foreach ($grafico->getResult() as $resultGrafico) {extract($resultGrafico);
						$grafico->FullRead("SELECT * FROM sac_registro where sg_contato = '".$id."' ");
						$total = $grafico->getRowCount();
					?>
						['<?php echo $contato;?>', <?php echo $total;?>],
						
					<?php } ?>					
					]);

					var options = {	title: '',is3D: true,};

					var chart = new google.visualization.PieChart(document.getElementById('piechart_3d4'));
					chart.draw(data, options);
					}
					</script>
					<div id="piechart_3d4" style="width: 636px; height: 359px;"></div>
				</div>
			</div>
		</div>
<?php } ?>

<?php
/*CLIENTE*/
	$grafico->FullRead("SELECT sg.sg_cliente, scg.id,scg.cliente, sg.sg_data FROM sac_registro as sg INNER JOIN sac_configuracao as scg ON sg.sg_cliente=scg.id WHERE sg.sg_data >= '".$datai."' and sg.sg_data <= '".$dataf."' group by scg.cliente");	
	if($grafico->getRowCount() >= 1){?>
		<div class="col-lg-6 ">
			<h2>Cliente</h2>
			<div class="border">
				<div>
					<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
					var data = google.visualization.arrayToDataTable([					
					['Task', 'Hours per Day'],
					<?php foreach ($grafico->getResult() as $resultGrafico) {extract($resultGrafico);
						$grafico->FullRead("SELECT * FROM sac_registro where sg_cliente = '".$id."' ");
						$total = $grafico->getRowCount();
					?>
						['<?php echo $cliente;?>', <?php echo $total;?>],
						
					<?php } ?>					
					]);

					var options = {	title: '',is3D: true,};

					var chart = new google.visualization.PieChart(document.getElementById('piechart_3d5'));
					chart.draw(data, options);
					}
					</script>
					<div id="piechart_3d5" style="width: 636px; height: 359px;"></div>
				</div>
			</div>
		</div>
<?php } ?>
</div>

<?php }else{?>
<div class="col-lg-12 border">
	<p>Para exibir o relatório selecione uma data inicial e final.</p>
	</div>

<?php }?>

</div>
<div class="bloco2 hidden">
	<div class="col-lg-12 border recebe_pesquisa"></div>	
</div>