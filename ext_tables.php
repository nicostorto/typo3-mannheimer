<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Mtm.MtmFertighausweltIntegration',
            'Fertighausweltintegration',
            'Fertighauswelt Integration'
        );

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Mtm.MtmFertighausweltIntegration',
                'web', // Make module a submodule of 'web'
                'fertighausweltsync', // Submodule key
                '', // Position
                [
                    'House' => 'list, sync',
                    'Manufacturer' => 'list, sync',
                    
                ],
                [
                    'access' => 'user,group',
                    'icon'   => 'EXT:mtm_fertighauswelt_integration/Resources/Public/Icons/user_mod_fertighausweltsync.svg',
                    'labels' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_fertighausweltsync.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('mtm_fertighauswelt_integration', 'Configuration/TypoScript', 'Fertighauswelt Integration');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mtmfertighausweltintegration_domain_model_house', 'EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_csh_tx_mtmfertighausweltintegration_domain_model_house.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mtmfertighausweltintegration_domain_model_house');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mtmfertighausweltintegration_domain_model_manufacturer', 'EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_csh_tx_mtmfertighausweltintegration_domain_model_manufacturer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mtmfertighausweltintegration_domain_model_manufacturer');
    }
);
