$(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#sc_endereco").val("");
                $("#sc_bairro").val("");
                $("#sc_cidade").val("");
                $("#sc_uf").val("");
                $("#sc_numero").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#sc_cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#sc_endereco").val("...");
                        $("#sc_bairro").val("...");
                        $("#sc_cidade").val("...");
                        $("#sc_uf").val("...");
                        $("#sc_numero").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#sc_endereco").val(dados.logradouro);
                                $("#sc_bairro").val(dados.bairro);
                                $("#sc_cidade").val(dados.localidade);
                                $("#sc_uf").val(dados.uf);
                                $("#sc_numero").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
