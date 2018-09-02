@extends('layouts.home.home')

@section('content')
    <div class="mt-4"> </div>
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Participar</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form action="{{route('cliente.save')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Nome</label>
                                <input class="form-control" id="name" name="nome" type="text" placeholder="Nome" required
                                       data-validation-required-message="Please enter your Nome." maxlength="60">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>E-mail</label>
                                <input class="form-control" id="email" type="email" placeholder="E-mail"
                                       data-validation-required-message="Please enter your email address." maxlength="40">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Cpf</label>
                                <input class="form-control" id="cpf" name="cpf" type="text" placeholder="Cpf"
                                       data-validation-required-message="Please enter your Cpf number." maxlength="11">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Celular</label>
                                <input class="form-control" id="phone" name="celular" type="tel" placeholder="Celular"
                                       data-validation-required-message="Please enter your phone number." maxlength="11" required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Data de Nascimento</label>
                                <input class="form-control" id="dtnasc" name="dtnasc" type="date" placeholder="Data de Nacimento"
                                       data-validation-required-message="Please enter your phone number." required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Cep</label>
                                <input class="form-control" id="cep" name="cep" type="text" placeholder="Cep"
                                       data-validation-required-message="Please enter your phone number." maxlength="8" required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Genero</label>
                            <div class="form-group controls mb-0 pb-2">
                                <select id="genero" name="genero" class="form-control" required>
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
                            <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Participar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop