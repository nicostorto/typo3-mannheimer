<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house',
        'label' => 'house_number',
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
        'searchFields' => 'house_name,house_description,architectial_style,living_space,energetic_standard,living_space_basement,living_space_ground_floor,living_space_upstairs,living_space_attic,contact_data,youtube_data',
        'iconfile' => 'EXT:mtm_fertighauswelt_integration/Resources/Public/Icons/tx_mtmfertighausweltintegration_domain_model_house.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, house_number, house_name, house_manufacturer, house_description, architectial_style, number_of_rooms, living_space, energetic_standard, slider_images, layout_basement, living_space_basement, layout_ground_floor, living_space_ground_floor, layout_upstairs, living_space_upstairs, layout_attic, living_space_attic, contact_data, youtube_data',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, house_number, house_name, house_manufacturer, house_description, architectial_style, number_of_rooms, living_space, energetic_standard, slider_images, layout_basement, living_space_basement, layout_ground_floor, living_space_ground_floor, layout_upstairs, living_space_upstairs, layout_attic, living_space_attic, contact_data, youtube_data'],
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
                'foreign_table' => 'tx_mtmfertighausweltintegration_domain_model_house',
                'foreign_table_where' => 'AND {#tx_mtmfertighausweltintegration_domain_model_house}.{#pid}=###CURRENT_PID### AND {#tx_mtmfertighausweltintegration_domain_model_house}.{#sys_language_uid} IN (-1,0)',
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

        'house_number' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.house_number',
            'config' => [
                'type' => 'input',
                'size' => 3,
                'eval' => 'trim'
            ]
        ],
        'house_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.house_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'house_manufacturer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.house_manufacturer',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'itemsProcFunc' => "Mtm\MtmFertighausweltIntegration\Controller\ItemsProcFunc->select",
                'maxitems' => 1,
            ],
        ],
        'house_description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.house_description',
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
        'architectial_style' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.architectial_style',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'number_of_rooms' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.number_of_rooms',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'living_space' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.living_space',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'energetic_standard' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.energetic_standard',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'slider_images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.slider_images',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
	            'sliderImages',
	            array('minitems' => 0,'maxitems' => 10),
	            $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),

        ],
        'layout_basement' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.layout_basement',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'layout_basement',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
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
        'living_space_basement' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.living_space_basement',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'layout_ground_floor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.layout_ground_floor',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'layout_ground_floor',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
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
        'living_space_ground_floor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.living_space_ground_floor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'layout_upstairs' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.layout_upstairs',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'layout_upstairs',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
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
        'living_space_upstairs' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.living_space_upstairs',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'layout_attic' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.layout_attic',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'layout_attic',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
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
        'living_space_attic' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.living_space_attic',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'contact_data' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.contact_data',
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
        'youtube_data' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:mtm_fertighauswelt_integration/Resources/Private/Language/locallang_db.xlf:tx_mtmfertighausweltintegration_domain_model_house.youtube_data',
	        'config' => [
		        'type' => 'text',
		        'enableRichtext' => false,
		        'richtextConfiguration' => 'default',
		        'fieldControl' => [
			        'fullScreenRichtext' => [
				        'disabled' => false,
			        ],
		        ],
		        'cols' => 40,
		        'rows' => 5,
		        'eval' => 'trim',
	        ],

        ],
    
    ],
];
