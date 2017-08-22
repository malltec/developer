$().ready(function () {
    function consultaCPFCadastrado1(val) {
        $.ajax({
            url: 'controlers/ControleConsultas.php',
            dataType: "json",
            type: 'POST',
            data: {sc_cpf: val, acao: 'CONSULTA_CPF'},
            success: function (responseText) {
                if (responseText.retorno > 0) {
                     alerta('<p> CPF já está cadastrado.</p>');
                     $('#sc_cpf').val('');
                }
                
            },
            beforeSend: function () {},
            complete: function () {},
            error: function () {}
        });
    }

    function consultaCPFCadastrado2(val) {
        $.ajax({
            url: 'controlers/ControleConsultas.php',
            dataType: "json",
            type: 'POST',
            data: {sc_cpf: val, acao: 'CONSULTA_CPF'},
            success: function (responseText) {
                //console.log(responseText);
                if (responseText.retorno > 0) {
                    alerta('<p>Aguarde, carregando os dados.</p>');                    
                    $('input[name="sc_cpf"]').val(responseText.sc_cpf);
                    $('input[name="sc_nome"]').val(responseText.sc_nome);
                    $('input[name="sc_nascimento"]').val(responseText.sc_nascimento);
                    $('input[name="sc_rg"]').val(responseText.sc_rg);
                    $('select[name="sc_sexo"]').html(responseText.sc_sexo);                   
                    $('select[name="sc_estado_civil"]').html(responseText.sc_estado_civil);
                    $('input[name="sc_email"]').val(responseText.sc_email);
                    $('input[name="sc_telefone"]').val(responseText.sc_telefone);
                    $('input[name="sc_celular"]').val(responseText.sc_celular);
                    $('input[name="sc_cep"]').val(responseText.sc_cep);
                    $('input[name="sc_endereco"]').val(responseText.sc_endereco);
                    $('input[name="sc_numero"]').val(responseText.sc_numero);
                    $('input[name="sc_complemento"]').val(responseText.sc_complemento);
                    $('input[name="sc_bairro"]').val(responseText.sc_bairro);
                    $('input[name="sc_cidade"]').val(responseText.sc_cidade);
                    $('input[name="sc_uf"]').val(responseText.sc_uf);
                    $('input[name="sc_codigo_controle"]').val(responseText.sc_codigo_controle);
                    $('input[name="idsac_cadastro_cliente"]').val(responseText.idsac_cadastro_cliente);
                    $('input[name="acao"]').val('ED_CADASTRO');                    
                }else{
                    $('input[name="acao"]').val('CADASTRO_NOVO');                     
                    $('input[name="sc_nome"]').val('');
                    $('input[name="sc_nascimento"]').val('');
                    $('input[name="sc_rg"]').val('');
                   // $('select[name="sc_sexo"]').html('');
                    //$('select[name="sc_estado_civil"]').html('');
                    $('input[name="sc_email"]').val('');
                    $('input[name="sc_telefone"]').val('');
                    $('input[name="sc_celular"]').val('');
                    $('input[name="sc_cep"]').val('');
                    $('input[name="sc_endereco"]').val('');
                    $('input[name="sc_numero"]').val('');
                    $('input[name="sc_complemento"]').val('');
                    $('input[name="sc_bairro"]').val('');
                    $('input[name="sc_cidade"]').val('');
                    $('input[name="sc_uf"]').val('');
                    $('input[name="sc_codigo_controle"]').val('');
                    $('input[name="idsac_cadastro_cliente"]').val('');
                }
            },
            beforeSend: function () {},
            complete: function () {},
            error: function () {}
        });
    }

    $('#sc_cpf').blur(function (event) {
        var sc_cpf = $(this).val();
        //var acao = $('input[name="acao"]').val(); 
       /* if (sc_cpf.length > 0 && acao === 'CADASTRO_NOVO') {
            consultaCPFCadastrado1(sc_cpf);
        }*/
        if (sc_cpf.length > 0 ) {
            consultaCPFCadastrado2(sc_cpf);
        }
    });

    /*Novo Registro*/
    $('form[name="formCadastro"]').submit(function () {
        var dados = $(this).serialize();
        var action = $(this).attr('action');
        var valor = $(this).attr('data-valor');
        $.ajax({
            url: action,
            dataType: "json",
            type: 'POST',
            data: dados,
            success: function (responseText) {
                //console.log(responseText);
                if (responseText.acao == 'success') {
                    $('#botao_submit' + valor).removeClass('submit_black');
                    $('#botao_submit' + valor).removeClass('submit_red');
                    $('#botao_submit' + valor).addClass('submit_green');
                    alerta(responseText.msg);
                    window.setTimeout(function () {
                        window.location.href = '?p=novo-registro&codR=' + responseText.cod;
                    }, 2000);
                } else {
                    $('#botao_submit' + valor).removeClass('submit_black');
                    $('#botao_submit' + valor).removeClass('submit_green');
                    $('#botao_submit' + valor).addClass('submit_red');
                    alerta(responseText.msg);
                }
            },
            beforeSend: function () {
                $('#botao_submit' + valor).html('<div class="loader"></div>');
            },
            complete: function () {
                $('#botao_submit' + valor).html('')
            },
            error: function () {
                alert('Erro no processamento, fale com nosso suporte');
            }
        });
        return false;
    });

    $('form[name="formRegistro"]').submit(function () {
        var dados = $(this).serialize();
        var action = $(this).attr('action');
        var valor = $(this).attr('data-valor');
        $.ajax({
            url: action,
            dataType: "json",
            type: 'POST',
            data: dados,
            success: function (responseText) {
               // console.log(responseText);
                if (responseText.acao == 'success') {
                    $('#botao_submit' + valor).removeClass('submit_black');
                    $('#botao_submit' + valor).removeClass('submit_red');
                    $('#botao_submit' + valor).addClass('submit_green');
                    alerta(responseText.msg);
                    window.setTimeout(function () {
                        window.location.href = '?p=novo-registro&codR=' + responseText.cod;
                    }, 2000);
                } else {
                    $('#botao_submit' + valor).removeClass('submit_black');
                    $('#botao_submit' + valor).removeClass('submit_green');
                    $('#botao_submit' + valor).addClass('submit_red');
                    alerta(responseText.msg);
                }
            },
            beforeSend: function () {
                $('#botao_submit' + valor).html('<div class="loader"></div>');
            },
            complete: function () {
                $('#botao_submit' + valor).html('')
            },
            error: function () {
                alert('Erro no processamento, fale com nosso suporte');
            }
        });
        return false;
    });


    $('#Busca').on('keyup', function () {
        var val = $(this).val().length;
        if (val <= 0) {
            $('.bloco2').addClass('hidden');
            $('.bloco1').fadeIn('slow');
        }
    });

    $('#Busca').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            $('.bloco1').hide();
            $('.bloco2').removeClass('hidden');
            var idusuario = $('#idusuario').val();
            var permissao = $('#permissao').val();
            var pesquisa = $(this).val();

            $.ajax({
                url: 'pesquisa.php',
                type: 'POST',
                data: {pesquisa: pesquisa, idusuario: idusuario, permissao: permissao},
                success: function (responseText) {
                    $('.recebe_pesquisa').html(responseText);
                },
                beforeSend: function () {
                    $('.recebe_pesquisa').html('<div class="loader"></div>');
                },
                complete: function () {
                    $('.loader').hide();
                },
                error: function () {
                    alert('Erro no processamento, fale com nosso suporte');
                }
            });
        }
    });

}); //fim do documento