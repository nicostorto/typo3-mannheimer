<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer',
        'label' => 'manufacturer_name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'manufacturer_name,manufacturer_slogan,description,email,phone,fax,website,strasse,plz,ort',
        'iconfile' => 'EXT:mtm_fertighauswelt_integration/Resources/Public/Icons/tx_mtmfertighausweltintegration_domain_model_manufacturer.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, manufacturer_name, manufacturer_slogan, description, email, phone, fax, website, strasse, plz, ort, manufacturer_logo',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, manufacturer_name, manufacturer_slogan, description, email, phone, fax, website, strasse, plz, ort, manufacturer_logo'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_mtmfertighausweltintegration_domain_model_manufacturer',
                'foreign_table_where' => 'AND {#tx_mtmfertighausweltintegration_domain_model_manufacturer}.{#pid}=###CURRENT_PID### AND {#tx_mtmfertighausweltintegration_domain_model_manufacturer}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],

        'manufacturer_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.manufacturer_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'manufacturer_slogan' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.manufacturer_slogan',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],

        ],
        'brochure_email' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.brochure_email',
	        'config' => [
		        'type' => 'input',
		        'size' => 30,
		        'eval' => 'trim'
	        ],
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'phone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.phone',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'fax' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'website' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'strasse' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.strasse',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'plz' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.plz',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'ort' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.ort',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'manufacturer_logo' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_manufacturer.manufacturer_logo',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'manufacturer_logo',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ]
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
    
    ],
];
