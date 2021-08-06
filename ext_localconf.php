<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Mtm.MtmFertighausweltIntegration',
            'Fertighausweltintegration',
            [
                'House' => 'list, slider, show',
                'Manufacturer' => 'list, slider, show',
	            'Requestlist' => 'additem, removeitem, show, sendrequest, widget',
	            'Imagemap' => 'show'
            ],
            // non-cacheable actions
            [
                'House' => 'list, slider, show',
                'Manufacturer' => 'list, slider, show',
                'Requestlist' => 'additem, removeitem, show, sendrequest, widget',
                'Imagemap' => 'show'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    fertighausweltintegration {
                        iconIdentifier = mtm_fertighauswelt_integration-plugin-fertighausweltintegration
                        title = LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtm_fertighauswelt_integration_fertighausweltintegration.name
                        description = LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtm_fertighauswelt_integration_fertighausweltintegration.description
                        tt_content_defValues {
                            CType = list
                            list_type = mtmfertighausweltintegration_fertighausweltintegration
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'mtm_fertighauswelt_integration-plugin-fertighausweltintegration',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:mtm_fertighauswelt_integration/Resources/Public/Icons/user_plugin_fertighausweltintegration.svg']
			);
		
    }
);
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['de']['EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang.xlf'][] = 'EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang.xlf';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Mtm\MtmFertighausweltIntegration\Tasks\UpdateDataFromFHW'] = array(
	'extension'        => $_EXTKEY,
	'title'            => 'Datenabgleich mit der Fertighauswelt API',
	'description'      => 'Dieser Task gleicht die Fertighäuser & Anbieter im Typo3 mit den Daten, die von der Fertighauswelt APi bereitgestellt werden ab.'
);