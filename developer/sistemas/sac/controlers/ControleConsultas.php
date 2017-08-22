<?php

require '../../../_app/Config.inc.php';
require '../info_config.php';
$acao = strip_tags($_POST['acao']);
$Cadastra = new Create;
$read = new Read;
$update = new Update;
switch ($acao) {
    /*
     * Consulta cpf já cadastrado
     * função só é executado quando o blur do jquery é acionado.
     */
    case 'CONSULTA_CPF':

        $data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $read->FullRead("SELECT * FROM sac_cadastro_cliente WHERE sc_cpf= '" . $data_array['sc_cpf'] . "'");
        if ($read->getRowCount() >= 1) {
            foreach ($read->getResult() as $resultCPF) {
                extract($resultCPF);
            }
            /* Código temporario, retorna todos optons das opções abaixo. */
            $arraySexo = array(1 => 'Masculino', 2 => 'Feminino');
            foreach ($arraySexo as $key => $values) {
                if ($sc_sexo == $key) {
                    $sc_sexo .='<option value="' . $key . '" selected >' . $values . '</option>';
                } else {
                    $sc_sexo .='<option value="' . $key . '">' . $values . '</option>';
                }
            }

            $arrayCivil = array(1 => 'Solteiro (a)', 2 => 'Casado(a)', 3 => 'Separado (a)', 4 => 'Divorciado (a)', 5 => 'Viúvo (a)');
            foreach ($arrayCivil as $keys => $valCivil) {
                if ($sc_estado_civil == $keys) {
                    $sc_estado_civil .= '<option value="' . $keys . '" selected >' . $valCivil . '</option>';
                } else {
                    $sc_estado_civil .= '<option value="' . $keys . '">' . $valCivil . '</option>';
                }
            }


            $data = array(
                'retorno' => 1,
                'sc_cpf' => $sc_cpf,
                'sc_nome' => $sc_nome,
                'sc_nascimento' => $sc_nascimento,
                'sc_rg' => $sc_rg,
                'sc_sexo' => $sc_sexo,
                'sc_estado_civil' => $sc_estado_civil,
                'sc_email' => $sc_email,
                'sc_telefone' => $sc_telefone,
                'sc_celular' => $sc_celular,
                'sc_cep' => $sc_cep,
                'sc_endereco' => $sc_endereco,
                'sc_numero' => $sc_numero,
                'sc_complemento' => $sc_complemento,
                'sc_bairro' => $sc_bairro,
                'sc_cidade' => $sc_cidade,
                'sc_uf' => $sc_uf,
                'sc_codigo_controle' => $sc_codigo_controle,
                'idsac_cadastro_cliente' => $idsac_cadastro_cliente,
                'acao' => 'ED_CADASTRO',
            );
        } else {
            $data = array('retorno' => 0);
        }
        echo json_encode($data);
        break;
    default;
        header('Location:/sistemas/sac/');
}//FIM DO BLOCO
