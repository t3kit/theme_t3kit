<?php
namespace T3kit\themeT3kit\UserFunction;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Class to manipulate the BreadCrumb
 *
 * @package TYPO3
 * @subpackage
 * @author Markus Goldbach <markus.goldbach@dkd.de>
 */
class BreadCrumb
{
    /**
     * Add an item to the last position of an Menu
     *
     * @param $menuArr
     * @param $conf
     * @return array
     */
    public function addAdditionalItem($menuArr, $conf): array
    {
        if (isset($GLOBALS['TSFE']->register['additionalBreadCrumbItem'])) {
            end($menuArr);
            $lastMenuKey = key($menuArr);

            $breadcrumpItem = $menuArr[$lastMenuKey];
            $breadcrumpItem['title'] = $GLOBALS['TSFE']->register['additionalBreadCrumbItem'];
            $breadcrumpItem['ITEM_STATE'] = 'CUR';
            $menuArr[$lastMenuKey]['ITEM_STATE'] = 'NO';
            $menuArr[] = $breadcrumpItem;
        }
        return $menuArr;
    }
}
