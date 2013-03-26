<?php

class ArticleConditions extends Controller {
	
	public function hookGetArticle($objArticle) {
		if(!$objArticle->published) {
			return;
		}
		
		$arrConditions = deserialize($objArticle->bbit_art_cond, true);
		foreach($arrConditions as $arrRow) {
			$strCondition = trim($arrRow['condition']);
			if(!strlen($strCondition)) {
				continue;
			}
			
			$arrCondition = array_map('trim', explode(',', $strCondition));
			foreach($arrCondition as $strParam) {
				list($strParam, $strValue) = array_map('urldecode', explode('=', $strParam, 2));
				
				if(isset($strValue)) {
					$blnNegate = substr($strParam, -1) == '!';
					$blnNegate && $strParam = substr($strParam, 0, -1);
					$blnMatch = $_GET[$strParam] == $strValue;
				} else {
					$blnNegate = $strParam[0] == '!';
					$blnNegate && $strParam = substr($strParam, 1);
					$blnMatch = isset($_GET[$strParam]);
				}
				
				if(!($blnNegate ^ $blnMatch)) {
					continue 2;
				}
			}
			
			$objArticle->published = $arrRow['show'];
			return;
		}
	}
	
	
	protected function __construct() {
		parent::__construct();
	}
	
	private static $objInstance;
	
	public static function getInstance() {
		if(!isset(self::$objInstance)) {
			self::$objInstance = new self();
		}
		return self::$objInstance;
	}

}
