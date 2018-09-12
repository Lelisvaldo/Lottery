<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sorteador</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('home/scss/_animExtraOne.scss')}}" rel="stylesheet">
    <link href="{{URL::asset('home/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{URL::asset('home/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="{{URL::asset('home/vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{URL::asset('home/css/freelancer.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">


    <!-- Header -->
    <header class="text-white text-center p-xl-5">
        <div class="container">
            <img class="img-fluid d-block mx-auto" src="{{URL::asset('/img/home/logo.png')}}" alt="">
            <h1 class="text-uppercase ">Sortear</h1>
            <i class="fa fa-trophy fa-3x"></i>
        </div>
    </header>

    <section class="text-white text-center p-0">
        <div class="container">
            <div class="boxes-container">
                <div class="box">
                    <!-- https://webdesign.tutsplus.com/tutorials/a-beginners-introduction-to-css-animation--cms-21068 -->
                    <div id="anim-extra-one"></div>
                </div>

            </div>
            <button class="btn btn-outline-light text-center" onclick="myPlayFunction()"><i class="fa fa-random"></i>&nbsp;Sortear</button>

            {{--<button class="btn btn-outline-light  text-center" onclick="myPauseFunction()"><i class="fa fa-pause"></i>&nbsp;Pause</button>--}}
            <h2 class="font-weight-light mt-1 mb-0">Web Developer - Graphic Artist - User Experience Designer</h2>
        </div>
    </section>

    <script src="{{URL::asset('home/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('home/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script>
        $(function(){
            var arrayCupons = [];
            var arrayNomes = [];
            var arrayCelulares = [];
            carregaArray();
            //======================================================================================================
            //FUNÇÃO QUE POPULA OS ARRAYS AO CARREGAR A PÁGINA
            function carregaArray(){

                @foreach($participantes_sorteio as $c)
                    console.log({{$c->id_sorteio}});
                    arrayCupons.push('{{$c->id_sorteio}}');
                    arrayNomes.push('{{$c->nome}}');
                    arrayCelulares.push('{{$c->celular}}');
                @endforeach
            }

            //======================================================================================================
            //BOTÃO PARA GERAR O SORTEIO
            let valor_ganhador = '';
            $('#btn_sorteio').click(function(){

                if($('#premio_ganhador').val() == ""){
                    swal('Ops', 'O prêmio do ganhador não foi escrito.', 'warning');
                }
                else {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $(this).css('display', 'none');
                    $('#div_nome_premio').attr('hidden', true);
                    valor_ganhador = Math.floor((Math.random() * arrayCupons.length) + 1);

                    $('#num_ganhador').removeAttr('hidden');
                    $('#nm_ganhador').removeAttr('hidden');

                    let menor_num = arrayCupons[0];
                    let maior_num = arrayCupons[arrayCupons.length - 1];

                    let contador = 0;

                    let primeiro_intervalo = setInterval(function () {
                        let num_random = Math.floor((Math.random() * maior_num) + menor_num);

                        $('#p_num_ganhador').html(num_random);

                        contador++;
                        if (contador >= 30) {
                            clearInterval(primeiro_intervalo);
                            $('#p_num_ganhador').html(arrayCupons[valor_ganhador - 1]);
                            $('#p_nm_ganhador').html(arrayNomes[valor_ganhador - 1]);
                            $('#btn_sorteio').attr('hidden', true);
                            $('#div_wpp').removeAttr('hidden');

                            $.ajax({
                                url: '{{route('lottery.save.winner')}}',
                                type: 'post',
                                data: {_token: CSRF_TOKEN, cupom: arrayCupons[valor_ganhador - 1]},
                                success: function(data){
                                    console.log(data);
                                }
                            })
                        }

                    }, 150);
                }
            });

            //======================================================================================================
            //BOTÃO PARA ENVIAR MENSAGEM PARA O GANHADOR DO SORTEIO
            $('#btn_msg_wpp').click(function(){

                let premio = $("#premio_ganhador").val().toUpperCase();

                let mensagem = "Parabéns%20você%20é%20o%20ganhador%20do%20sorteio%20do%20Shopping%20Vip-X,%20" +
                    "entre%20em%20contato%20através%20do%20WhatsApp%20em%20até%205%20dias%20e%20faça%20o%20seu%20agendamento%20" +
                    "no%20salão%20Maktub%20Beauty%20Care.%0A" +
                    "%0A" +
                    "Seu%20prêmio:%20%2A" + premio + ".%2A%0A" +
                    "%0A" +
                    "Aproveite%20e%20conheça%20nosso%20novo%20site%20e%20nossos%20produtos%0A" +
                    "www.vipx.com.br%0A" +
                    "%0A" +
                    "Obrigado%20pela%20participação%20e%20não%20esqueça%20em%20breve%20mais%20sorteios%20Ao%20vivo%20no%20Instagram%0A" +
                    "www.instagram.com/maktubbeautycare/%20ou%20@maktubbeautycare." +
                    "%0A" +
                    "%0A%2AEm%2A%20%2Aapoio:%2A%20www.instagram.com/shoppingvipx/";

                let wpp = "https://api.whatsapp.com/send?phone=55" + arrayCelulares[valor_ganhador - 1] + "&text=" + mensagem;

                window.open(wpp, '_blank');

            });

        });

        function myPlayFunction() {
            document.getElementById("anim-extra-one").style.WebkitAnimationPlayState = "running"; // Code for Chrome, Safari, and Opera
            document.getElementById("anim-extra-one").style.animationPlayState = "running";
        }

        function myPauseFunction() {
            document.getElementById("anim-extra-one").style.WebkitAnimationPlayState = "paused"; // Code for Chrome, Safari, and Opera
            document.getElementById("anim-extra-one").style.animationPlayState = "paused";
        }
    </script>


</body>


</html>