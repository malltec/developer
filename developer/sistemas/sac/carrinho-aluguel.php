<div class="row">
	<div class="col-lg-6 ">
		<h2 >Aluguel de Carrinho</h2>
		<div class="border">
			<form action="" enctype="multipart/form-data" name="formCadastro" method="post" data-valor="1">
				<?php 		
					new Text_Data(array('label'=>'Data','name'=>'data', 'badge'=>'calendar'));
					new Select(array('label'=>'Serviço','name'=>'servico','option'=>'1: Cadeira de Rodas (a)|2: Carrinho'));
					new Select(array('label'=>'Numerador','name'=>'numerador','option'=>'1: '));
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
					<td class="bold">Carrinho n°</td>
					<td class="bold">Data/Hora</td>
					<td class="bold">Baixa</td>
				</tr>
				<tr>
					<td>001</td>
					<td>15/08/2017 14:30</td>
					<td><i class="glyphicon glyphicon-ok-sign"></i></td>
				</tr>
				<tr>
					<td>003</td>
					<td>15/08/2017 14:30</td>
					<td><i class="glyphicon glyphicon-ok-sign"></i></td>
				</tr>
				<tr>
					<td>003</td>
					<td>15/08/2017 14:30</td>
					<td><i class="glyphicon glyphicon-ok-sign "></i></td>
				</tr>
				<tr>
					<td>004</td>
					<td>15/08/2017 14:30</td>
					<td><i class="glyphicon glyphicon-ok-sign"></i></td>
				</tr> 
			</table>
		</div>
	</div>	
</div>
