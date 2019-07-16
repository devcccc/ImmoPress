<?php

/**
 * Immocaster SDK
 * Verbindung zur API von ImmobilienScout24.
 *
 * @package    Immocaster SDK
 * @author     Norman Braun (medienopfer98.de)
 * @link       http://www.immocaster.com
 */

class Immocaster_Immobilienscout
{

	/**
     * REST-URL die für ImmobilienScout24 genutzt werden soll.
     *
     * @var string
     */
	protected $_sUri = 'http://sandbox.immobilienscout24.de';
	
    /**
     * REST-Pfad der für ImmobilienScout24 genutzt werden soll.
     *
     * @var string
     */
	private $_sUriPath = 'restapi/api/';
	
    /**
     * REST-Pfad der für ImmobilienScout24 genutzt werden soll,
	 * bei 3-legged-oauth.
     *
     * @var string
     */
	private $_sUriPathSecurity = 'restapi/security/';
	
	/**
     * Typ der Authentifizierung die genutzt werden soll (z.B. oauth).
	 *
	 * @var string
     */
	private $_sAuthType = null;
	
	/**
     * Signaturmethode für die Nutzung des Service.
	 *
	 * @var object
     */
	protected $_oSignatureMethod = null;
	
	/**
     * Consumerobjekt für die Ausführung der Requests.
	 *
	 * @var object
     */
	protected $_oConsumer = null;
	
	/**
     * Key des Consumer.
	 *
	 * @var string
     */
	protected $_sConsumerKey = null;
	
	/**
     * Secret des Consumer.
	 *
	 * @var string
     */
	protected $_sConsumerSecret = null;
	
	/**
     * Verbindung zum Service aufbauen.
     *
	 * @param string $sKey Key für diesen Service
	 * @param string $sSecret Secret für diesen Service
	 * @param string $sAuth Typ der Authentifizierung für den Service
     * @return void
     */
    protected function connectService($sKey,$sSecret,$sAuth)
    {
		$this->_sConsumerKey = $sKey;
		$this->_sConsumerSecret = $sSecret;
		$this->_sAuthType = strtolower($sAuth);
		if($this->_sAuthType=='oauth')
		{
			$this->_oSignatureMethod = new OAuthSignatureMethod_HMAC_SHA1();
			$this->_oConsumer = new OAuthConsumer($sKey,$sSecret,NULL);
		}
    }
	
	/**
     * Prüfen ob alle Pflichvariablen für eine Methode gesetzt sind.
	 *
	 * @param array Variablen die gesetzt sind
	 * @param array Variablen die benötigt werden
	 * @param string Name der Methode die geprüft wird
	 * @return boolean
     */
	protected function requiredArgs($aArgs,$aRequired,$sMethod)
	{
		foreach($aRequired as $sRequired)
		{
			if(!isset($aArgs[$sRequired]))
			{
				$sMethod = substr($sMethod,1,strlen($sMethod)-1);
				throw new Exception(sprintf(IMMOCASTER_SDK_LANG_PARAMETER_NOT_SET,$sMethod,$sRequired));
				return false;
			}
		}
		return true;
	}
	
	/**
     * Request per REST ausführen.
     *
	 * @param string $sPath Pfad zum Request
	 * @param array $aArgs Variablen für den Request
	 * @param boolean $bSecurity Wert, ob der Securitypfad genutzt werden soll (für 3-legged-oauth)
	 * @param object Requesttoken für 3-Legged-Oauth
	 * @param string $requestMethod HTTP Request Method ('GET','POST')
     * @return mixed
     */
	protected function restRequest($sPath='',$aArgs=array(),$bSecurity=false,$oToken=null,$requestMethod='GET')
	{
		if(!in_array($requestMethod,array('GET','POST')))
		{
			$requestMethod = 'GET';
		}
		if($this->_sAuthType=='oauth')
		{
			$sSubPath = $this->_sUriPath;
			if($bSecurity==true)
			{
				$sSubPath = $this->_sUriPathSecurity;
			}
			if($oToken!=null)
			{
				return OAuthRequest::from_consumer_and_token($this->_oConsumer,$oToken,$requestMethod,$this->_sUri.'/'.$sSubPath.$sPath,$aArgs);
			}
			return OAuthRequest::from_consumer_and_token($this->_oConsumer,NULL,$requestMethod,$this->_sUri.'/'.$sSubPath.$sPath,$aArgs);
		}
		return false;
	}
	
	/**
     * Content für aktuellen Request abfragen,
	 * ermitteln und zurückliefern.
	 *
	 * @param object oAuth Objekt
	 * @param string Secret des Accesstoken
	 * @return mixed
     */
	protected function getContent($req,$sSecret=null)
	{
		if($this->_sAuthType=='oauth')
		{
			if($req->get_normalized_http_method() == 'POST')
			{
				$requestBody = $req->get_parameter('request_body');
				if($requestBody !== NULL)
				{
					$req->unset_parameter('request_body');
				}
			}
			$req->sign_request($this->_oSignatureMethod,$this->_oConsumer,NULL);
			$sNewHeader = $this->getContentRequestHeaderArray($req,$sSecret);
			if($this->_sUrlReadingType=='none')
			{
				$opts = array('http'=>array('ignore_errors'=>true,'header'=>implode("\r\n", $sNewHeader)));
				if($req->get_normalized_http_method() == 'POST')
				{
					$opts['http']['method'] = 'POST';
					$opts['http']['content'] = $requestBody;
				}
				$result = file_get_contents($req->to_url(),false,stream_context_create($opts));
			}
			if($this->_sUrlReadingType=='curl')
			{
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_HTTPHEADER,$sNewHeader);
				curl_setopt($ch,CURLOPT_URL,$req->to_url());
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
				if($req->get_normalized_http_method() == 'POST')
				{
					curl_setopt($ch,CURLOPT_POST,TRUE);
					curl_setopt($ch,CURLOPT_POSTFIELDS,$requestBody);
				}
				$result = curl_exec($ch);
				curl_close($ch);
			}
			return $result;
		}
		return false;
	}
	
	/**
	 * Header Array für aktuellen Request erstellen
	 *
	 * @param object oAuth Objekt
	 * @param string Secret des Accesstoken
	 * @return array
	 */
	protected function getContentRequestHeaderArray($req,$sSecret=null) {
		$sAccessTokenSignature = '';
		if($sSecret)
		{
			$sConsKey = rawurlencode($this->_sConsumerSecret).'&'.$sSecret;
			$sSignature = urlencode(base64_encode(hash_hmac('sha1',$req->get_signature_base_string(),$sConsKey,true)));
			$sAccessTokenSignature = ',oauth_signature_method="HMAC-SHA1",oauth_signature="'.$sSignature.'"';
		}
		$sNewHeader = array(
			$req->to_header().$sAccessTokenSignature,
			'User-Agent: '.IMMOCASTER_USER_AGENT
		);
		if($this->_sContentResultType=='json')
		{
			$sNewHeader[] = 'Accept: application/json';
		}
		if($req->get_normalized_http_method()=='POST')
		{
			if ($this->_sContentRequestType=='json')
			{
				$sNewHeader[] = 'Content-Type: application/json;charset=utf-8';
			}
			else
			{
				$sNewHeader[] = 'Content-Type: application/xml;charset=utf-8';
			}
		}
		return $sNewHeader;
	}
}