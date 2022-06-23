<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <meta name="IDGS" content="IDGS" />

        <title>Grupo ISS</title>

        <!-- Styles -->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
        <link href="css/fontawesome-all.css" rel="stylesheet" />
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
        <link href="css/swiper.css" rel="stylesheet" />
        <link href="css/magnific-popup.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Favicon  -->
        <link rel="icon" href="{{ asset('img/grupo.png') }}" />
    </head>
    <body data-spy="scroll" data-target=".fixed-top">

        <!-- Navigation -->
        <nav class="navbar fixed-top">
            <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">
                
                <a class="text-gray-800 font-semibold text-3xl leading-4 no-underline page-scroll" href="{{ url('/') }}">Grupo ISS</a>

                <button class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400" type="button" data-toggle="offcanvas">
                    <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
                </button>

                <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center" id="navbarsExampleDefault">
                    <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row">
                        @if (Route::has('login'))
                            @auth
                                <li>
                                    <a class="nav-link page-scroll active" href="{{ route('dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
                                </li>
                            @else
                                <li>
                                    <a class="nav-link page-scroll" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a class="nav-link page-scroll" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                    
                </div> 
            </div> 
        </nav> 
        <!-- end of navigation -->

        <!-- Header -->
        <header id="header" class="header py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
            <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
                <div class="mb-16 lg:mt-32 xl:mt-32 xl:mr-12">
                    <h1 class="h1-large mb-5">Sistema de administracion de solicitudes</h1>
                    <p class="p-large mb-8">Inicia sesion para ver los insumos disponibles y porder generar tu solicitud.</p>
                    <a class="btn-solid-lg" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    <a class="btn-solid-lg secondary" href="{{ route('register') }}"><i class="fa-solid fa-right-to-bracket"></i> Registro</a>
                </div>
                <div class="xl:text-right">
                    <img class="inline" src="https://cdn.pixabay.com/photo/2016/04/01/11/01/clip-art-1300167_960_720.png" alt="alternative" />
                </div>
            </div> 
        </header> 

        <div id="features" class="cards-1">
            <div class="container px-4 sm:px-8 xl:px-4">

                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('img/features-icon-1.svg') }}" alt="alternative" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Platform Integration</h5>
                        <p class="mb-4">You sales force can the app on any smartphone platform without compatibility issues</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('img/features-icon-2.svg') }}" alt="alternative" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Easy On Resources</h5>
                        <p class="mb-4">Works smoothly even on older generation hardware due to our optimization efforts</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('img/features-icon-3.svg') }}" alt="alternative" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Productos mas solicitados</h5>
                        <p class="mb-4">Da click en el siguiente en lace para ver las estadisticas de las solicitudes.</p>
                    </div>
                </div>
            </div> 
        </div> 

        <div id="download" class="basic-5">
            <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2">
                <div class="mb-16 lg:mb-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.881985861051!2d-99.59659718562004!3d19.28749765030365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd8a5ec86ffd19%3A0x6ef7fcb29f832a63!2sISS%20Toluca!5e0!3m2!1ses-419!2smx!4v1655741577767!5m2!1ses-419!2smx" 
                        width="580" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="rounded-lg"
                    >
                    </iframe>
                </div>
                <div class="lg:mt-24 xl:mt-44 xl:ml-12">
                    <p class="mb-9 text-gray-800 text-3xl leading-10">Team management mobile applications don’t get much better than Pavo. Download it today</p>
                    <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>Ingresar</a>
                    <a class="btn-solid-lg secondary" href="#your-link"><i class="fab fa-google-play"></i>Logout</a>
                </div>
            </div> 
        </div> 


        <!-- Footer -->
        <div class="footer">
            <div class="container px-4 sm:px-8">
                <h4 class="mb-8 lg:max-w-3xl lg:mx-auto">Sistemas de administracion de solicitudes, si tienes dudas contactanos via correo electronico <a class="text-indigo-600 hover:text-gray-500" href="mailto:email@domain.com">al221910354@gmail.com</a></h4>
            </div> 
        </div> 

        <!-- Copyright -->
        <div class="copyright">
            <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-3">
                <ul class="mb-4 list-unstyled p-small">
                    <li class="mb-2"><a href="article.html">Article Details</a></li>
                </ul>
                <p class="pb-2 p-small statement">Copyright © <a href="#your-link" class="no-underline">{{ Date::now()->format('Y') }}</a></p>

                <p class="pb-2 p-small statement">Grupo <a href="#" class="no-underline">ISS</a></p>
            </div> 
        </div> 

        <script src="js/jquery.min.js"></script> 
        <script src="js/jquery.easing.min.js"></script> 
        <script src="js/swiper.min.js"></script> 
        <script src="js/jquery.magnific-popup.js"></script> 
        <script src="js/scripts.js"></script> 
    </body>
</html>
