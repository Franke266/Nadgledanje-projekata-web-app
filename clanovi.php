<!DOCTYPE html>
<html lang="hr" ng-app="clanovi-app">

<head>
    <title>VSMTI_projekti</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/angular-route.min.js"></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="150" ng-app="clanovi-app" ng-controller="clanoviController">
    <header>
        <div class="jumbotron text-center">
            <h1>Članovi</h1>
        </div>
    </header>
    <div class="container-fluid">
        <a ng-click="GetModal('dodaj')" class="btn btn-info btn-sm float-right">DODAJ</a>
    <table class="table table-hover">
        <input id="searchInput" ng-model="searchText" placeholder="Traži">
            <thead>
                <tr>
                    <th>Rbr.</th>
                    <th>Ime i prezime</th>
                    <th>Kontakt</th>
                    <th>E-mail</th>
                    <th>Projekti</th>
                    <th>Aktivnosti</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="clan in oClanovi | filter:searchText">
                    <td>{{$index + 1}}</td>
                    <td>{{clan.imeprezime}}</td>
                    <td>{{clan.kontakt}}</td>
                    <td>{{clan.mail}}</td>
                    <td>{{clan.projekti}}</td>
                    <td>{{clan.aktivnosti}}</td>
                    <td> <a ng-click="GetModal('obrisi', clan.id)">
                        <span class="glyphicon glyphicon-trash" style="font-size:1.5em;"></span></td>
                </tr>
            </tbody>
        </table>
          
    </div>
    <div class="modal" id="dodajclana" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Dodaj člana</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal" name="frm3">
                    <div class="form-group">
                        <label class="control-label col-md-3">Ime i prezime</label>
                        <div class="col-md-8">
                            <input name="ime" ng-model="inptImePrezime" data-parsley-required="true" type="text" placeholder="Unesite ime" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Kontakt</label>
                        <div class="col-md-8">
                            <input name="kontakt" ng-model="inptKontakt" data-parsley-required="true" type="text" placeholder="Unesite kontakt" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">E-mail</label>
                        <div class="col-md-8">
                            <input name="mail" ng-model="inptMail" data-parsley-required="true" type="email" placeholder="ime.prezime@gmail.com" class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="Provjera3()" data-dismiss="modal">Dodaj</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>


    <div class="modal" id="obrisi" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Pažnja</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal">
                    Jeste li sigurni da želite obrisati?
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="ObrisiClana()" data-dismiss="modal">Obriši</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>

   
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
    <script src="js/script.js"></script>

</body>

</html>