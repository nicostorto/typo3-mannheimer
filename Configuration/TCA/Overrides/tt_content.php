<?php
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['mtmfertighausweltintegration_fertighausweltintegration'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	// plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
	'mtmfertighausweltintegration_fertighausweltintegration',
	// Flexform configuration schema file
	'FILE:EXT:mtm_fertighauswelt_integration/Configuration/FlexForms/flexform.xml'
);