<?php
namespace FKU\FkuPydioAuthentication\EventListener;

use TYPO3\CMS\FrontendLogin\Event\LoginConfirmedEvent;
use TYPO3\CMS\FrontendLogin\Event\LogoutConfirmedEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

class PydioAuthentication {
	
    public function connect (LoginConfirmedEvent $event): void {
		$configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('fku_pydio_authentication');
		$secret = $configuration['secretKey'];
		$path = $configuration['pathToPydio'];
		
		if (substr($path, -1) == '/') {
			$path = substr($path, 0, -1);
		}
		$glueCode = $path."/plugins/auth.remote/glueCode.php";
		
		// Get user data
		$user = $GLOBALS['TSFE']->fe_user->user; 
					
		// Initialize the "parameters holder"
		define("AJXP_EXEC", true);
		global $AJXP_GLUE_GLOBALS;
		$AJXP_GLUE_GLOBALS = array();
		$AJXP_GLUE_GLOBALS["secret"] = $secret;

		if ($user != NULL and $glueCode != NULL) {
			$AJXP_GLUE_GLOBALS["plugInAction"] = "login";
			$AJXP_GLUE_GLOBALS["autoCreate"] = true;		
			$AJXP_GLUE_GLOBALS["login"] = array("name" => $user['username'], "password" => "");
		
			// NOW call Pyfio's glueCode!
			include $glueCode;
		}
	}
	
    public function disconnect (LogoutConfirmedEvent $event): void {
		$configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('fku_pydio_authentication');
		$secret = $configuration['secretKey'];
		$path = $configuration['pathToPydio'];
		
		if (substr($path, -1) == '/') {
			$path = substr($path, 0, -1);
		}
		$glueCode = $path."/plugins/auth.remote/glueCode.php";
		
		// Get user data
		$user = $GLOBALS['TSFE']->fe_user->user; 
					
		// Initialize the "parameters holder"
		define("AJXP_EXEC", true);
		global $AJXP_GLUE_GLOBALS;
		$AJXP_GLUE_GLOBALS = array();
		$AJXP_GLUE_GLOBALS["secret"] = $secret;

		if ($user === NULL and $glueCode != NULL) {
			$AJXP_GLUE_GLOBALS["plugInAction"] = "logout";
			include $glueCode;
		}
	}
}