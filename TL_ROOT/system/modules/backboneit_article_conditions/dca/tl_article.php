<?php

foreach($GLOBALS['TL_DCA']['tl_article']['palettes'] as $strSelector => &$strPalette) if($strSelector != '__selector__') {
	$strPalette .= ';{bbit_art_cond_legend:hide},bbit_art_cond';
}

$GLOBALS['TL_DCA']['tl_article']['fields']['bbit_art_cond'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_article']['bbit_art_cond'],
	'exclude'		=> true,
	'inputType'		=> 'multiColumnWizard',
	'eval'			=> array(
		'columnFields' => array(
			'condition' => array(
				'label'		=> &$GLOBALS['TL_LANG']['tl_article']['bbit_art_cond_condition'],
				'inputType'	=> 'text',
				'eval'		=> array(
					'style'			=> 'width: 400px;'
				),
			),
			'show' => array(
				'label'		=> &$GLOBALS['TL_LANG']['tl_content']['bbit_art_cond_show'],
				'inputType'	=> 'checkbox',
				'eval'		=> array(
				),
			),
		),
	),
);
