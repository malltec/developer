<div class="bloco1">
	<h2 >Cadastro de Cliente</h2>
	<div class="col-lg-6 border">
		<form action="" enctype="multipart/form-data" name="formCadastro" method="post" data-valor="1">
			<p class="checkbx"> 
                <input type="checkbox" name="fraldario_tipo" value="Cotonetes">&nbsp;&nbsp;Cadastro Anônimo 
            </p>
			<?php 		
				new Text_Cpf(array('label'=>'CPF','name'=>'sc_cpf','required'=>true));
				new Text(array('label'=>'Nome','name'=>'sc_nome','required'=>true));
				new Text_Data(array('label'=>'Nascimento','name'=>'sc_nascimento'));
				new Text_Rg(array('label'=>'RG','name'=>'sc_rg','maxlength'=>'15'));
				new Select(array('label'=>'Sexo','name'=>'sc_sexo','option'=>'1: Masculino|2: Feminino'));
				new Select(array('label'=>'Estado Civil','name'=>'sc_estado_civil','option'=>'1: Solteiro (a)|2: Casado(a)|3: Separado (a)|4: Divorciado (a)|5: Viúvo (a)'));
				new Text_Email(array('label'=>'E-mail','name'=>'sc_email'));
				new Text_Telefone(array('label'=>'Telefone','name'=>'sc_telefone'));
				new Text_Celular(array('label'=>'Celular','name'=>'sc_celular'));
				new Text_Cep(array('label'=>'CEP','name'=>'sc_cep'));
				new Text(array('label'=>'Endereço','name'=>'sc_endereco'));
				new Text(array('label'=>'N°','name'=>'sc_numero'));
				new Text(array('label'=>'Complemento','name'=>'sc_complemento'));
				new Text(array('label'=>'Bairro','name'=>'sc_bairro'));
				new Text(array('label'=>'Cidade','name'=>'sc_cidade'));
				new Text(array('label'=>'UF','name'=>'sc_uf'));

				new submit();
			?>
		</form>
	</div>
</div>
<style type="text/css">
	.checkbx * {vertical-align: sub;  }
</style>
