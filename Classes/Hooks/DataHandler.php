<?php

namespace T3kit\themeT3kit\Hooks;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility as gu;
use TYPO3\CMS\Backend\Utility\BackendUtility as bu;

//use TYPO3\CMS\Extbase\Utility\DebuggerUtility as du;

/**
 * Class/Function which offers TCE main hook functions.
 *
**/
class DataHandler implements SingletonInterface {

    /**
     * fixing translation bug at grid elements
     *
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $tcemainObj
     */
    public function processCmdmap_afterFinish	(\TYPO3\CMS\Core\DataHandling\DataHandler $tcemainObj){

	$getArray = gu::_GET();
	// we need only action 'copyFromLanguage'
	if ($getArray['action'] == "copyFromLanguage"){

	    if (count($getArray['uidList']) > 0){
		// create preTitle like [Translate to English:]
		$preTitle = bu::getRecord('sys_language', $getArray['destLanguageId'], 'title');
		$preTitle = "[Translate to ". $preTitle['title'] .":]";

		// check all CE at list, that was localized
		foreach ($getArray['uidList'] as $origCeUid){

		    // get uid of localized records
		    $localizedCeUid = $tcemainObj->copyMappingArray_merged['tt_content'][$origCeUid];
		    if (empty($localizedCeUid)){
			continue;
		    }
		    $this->localizeChildrenRecordsForGridElement($origCeUid, $localizedCeUid,
				$tcemainObj->copyMappingArray_merged['tt_content'],
				$getArray['srcLanguageId'], $preTitle);

		}
	    }

	}
    }

    /**
     *
     * @param integer	$origCeUid - uid of original CE
     * @param integer	$localizedCeUid - uid of localized CE
     * @param array	$localizeMapping - array with relations between CE original --> localized
     * @param integer	$sourceLanguageUid - uid of original language
     * @param string	$preTitle - preTitle like [Translate to English:]
     *
     * @return void
     */
    private function localizeChildrenRecordsForGridElement ($origCeUid, $localizedCeUid, $localizeMapping, $sourceLanguageUid, $preTitle){

	$localizedRecord = bu::getRecord('tt_content', $localizedCeUid,
		'uid,pid,Ctype,sys_language_uid,tx_gridelements_children,tx_gridelements_container,l18n_parent,header');


	// check if this record is gridelement and has related records (childrens)
	if ($localizedRecord['Ctype'] == "gridelements_pi1" && $localizedRecord['tx_gridelements_children'] > 0){

	    // try to find childrens of this record
	    $childrens = bu::getRecordsByField('tt_content', 'tx_gridelements_container', $localizedRecord['uid'],'','','',$localizedRecord['tx_gridelements_children']);

	    if (count($childrens) > 0){
		foreach($childrens as $record){

		    $key = array_search($record['uid'], $localizeMapping);
		    if ($key == FALSE){
			continue;
		    }
		    // define l18n_parent for children records
		    if ($sourceLanguageUid > 0){
			$tmpRecord = bu::getRecord('tt_content', $record['uid'], 'l18n_parent');
			$l18nparent = $tmpRecord['l18n_parent'];
		    } else {
			$l18nparent = $key;
		    }
		    // update children records
		    $GLOBALS['TYPO3_DB']->sql_query('UPDATE tt_content SET sys_language_uid = '. $localizedRecord['sys_language_uid'].
			    ', l18n_parent = '. $l18nparent .', header = \''. $preTitle . $record['header'] . '\' WHERE uid = '. $record['uid']
			);

		    $this->localizeChildrenRecordsForGridElement($key, $record['uid'], $localizeMapping, $sourceLanguageUid, $preTitle);
		}
	    }
	    // define l18n_parent for grid container record
	    if ($sourceLanguageUid > 0){
		$tmpRecord = bu::getRecord('tt_content', $origCeUid, 'l18n_parent');
		$l18nparent = $tmpRecord['l18n_parent'];
	    } else {
		$l18nparent = $origCeUid;
	    }
	    // update grid container record
	    $GLOBALS['TYPO3_DB']->sql_query('UPDATE tt_content SET l18n_parent = '. $l18nparent .
		    ', header = \''. $preTitle . $localizedRecord['header'] . '\' WHERE uid = '. $localizedRecord['uid']
		);

	}

    }

}

//    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] = 'EXT:theme_t3kit/Classes/Hooks/DataHandler.php:T3kit\\themeT3kit\\Hooks\\DataHandler';

