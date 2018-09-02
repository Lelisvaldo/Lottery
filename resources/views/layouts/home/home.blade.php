<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        @include('partials.home._head')
        @include('partials.home._styles')
    </head>

    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><i class="fa fa-home"></i>&nbsp;Inicio</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button"
                        data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                        aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    @if (Route::has('login'))
                        <ul class="navbar-nav ml-auto">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item mx-0 mx-lg-1">
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Sorteios</a>
                                </li>
                                <li class="nav-item mx-0 mx-lg-1">
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a>
                                </li>
                                {{--<li class="nav-item mx-0 mx-lg-1">
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
                                </li>--}}
                                @auth
                                    <li class="nav-item mx-0 mx-lg-1">
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ url('/admin') }}">
                                            <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                                    </li>
                                @else
                                    <li class="nav-item mx-0 mx-lg-1">
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('login') }}">Entrar</a>
                                    </li>
                                    <li class="nav-item mx-0 mx-lg-1">
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                           href="{{ route('register') }}">Cadastra-se</a>
                                    </li>
                                @endauth
                            </ul>
                        </ul>
                    @endif
                </div>
            </div>
        </nav>

        @yield('content')

        @include('partials.home._footer')

        <div class="copyright py-4 text-center text-white">
            <div class="container">
                <small>Copyright &copy; Your Website 2018</small>
            </div>
        </div>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-to-top d-lg-none position-fixed ">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

        @include('partials.home._scripts')
    </body>
</html>