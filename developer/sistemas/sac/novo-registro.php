<?php
$get = filter_input(INPUT_GET, 'codR');
if (isset($get) && $get <> '') {
    ?>
    <?php
    $readUsuario = new Read;
    $readUsuario->FullRead("select p.nome as 'nome_usuario' from usuario as us inner join pessoa as p on us.pessoa_id=p.id where us.id = '".$_SESSION['usuario_id']."'");
    if ($readUsuario->getRowCount() >= 1) {foreach ($readUsuario->getResult() as $resultUser) {extract($resultUser);}}
    
    $readConsulta = new Read;
    $readConsulta->FullRead("select * from sac_registro where sg_codigo_controle='" . $get . "'");
    if ($readConsulta->getRowCount() >= 1) {
        foreach ($readConsulta->getResult() as $resultSac) {
            extract($resultSac);
        }
        $acao = 'ED_REGISTRO';
        //$nameForm = 'edFormRegistro';
    } else {
        //$nameForm = 'formRegistro';
        $acao = 'NOVO_REGISTRO';
        $sg_protocolo = substr(date("Ymd") . mt_rand(), 0, 9);
        $sg_cliente = null;
        $sg_contato = null;
        $sg_departamento = null;
        $sg_assunto = null;
        $sg_motivo = null;
        $sg_setores = null;
        $sg_operador = $nome_usuario;
        $sg_data = null;
        $sg_empresa = null;
        $sg_email = null;
        $sg_descricao_texto = null;
        $sg_andamento_texto = null;
        $sg_conclusao_texto = null;
        $id_registro_sac = null;
        $sg_loja = null;
    }
    ?>
    <div class="bloco1">
        <h2 >Registro de SAC</h2>
        <div class="col-lg-6 border">
            <form action="<?php echo URL; ?>/controlers/controleNovo.php" enctype="multipart/form-data" name="formRegistro" method="post" data-valor="1">
                <?php
                new Text(array('label' => 'Protocolo', 'name' => 'sg_protocolo', 'value' => $sg_protocolo, 'disabled' => 'disabled'));
                new Text(array('label' => 'Operador', 'name' => 'sg_operador', 'value' => $sg_operador));
                new Text_Data(array('label' => 'Data', 'name' => 'sg_data', 'badge' => 'calendar', 'value' => $sg_data));
                new Text(array('label' => 'Empresa', 'name' => 'sg_empresa', 'value' => $_SESSION['empreendimento_nome']));
                new Select_sql(array('label' => 'Cliente', 'name' => 'sg_cliente', 'value' => $sg_cliente, 'sql' => "select cliente as 'nome', id from sac_configuracao where ativo=1 and tipo ='cliente' order by nome asc"));
                new Select_sql(array('label' => 'Contato', 'name' => 'sg_contato', 'value' => $sg_contato, 'sql' => "select contato as 'nome', id from sac_configuracao where ativo=1 and tipo ='contato' order by nome asc"));
                new Select_sql(array('label' => 'Depto.', 'name' => 'sg_departamento', 'value' => $sg_departamento, 'sql' => "select departamento as 'nome', id from sac_configuracao where ativo=1 and tipo ='depto' order by nome asc"));
                new Select_sql(array('label' => 'Assunto', 'name' => 'sg_assunto', 'value' => $sg_assunto, 'sql' => "select assunto as 'nome', id from sac_configuracao where ativo=1 and tipo ='assunto' order by nome asc"));
                new Select_sql(array('label' => 'Motivo', 'name' => 'sg_motivo', 'value' => $sg_motivo, 'sql' => "select motivo as 'nome', id from sac_configuracao where ativo=1 and tipo ='motivo' order by nome asc"));
                new Select_sql(array('label' => 'Setores', 'name' => 'sg_setores', 'value' => $sg_setores, 'sql' => "select setor as 'nome', id from sac_configuracao where ativo=1 and tipo ='setor' order by nome asc"));
                new Select_sql(array('label' => 'Loja', 'name' => 'sg_loja', 'sql' => "select id, nome from loja where empreendimento_id = '" . $_SESSION['empreendimento_id'] . "' order by nome asc", 'value' => $sg_loja));
                new Text_Email(array('label' => 'E-mail', 'name' => 'sg_email', 'value' => $sg_email));
                new Textarea(array('label' => 'Descrição', 'name' => 'sg_descricao_texto', 'value' => $sg_descricao_texto));
                new Textarea(array('label' => 'Andamento', 'name' => 'sg_andamento_texto', 'value' => $sg_andamento_texto));
                new Textarea(array('label' => 'Conclusão', 'name' => 'sg_conclusao_texto', 'value' => $sg_conclusao_texto));
                ?>    
                <input type="hidden" name="sg_idusuario" value="<?php echo $_SESSION['usuario_id']; ?>">
                <input type="hidden" name="acao" value="<?php echo $acao; ?>">
                <input type="hidden" name="sg_protocolo_" value="<?php echo $sg_protocolo; ?>">
                <input type="hidden" name="sg_codigo_controle" value="<?php echo $get; ?>">
                <input type="hidden" name="id_registro_sac" value="<?php echo $id_registro_sac; ?>">
                <button id="botao_submit1" type="Submit" class="submit_black"></button>
            </form>		
        </div>
    </div>
    <div class="bloco2 hidden">
        <div class="col-lg-12 border recebe_pesquisa"></div>	
    </div>
<?php } else { ?>
    <div class="col-lg-6 border"><p>Esta página não pode ser acessada sem parâmetros.</p></div>
<?php } ?> 