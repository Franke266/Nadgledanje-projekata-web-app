<?php
ini_set('memory_limit', '2048M');
header('Content-type: text/json');
header('Content-type: application/json; charset=utf-8');
	class Configuration
	{
		public $host = '127.0.0.1';
		public $dbName = 'vsmti';
		public $username = 'root';
		public $password = 'root12345';
	}

	class Projekt
	{
		public $id="N/A";
		public $naziv="N/A";
		public $nositelj="N/A";
		public $vrijednost="N/A";
		public $status="N/A";
		public $voditelj="N/A";
		public $kategorija="N/A";

		public function __construct($id=null,$naziv=null,$nositelj=null,$vrijednost=null,$status=null,$voditelj=null,$kategorija=null)
		{
			if($id) $this->id=$id;
			if($naziv) $this->naziv=$naziv;
			if($nositelj) $this->nositelj=$nositelj;
			if($vrijednost) $this->vrijednost=$vrijednost;
			if($status) $this->status=$status;
			if($voditelj) $this->voditelj=$voditelj;
			if($kategorija) $this->kategorija=$kategorija;
		}
	}

	class Lokacija extends Projekt
	{
		public $adresa="N/A";
		public $postanski_broj="N/A";
		public $grad="N/A";
		public $latituda="N/A";
		public $longituda="N/A";

		public function __construct($id=null,$naziv=null,$nositelj=null,$vrijednost=null,$status=null,$voditelj=null,$kategorija=null,$adresa=null,$postanski_broj=null,$grad=null,$latituda=null,$longituda=null)
		{
			if($adresa) $this->adresa=$adresa;
			if($postanski_broj) $this->postanski_broj=$postanski_broj;
			if($grad) $this->grad=$grad;
			if($latituda) $this->latituda=$latituda;
			if($longituda) $this->longituda=$longituda;
			parent::__construct($id,$naziv,$nositelj,$vrijednost,$status,$voditelj,$kategorija);
		}
	}

	class Osoba
	{
		public $id="N/A";
		public $imeprezime="N/A";
		

		public function __construct($id=null,$imeprezime=null)
		{
			if($id) $this->id=$id;
			if($imeprezime) $this->imeprezime=$imeprezime;
		}
	}

	class ClanProjekta extends Osoba
   {
      public $kontakt="N/A";
      public $mail="N/A";
      public $projekti="N/A";
      public $aktivnosti="N/A";


      public function __construct($id=null,$imeprezime=null,$kontakt=null,$mail=null,$projekti=null,$aktivnosti=null)
		{
			if($kontakt) $this->kontakt=$kontakt;
			if($mail) $this->mail=$mail;
			if($projekti) $this->projekti=$projekti;
			if($aktivnosti) $this->aktivnosti=$aktivnosti;
			parent::__construct($id,$imeprezime);
		}
   }


	class Aktivnost
	{
		public $id="N/A";
		public $naziv="N/A";
		public $opis="N/A";
		public $vrijeme="N/A";
		public $projekt="N/A";
		public $clan_projekta="N/A";
		public $status="N/A";

		public function __construct($id=null,$naziv=null,$opis=null,$vrijeme=null,$projekt=null,$clan_projekta=null,$status=null)
		{
			if($id) $this->id=$id;
			if($naziv) $this->naziv=$naziv;
			if($opis) $this->opis=$opis;
			if($vrijeme) $this->vrijeme=$vrijeme;
			if($projekt) $this->projekt=$projekt;
			if($clan_projekta) $this->clan_projekta=$clan_projekta;
			if($status) $this->status=$status;
		}
	}

	class Kategorija
	{
		public $id="N/A";
		public $naziv="N/A";

		public function __construct($id=null,$naziv=null)
		{
			if($id) $this->id=$id;
			if($naziv) $this->naziv=$naziv;
		}
	}
?>