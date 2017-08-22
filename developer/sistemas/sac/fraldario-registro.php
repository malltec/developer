<div class="row">
	<div class="col-lg-6 ">
		<h2 >Registro Fraldário</h2>
		<div class="border">
			<form action="" enctype="multipart/form-data" name="formCadastro" method="post" data-valor="1">
				<?php 		
					new Text_Data(array('label'=>'Data','name'=>'data', 'badge'=>'calendar'));
					new Select(array('label'=>'Serviço','name'=>'servico','option'=>'1: Papinha |2: Amamentação |3: Fralda|4:Banheiro Familiar'));
					new Select(array('label'=>'Tam. Fraldas','name'=>'tamanho','option'=>'1: S/F |2: P |3: M| 4:G |5: xg')); 
					new Select(array('label'=>'Materiais do Fraldário','name'=>'materiais','option'=>'1: Pomada |2: Lencinho |3: Algodão|4:Cotonetes')); 
					new Textarea(array('label'=>'Observação','name'=>'observacao','option'=>'1: ')); 

					new submit();
				?>
			</form>
		</div>
	</div>
	<div class="col-lg-6 ">
		<h2 >Histórico</h2>
		<div class="border">
			<table class="list">  
				<tr> 
					<td>15/08/2017 14:30</td>
					<td>Amamentação</td>
					<td>S/F</td>
					<td>Lencinho</td>
				</tr> 
				<tr> 
					<td>15/08/2017 14:30</td>
					<td>Fralda</td>
					<td>M</td>
					<td>Lencinho</td>
				</tr> 
				<tr> 
					<td>15/08/2017 14:30</td>
					<td>Papinha</td>
					<td>S/F</td>
					<td>Lencinho</td>
				</tr> 
			</table>
		</div>
	</div>	
</div>
