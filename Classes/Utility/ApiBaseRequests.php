<?php
namespace Mtm\MtmFertighausweltIntegration\Utility;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ApiBaseRequests {

	//API Endpoint and Request Url
	protected $requestUrl = 'https://www.fertighauswelt.de/parkbetreiber/graphql';

	//Username und Passwort als Base64 String | mannheim:GbbU2bAnEQ
	protected $authString = '';

	// String to Authentificate the user
	protected $authQueryString = 'query=mutation+authenticate+%7B%0D%0A++++authenticate%0D%0A%7D';

	//API Token | JWT
	protected $authBearer = '';

	// Array to store the Request Headers
	protected $authCurlHeaders = array();
	protected $requestCurlHeaders = array();

	/*
	 * Public Konstruktor
	 * Fragt das AccessToken der API ab und setzt dann die Standardheader für weitere Abfragen.
	 *
	 * @return void
	 */

	public function __construct($authString) {

		$this->authString = $authString;

		//open connection
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->requestUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->authQueryString);


		$this->authCurlHeaders[] = 'Authorization: Basic ' . $this->authString;
		$this->authCurlHeaders[] = 'Content-Type: application/x-www-form-urlencoded';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->authCurlHeaders);

		$jsonResult = curl_exec($ch);

		curl_close($ch);

		$result = json_decode($jsonResult);
		$this->authBearer = $result->data->authenticate;

	}

	/*
	 * Führt den CURL Request aus, um alle benötigten Informationen für die Musterhäuser abzufragen
	 *
	 *
	 * @return array
	 */

	public function getAllHouses() {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->requestUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'query=query%7BmusterhausPark%7Bmusterhaeuser%7Bparzelle%20name%20beschreibung%20hausart%20haustyp%20zimmeranzahl%20wohnflaeche_eg%20wohnflaeche_og%20wohnflaeche_dg%20wohnflaeche_keller%20wohnflaeche_gesamt%20energetischer_standard%20hersteller%7Bname%20logo%7Bsrc%7D%7D%20rundgang_url%20bilder%20%7Bsrc%20caption%7D%20grundriss_eg%7Bsrc%7D%20grundriss_og%7Bsrc%7D%20grundriss_dg%7Bsrc%7D%20grundriss_keller%7Bsrc%7D%20%7D%7D%7D');

		$this->requestCurlHeaders[] = 'Accept: application/json';
		$this->requestCurlHeaders[] = 'Authorization: Bearer ' . $this->authBearer;

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->requestCurlHeaders);

		$jsonResult = curl_exec($ch);
		$result = json_decode($jsonResult, true);

		$musterhaeuser = $result['data']['musterhausPark']['musterhaeuser'];

		$columns = array_column($musterhaeuser, 'parzelle');
		array_multisort($columns, SORT_ASC, $musterhaeuser);

		return $musterhaeuser;
	}

	/*
	 * Führt den CURL Request aus, um alle benötigten Informationen für die Musterhaus Anbieter abzufragen
	 *
	 *
	 * @return array
	 */

	public function getAllManufacturer() {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->requestUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'query=query%7BmusterhausPark%7Bhersteller%7Bname%20headline%20text%20markenname%20telefonnummer%20telefaxnummer%20website%20eMailAdresse%20adresse%20%7B%0A%20%20strasse%0A%20%20plz%0A%20%20ort%0A%20%20land%0A%7D%20logo%7Bsrc%20width%20height%7D%7D%7D%7D');

		$this->requestCurlHeaders[] = 'Accept: application/json';
		$this->requestCurlHeaders[] = 'Authorization: Bearer ' . $this->authBearer;

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->requestCurlHeaders);

		$jsonResult = curl_exec($ch);
		$result = json_decode($jsonResult, true);

		$manufacturer = $result['data']['musterhausPark']['hersteller'];

		return $manufacturer;
	}
}