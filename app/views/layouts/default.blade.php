<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Controle de Ponto</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app/public/css/file-upload.css"/>
    <link rel="stylesheet" type="text/css" href="/app/public/css/app.css"/>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="/vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/be56a064b0.js" crossorigin="anonymous"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/app/public/js/jquery.mask.min.js"></script>
    <script src="/app/public/js/jquery.funcoes.js"></script>

    <script src="/app/public/js/sweetalert2.all.min.js"></script>
    <script src="/app/public/js/jquery.funcoes.file-upload.js"></script>
    <script src="/app/public/js/app/jquery.funcoes.import-xml.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.file-upload').file_upload();
        });
    </script>
    <script type="text/javascript" src="/app/public/js/app/jquery.funcoes.registros.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="/">
            <img src="/app/public/img/icone_ponto.png" width="30" height="30"
                 alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item{{App\Helpers\Helper::replaceUrl($_SERVER['REQUEST_URI']) ==='/inicio' ? ' active' : ''}}">
                    <a class="nav-link" href="/inicio">Importar <span class="sr-only">(Página atual)</span></a>
                </li>
                <li class="nav-item{{$_SERVER['REQUEST_URI'] ==='/cartorio/novo'? ' active' : ''}}">
                    <a class="nav-link" href="/cartorio/novo">Cadastro</a>
                </li>
                {{--<li class="nav-item">
                    <a class="nav-link" href="#">Preços</a>
                </li>--}}
            </ul>
        </div>
    </nav>

    <section id="content">
        @yield('content')
    </section>

    {{--<footer class="container py-5">
        <div class="row">
            <div class="col-12 col-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mb-2"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                <small class="d-block mb-3 text-muted">© 2017-2018</small>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Algo legal</a></li>
                    <li><a class="text-muted" href="#">Feature aleatória</a></li>
                    <li><a class="text-muted" href="#">Recursos para times</a></li>
                    <li><a class="text-muted" href="#">Coisas para desenvolvedores</a></li>
                    <li><a class="text-muted" href="#">Outra coisa legal</a></li>
                    <li><a class="text-muted" href="#">Último item</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Fontes</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Fonte</a></li>
                    <li><a class="text-muted" href="#">Nome da fonte</a></li>
                    <li><a class="text-muted" href="#">Outra fonte</a></li>
                    <li><a class="text-muted" href="#">Fonte final</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Fontes</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Negócios</a></li>
                    <li><a class="text-muted" href="#">Educação</a></li>
                    <li><a class="text-muted" href="#">Governo</a></li>
                    <li><a class="text-muted" href="#">Jogos</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Sobre</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Equipe</a></li>
                    <li><a class="text-muted" href="#">Locais</a></li>
                    <li><a class="text-muted" href="#">Privacidade</a></li>
                    <li><a class="text-muted" href="#">Termos</a></li>
                </ul>
            </div>
        </div>
    </footer>--}}
</div>

</body>
</html>
