var oProjektiModul = angular.module('projekti-app', []);

oProjektiModul.controller('projektiController', function ($scope, $http) {
    $scope.oProjekti = [];
    $scope.oClanoviProjekt = [];
    $scope.currentCategory = '';
    $scope.trenutninaziv = '';
    $scope.categories = [];
    $scope.oAktivnostiProjekta = [];
    $scope.imeclana2='';
    $scope.idclana2='';
    $scope.nazivkategorije='';
    $scope.idkategorije='';
    /*$scope.imenositelja='';
    $scope.idnositelja='';
    $scope.imevoditelja='';
    $scope.idvoditelja='';*/


    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_kategorije"
    }).then(function(response) {
        console.log(response);
        $scope.categories = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
$scope.UcitajAktivnosti2 = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_aktivnosti"
    }).then(function(response) {
        console.log(response);
        $scope.oAktivnostiProjekta = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};
$scope.UcitajAktivnosti2();
     

$scope.DohvatiNazivProjekta=function(nazivprojekta){
	localStorage.setItem('naz', nazivprojekta);
	

};
$scope.trenutninaziv=localStorage.getItem("naz");


$scope.setCurrentCategoryItem = function (item) {
        $scope.currentCategory = item;
    };

    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_clanove"
    }).then(function(response) {
        console.log(response);
        $scope.oClanoviProjekt = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });

$scope.UcitajProjekte = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_projekte"
    }).then(function(response) {
        console.log(response);
        $scope.oProjekti = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};
$scope.UcitajProjekte();

    $scope.GetModal = function(naziv, projekt)
	{
		if(naziv=='dodaj')
		{
			$('#dodajprojekt').modal
			({
				show: true
			});
			
		}

		else if(naziv=='dodajkat')
		{
			$('#dodajkat').modal
			({
				show: true
			});
		}
		else if(naziv=='obrisi3')
		{
			$scope.obrID4 = projekt;
			$('#obrisi3').modal
			({
				show: true
			});
		}

		else if(naziv=='uredi')
		{
			console.log(projekt);
			$scope.inptImeProjekta = projekt.naziv;
			$scope.inptNositelj = projekt.nositelj;
			$scope.inptVrijednost = projekt.vrijednost;
			$scope.inptStatusProjekta = projekt.status;
			$scope.inptVoditelj = projekt.voditelj;
			//$scope.inptKategorija=projekt.kategorija;
			$scope.inptAdresa = projekt.adresa;
			$scope.inptPb = parseInt(projekt.postanski_broj);
			$scope.inptGrad = projekt.grad;
			$scope.inptLatituda = parseFloat(projekt.latituda);
			$scope.inptLongituda = parseFloat(projekt.longituda);
			$scope.inptId = projekt.id;
			$('#azurirajprojekt').modal
			({
				show: true
			});

			$scope.nazivkategorije=projekt.kategorija;
	$.each($scope.categories, function( index ) {
		if($scope.categories[index].naziv==$scope.nazivkategorije)
		  	{
		  		$scope.idkategorije=$scope.categories[index].id;
		  	}
		  });

		/*$scope.imenositelja=projekt.nositelj;
	$.each($scope.oClanoviProjekt, function( index ) {
		if($scope.oClanoviProjekt[index].imeprezime==$scope.imenositelja)
		  	{
		  		$scope.idnositelja=$scope.oClanoviProjekt[index].id;
		  	}
		  });

		$scope.imevoditelja=projekt.voditelj;
	$.each($scope.oClanoviProjekt, function( index ) {
		if($scope.oClanoviProjekt[index].imeprezime==$scope.imevoditelja)
		  	{
		  		$scope.idvoditelja=$scope.oClanoviProjekt[index].id;
		  	}
		  });*/
	}
	
	};
	$scope.GetModal2 = function(naziv2, aktivnost2)
	{
		if(naziv2=="dodaj2")
		{
			$('#dodajaktivnost2').modal
			({
				show: true
			});
		}
		else if(naziv2=='uredi2')
		{
			console.log(aktivnost2.clan_projekta);
			$scope.inptNaziv = aktivnost2.naziv;
			$scope.inptOpis = aktivnost2.opis;
			$scope.inptVrijeme = aktivnost2.vrijeme;
			$scope.inptProjekt = aktivnost2.projekt;
			//$scope.inptClan = aktivnost2.clan_projekta;
			$scope.inptStatusAktivnosti = aktivnost2.status;
			$scope.inptId = aktivnost2.id;
			$('#azurirajaktivnost2').modal
			({
				show: true
			});
			
			$scope.imeclana2=aktivnost2.clan_projekta;
	console.log($scope.imeclana2);
	$.each($scope.oClanoviProjekt, function( index ) {
		if($scope.oClanoviProjekt[index].imeprezime==$scope.imeclana2)
		  	{
		  		$scope.idclana2=$scope.oClanoviProjekt[index].id;
		  	}
		  });
	
		console.log($scope.idclana2);
		}
		else if(naziv2=='obrisi2')
		{
			$scope.obrID2 = aktivnost2;
			$('#obrisi2').modal
			({
				show: true
			});
		}
			
	};
$scope.Provjera6=function()
	{
		if (document.forms['frm6'].naziv3.value === "") {
	}
	else
	{
		$scope.DodajKategoriju();
	}
}

$scope.Provjera2=function()
	{
		if (document.forms['frm2'].naziv2.value === "" || document.forms['frm2'].nositelj.value === "" || document.forms['frm2'].vrijednost.value === "" || document.forms['frm2'].status2.value === "" || document.forms['frm2'].voditelj.value === "" || document.forms['frm2'].adresa.value === "" || document.forms['frm2'].pb.value === "" || document.forms['frm2'].grad.value === "" || document.forms['frm2'].lat.value === "" || document.forms['frm2'].long.value === "") {
    alert("Molim Vas popunite sva polja!");
	}
	else
	{
		$scope.DodajProjekt();
	}
}
$scope.Provjera4=function()
	{
		if (document.forms['frm4'].naziv3.value === "" || document.forms['frm4'].nositelj2.value === "" || document.forms['frm4'].vrijednost2.value === "" || document.forms['frm4'].status3.value === "" || document.forms['frm4'].voditelj2.value === "" || document.forms['frm4'].adresa2.value === "" || document.forms['frm4'].pb2.value === "" || document.forms['frm4'].grad2.value === "" || document.forms['frm4'].lat2.value === "" || document.forms['frm4'].long2.value === "") {
    alert("Molim Vas popunite sva polja!");
	}
	else
	{
		$scope.AzurirajProjekt();
	}
}

$scope.Provjera7=function()
	{
		if (document.forms['frm8'].naziv2.value === "" || document.forms['frm8'].opis2.value === "" || document.forms['frm8'].clan2.value === "" || document.forms['frm8'].status2.value === "") {
    alert("Molim Vas popunite sva polja!");
	}
	else
	{
		$scope.DodajAktivnostProjekta();
	}
}

$scope.Provjera8=function()
	{
		if (document.forms['frm9'].opis3.value === "" || document.forms['frm9'].status3.value === "") {
    alert("Molim Vas popunite sva polja!");
	}
	else
	{
		$scope.AzurirajAktivnostProjekta();
	}
}

$scope.DodajKategoriju=function()
{
	var oData = {
			'action_id': 'dodaj_kategoriju',
			'naziv': $scope.inptNazivKategorije
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajProjekte();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
}

	$scope.DodajProjekt = function()
	{
		var oData = {
			'action_id': 'dodaj_projekt',
			'naziv': $scope.inptImeProjekta,
			'nositelj': $scope.inptNositelj,
			'vrijednost': $scope.inptVrijednost,
			'status': $scope.inptStatusProjekta,
			'voditelj': $scope.inptVoditelj,
			'kategorija': $scope.inptKategorija,
			'adresa': $scope.inptAdresa,
			'postanski_broj': $scope.inptPb,
			'grad': $scope.inptGrad,
			'latituda': $scope.inptLatituda,
			'longituda': $scope.inptLongituda
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajProjekte();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

	$scope.AzurirajProjekt = function()
	{
		var oData = {
			'action_id':'azuriraj_projekt',
			'naziv': $scope.inptImeProjekta,
			'nositelj': $scope.inptNositelj,
			'vrijednost': $scope.inptVrijednost,
			'status': $scope.inptStatusProjekta,
			'voditelj': $scope.inptVoditelj,
			'kategorija': $scope.idkategorije,
			'adresa': $scope.inptAdresa,
			'postanski_broj': $scope.inptPb,
			'grad': $scope.inptGrad,
			'latituda': $scope.inptLatituda,
			'longituda': $scope.inptLongituda,
			'id': $scope.inptId
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
				console.log(response);
		    	$scope.UcitajProjekte();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

	$scope.ObrisiProjekt = function()
	{
		var oData = {
			'action_id':'obrisi_projekt',
			'id': $scope.obrID4,
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajProjekte();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

	$scope.DodajAktivnostProjekta = function()
	{
		var today = new Date();
		var date = today.getDate()+'.'+(today.getMonth()+1)+'.'+ today.getFullYear()+' '+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
		var oData = {
			'action_id': 'dodaj_aktivnost',
			'naziv': $scope.inptNaziv,
			'opis': $scope.inptOpis,
			'vrijeme': date,
			'projekt': $scope.trenutninaziv,
			'clan_projekta': $scope.inptClan,
			'status': $scope.inptStatusAktivnosti,
		};
	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajAktivnosti2();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

	$scope.AzurirajAktivnostProjekta = function()
	{
		var oData = {
			'action_id': 'azuriraj_aktivnost',
			'naziv': $scope.inptNaziv,
			'opis': $scope.inptOpis,
			'vrijeme': $scope.inptVrijeme,
			'projekt': $scope.inptProjekt,
			'clan_projekta': $scope.idclana2,
			'status': $scope.inptStatusAktivnosti,
			'id': $scope.inptId
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
				console.log(response);
		    	$scope.UcitajAktivnosti2();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};



	$scope.ObrisiAktivnostProjekta = function()
	{
		var oData = {
			'action_id':'obrisi_aktivnost',
			'id': $scope.obrID2,
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajAktivnosti2();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

});



var oAktivnostiModul = angular.module('aktivnosti-app', []);

oAktivnostiModul.controller('aktivnostiController', function ($scope, $http) {
    $scope.oAktivnosti = [];
    $scope.oClanoviAktivnost = [];
    $scope.oNaziviProjekta = [];
    $scope.imeclana = '';
    $scope.idclana= '';

    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_clanove"
    }).then(function(response) {
        console.log(response);
        $scope.oClanoviAktivnost = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });

$http({
        method : "GET",
        url: "json.php?json_id=ucitaj_projekte"
    }).then(function(response) {
        console.log(response);
        $scope.oNaziviProjekta = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });

$scope.UcitajAktivnosti = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_aktivnosti"
    }).then(function(response) {
        console.log(response);
        $scope.oAktivnosti = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};
$scope.UcitajAktivnosti();
$scope.GetModal = function(naziv, aktivnost)
	{
		if(naziv=="dodaj")
		{
			$('#dodajaktivnost').modal
			({
				show: true
			});
		}
		else if(naziv=='uredi')
		{
			$scope.inptNaziv = aktivnost.naziv;
			$scope.inptOpis = aktivnost.opis;
			$scope.inptVrijeme = aktivnost.vrijeme;
			$scope.inptProjekt = aktivnost.projekt;
			//$scope.inptClan = aktivnost.clan_projekta;
			$scope.inptStatusAktivnosti = aktivnost.status;
			$scope.inptId = aktivnost.id;
			$('#azurirajaktivnost').modal
			({
				show: true
			});
	$scope.imeclana=aktivnost.clan_projekta;
	console.log($scope.imeclana);
	$.each($scope.oClanoviAktivnost, function( index ) {
		if($scope.oClanoviAktivnost[index].imeprezime==$scope.imeclana)
		  	{
		  		$scope.idclana=$scope.oClanoviAktivnost[index].id;
		  	}
		  });
	
		console.log($scope.idclana);
		}
		else if(naziv=='obrisi')
		{
			$scope.obrID2 = aktivnost;
			$('#obrisi').modal
			({
				show: true
			});
		}
			
	};

	$scope.Provjera=function()
	{
		if (document.forms['frm'].naziv.value === "" || document.forms['frm'].opis.value === "" || document.forms['frm'].projekt.value === "" || document.forms['frm'].clan.value === "" || document.forms['frm'].status.value === "") {
    alert("Molim Vas popunite sva polja!");
	}
	else
	{
		$scope.DodajAktivnost();
	}
}

$scope.Provjera5=function()
	{
		if (document.forms['frm5'].opis2.value === "" || document.forms['frm5'].status2.value === "") {
    alert("Molim Vas popunite sva polja!");
	}
	else
	{
		$scope.AzurirajAktivnost();
	}
}

	$scope.DodajAktivnost = function()
	{
		var today = new Date();
		var date = today.getDate()+'.'+(today.getMonth()+1)+'.'+ today.getFullYear()+' '+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
		var oData = {
			'action_id': 'dodaj_aktivnost',
			'naziv': $scope.inptNaziv,
			'opis': $scope.inptOpis,
			'vrijeme': date,
			'projekt': $scope.inptProjekt,
			'clan_projekta': $scope.inptClan,
			'status': $scope.inptStatusAktivnosti,
		};
	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajAktivnosti();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

	$scope.AzurirajAktivnost = function()
	{
		
		var oData = {
			'action_id': 'azuriraj_aktivnost',
			'naziv': $scope.inptNaziv,
			'opis': $scope.inptOpis,
			'vrijeme': $scope.inptVrijeme,
			'projekt': $scope.inptProjekt,
			'clan_projekta': $scope.idclana,
			'status': $scope.inptStatusAktivnosti,
			'id': $scope.inptId
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
				console.log(response);
		    	$scope.UcitajAktivnosti();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};



	$scope.ObrisiAktivnost = function()
	{
		var oData = {
			'action_id':'obrisi_aktivnost',
			'id': $scope.obrID2,
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajAktivnosti();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

});



var oClanoviModul = angular.module('clanovi-app', []);

oClanoviModul.controller('clanoviController', function ($scope, $http) {
    $scope.oClanovi = [];

    $scope.UcitajClanove = function()
    {
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_clanove"
    }).then(function(response) {
        console.log(response);
        $scope.oClanovi = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });

   
	};

$scope.UcitajClanove();
    $scope.GetModal = function(naziv, clan)
	{
		if(naziv=='dodaj')
		{
			$('#dodajclana').modal
			({
				show: true
			});
		}
		else if(naziv=='obrisi')
		{
			$scope.obrID = clan;
			$('#obrisi').modal
			({
				show: true
			});
		}
	};

	$scope.Provjera3=function()
	{
		if (document.forms['frm3'].ime.value === "" || document.forms['frm3'].kontakt.value === "" || document.forms['frm3'].mail.value === "") {
    alert("Molim Vas popunite sva polja!");
	}
	else
	{
		$scope.DodajClana();
	}
	}

	

	$scope.DodajClana = function()
	{
		var pro="N/A";
		var akt="N/A";
		var oData = {
			'action_id': 'dodaj_clana',
			'imeprezime': $scope.inptImePrezime,
			'kontakt': $scope.inptKontakt,
			'mail': $scope.inptMail,
			'projekti': $scope.pro,
			'akivnosti': $scope.akt
		};
		
	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajClanove();
		    	window.location.reload();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		    	$scope.UcitajClanove();
		    	window.location.reload();
		 	}
		);
	};

	$scope.ObrisiClana = function()
	{
		var oData = {
			'action_id':'obrisi_clana',
			'id': $scope.obrID,
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	$scope.UcitajClanove();
		    },
		    function (e) 
		    {
		    	console.log("Greska");
		 	}
		);
	};

});

