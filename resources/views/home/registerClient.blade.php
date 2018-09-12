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
                    <form enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!--Id Do sorteio-->
                        <input class="form-control" id="sorteio_id" name="sorteio_id" type="text" placeholder="Id Sorteio" value="{{$sorteios->id}}" hidden readonly>
                        <input class="form-control" id="id_participante" name="id_participante" type="text" placeholder="ID Participante" value="" hidden readonly>
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
                            <button type="button" class="btn btn-primary btn-xl" id="sendMessageButton" >Participar</button>
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
                    data: {_token: CSRF_TOKEN, celular: phone},
                    success: function (data) {
                        if(data.phone != undefined){
                            $('#phone').val(data.phone[0].celular);
                            $('#id_participante').val(data.phone[0].id);
                            $('#name').val(data.phone[0].nome).attr('readonly', true);
                            $('#email').val(data.phone[0].email).attr('readonly', true);
                            $('#cpf').val(data.phone[0].cpf).attr('readonly', true);
                            $('#cep').val(data.phone[0].cep).attr('readonly', true);
                            $('#dtnasc').val(data.phone[0].dtnasc).attr('readonly', true);
                            $('#genero_id').val(data.phone[0].genero_id).attr('readonly', true);
                        }
                        else {
                            $('#name').removeAttr("readonly").val('');
                            $('#id_participante').val('');
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
                $('#id_participante').val('');
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

        //==================================================================================
        //BOTÃO PARA SALVAR AS ALTERAÇÕES DOS DADOS DO PARTICIPANTE
        $('#sendMessageButton').click(function() {
            let nomeCliente = $('#name').val();
            let sorteio_id = $('#sorteio_id').val();
            let id_participante = $('#id_participante').val();
            let phone = $('#phone').val().replace();
            let email = $('#email').val();
            let cpf = $('#cpf').val();
            let cep = $('#cep').val();
            let dtnasc = $('#dtnasc').val();
            let genero = $('#genero_id').val();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{route('cliente.save')}}',
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    sorteio_id: sorteio_id,
                    id_participante: id_participante,
                    nome: nomeCliente,
                    email: email,
                    cpf: cpf,
                    celular: phone,
                    cep: cep,
                    dtnasc: dtnasc,
                    genero_id: genero
                },
                success: function (data) {
                    if (data.status == 1) {
                        swal({
                            type: 'warning',
                            title: 'Oops...',
                            text: "Você ja esta participando desse sorteio!",
                        })
                    }
                    else if (data.status == 0) {
                        swal({
                            type: "success",
                            title: "Sucesso",
                            text: "Parabéns! Sua inscrição foi realizada com sucesso!",
                        }).then((valor) => {
                            console.log('Out IF');
                            if (valor){
                                console.log('In IF');
                                let mensagem = "Olá,%20%2A" + data.nome +"%2A%20agora%20o%20Sr(a)%20está%20participando%20de%20nosso%20sorteio%20Shopping%20Vip-X%20" +
                                    "e%20o%20seu%20cupom%20de%20sorteio%20é%20o%20%2Anúmero%2A%20%2A" + data.cupom_id +".%2A%0A" +
                                    "%0A" +
                                    "Acompanhe%20diariamente%20os%20sorteios%20Ao%20Vivo%20no%20nosso%20Instagram%20www.instagram.com/maktubbeautycare/%20ou%20" +
                                    "@maktubbeautycare.%0A" +
                                    "%0A" +
                                    "Serão%20sorteios%20diários%20de%20até%205%20unhas%20por%20dia%20e%201%20sorteio%20semanal%20de%20Alongamento%20de%20Cílios,%20" +
                                    "Hidratação%20com%20Escova,%20Designer%20de%20Sobrancelha%20e%20Maquiagem%20Expressa.%0A" +
                                    "%0A" +
                                    "Aproveite%20e%20conheça%20nosso%20novo%20site:%20www.vipx.com.br,%20use%20o%20%2Acupom%2A%20%2AVIPX5%2A%20em%20suas%20compres%20online%20" +
                                    "e%20ganhe%2010%25%20de%20desconto."+
                                    "%0A" +
                                    "%0A%2AEm%2A%20%2Aapoio:%2A%20www.instagram.com/shoppingvipx/";

                                let wpp = "https://api.whatsapp.com/send?phone=55" + data.celular + "&text=" + mensagem;

                                window.open(wpp, '_blank');

                                window.location.href = "{{url('/painel')}}" + "/" + id_participante;
                            }
                        });
                    }
                    else if (data.status == 2) {
                        swal({
                            type: 'error',
                            title: data.mError,
                            text: "Error! Sua inscrição  não foi realizada.",
                            footer: data.dError
                        })
                        .then(() => {
                            window.location.href = '{{route('home')}}';
                        });
                    }
                }
            });
        });

    </script>

@stop
