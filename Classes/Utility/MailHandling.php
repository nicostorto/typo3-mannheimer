<?php

namespace Mtm\MtmFertighausweltIntegration\Utility;


use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class MailHandling {

	/**
	 * action sync
	 *
	 * @return boolean
	 */
	public function checkFormData($formData){
		if(array_key_exists('vorname', $formData)){

		} else {

		}

		if(array_key_exists('nachname', $formData)){

		} else {

		}

		if(array_key_exists('strasse', $formData)){

		} else {

		}

		if(array_key_exists('plz', $formData)){

		} else {

		}

		if(array_key_exists('ort', $formData)){

		} else {

		}

		if(array_key_exists('telefon', $formData)){

		} else {

		}

		if(array_key_exists('email', $formData)){

		} else {

		}
	}

	public function createContactCSV( $formData){
		$filename = '../csv/kunden_kontakt.csv';

		$street_label = utf8_decode('Straße');

		$csv_str = 'Vorname;Nachname;' . $street_label . ';PLZ;Ort;Telefon;E-Mail' . "\n";
		$csv_str .= utf8_decode($formData['vorname']) . ';' . utf8_decode($formData['nachname']) . ';' . utf8_decode($formData['strasse']) . ';' . $formData['plz'] . ';' . utf8_decode($formData['ort']) . ';' . $formData['telefon'] . ';' . $formData['email'];

		if($file_handle = fopen($filename, "w+")) {

			fwrite($file_handle, $csv_str);
			fclose($file_handle);

			return true;

		}else {
			return false;
		}
	}

	public function sendManufacturerMails($formData, $manufacturerRequests){
		foreach($manufacturerRequests as $manufacturerMailInfo){
			//Create new Mail and set the mail coordiantes
			$mail = GeneralUtility::makeInstance( MailMessage::class);
			$mail->setSubject('Prospektanforderung Deutsches Fertighaus Center Mannheim - ' . $manufacturerMailInfo['manufacturerdata']->getManufacturerName());
			$mail->setFrom("prospekte@deutsches-fertighaus-center.de");

			/*if(!empty($manufacturerMailInfo['manufacturerdata']->getBrochureEmail())){
				$mail->setTo($manufacturerMailInfo['manufacturerdata']->getBrochureEmail());
			} else {
				$mail->setTo($manufacturerMailInfo['manufacturerdata']->getEmail());
			}*/
			$mail->setTo("storto@matoma.de");

			//Message helper
			$eol = "\n";
			$tab = "\t";

			//Kontaktdaten des Kunden in den Emailbody schreiben
			$messageBody = "Kontaktdaten:" . $eol . $eol;
			$messageBody .= "Vorname: " . $formData['vorname'] . $eol;
			$messageBody .= "Nachname: " . $formData['nachname'] . $eol;
			$messageBody .= "Straße: " . $formData['strasse']  . $eol;
			$messageBody .= "PLZ, Ort: " . $formData['plz'] . " " . $formData['ort']  . $eol;
			$messageBody .= "Telefon: " . $formData['telefon']  . $eol;
			$messageBody .= "E-Mail: " . $formData['email']  . $eol . $eol;

			//Die angefragten Häuser in den Emailbody schreiben
			$messageBody .= 'Folgende Prospektanforderungen wurden durchgeführt:'  . $eol . $eol;
			foreach($manufacturerMailInfo['housedata'] as $requestedHouse){
				$messageBody .= $tab . '- ' . $requestedHouse['hausnumber'] . ' ' . $requestedHouse['hausname'] . $eol;
			}

			//Akzeptierte Datenschutzklausel in den Emailbody schreiben
			$messageBody .= $eol . 'Der Empfänger hat folgenden Datenschutzbestimmungen zugestimmt:' . $eol . $eol;
			$messageBody .= 'Sie erklären sich damit einverstanden, dass die im Rahmen der Prospekt-' . $eol;
			$messageBody .= 'und Informations-Anforderung erhobenen Daten zum Zwecke der Kundenbetreuung' . $eol;
			$messageBody .= 'und Kommunikation zwischen Ihnen und den ausgewählten Anbietern/Ausstellern' . $eol;
			$messageBody .= 'des Deutschen Fertighaus Centers Mannheim und deren Vertriebs-Organisationen' . $eol;
			$messageBody .= 'verwendet und gespeichert werden.' . $eol;
			$messageBody .= 'Sollten Sie keinen telefonischen Kontakt wünschen, so geben Sie Ihre Telefonnummer' . $eol;
			$messageBody .= 'bitte nicht an.' . $eol;
			$messageBody .= 'Diese Einwilligung kann jederzeit mit Wirkung für die Zukunft bei den Anbietern/Ausstellern widerrufen werden.' . $eol;

			$mail->setBody($messageBody, 'text/plain');
			$mail->send();
		}

		return true;
	}


	public function sendOperatorMail($formData, $manufacturerRequests){
		//Create new Mail and set the mail coordiantes
		$mail = GeneralUtility::makeInstance( MailMessage::class);
		$mail->setSubject('Prospektanforderung Deutsches Fertighaus Center Mannheim');
		$mail->setFrom("prospekte@deutsches-fertighaus-center.de");
		$mail->setTo("storto@matoma.de");

		//Message helper
		$eol = "\n";
		$tab = "\t";

		//Kontaktdaten des Kunden in den Emailbody schreiben
		$messageBody = "Kontaktdaten:" . $eol . $eol;
		$messageBody .= "Vorname: " . $formData['vorname'] . $eol;
		$messageBody .= "Nachname: " . $formData['nachname'] . $eol;
		$messageBody .= "Straße: " . $formData['strasse']  . $eol;
		$messageBody .= "PLZ, Ort: " . $formData['plz'] . " " . $formData['ort']  . $eol;
		$messageBody .= "Telefon: " . $formData['telefon']  . $eol;
		$messageBody .= "E-Mail: " . $formData['email']  . $eol . $eol;

		//Die angefragten Häuser in den Emailbody schreiben
		$messageBody .= 'Folgende Prospektanforderungen wurden durchgeführt:'  . $eol . $eol;
		foreach($manufacturerRequests as $requestedmanufacturer){
			$messageBody .= $requestedmanufacturer['manufacturerdata']->getManufacturerName() . $eol;
			foreach($requestedmanufacturer['housedata'] as $requestedHouse){
				$messageBody .= $tab . '- ' . $requestedHouse['hausnumber'] . ' ' . $requestedHouse['hausname'] . $eol;
			}
			$messageBody .= $eol;
		}

		//Akzeptierte Datenschutzklausel in den Emailbody schreiben
		$messageBody .= $eol . 'Der Empfänger hat folgenden Datenschutzbestimmungen zugestimmt:' . $eol . $eol;
		$messageBody .= 'Sie erklären sich damit einverstanden, dass die im Rahmen der Prospekt-' . $eol;
		$messageBody .= 'und Informations-Anforderung erhobenen Daten zum Zwecke der Kundenbetreuung' . $eol;
		$messageBody .= 'und Kommunikation zwischen Ihnen und den ausgewählten Anbietern/Ausstellern' . $eol;
		$messageBody .= 'des Deutschen Fertighaus Centers Mannheim und deren Vertriebs-Organisationen' . $eol;
		$messageBody .= 'verwendet und gespeichert werden.' . $eol;
		$messageBody .= 'Sollten Sie keinen telefonischen Kontakt wünschen, so geben Sie Ihre Telefonnummer' . $eol;
		$messageBody .= 'bitte nicht an.' . $eol;
		$messageBody .= 'Diese Einwilligung kann jederzeit mit Wirkung für die Zukunft bei den Anbietern/Ausstellern widerrufen werden.' . $eol;

		$mail->setBody($messageBody, 'text/plain');
		$mail->send();

		return true;
	}

}