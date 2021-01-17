<?php
include 'connection.php';

$sJsonID= "";
$oJson= array();

if(isset($_GET['projekt_id']))
{
	$projekt_id=$_GET['projekt_id'];
}

if(isset($_GET['aktivnost_id']))
{
	$aktivnost_id=$_GET['aktivnost_id'];
}

if(isset($_GET['clan_id']))
{
	$clan_id=$_GET['clan_id'];
}

if(isset($_GET['json_id']))
{
	$sJsonID= $_GET['json_id'];
}
else
{
	header("Location:index.php");
}



switch ($sJsonID)
{
	case 'ucitaj_projekte':
		$sQuery="SELECT * FROM projekt";
		$oRecord=$oConnection->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
		{
			$nos="";
			$vod="";
			$sta="";
			if($oRow['nositelj']==null)
			{
					$nos="N/A";
			}
			else
			{
				$sQuery2 = "SELECT * FROM clanprojekta
			WHERE clanprojekta.id = ".$oRow['nositelj'];
			$oRecord2=$oConnection->query($sQuery2);
			while($oRow2=$oRecord2->fetch(PDO::FETCH_BOTH))
			{
				$nos=$oRow2['imeprezime'];
			}
			}

			if($oRow['voditelj']==null)
				{
					$vod="N/A";
				}
			else
			{
					$sQuery3 = "SELECT * FROM clanprojekta
			WHERE clanprojekta.id = ".$oRow['voditelj'];
			$oRecord3=$oConnection->query($sQuery3);
			while($oRow3=$oRecord3->fetch(PDO::FETCH_BOTH))
			{
				$vod=$oRow3['imeprezime'];
			}
			}
			if($nos=="N/A" && $vod=="N/A")
			{
				$sta="Neaktivan";
			}
			else
			{
				$sta=$oRow['status'];
			}
				$sQuery4 = "SELECT * FROM kategorija
			WHERE kategorija.id = ".$oRow['kategorija'];
			$oRecord4=$oConnection->query($sQuery4);
			while($oRow4=$oRecord4->fetch(PDO::FETCH_BOTH))
			{
					
			$oProjekt=new Lokacija(
					$oRow['id'],
					$oRow['naziv'],
					$nos,
					$oRow['vrijednost'],
					$sta,
					$vod,
					$oRow4['naziv'],
					$oRow['adresa'],
					$oRow['postanski_broj'],
					$oRow['grad'],
					$oRow['latituda'],
					$oRow['longituda']
				);
			array_push($oJson, $oProjekt);
		}
		}
		

		break;
		case 'projekti_po_id':
		$sQuery="SELECT * FROM projekt WHERE id=".$projekt_id;
		$oRecord=$oConnection->query($sQuery);
		
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
		{
			$oProjekt=new Lokacija(
					$oRow['id'],
					$oRow['naziv'],
					$oRow['nositelj'],
					$oRow['vrijednost'],
					$oRow['status'],
					$oRow['voditelj'],
					$oRow['kategorija'],
					$oRow['adresa'],
					$oRow['postanski_broj'],
					$oRow['grad'],
					$oRow['latituda'],
					$oRow['longituda']
				);
			array_push($oJson, $oProjekt);
		}
		break;
		case 'ucitaj_kategorije':
		$sQuery="SELECT * FROM kategorija";
		$oRecord=$oConnection->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
		{
			$oKategorija=new Kategorija(
					$oRow['id'],
					$oRow['naziv']
				);
			array_push($oJson,$oKategorija);
		}
		
		break;
		

		case 'ucitaj_aktivnosti':
		$sQuery="SELECT * FROM aktivnost";
		$oRecord=$oConnection->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
		{
			$cla="";
			if($oRow['clan_projekta']==null)
			{
				$cla="N/A";
			}
			else
			{
			$sQuery2 = "SELECT * FROM clanprojekta
			WHERE clanprojekta.id = ".$oRow['clan_projekta'];
			$oRecord2=$oConnection->query($sQuery2);
			while($oRow2=$oRecord2->fetch(PDO::FETCH_BOTH))
			{
				$cla=$oRow2['imeprezime'];
			}
			}
			$oAktivnost=new Aktivnost(
					$oRow['id'],
					$oRow['naziv'],
					$oRow['opis'],
					$oRow['vrijeme'],
					$oRow['projekt'],
					$cla,
					$oRow['status']
				);
			array_push($oJson,$oAktivnost);
		}
		
		break;
		 case 'aktivnosti_po_id':
		$sQuery="SELECT * FROM aktivnost WHERE id=".$aktivnost_id;
		$oRecord=$oConnection->query($sQuery);
		
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
		{
			$oAktivnost=new Aktivnost(
					$oRow['id'],
					$oRow['naziv'],
					$oRow['opis'],
					$oRow['vrijeme'],
					$oRow['projekt'],
					$oRow['clan_projekta'],
					$oRow['status']
				);
			array_push($oJson,$oAktivnost);
		}
		break;
		case 'ucitaj_clanove':
		$sQuery="SELECT * FROM clanprojekta";
		$oRecord=$oConnection->query($sQuery);

		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
		{
			$projekti="";
			$aktivnosti="";
			$sQuery2="SELECT * FROM aktivnost
			WHERE aktivnost.clan_projekta= ".$oRow['id'];
			$oRecord2=$oConnection->query($sQuery2);

			while($oRow2=$oRecord2->fetch(PDO::FETCH_BOTH))
			{
				if($aktivnosti=="")
				{
					$aktivnosti=$oRow2['naziv'] .$aktivnosti;
				}
				else
				{
					$aktivnosti=$oRow2['naziv']. "," . " ".$aktivnosti;
				}
				
			}
				$sQuery3="SELECT * FROM projekt
				WHERE projekt.nositelj = ".$oRow['id'];
				$oRecord3=$oConnection->query($sQuery3);

				while($oRow3=$oRecord3->fetch(PDO::FETCH_BOTH))
				{
					if($projekti=="")
					{
						$projekti=$oRow3['naziv'].$projekti;
					}
					else
					{
						$projekti=$oRow3['naziv']. "," . " ".$projekti;
					}
					
				}
				$sQuery4="SELECT * FROM projekt
				WHERE projekt.voditelj= ".$oRow['id'];
				$oRecord4=$oConnection->query($sQuery4);
				while($oRow4=$oRecord4->fetch(PDO::FETCH_BOTH))
				{
					if($projekti=="")
					{
						$projekti=$oRow4['naziv'].$projekti;
					}
					else
					{
					$projekti=$oRow4['naziv']. "," . " ".$projekti;
					}
				}
					$oClan=new ClanProjekta(
					$oRow['id'],
					$oRow['imeprezime'],
					$oRow['kontakt'],
					$oRow['mail'],
					$projekti,
					$aktivnosti
				);
				
				
			array_push($oJson,$oClan);
		}

        break;
        
}
		echo json_encode($oJson);


?>