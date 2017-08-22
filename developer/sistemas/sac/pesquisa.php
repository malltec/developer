<?php 
	require_once('../../_app/Config.inc.php'); 
	$pesquisa = $_POST['pesquisa'];		 
	$readConsulta 	= new Read; 
	$val = ''; 
	$readConsulta->FullRead("select * from sac_registro as sg INNER JOIN sac_cadastro_cliente as sc 
							ON sg.sg_codigo_controle=sc.sc_codigo_controle where (sg.sg_protocolo like '%$pesquisa%' || sc.sc_nome like '%$pesquisa%' || sc.sc_cpf like '%$pesquisa%' || sc.sc_rg like '%$pesquisa%' || sc.sc_email like '%$pesquisa%' || sc.sc_telefone like '%$pesquisa%' || sc.sc_celular like '%$pesquisa%') ");
	if ($readConsulta->getRowCount() >= 1){
		$val ='<div class="col-lg-8  ">';
		$val .='<table class="list">';
		$val .='<tbody >';

		$val .='<tr>';
		$val .='<td>Protocolo:</td>';
		$val .='<td>Nome:</td>';
		$val .='<td>CPF:</td>';
		$val .='<td>RG:</td>';
		$val .='<td>E-Mail:</td>';
		$val .='<td>Data de cadastro:</td>';
		$val .='</tr>';

		foreach ($readConsulta->getResult() as $resultSac) {extract($resultSac);			
			$val .='<tr>';
				$val .='<td><a href="?p=novo-registro&codR='.$sc_codigo_controle.'">'.$sg_protocolo.'</a></td>';
				$val .='<td><a href="?p=novo&codR='.$sc_codigo_controle.'">'.$sc_nome.'</a></td>';
				$val .='<td><a href="?p=novo&codR='.$sc_codigo_controle.'">'.$sc_cpf.'</a></td>';
				$val .='<td><a href="?p=novo&codR='.$sc_codigo_controle.'">'.$sc_rg.'</a></td>';
				$val .='<td><a href="?p=novo&codR='.$sc_codigo_controle.'">'.$sc_email.'</a></td>';
				$val .='<td><a href="?p=novo&codR='.$sc_codigo_controle.'">'.Check::DataBr($sc_data_auto).'</a></td>';
			$val .='</tr>';		
		} 

	$val .='</tbody>';
	$val .='</table>';
	$val .='</div>'; 	
}else{
	$val ='<div class="col-lg-8"><p>Para exibir o relatório selecione uma data inicial e final.</p></div>';
}
echo $val;
?>