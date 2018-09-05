@extends('layouts.home.home')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mt-4"> </div>
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Participar</h2>
            <hr class="star-dark mb-5">

            <div class="masthead text-black box-primary text-center">
                <div class="container">
                    <h1 class="text-uppercase mb-4">{{$sorteios->titulo_sorteio}}</h1>
                    <h2 class="font-weight-light mb-0">{{$sorteios->descricao_sorteio}}</h2>
                </div>
            </div>

            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form action="{{route('cliente.save')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!--Id Do sorteio-->
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Id Sorteio</label>
                                <input class="form-control" id="sorteio_id" name="sorteio_id" type="text" placeholder="Id Sorteio" value="{{$sorteios->id}}" readonly>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Id Participante</label>
                                <input class="form-control" id="id_participante" name="id_participante" type="text" placeholder="ID Participante" value="" readonly>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Celular</label>
                                <input class="form-control" id="phone" name="celular" type="tel" placeholder="Celular"
                                       data-validation-required-message="Please enter your phone number." maxlength="11" value="" required>
                                <p id="msg_phone" class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Nome</label>
                                <input class="form-control" id="name" name="nome" type="text" placeholder="Nome" value="" required
                                       data-validation-required-message="Please enter your Nome." maxlength="60">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>E-mail</label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="E-mail"
                                       data-validation-required-message="Please enter your email address." value="" maxlength="40">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Cpf</label>
                                <input class="form-control" id="cpf" name="cpf" type="text"
                                       data-validation-required-message="Please enter your CPF number." maxlength="11" placeholder="Cpf" value="">
                                <p id="msg_cpf" class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Data de Nascimento</label>
                                <input class="form-control" id="dtnasc" name="dtnasc" type="date" placeholder="Data de Nacimento"
                                       data-validation-required-message="Please enter your Data de Nascimento." value="" required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Cep</label>
                                <input class="form-control" id="cep" name="cep" type="text" placeholder="Cep"
                                       data-validation-required-message="Please enter your Cep number." maxlength="8" value="" required>
                                <p id="msg_cep" class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Genero</label>
                            <div class="form-group controls mb-0 pb-2">
                                <select id="genero_id" name="genero_id" class="form-control" required>
                                    <option value="">Escolha um Genero</option>
                                    @foreach($generos as $genero)
                                        <option value="{{$genero->id}}">{{$genero->genero}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton" >Participar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('partials.home._scripts')
    <script>
        //=====================================================================================================
        //AO PERDER O FOCO DO CAMPO PHONE
        $('#phone').blur(function(){
            //console.log($(this).val());
            let phone = $(this).val();
            $('#msg_phone').html("");
            if(phone.length == 11){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('consulta.telefone') }}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, phone: phone},
                    success: function (data) {
                        if(data.phone != undefined){
                            $('#phone').val(data.phone[0].celular);
                            $('#name').val(data.phone[0].nome).attr('readonly', true);
                            $('#email').val(data.phone[0].email).attr('readonly', true);
                            $('#cpf').val(data.phone[0].cpf).attr('readonly', true);
                            $('#cep').val(data.phone[0].cep).attr('readonly', true);
                            $('#dtnasc').val(data.phone[0].dtnasc).attr('readonly', true);
                            $('#genero_id').val(data.phone[0].genero_id).attr('disabled', true);
                        }
                        else {
                            $('#name').removeAttr("readonly").val('');
                            $('#email').removeAttr("readonly").val('');
                            $('#cpf').removeAttr("readonly").val('');
                            $('#cep').removeAttr("readonly").val('');
                            $('#dtnasc').removeAttr("readonly").val('');
                            $('#genero_id').removeAttr("readonly").val('');
                        }
                    }
                });
            }else {
                console.log('NÃO CADASTRADO');
                $('#name').removeAttr("readonly").val('');
                $('#email').removeAttr("readonly").val('');
                $('#cpf').removeAttr("readonly").val('');
                $('#cep').removeAttr("readonly").val('');
                $('#dtnasc').removeAttr("readonly").val('');
                $('#genero_id').removeAttr("readonly").val('');
            };
        });

        //=====================================================================================================
        //AO PERDER O FOCO DO CAMPO CPF VERIFICA SE OS DADOS PREENCHIDOS ESTÃO CORRETOS
        $('#cpf').blur(function(){
            var cpf = $(this).val();
            var cpfValido = validarCPF(cpf);
            //console.log(cpf);
            $('#msg_cpf').html("");

            if(!cpfValido && cpf != "") {
                $('#msg_cpf').html("CPF/CNPJ inválido.");
                $("#sendMessageButton").attr("disabled", "disabled");
            }
            else if(cpf.length < 11 && cpf.length > 0){
                $('#msg_cpf').html("CPF/CNPJ inválido.");
                $("#sendMessageButton").attr("disabled", "disabled");
            }
            else if(cpf.length == 11){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('consulta.cpf') }}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, cpf: cpf},
                    success: function(data){
                        if(data.cpf.length > 0){
                            $('#msg_cpf').html("CPF/CNPJ já existente.").css("color", "red").css("font-size", "small");
                            $("#sendMessageButton").attr("disabled", "disabled");
                        }
                        else{
                            console.log("CPF OK");
                            $("#sendMessageButton").removeAttr("disabled");
                        }
                    }
                });
            }
        });

        //FUNÇÃO PARA VALIDAÇÃO DO CPF
        function validarCPF(cpf){
            var numeros, digitos, soma, i, resultado, digitos_iguais;
            digitos_iguais = 1;
            if (cpf.length < 11)
                return false;
            for (i = 0; i < cpf.length - 1; i++)
                if (cpf.charAt(i) != cpf.charAt(i + 1))
                {
                    digitos_iguais = 0;
                    break;
                }
            if (!digitos_iguais)
            {
                numeros = cpf.substring(0,9);
                digitos = cpf.substring(9);
                soma = 0;
                for (i = 10; i > 1; i--)
                    soma += numeros.charAt(10 - i) * i;
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(0))
                    return false;
                numeros = cpf.substring(0,10);
                soma = 0;
                for (i = 11; i > 1; i--)
                    soma += numeros.charAt(11 - i) * i;
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(1))
                    return false;
                return true;
            }
            else
                return false;
        }

        //QUANDO O CAMPO CEP PERDE O FOCO.
        $("#cep").blur(function() {
            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');
            $('#msg_cep').html("");
            //Verifica se campo cep possui valor informado.
            if (cep != "") {
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;
                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            console.log('CEP Ok');
                            $("#sendMessageButton").removeAttr("disabled");
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            $('#msg_cep').html("CEP não encontrado.");
                            $("#sendMessageButton").attr("disabled", "disabled");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    $('#msg_cep').html("CEP inválido.");
                    $("#sendMessageButton").attr("disabled", "disabled");
                }
            }
        });
    </script>

@stop
