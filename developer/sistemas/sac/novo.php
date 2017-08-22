<div class="bloco1">
	<?php
	$get = filter_input(INPUT_GET,'codR');
	if (isset($get) && isset($get) != '') {	
		$readConsulta 	= new Read; 
		$readConsulta->FullRead("select * from sac_cadastro_cliente where sc_codigo_controle='".$get."'");	
		if ($readConsulta->getRowCount() >= 1){foreach ($readConsulta->getResult() as $resultSac) {extract($resultSac);}}
		$acao = 'ED_CADASTRO';
		//$nameForm = 'edFormRegistro';
	}else{
		$acao = 'CADASTRO_NOVO';
		//$nameForm = 'formCadastro';
		$sc_cpf=null;$sc_nome=null;$sc_nascimento=null;$sc_rg=null;$sc_sexo=null;$sc_estado_civil=null;$sc_email=null;$sc_telefone=null;$sc_celular=null;$sc_cep=null;$sc_endereco=null;$sc_numero=null;$sc_complemento=null;$sc_bairro=null;$sc_cidade=null;$sc_uf=null;$idsac_cadastro_cliente=null;
	}
	?>
	<h2 >Cadastro de Cliente</h2>
	<div class="col-lg-6 border">
		<form action="<?php echo URL;?>/controlers/controleNovo.php" enctype="multipart/form-data" name="formCadastro" method="post" data-valor="1">
			<?php 		
				new Text_Cpf(array('label'=>'CPF','name'=>'sc_cpf','required'=>true, 'value'=>$sc_cpf));
				new Text(array('label'=>'Nome','name'=>'sc_nome','required'=>true, 'value'=>$sc_nome));
				new Text_Data(array('label'=>'Nascimento','name'=>'sc_nascimento', 'value'=>$sc_nascimento));
				new Text_Rg(array('label'=>'RG','name'=>'sc_rg','maxlength'=>'15', 'value'=>$sc_rg));
				new Select(array('label'=>'Sexo','name'=>'sc_sexo','option'=>'1: Masculino|2: Feminino', 'value'=>$sc_sexo));
				new Select(array('label'=>'Estado Civil','name'=>'sc_estado_civil','option'=>'1: Solteiro (a)|2: Casado(a)|3: Separado (a)|4: Divorciado (a)|5: Viúvo (a)', 'value'=>$sc_estado_civil));
				new Text_Email(array('label'=>'E-mail','name'=>'sc_email', 'value'=>$sc_email));
				new Text_Telefone(array('label'=>'Telefone','name'=>'sc_telefone', 'value'=>$sc_telefone));
				new Text_Celular(array('label'=>'Celular','name'=>'sc_celular', 'value'=>$sc_celular));
				new Text_Cep(array('label'=>'CEP','name'=>'sc_cep', 'value'=>$sc_cep));
				new Text(array('label'=>'Endereço','name'=>'sc_endereco', 'value'=>$sc_endereco));
				new Text(array('label'=>'N°','name'=>'sc_numero', 'value'=>$sc_numero));
				new Text(array('label'=>'Complemento','name'=>'sc_complemento', 'value'=>$sc_complemento));
				new Text(array('label'=>'Bairro','name'=>'sc_bairro', 'value'=>$sc_bairro));
				new Text(array('label'=>'Cidade','name'=>'sc_cidade', 'value'=>$sc_cidade));
				new Text(array('label'=>'UF','name'=>'sc_uf', 'value'=>$sc_uf));
			?>
			<input type="hidden" name="sc_idusuario" value="<?php echo $_SESSION['usuario_id'];?>">
			<input type="hidden" name="acao" value="<?php echo $acao;?>">
			<input type="hidden" name="sc_codigo_controle" value="<?php echo $get;?>">
			<input type="hidden" name="idsac_cadastro_cliente" value="<?php echo $idsac_cadastro_cliente;?>">
			<button id="botao_submit1" type="Submit" class="submit_black"></button>
		</form>
	</div>
</div>
<div class="bloco2 hidden">
	<div class="col-lg-12 border recebe_pesquisa"></div>	
</div>  
















