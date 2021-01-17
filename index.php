<!DOCTYPE html>
<html lang="hr">

<head>
    <title>VSMTI_projekti</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="150">
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#"><img src="images/logo.png" height="60" width="270"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="projekti.php">Projekti</a></li>
                        <li><a href="aktivnosti.php">Aktivnosti</a></li>
                        <li><a href="clanovi.php">Članovi</a></li>
                        <li><a href="kontakt.php">Kontakt</a></li>
                    </ul>
                   
                </div>
            </div>
        </nav>
        <div class="jumbotron text-center">
            <h1>VSMTI</h1>
        </div>
    </header>

    <section id="carousel">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="item active">
                    <div class="overlay"></div>
                    <img src="images/skola2.jpg" class="img-responsive" alt="pic1">
                </div>

                <div class="item">
                    <div class="overlay"></div>
                    <img src="images/stdom.jpg" alt="pic2">
                </div>

                <div class="item">
                    <div class="overlay"></div>
                    <img src="images/skola4.jpg" alt="pic3">
                </div>
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Lijevo</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Desno</span>
            </a>
        </div>
    </section>
    

    <footer>
        <div class="container-fluid futer-container">
            <div class="row">
                <div class="col-sm-4 col-xs-12 text-center">
                    <p>                    
                    </p>             
                    <p> &copy; 2020 - VSMTI_projekti | Ivan Franjić</p>
                   </div>
            </div>
        </div>
    </footer>

</body>

</html>