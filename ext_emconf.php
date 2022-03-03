<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "fku_pydio_authentication"
 *
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
	'title' => 'Pydio Authentication',
	'description' => '',
	'category' => 'plugin',
	'author' => 'Daniel Widmer',
	'author_email' => 'daniel.widmer@fku.ch',
	'state' => 'stable',
	'clearCacheOnLoad' => 0,
	'version' => '1.0.0',
	'constraints' => [
		'depends' => [
			'typo3' => '8.7.0 - 10.4.99',
		],
		'conflicts' =>[],
		'suggests' => [],
	],
];


/******************************************
 * Version 0.5.0
 * -------------
 * Disabled hook for login and created workaround in hook for lougout due to incompatibility of used Guzzle versions
 * in Typo3 v8 and Pydio v8
 *
 * Version 0.6.0
 * -------------
 * Ready for Typo3 version 10
 *
 * Version 1.0.0
 * -------------
 * composer.json added
 * Services.yaml
 * Replaced hooks by event listener (PSR-14)
 * Removed all frontend stuff like controller, templates, typoscript
 * Deleted ext_lobalconf and ext_tables
 *
 *
 */