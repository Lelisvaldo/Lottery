@extends('layouts.home.home')

@section('content')
    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
        <div class="container mt-5">
            <h2 class="text-center text-uppercase text-secondary mb-0">Meus Sorteios</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                @foreach($sorteios as $sorteio)
                    <div class="col-md-12 col-lg-4 col-xl-4">
                        <a class="portfolio-item d-block mx-auto" href="#">
                            <div class="d-flex position-absolute h-100 w-100">
                                <div class="mx-auto mt-xl-5 text-white-50">{{$sorteio->titulo_sorteio}}</div>
                            </div>

                            <img class="img-fluid " src="{{URL::asset('/img/home/cupom.png')}}" alt="{{$sorteio->titulo_sorteio}}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('partials.home._scripts')
    <script>

    </script>
@stop