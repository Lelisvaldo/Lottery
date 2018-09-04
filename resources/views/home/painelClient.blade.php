@extends('layouts.home.home')

@section('content')
    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
        <div class="container mt-5">
            <h2 class="text-center text-uppercase text-secondary mb-0">Meus Sorteios</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                @foreach($sorteios as $sorteio)
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <a class="portfolio-item d-block mx-auto" href="#">
                            <div class="portfolio-item-caption d-flex position-absolute h-100 w-50">
                                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                                    <i class="fa fa-search-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid h-50 w-50" src="{{URL::asset($sorteio->foto_sorteio)}}" alt="{{$sorteio->titulo_sorteio}}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop