<?php
require '../../../_app/Config.inc.php';
require '../info_config.php';
$acao		= strip_tags($_POST['acao']);
$Cadastra 	= new Create;
$read 		= new Read;
$update 	= new Update;
switch ($acao){
	case 'CADASTRO_NOVO':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		unset($data_array['acao']);
		unset($data_array['idsac_cadastro_cliente']);
		unset($data_array['sc_codigo_controle']);
		$data_array['sc_codigo_controle'] = md5(time());

		/* VERIFICA SE O CPF JÁ FOI CADASTRADO.*/
		$read->FullRead("SELECT * FROM sac_cadastro_cliente WHERE sc_cpf= '".$data_array['sc_cpf']."'");
		$totalCPF = $read->getRowCount();

		if(!$data_array['sc_cpf'] || !$data_array['sc_nome']){
			$msg 		=  '<p>Preencha os campos</p>';
			$data = array('acao' => 'error', 'msg' => $msg);
			echo json_encode($data);
		}elseif($totalCPF >= 1){
			$msg 		=  '<p>CPF já cadastrado</p>';
			$data = array('acao' => 'error', 'msg' => $msg);
			echo json_encode($data);
		}else{
			/* preparar o cadastro para um futuro cadastro de arquivo.*/
			/*verifica se existe file no post*/

			if(!empty($_FILES['anexo']['name'])){
				$file 	= $_FILES['anexo'];	$upload = new Upload('../uploads/');

				if($_FILES['anexo']['type'] == 'image/jpeg' || $_FILES['anexo']['type'] == 'image/png'){$upload->Image($file);}else{$upload->File($file);}

				if (!$upload->getResult()){
					$msg 		=  '<p> Erro ao enviar arquivo:<br><small>'.$upload->getError().'</small></p>';
					$data = array('acao' => 'error', 'tipo' => 'arquivoNovo', 'msg' => $msg);
					echo json_encode($data);
            	}else{
            		/*Existe imagem no post*/
            		$com_arquivo_name = $upload->getResult();
            		$Cadastra->ExeCreate('sac_cadastro_cliente', $data_array);
					$idsac_cadastro_cliente = $Cadastra->getResult();

            		$arrayArquivo = array(
						'id_generico'			=> $idsac_cadastro_cliente,
						'data_cadastro'			=> date('Y-m-d H:i:s'),
						'nome_arquivo'			=> $com_arquivo_name,
						'nome_arquivo_type'		=> $_FILES['anexo']['type'],						
						'nome_arquivo_size'		=> $_FILES['anexo']['size'],						
						'nome_arquivo_error'	=> $_FILES['anexo']['error'],
						'arq_status'			=> 1,
					);
					$Cadastra->ExeCreate('sac_arquivo', $arrayArquivo);
					if($Cadastra->getResult()):
						$msg 	=  '<p>Dados cadastrados com sucesso.</p>';
						$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$data_array['sc_codigo_controle']);
						echo json_encode($data); 
					endif;
				}
			}else{
				/*Não existe imagem no post*/
				$Cadastra->ExeCreate('sac_cadastro_cliente', $data_array);
				if($Cadastra->getResult()):
						$msg 	=  '<p>Dados cadastrados com sucesso.</p>';
						$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$data_array['sc_codigo_controle']);
						echo json_encode($data); 
				endif;
			}
		}//fim da validação		
	break;		

	case 'ED_CADASTRO':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$cod = $data_array['sc_codigo_controle'];
		$id = $data_array['idsac_cadastro_cliente'];
		unset($data_array['acao']);
		unset($data_array['sc_codigo_controle']);
		unset($data_array['idsac_cadastro_cliente']);

		/* VERIFICA SE O CPF JÁ FOI CADASTRADO.*/
		$read->FullRead("SELECT * FROM sac_cadastro_cliente WHERE sc_cpf= '".$data_array['sc_cpf']."' and idsac_cadastro_cliente <> '".$id."' ");
		$totalCPF = $read->getRowCount();

		if(!$data_array['sc_cpf'] || !$data_array['sc_nome']){
			$msg 		=  '<p>Preencha os campos</p>';
			$data = array('acao' => 'error', 'msg' => $msg);
			echo json_encode($data);
		}elseif($totalCPF >= 1){
			$msg 		=  '<p>CPF já cadastrado</p>';
			$data = array('acao' => 'error', 'msg' => $msg);
			echo json_encode($data);
		}else{
			/* preparar o cadastro para um futuro cadastro de arquivo.*/
			/*verifica se existe file no post*/

			if(!empty($_FILES['anexo']['name'])){
				$file 	= $_FILES['anexo'];	$upload = new Upload('../uploads/');

				if($_FILES['anexo']['type'] == 'image/jpeg' || $_FILES['anexo']['type'] == 'image/png'){$upload->Image($file);}else{$upload->File($file);}

				if (!$upload->getResult()){
					$msg 		=  '<p> Erro ao enviar arquivo:<br><small>'.$upload->getError().'</small></p>';
					$data = array('acao' => 'error', 'tipo' => 'arquivoNovo', 'msg' => $msg);
					echo json_encode($data);
            	}else{
            		/*Existe imagem no post*/
            		$com_arquivo_name = $upload->getResult();            		

            		$update->ExeUpdate('sac_cadastro_cliente', $data_array, "WHERE idsac_cadastro_cliente = :id", 'id='.$id);

            		/*deleta o arquivo*/
					$deleta->ExeDelete("sac_arquivo", "WHERE id_generico = :id", 'id='.$id);

            		$arrayArquivo = array(
						'id_generico'			=> $id,
						'data_cadastro'			=> date('Y-m-d H:i:s'),
						'nome_arquivo'			=> $com_arquivo_name,
						'nome_arquivo_type'		=> $_FILES['anexo']['type'],						
						'nome_arquivo_size'		=> $_FILES['anexo']['size'],						
						'nome_arquivo_error'	=> $_FILES['anexo']['error'],
						'arq_status'			=> 1,
					);
					$Cadastra->ExeCreate('sac_arquivo', $arrayArquivo);

            		if($update->getResult()):
						$msg 	=  '<p>Dado alterado.</p>';
						$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$cod);
						echo json_encode($data); 
					endif;
				}
			}else{
				/*Não existe imagem no post*/
				$update->ExeUpdate('sac_cadastro_cliente', $data_array, "WHERE idsac_cadastro_cliente = :id", 'id='.$id);
				if($update->getResult()):
					$msg 	=  '<p>Dado alterado.</p>';
					$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$cod);
					echo json_encode($data); 
				endif;
			}
		}//fim da validação		
	break;	

	case 'NOVO_REGISTRO':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		unset($data_array['acao']);	
    
		unset($data_array['sg_protocolo']);// ta disabled no html ou seja não vem informação mas por segurança estou removendo o indice. Novo indice [ sg_protocolo_ ]	
    $data_array['sg_protocolo'] = $data_array['sg_protocolo_']; // joga o valor do indice sg_protocolo_ no sg_protocolo
    unset($data_array['sg_protocolo_']);//remove o indece para não dar erro no insert
    
		$data_array['sg_data'] =  Check::Data($data_array['sg_data']);
		if(!$data_array['sg_operador'] || !$data_array['sg_cliente'] || !$data_array['sg_codigo_controle']){
			$msg 		=  '<p>Preencha os campos</p>';
			$data = array('acao' => 'error', 'msg' => $msg);
			echo json_encode($data);
		}else{
			/* preparar o cadastro para um futuro cadastro de arquivo.*/
			/*verifica se existe file no post*/

			if(!empty($_FILES['anexo']['name'])){
				$file 	= $_FILES['anexo'];	$upload = new Upload('../uploads/');

				if($_FILES['anexo']['type'] == 'image/jpeg' || $_FILES['anexo']['type'] == 'image/png'){$upload->Image($file);}else{$upload->File($file);}

				if (!$upload->getResult()){
					$msg 		=  '<p> Erro ao enviar arquivo:<br><small>'.$upload->getError().'</small></p>';
					$data = array('acao' => 'error', 'tipo' => 'arquivoNovo', 'msg' => $msg);
					echo json_encode($data);
            	}else{
            		/*Existe imagem no post*/
            		$com_arquivo_name = $upload->getResult();
            		$Cadastra->ExeCreate('sac_registro', $data_array);
					$idsac_registro = $Cadastra->getResult();

            		$arrayArquivo = array(
						'id_generico'			=> $idsac_registro,
						'data_cadastro'			=> date('Y-m-d H:i:s'),
						'nome_arquivo'			=> $com_arquivo_name,
						'nome_arquivo_type'		=> $_FILES['anexo']['type'],						
						'nome_arquivo_size'		=> $_FILES['anexo']['size'],						
						'nome_arquivo_error'	=> $_FILES['anexo']['error'],
						'arq_status'			=> 2,
					);
					$Cadastra->ExeCreate('sac_arquivo', $arrayArquivo);
					if($Cadastra->getResult()):
						$msg 	=  "<p>Dados cadastrados com sucesso.</p><p>Seu número de protocolo é <b>".$data_array['sg_protocolo']."</b>  </p>";
						$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$data_array['sg_codigo_controle']);
						echo json_encode($data); 
					endif;
				}
			}else{
				/*Não existe imagem no post*/
				$Cadastra->ExeCreate('sac_registro', $data_array);
				if($Cadastra->getResult()):
						$msg 	=  '<p>Dados cadastrados com sucesso.</p>';
						$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$data_array['sg_codigo_controle']);
						echo json_encode($data); 
				endif;
			}
		}//fim da validação		
	break;	

	case 'ED_REGISTRO':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$id=$data_array['id_registro_sac'];		
		$cod=$data_array['sg_codigo_controle'];	
		$data_array['sg_data'] =  Check::Data($data_array['sg_data']);	
		unset($data_array['acao']);		
		unset($data_array['id_registro_sac']);		
		unset($data_array['sg_codigo_controle']);		
		unset($data_array['sg_protocolo']);// ta disabled no html ou seja não vem informação mas por segurança estou removendo o indice. Novo indice [ sg_protocolo_ ]	
    $data_array['sg_protocolo'] = $data_array['sg_protocolo_']; // joga o valor do indice sg_protocolo_ no sg_protocolo
    unset($data_array['sg_protocolo_']);//remove o indece para não dar erro no insert
    
		if(!$data_array['sg_operador'] || !$data_array['sg_cliente']){
			$msg 		=  '<p>Preencha os campos</p>';
			$data = array('acao' => 'error', 'msg' => $msg);
			echo json_encode($data);
		}else{
			/* preparar o cadastro para um futuro cadastro de arquivo.*/
			/*verifica se existe file no post*/

			if(!empty($_FILES['anexo']['name'])){
				$file 	= $_FILES['anexo'];	$upload = new Upload('../uploads/');

				if($_FILES['anexo']['type'] == 'image/jpeg' || $_FILES['anexo']['type'] == 'image/png'){$upload->Image($file);}else{$upload->File($file);}

				if (!$upload->getResult()){
					$msg 		=  '<p> Erro ao enviar arquivo:<br><small>'.$upload->getError().'</small></p>';
					$data = array('acao' => 'error', 'tipo' => 'arquivoNovo', 'msg' => $msg);
					echo json_encode($data);
            	}else{
            		/*Existe imagem no post*/
            		$com_arquivo_name = $upload->getResult();            		
					$update->ExeUpdate('sac_registro', $data_array, "WHERE id_registro_sac = :id", 'id='.$id);

					/*deleta o arquivo*/
					$deleta->ExeDelete("sac_arquivo", "WHERE id_generico = :id", 'id='.$id);

            		$arrayArquivo = array(
						'id_generico'			=> $id,
						'data_cadastro'			=> date('Y-m-d H:i:s'),
						'nome_arquivo'			=> $com_arquivo_name,
						'nome_arquivo_type'		=> $_FILES['anexo']['type'],						
						'nome_arquivo_size'		=> $_FILES['anexo']['size'],						
						'nome_arquivo_error'	=> $_FILES['anexo']['error'],
						'arq_status'			=> 2,
					);
					$Cadastra->ExeCreate('sac_arquivo', $arrayArquivo);

					if($update->getResult()):
						$msg 	=  '<p>Dado alterado.</p>';
						$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$cod);
						echo json_encode($data); 
					endif;					
				}
			}else{
				/*Não existe imagem no post*/
				$update->ExeUpdate('sac_registro', $data_array, "WHERE id_registro_sac = :id", 'id='.$id);
				if($update->getResult()):
					$msg 	=  '<p>Dado alterado.</p>';
					$data = array('acao' => 'success', 'msg' => $msg, 'cod'=>$cod);
					echo json_encode($data); 
				endif;
			}
		}//fim da validação		
	break;

 default; header('Location:/sistemas/sac/');	
}//FIM DO BLOCO
?>