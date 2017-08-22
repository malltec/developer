<?php 	require('../../inc/prepend.php');
		require_once('../../_app/Config.inc.php'); 
		require('/info_config.php');
		$read 	= new Read; 		 
 ?>
<div class="menu">
	<ul>
		<?php

			aba('Novo','novo','file');
			aba_busca_nome('Busca','data-pag="busca_nome"','busca','search');
			aba('Filtro','filtro','filter');
			aba('Relatório','relatorio','th-list');
			if(rg('p')=='relatorio' || rg('p')=='fraldario-relatorio' || rg('p')=='carrinho-relatorio' || rg('p')=='ramal-relatorio' ){
				aba_busca_data('Data início','datai','calendar');
				aba_busca_data('Data final','dataf','calendar');
			}		
		?>
		<script type="text/javascript">
		$(function(){
			$('[data-type=data]').change(function(){
				var datai = $('#datai').val();
				var dataf = $('#dataf').val();
				if(datai.length >0 || dataf.length >0){			
					window.location.href='?p=relatorio&datai='+datai+'&dataf='+dataf;
				}
			});
		});
	</script>
	</ul>
</div>
<div class="content">
	<?php if(rg('p')=='relatorio'){require('relatorio.php');
	} else if(rg('p')=='cliente'){require('cliente.php');
	} else if(rg('p')=='filtro'){require('filtro.php');
	} else if(rg('p')=='novo'){require('novo.php');
	} else if(rg('p')=='novo-registro'){require('novo-registro.php');
	} else if(rg('p')=='carrinho-novo'){require('carrinho-novo.php');
	} else if(rg('p')=='carrinho-aluguel'){require('carrinho-aluguel.php');
	} else if(rg('p')=='carrinho-relatorio'){require('carrinho-relatorio.php');
	} else if(rg('p')=='fraldario-novo'){require('fraldario-novo.php');
	} else if(rg('p')=='fraldario-registro'){require('fraldario-registro.php');
	} else if(rg('p')=='fraldario-relatorio'){require('fraldario-relatorio.php');
	} else if(rg('p')=='busca-loja'){require('busca-loja.php');
	} else if(rg('p')=='ramal'){require('ramal.php');
	} else if(rg('p')=='ramal-relatorio'){require('ramal-relatorio.php');
	} else if(rg('p')=='loja-relatorio'){require('loja-relatorio.php');
	} else {require('novo.php');
	} ?>
</div>
<style type="text/css">
	.list tbody td .glyphicon {font-size: 12px;margin: 6px 2px 0 0px;float: none; background-color: transparent; color: #52555e;}
	.list tbody td:nth-last-child(1) .glyphicon{font-size: 18px;}
	.list tbody td:nth-last-child(2) .glyphicon{margin-left:6px;}
	.list tbody th:nth-last-child(2){width: 62px;}
	.list { table-layout: initial; }
</style>

<script src="./jsc/controlers.js"></script>
<script src="./jsc/cep.js"></script>
<?php require('../../inc/append.php'); ?>
<style>
.content a {text-decoration: none;color: #000}
.loader {
  border: 2px solid #f3f3f3;
  border-radius: 50%;
  border-top: 2px solid #000;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
