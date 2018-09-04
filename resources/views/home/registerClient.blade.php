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
                                <input class="form-control" id="sorteio_id" name="sorteio_id" type="text" placeholder="Id Sorteio" value="{{$sorteios->id}}" readonly required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Id Participante</label>
                                <input class="form-control" id="id_participante" name="id_participante" type="text" placeholder="ID Participante" value="" readonly required>
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
                                       data-validation-required-message="Please enter your phone number." value="" required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Cep</label>
                                <input class="form-control" id="cep" name="cep" type="text" placeholder="Cep"
                                       data-validation-required-message="Please enter your phone number." maxlength="8" value="" required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Genero</label>
                            <div class="form-group controls mb-0 pb-2">
                                <select id="genero_id" name="genero_id" class="form-control" value="" required>
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
        $('#phone').blur(function(e){
            e.preventDefault();
            var phone = $(this).val();
            //console.log(phone);
            $('#msg_phone').html("");

            if(phone.length == 11){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('consulta.telefone') }}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, phone: phone},
                    success: function (data) {
                        if(data.phone.length > 0){
                            console.log("existe cliente");
                            //console.log(data);
                            $('#id_participante').val(data.phone[0].id).attr('readonly', true);
                            $('#phone').val(data.phone[0].celular).attr('readonly', true);
                            $('#name').val(data.phone[0].nome).attr('readonly', true);
                            $('#email').val(data.phone[0].email).attr('readonly', true);
                            $('#cpf').val(data.phone[0].cpf).attr('readonly', true);
                            $('#cep').val(data.phone[0].cep).attr('readonly', true);
                            $('#dtnasc').val(data.phone[0].dtnasc).attr('readonly', true);
                            $('#genero_id').val(data.phone[0].genero).attr('disabled', true);

                            // $('#btnSalvarParticipante').attr('disabled', true).css('display', 'none');
                            // $('#btnAlterarParticipante').css('display', 'block');
                            // $('#btnParticiparSorteio').css('display', 'block');
                            // $('#msg_cpf').css('display', 'none');
                        }
                        else {
                            //swal('Ops', 'Participante ainda não cadastrado.', 'info');
                            $('#phone').val(phone);
                        }
                    }


                    /*success: function(data){
                        if(data.phone.length > 0){
                            $('#msg_phone').html("Telefone já existente.").css("color", "red").css("font-size", "small");
                            $("#sendMessageButton").attr("disabled", "disabled");
                        }
                        else{
                            console.log("Cadastrar!!!");
                            $("#sendMessageButton").removeAttr("disabled");
                        }
                    }*/
                });
            }
        });
    </script>

@stop
