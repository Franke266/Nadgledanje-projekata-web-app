<!DOCTYPE html>
<html lang="hr" ng-app="projekti-app">

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
    <script type="text/javascript" src='https://rawgithub.com/gsklee/ngStorage/master/ngStorage.js'></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="150"  ng-app="projekti-app" ng-controller="projektiController">
    <header>
        <div class="jumbotron text-center">
            <h1>Aktivnosti</h1>
        </div>
    </header>
    <div class="container-fluid">
        <a ng-click="GetModal2('dodaj2')" class="btn btn-info btn-sm float-right">DODAJ</a>
    <table class="table table-hover" ng-model="trenutninaziv" >
        <input id="searchInput" ng-model="searchText" placeholder="Traži">
            <thead>
                <tr>
                    <th>Rbr.</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Vrijeme</th>
                    <th>Projekt</th>
                    <th>Član projekta</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="aktivnost2 in oAktivnostiProjekta | filter:searchText | filter:trenutninaziv ">
                    <td>{{$index + 1}}</td>
                    <td>{{aktivnost2.naziv}}</td>
                    <td>{{aktivnost2.opis}}</td>
                    <td>{{aktivnost2.vrijeme}}</td>
                    <td>{{aktivnost2.projekt}}</td>
                    <td>{{aktivnost2.clan_projekta}}</td>
                    <td>{{aktivnost2.status}}</td>
                    <td><a ng-click="GetModal2('uredi2', aktivnost2)">
                        <span class="glyphicon glyphicon-pencil" style="font-size:1.5em;"></span>
                    </a> </td>
                    <td> <a ng-click="GetModal2('obrisi2', aktivnost2.id)">
                        <span class="glyphicon glyphicon-trash" style="font-size:1.5em;"></span></td>
                        
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal" id="dodajaktivnost2" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Dodaj aktivnost</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal" name="frm8">
                    <div class="form-group">
                        <label class="control-label col-md-3">Naziv aktivnosti</label>
                        <div class="col-md-8">
                            <input name="naziv2" ng-model="inptNaziv" data-parsley-required="true" type="text" placeholder="Unesite naziv aktivnosti" 
                            class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Opis</label>
                        <div class="col-md-8">
                            <input name="opis2" ng-model="inptOpis" data-parsley-required="true" type="text" placeholder="Opis"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Član projekta</label>
                        <div class="col-md-8">
                            <select id="test" name="clan2" ng-model="inptClan" class="form-control">
                            <option ng-repeat="clan in oClanoviProjekt" value="{{clan.id}}">{{clan.imeprezime}}</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-8">
                            <input name="status2" ng-model="inptStatusAktivnosti" data-parsley-required="true" type="text" placeholder="Unesite status aktivnosti" class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="Provjera7()" data-dismiss="modal">Dodaj</button>
                <button type="button" class="btn btn-default" onClick="window.location.reload();" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="azurirajaktivnost2" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Azuriraj aktivnost</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal" name="frm9">
                    <div class="form-group">
                        <label class="control-label col-md-3">Opis</label>
                        <div class="col-md-8">
                            <input name="opis3" ng-model="inptOpis" data-parsley-required="true" type="text" placeholder="Opis"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-8">
                            <input name="status3" ng-model="inptStatusAktivnosti" data-parsley-required="true" type="text" placeholder="Unesite status aktivnosti" class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="Provjera8()" data-dismiss="modal">Spremi</button>
                <button type="button" class="btn btn-default" onClick="window.location.reload();" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="obrisi2" tabindex="-1" role="dialog">
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
                <button type="button" class="btn btn-success btn-s" ng-click="ObrisiAktivnostProjekta()" data-dismiss="modal">Obriši</button>
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