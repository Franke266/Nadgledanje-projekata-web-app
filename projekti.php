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
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="150" ng-app="projekti-app" ng-controller="projektiController">
    <header>
        <div class="jumbotron text-center">
            <h1>Projekti</h1>
        </div>
    </header>
    <div class="tabbable tabs-below">
    <ul class="nav nav-pills">
        <li ng-repeat="category in categories" ng-class="{active: category == currentCategory}">
            <a href="" ng-click="setCurrentCategoryItem(category.naziv)">{{category.naziv}}</a>
        </li>
        <li>
            <a ng-click="GetModal('dodajkat')" class="glyphicon glyphicon-plus"></a>
        </li>
    </ul>
</div>

    
    <div class="container-fluid">
        <a ng-click="GetModal('dodaj')" class="btn btn-info btn-sm float-right">DODAJ</a>
    <table class="table table-hover">
        <input id="searchInput" ng-model="searchText" placeholder="Traži">
            <thead>
                <tr>
                    <th>Rbr.</th>
                    <th>Naziv</th>
                    <th>Nositelj</th>
                    <th>Vrijednost</th>
                    <th>Status</th>
                    <th>Voditelj</th>
                    <th>Adresa</th>
                    <th>Poštanski broj</th>
                    <th>Grad</th>
                    <th>Latituda</th>
                    <th>Longituda</th>
                    <th>Aktivnosti</th>
                    <th>Prikaz na karti</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="projekt in oProjekti | filter:searchText | filter: currentCategory">
                    <td>{{$index + 1}}</td>
                    <td>{{projekt.naziv}}</td>
                    <td>{{projekt.nositelj}}</td>
                    <td>{{projekt.vrijednost}} kn</td>
                    <td>{{projekt.status}}</td>
                    <td>{{projekt.voditelj}}</td>
                    <td>{{projekt.adresa}}</td>
                    <td>{{projekt.postanski_broj}}</td>
                    <td>{{projekt.grad}}</td>
                    <td>{{projekt.latituda}}</td>
                    <td>{{projekt.longituda}}</td>
                    <td><a href="aktivnostiprojekta.php" ng-click="DohvatiNazivProjekta(projekt.naziv)">
                        <span class="glyphicon glyphicon-list-alt" style="font-size:1.5em;"></span>
                    </a> </td>
                    <td><a class="marker-link" data-markerid="{{$index}}" href="#map">
                        <span class="glyphicon glyphicon-map-marker" style="font-size:1.5em;"></span>
                    </a></td>
                    <td><a ng-click="GetModal('uredi', projekt)">
                        <span class="glyphicon glyphicon-pencil" style="font-size:1.5em;"></span>
                    </a> </td>   
                    <td> <a ng-click="GetModal('obrisi3', projekt.id)">
                        <span class="glyphicon glyphicon-trash" style="font-size:1.5em;"></span></td>
                </tr>
            </tbody>
        </table>

    </div>
    
    <style>

    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
 /* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
    #map {
        height: 100%;
    }
</style>

<?php

include_once 'locations_model.php';
?>


<div id="map"></div>

<script>
    var map;
    var marker;
    var infowindow;
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    var locations = <?php get_all_locations() ?>;
    var markers = new Array();

    function initMap() {
        var croatia = {lat: 45.1000, lng: 16.5000};
        infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById('map'), {
            center: croatia,
            zoom: 8
        });


        var i ; var confirmed = 0;
        for (i = 0; i < locations.length; i++) {
            //$('#markers').append('<a class="marker-link" data-markerid="' + i + '" href="">' + locations[i][1] + '</a> ');

            var content =   '<div class="infoWindow"><strong>'  + locations[i][1] + '</strong>'
            + '<br/>'     + locations[i][6] + "," + " "  + locations[i][7] + "," + " "+ locations[i][8]
            + '<br/>' + /*"Nositelj:" + " " + locations[i][2]
            + '<br/>' + "Voditelj:" + " " + locations[i][5]
            + '<br/>' + */"Vrijednost:" + " " + locations[i][3] + " " + "kn"
            + '<br/>' + "Status:"  + " " + locations[i][4] 
            +'</div>';

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][9], locations[i][10]),
                map: map,
                icon : red_icon,
                html: content
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(marker.html);
                    infowindow.open(map, marker);
                }
            })(marker, i));
            markers.push(marker);
            
        }
        $('.marker-link').on('click', function () {
        google.maps.event.trigger(markers[$(this).data('markerid')], 'click');
        map.setZoom(15);
        //map.setCenter(marker.getPosition()); 
    });
    }
    
        
    
   
    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                callback(request.responseText, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }


</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyDAPJh5iF5elbW7mpK6c86YHOXl6_aSwxc&callback=initMap">
</script>
    <div class="modal" id="dodajprojekt" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Dodaj projekt</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal" name="frm2">
                    <div class="form-group">
                        <label class="control-label col-md-3">Naziv projekta</label>
                        <div class="col-md-8">
                            <input  name="naziv2" ng-model="inptImeProjekta" data-parsley-required="true" type="text" placeholder="Unesite naziv projekta" 
                            class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Nositelj projekta</label>
                        <div class="col-md-8">
                            <select id="test2" name="nositelj" ng-model="inptNositelj" class="form-control">
                            <option ng-repeat="clan in oClanoviProjekt" value="{{clan.id}}">{{clan.imeprezime}}</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Vrijednost</label>
                        <div class="col-md-8">
                            <input  name="vrijednost" ng-model="inptVrijednost" data-parsley-required="true" type="text" placeholder="Unesite vrijednost projekta"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Status projekta</label>
                        <div class="col-md-8">
                            <input  name="status2" ng-model="inptStatusProjekta" data-parsley-required="true" type="text" placeholder="Unesite status projekta" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Voditelj projekta</label>
                        <div class="col-md-8">
                            <select id="test3" name="voditelj" ng-model="inptVoditelj" class="form-control">
                            <option ng-repeat="clan in oClanoviProjekt" value="{{clan.id}}">{{clan.imeprezime}}</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Kategorija</label>
                        <div class="col-md-8">
                            <select id="test7" name="kategorija" ng-model="inptKategorija" class="form-control">
                            <option ng-repeat="kategorija in categories" value="{{kategorija.id}}">{{kategorija.naziv}}</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Adresa</label>
                        <div class="col-md-8">
                            <input  name="adresa" ng-model="inptAdresa" data-parsley-required="true" type="text" placeholder="Unesite adresu"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Poštanski broj</label>
                        <div class="col-md-8">
                            <input name="pb" ng-model="inptPb" data-parsley-required="true" type="number" placeholder="Unesite poštanski broj"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Grad</label>
                        <div class="col-md-8">
                            <input name="grad" ng-model="inptGrad" data-parsley-required="true" type="text" placeholder="Unesite grad"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Latituda</label>
                        <div class="col-md-8">
                            <input name="lat" ng-model="inptLatituda" data-parsley-required="true" type="number" placeholder="Unesite latitudu"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Longituda</label>
                        <div class="col-md-8">
                            <input name="long" ng-model="inptLongituda" data-parsley-required="true" type="number" placeholder="Unesite longitudu"   class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="Provjera2()" data-dismiss="modal">Dodaj</button>
                <button type="button" class="btn btn-default" onClick="window.location.reload();" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>
    

    <div class="modal" id="azurirajprojekt" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Ažuriraj projekt</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal" name="frm4">
                    <div class="form-group">
                        <label class="control-label col-md-3">Naziv projekta</label>
                        <div class="col-md-8">
                            <input  name="naziv3" ng-model="inptImeProjekta" data-parsley-required="true" type="text" placeholder="Unesite naziv projekta" 
                            class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Nositelj projekta</label>
                        <div class="col-md-8">
                            <select id="test4" name="nositelj2" ng-model="inptNositelj" class="form-control">
                            <option ng-repeat="clan in oClanoviProjekt" value="{{clan.id}}">{{clan.imeprezime}}</option>
                        </select>
                        </div>
                    </div>
                     <!--ng-selected="inptNositelj==clan.imeprezime"-->
                    <div class="form-group">
                        <label class="control-label col-md-3">Vrijednost</label>
                        <div class="col-md-8">
                            <input  name="vrijednost2" ng-model="inptVrijednost" data-parsley-required="true" type="text" placeholder="Unesite vrijednost projekta"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Status projekta</label>
                        <div class="col-md-8">
                            <input name="status3" ng-model="inptStatusProjekta" data-parsley-required="true" type="text" placeholder="Unesite status projekta" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Voditelj projekta</label>
                        <div class="col-md-8">
                            <select id="test5" name="voditelj2" ng-model="inptVoditelj" class="form-control">
                            <option ng-repeat="clan in oClanoviProjekt" value="{{clan.id}}">{{clan.imeprezime}}</option>
                        </select>
                        </div>
                    </div>
                    <!--ng-selected="inptVoditelj==clan.imeprezime"-->
                    <div class="form-group">
                        <label class="control-label col-md-3">Adresa</label>
                        <div class="col-md-8">
                            <input name="adresa2" ng-model="inptAdresa" data-parsley-required="true" type="text" placeholder="Unesite adresu"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Poštanski broj</label>
                        <div class="col-md-8">
                            <input name="pb2" ng-model="inptPb" data-parsley-required="true" type="number" placeholder="Unesite poštanski broj"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Grad</label>
                        <div class="col-md-8">
                            <input name="grad2" ng-model="inptGrad" data-parsley-required="true" type="text" placeholder="Unesite grad"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Latituda</label>
                        <div class="col-md-8">
                            <input name="lat2" ng-model="inptLatituda" data-parsley-required="true" type="number" placeholder="Unesite latitudu"   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Longituda</label>
                        <div class="col-md-8">
                            <input name="long2" ng-model="inptLongituda" data-parsley-required="true" type="number" placeholder="Unesite longitudu"   class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="Provjera4()" data-dismiss="modal">Spremi</button>
                <button type="button" class="btn btn-default" onClick="window.location.reload();" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="obrisi3" tabindex="-1" role="dialog">
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
                <button type="button" class="btn btn-success btn-s" ng-click="ObrisiProjekt()" data-dismiss="modal">Obriši</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="dodajkat" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Dodaj kategoriju</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal" name="frm6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Naziv kategorije</label>
                        <div class="col-md-8">
                            <input  name="naziv3" ng-model="inptNazivKategorije" data-parsley-required="true" type="text" placeholder="Unesite naziv kategorije" 
                            class="form-control">
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="Provjera6()" data-dismiss="modal">Dodaj</button>
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