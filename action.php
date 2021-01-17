<?php
session_start();
include "connection.php";
$sPostData = file_get_contents("php://input");
$oPostData = json_decode($sPostData);


$sActionID=$oPostData->action_id;

switch ($sActionID) 
{
	case 'dodaj_projekt':
		$sQuery = "INSERT INTO projekt (naziv, nositelj, vrijednost, status,
voditelj, kategorija, adresa, postanski_broj, grad, latituda, longituda) VALUES (:naziv, :nositelj, :vrijednost, :status, :voditelj, :kategorija, :adresa, :postanski_broj, :grad, :latituda, :longituda)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'naziv' => $oPostData->naziv,
		 'nositelj' => $oPostData->nositelj,
		 'vrijednost' => $oPostData->vrijednost,
		 'status' => $oPostData->status,
		 'voditelj' => $oPostData->voditelj,
		 'kategorija' => $oPostData->kategorija,
		 'adresa' => $oPostData->adresa,
		 'postanski_broj' => $oPostData->postanski_broj,
		 'grad' => $oPostData->grad,
		 'latituda' => $oPostData->latituda,
		 'longituda' => $oPostData->longituda
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;

		case 'azuriraj_projekt':
		$sQuery = "UPDATE projekt SET naziv=:naziv, nositelj=:nositelj, vrijednost=:vrijednost, status=:status, voditelj=:voditelj, adresa=:adresa, postanski_broj=:postanski_broj, grad=:grad, latituda=:latituda, longituda=:longituda WHERE id=:id";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'naziv' => $oPostData->naziv,
		 'nositelj' => $oPostData->nositelj,
		 'vrijednost' => $oPostData->vrijednost,
		 'status' => $oPostData->status,
		 'voditelj' => $oPostData->voditelj,
		 'adresa' => $oPostData->adresa,
		 'postanski_broj' => $oPostData->postanski_broj,
		 'grad' => $oPostData->grad,
		 'latituda' => $oPostData->latituda,
		 'longituda' => $oPostData->longituda,
		 'id' => $oPostData->id
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;
		case 'obrisi_projekt':
		$sQuery = "DELETE FROM projekt WHERE id=:id ";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		'id'=>$oPostData->id
		);		
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}
		break;

		case 'dodaj_aktivnost':
		$sQuery = "INSERT INTO aktivnost (naziv, opis, vrijeme, projekt,
clan_projekta,status) VALUES (:naziv, :opis, :vrijeme, :projekt, :clan_projekta, :status)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'naziv' => $oPostData->naziv,
		 'opis' => $oPostData->opis,
		 'vrijeme' => $oPostData->vrijeme,
		 'projekt' => $oPostData->projekt,
		 'clan_projekta' => $oPostData->clan_projekta,
		 'status' => $oPostData->status
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;
		case 'azuriraj_aktivnost':
		$sQuery = "UPDATE aktivnost SET naziv=:naziv, opis=:opis, vrijeme=:vrijeme, projekt=:projekt, clan_projekta=:clan_projekta, status=:status WHERE id=:id";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'naziv' => $oPostData->naziv,
		 'opis' => $oPostData->opis,
		 'vrijeme' => $oPostData->vrijeme,
		 'projekt' => $oPostData->projekt,
		 'clan_projekta' => $oPostData->clan_projekta,
		 'status' => $oPostData->status,
		 'id' => $oPostData->id
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;
		case 'obrisi_aktivnost':
		$sQuery = "DELETE FROM aktivnost WHERE id=:id ";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		'id'=>$oPostData->id
		);		
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}
		break;

		case 'dodaj_clana':
		$sQuery = "INSERT INTO clanprojekta (imeprezime, kontakt, mail, projekti, aktivnosti) VALUES (:imeprezime, :kontakt, :mail, :projekti, :aktivnosti)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'imeprezime' => $oPostData->imeprezime,
		 'kontakt' => $oPostData->kontakt,
		 'mail' => $oPostData->mail,
		 'projekti' => $oPostData->projekti,
		 'aktivnosti' => $oPostData->aktivnosti
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;
		
	case 'obrisi_clana':
		$sQuery = "DELETE FROM clanprojekta WHERE id=:id ";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		'id'=>$oPostData->id
		);		
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}
		break;
		case 'dodaj_kategoriju':
		$sQuery = "INSERT INTO kategorija (naziv) VALUES (:naziv)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'naziv' => $oPostData->naziv
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;
}
?>