@extends('layouts.home.home')

<style type="text/css">
    .bSorteio {
        margin-top: 15.5% !important;
        text-transform: uppercase;
    }
    .tSorteio {
        margin-top: 6.5% !important;
        text-transform: uppercase;
    }
    .dSorteio {

    }
    .nCupom{
        position: absolute;
        margin: 15% 0 0 -7% !important;
        font-size: 12px;
        font-weight:bold;
        width: 105px;
        height: 40px;
        -moz-transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }
    .tN{
        font-size: 16px;
        font-weight:bold;
        padding-bottom: 0 !important;
    }
    pre {
        display: block;
        white-space: pre;
        margin-top: 22.5% !important;
        text-transform: capitalize;
        font-size: 16px;
        width: 200px;
        height: 50px;
        background-color: #00e765;
    }

</style>

@section('content')
    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
        <div class="container mt-5">
            <h2 class="text-center text-uppercase text-secondary mb-0">Meus Cupons</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                @foreach($cupons as $cupom)
                    <div class="col-md-12 col-lg-4 col-xl-4">
                        <a class="portfolio-item d-block text-center" href="#" style="width: 310px !important; height: 133px !important;">
                            <div class="d-flex position-absolute h-100 w-100">
                                <div class="bSorteio mx-auto text-black-50"><b>{{$cupom->brinde_sorteio}}</b></div>
                            </div>
                            <div class="d-flex position-absolute h-100 w-100">
                                <div class="tSorteio mx-auto text-black-50"><b>{{$cupom->titulo_sorteio}}</b></div>
                            </div>

                            <div class="d-flex position-absolute h-100 w-100">
                                <pre class="dSorteio mx-auto text-black-50">{{$cupom->descricao_sorteio}}</pre>
                            </div>

                            <div class="d-flex position-absolute h-100 w-100">
                                <div class="nCupom text-black-50"><div class="tN">Nº</div>{{$cupom->cupom_id}}</div>
                            </div>

                            <img class="img-fluid " src="{{URL::asset('/img/home/cupom.png')}}" alt="{{$cupom->titulo_sorteio}}">
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