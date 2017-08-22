<div class="bloco1">
    <?php $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);?>
    <h2 >Filtro</h2>
    <div class="col-lg-6 border">
        <form action="" method="post">
            <input type="hidden" name="acao" value="pesquisar">
            <?php
            new Text(array('label' => 'Protocolo', 'name' => 'sg_protocolo', 'value' => $post['sg_protocolo']));
            new Text(array('label' => 'Operador', 'name' => 'nome', 'value' => $post['nome']));            
            new Select_sql(array('label' => 'Cliente', 'name' => 'sg_cliente', 'value' => $post['sg_cliente'], 'sql' => "select id ,cliente as 'nome' from sac_configuracao where ativo=1 and tipo ='cliente' order by nome asc"));
            new Select_sql(array('label' => 'Contato', 'name' => 'sg_contato', 'value' => $post['sg_contato'], 'sql' => "select contato as 'nome', id from sac_configuracao where ativo=1 and tipo ='contato' order by nome asc"));
            new Select_sql(array('label' => 'Motivo', 'name' => 'sg_motivo', 'value' => $post['sg_motivo'], 'sql' => "select motivo as 'nome', id from sac_configuracao where ativo=1 and tipo ='motivo' order by nome asc"));
            new Text_Data(array('label' => 'Data', 'name' => 'sg_data', 'badge' => 'calendar', 'value' => $post['sg_data']));
            new Select_sql(array('label' => 'Depto.', 'name' => 'sg_departamento', 'value' => $post['sg_departamento'], 'sql' => "select departamento as 'nome', id from sac_configuracao where ativo=1 and tipo ='depto' order by nome asc"));
            new Select_sql(array('label' => 'Assunto', 'name' => 'sg_assunto', 'value' => $post['sg_assunto'], 'sql' => "select assunto as 'nome', id from sac_configuracao where ativo=1 and tipo ='assunto' order by nome asc"));
            //new Select(array('label' => 'Estado', 'name' => 'sg_status', 'value' => $post['sg_status'], 'option' => '1: Andamento | 2: Pendente | 3: Concluído '));
            new submit();
            ?>

        </form>
    </div>
    <?php
    if (isset($post['acao']) && isset($post['acao']) == 'pesquisar') {
        $nomeCli = $post['nome'];
        $post['sg_data'] = data_sql($post['sg_data']);
        unset($post['acao']);
        unset($post['nome']);
        $val = '';
        foreach ($post as $key => $value) {
          $val .= $post[$key] != '' ? " and $key = '" . $post[$key] . "'" : "";
        }

        $readConsulta = new Read;
        $read = new Read;
        //$readConsulta->FullRead("select * from sac_registro where ativo=1 $val ");	
        $readConsulta->FullRead("select * from sac_registro as sg INNER JOIN sac_cadastro_cliente as sc 
							ON sg.sg_codigo_controle=sc.sc_codigo_controle where sg.sg_operador like '%$nomeCli%' $val");
        if ($readConsulta->getRowCount() >= 1) {
            ?>
            <h2>Cliente</h2>
            <div class="col-lg-12 border ">
                <table class="list">
                    <tbody > 
                        <tr>
                            <td>Protocolo:</a></td>
                            <td>Nome do operador:</td>
                            <td>Cliente:</a></td> 
                            <td>Contato:</a></td> 
                            <td>Motivo:</a></td> 
                            <td>Departamento:</a></td>
                            <td>Assunto:</a></td>
                            <td>Data do cadastro:</a></td>
                            <td>Data da ocorrência:</a></td>
                        </tr>	
                        <?php
                        foreach ($readConsulta->getResult() as $resultSac) {
                            extract($resultSac);
                            $read->FullRead("SELECT * FROM sac_configuracao WHERE id in($sg_departamento,$sg_contato,$sg_motivo,$sg_cliente,$sg_assunto)");                           
                            if ($read->getRowCount() >= 1) {                               
                                foreach ($read->getResult() as $result) {                                   
                                    extract($result);
                                     if($sg_cliente == $id){$cli = $cliente;}
                                     if($sg_contato == $id){$cont = $contato;}
                                     if($sg_motivo == $id){$mot = $motivo;}
                                     if($sg_departamento == $id){$depto = $departamento;}
                                     if($sg_assunto == $id){$ass = $assunto;}
                                }                                
                            }
                            ?>
                            <tr>
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php echo $sg_protocolo; ?></a></td>                                
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php echo $sg_operador; ?></a></td>
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php echo $cli; ?></a></td>
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php echo $cont; ?></a></td>
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php echo $mot; ?></a></td>
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php echo $depto; ?></a></td>		
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php echo $ass; ?></a></td>		
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php if(!empty($sg_data_auto)){echo data($sg_data_auto);}?></a></td>
                                <td><a href="?p=novo-registro&codR=<?php echo $sg_codigo_controle ?>"><?php if(!empty($sg_data)){echo data($sg_data);}?></a></td>
                            </tr>		
            <?php } ?>
                    </tbody>
                </table>
            </div> 

    <?php } else { ?>
            <div class="col-lg-8 border ">Nenhum resultado encontrado.</div>	 
    <?php } ?>

<?php } ?>

</div>
<div class="bloco2 hidden">
    <div class="col-lg-12 border recebe_pesquisa"></div>	
</div>
