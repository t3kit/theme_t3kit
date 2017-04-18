<?php

namespace T3kit\themeT3kit;

/***************************************************************
*  Copyright notice
*
*  (c) 2016 T3kit
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * This class is for migrating between theme_t3kit versions
 *
 */
class ext_update
{

    /**
     * Runs the update.
     */
    public function main()
    {
        $content = '<h1>Migration scripts</h1>';
        $content .= '<form>';

        $pages =  $this->getT3kitExtensionToolFixedPostVarPages();
        if (is_array($pages) && count($pages) > 0) {
            $content .= '<table class="table table-striped table-condensed">';
            $content .= '<tr>';
            $content .= '<th>Update</th>';
            $content .= '<th>Page id</th>';
            $content .= '<th>Page title</th>';
            $content .= '<th>t3kit_extension_tool</th>';
            $content .= '<th>theme_t3kit</th>';
            $content .= '<tr>';
            foreach ($pages as $index => $page) {
                $selected = '';
                if ($page['tx_t3kitextensiontools_fixed_post_var_conf'] != $page['tx_themet3kit_fixed_post_var_conf']) {
                    $selected = 'checked="checked"';
                }
                $content .= '<tr>';
                $content .= '<td><input name="fixedPostVar[' . $page['uid'] . ']" type="checkbox" ' . $selected . ' /></td>';
                $content .= '<td>' . $page['uid'] . '</td>';
                $content .= '<td>' . $page['title'] . '</td>';
                $content .= '<td>' . $page['tx_t3kitextensiontools_fixed_post_var_conf'] . '</td>';
                $content .= '<td>' . $page['tx_themet3kit_fixed_post_var_conf'] . '</td>';
                $content .= '</tr>';
            }
            $content .= '</table>';
            $content .= '<button type="submit" name="copyFixedPostVars">Copy</button>';
        }
        $content .= '</form>';
        
        return $content;
    }

    /**
     * Checks if the script should execute. We check for everything except table
     * structure.
     *
     * @return bool
     */
    public function access()
    {
        return true;
    }

    protected function getT3kitExtensionToolFixedPostVarPages()
    {
        $hasT3kitExtensionToolsFixedPostVarField = $this->hasT3kitExtensionToolsFixedPostVarField();
        $pages = [];

        if ($hasT3kitExtensionToolsFixedPostVarField) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
            $pages = $queryBuilder
                ->select('uid', 'title', 'tx_t3kitextensiontools_fixed_post_var_conf', 'tx_themet3kit_fixed_post_var_conf')
                ->from('pages')
                ->where(
                    $queryBuilder->expr()->neq(
                        'tx_t3kitextensiontools_fixed_post_var_conf',
                        $queryBuilder->createNamedParameter('')
                    ),
                    $queryBuilder->expr()->neq(
                        'tx_t3kitextensiontools_fixed_post_var_conf',
                        $queryBuilder->createNamedParameter('0')
                    )
                )
                ->execute()
                ->fetchAll();
        }

        return $pages;
    }

    protected function hasT3kitExtensionToolsFixedPostVarField()
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $pages = $queryBuilder
            ->select('*')
            ->from('pages')
            ->setMaxResults(1)
            ->execute()
            ->fetchAll();
        
        return isset($pages[0]['tx_t3kitextensiontools_fixed_post_var_conf']);
    }
}
