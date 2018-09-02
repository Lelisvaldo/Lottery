@extends('layouts.home.home')

@include('partials.home._header')

@section('content')
    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Sorteios</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                @foreach($sorteios as $sorteio)
                    <div class="col-md-6 col-lg-4">
                        <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-{{$sorteio->id}}">
                            <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                                    <i class="fa fa-search-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{URL::asset($sorteio->foto_sorteio)}}" alt="{{$sorteio->titulo_sorteio}}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">About</h2>
            <hr class="star-light mb-5">
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes
                        the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets
                        for easy customization.</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">Whether you're a student looking to showcase your work, a professional looking to
                        attract clients, or a graphic artist looking to share your projects, this template is the perfect
                        starting point!</p>
                </div>
            </div>
            <div class="text-center mt-4">

                <a class="btn btn-xl btn-outline-light" href="#">
                    <i class="fa fa-download mr-2"></i>
                    Download Now!
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    {{--<section id="contact">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Contact Me</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Name</label>
                                <input class="form-control" id="name" type="text" placeholder="Name" required="required"
                                       data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Email Address</label>
                                <input class="form-control" id="email" type="email" placeholder="Email Address"
                                       required="required"
                                       data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Phone Number</label>
                                <input class="form-control" id="phone" type="tel" placeholder="Phone Number"
                                       required="required"
                                       data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Message"
                                          required="required"
                                          data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- Portfolio Modals -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-1">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-secondary text-uppercase mb-0">{{$sorteios[0]->titulo_sorteio}}</h2>
                        <hr class="star-dark mb-4">
                        <img class="img-fluid mb-2" src="{{URL::asset($sorteios[0]->foto_sorteio)}}" alt="{{$sorteios[0]->titulo_sorteio}}">
                        <p class="mb-2">Detalhes<br>{{$sorteios[0]->descricao_sorteio}}</p>
                        <p class="mb-2">Premio<br>{{$sorteios[0]->brinde_sorteio}}</p>
                        <p class="mb-2">Periodo de Inscrição<br><b>{{date( 'd/m/Y' , strtotime($sorteios[0]->data_inicio))}}</b>&nbsp;-&nbsp;<b>{{date( 'd/m/Y' , strtotime($sorteios[0]->data_fim))}}</b></p>

                        <a class="btn btn-primary btn-lg rounded-pill" href="{{route('registro.cliente')}}"><i class="fa fa-trophy"></i>&nbsp;Participar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-2">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-secondary text-uppercase mb-0">{{$sorteios[1]->titulo_sorteio}}</h2>
                        <hr class="star-dark mb-5">
                        <img class="img-fluid mb-5" src="{{URL::asset($sorteios[1]->foto_sorteio)}}" alt="{{$sorteios[1]->titulo_sorteio}}">
                        <p class="mb-3">Detalhes<br>{{$sorteios[1]->descricao_sorteio}}</p>
                        <p class="mb-3">Premio<br>{{$sorteios[1]->brinde_sorteio}}</p>
                        <p class="mb-4">Periodo de Inscrição<br><b>{{date( 'd/m/Y' , strtotime($sorteios[1]->data_inicio))}}</b>&nbsp;-&nbsp;<b>{{date( 'd/m/Y' , strtotime($sorteios[1]->data_fim))}}</b></p>
                        <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#"><i class="fa fa-trophy"></i>&nbsp;Participar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-3">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-secondary text-uppercase mb-0">{{$sorteios[2]->titulo_sorteio}}</h2>
                        <hr class="star-dark mb-5">
                        <img class="img-fluid mb-5" src="{{URL::asset($sorteios[2]->foto_sorteio)}}" alt="{{$sorteios[2]->titulo_sorteio}}">
                        <p class="mb-3">Detalhes<br>{{$sorteios[2]->descricao_sorteio}}</p>
                        <p class="mb-3">Premio<br>{{$sorteios[2]->brinde_sorteio}}</p>
                        <p class="mb-4">Periodo de Inscrição<br><b>{{date( 'd/m/Y' , strtotime($sorteios[2]->data_inicio))}}</b>&nbsp;-&nbsp;<b>{{date( 'd/m/Y' , strtotime($sorteios[2]->data_fim))}}</b></p>
                        <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#"><i class="fa fa-trophy"></i>&nbsp;Participar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-4">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-secondary text-uppercase mb-0">{{$sorteios[3]->titulo_sorteio}}</h2>
                        <hr class="star-dark mb-5">
                        <img class="img-fluid mb-5" src="{{URL::asset($sorteios[3]->foto_sorteio)}}" alt="{{$sorteios[3]->titulo_sorteio}}">
                        <p class="mb-3">Detalhes<br>{{$sorteios[3]->descricao_sorteio}}</p>
                        <p class="mb-3">Premio<br>{{$sorteios[3]->brinde_sorteio}}</p>
                        <p class="mb-4">Periodo de Inscrição<br><b>{{date( 'd/m/Y' , strtotime($sorteios[3]->data_inicio))}}</b>&nbsp;-&nbsp;<b>{{date( 'd/m/Y' , strtotime($sorteios[3]->data_fim))}}</b></p>
                        <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#"><i class="fa fa-trophy"></i>&nbsp;Participar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-5">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-secondary text-uppercase mb-0">{{$sorteios[4]->titulo_sorteio}}</h2>
                        <hr class="star-dark mb-5">
                        <img class="img-fluid mb-5" src="{{URL::asset($sorteios[4]->foto_sorteio)}}" alt="{{$sorteios[4]->titulo_sorteio}}">
                        <p class="mb-3">Detalhes<br>{{$sorteios[4]->descricao_sorteio}}</p>
                        <p class="mb-3">Premio<br>{{$sorteios[4]->brinde_sorteio}}</p>
                        <p class="mb-4">Periodo de Inscrição<br><b>{{date( 'd/m/Y' , strtotime($sorteios[4]->data_inicio))}}</b>&nbsp;-&nbsp;<b>{{date( 'd/m/Y' , strtotime($sorteios[4]->data_fim))}}</b></p>
                        <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#"><i class="fa fa-trophy"></i>&nbsp;Participar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-6">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-secondary text-uppercase mb-0">{{$sorteios[5]->titulo_sorteio}}</h2>
                        <hr class="star-dark mb-5">
                        <img class="img-fluid mb-5" src="{{URL::asset($sorteios[5]->foto_sorteio)}}" alt="{{$sorteios[5]->titulo_sorteio}}">
                        <p class="mb-3">Detalhes<br>{{$sorteios[5]->descricao_sorteio}}</p>
                        <p class="mb-3">Premio<br>{{$sorteios[5]->brinde_sorteio}}</p>
                        <p class="mb-4">Periodo de Inscrição<br><b>{{date( 'd/m/Y' , strtotime($sorteios[5]->data_inicio))}}</b>&nbsp;-&nbsp;<b>{{date( 'd/m/Y' , strtotime($sorteios[5]->data_fim))}}</b></p>
                        <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#"><i class="fa fa-trophy"></i>&nbsp;Participar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop