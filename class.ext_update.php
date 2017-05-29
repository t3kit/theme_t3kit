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
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * This class is for migrating between theme_t3kit versions
 *
 */
class ext_update
{

    /**
     * pages definition
     *
     * @var array
     */
    protected $pagesDefiniton = [];

    /**
     * tt_content definition
     *
     * @var array
     */
    protected $ttContentDefinition = [];

    /**
     * Runs the update.
     */
    public function main()
    {
        $content = '';

        $this->loadTableDefinitions();

        if ($this->canMigrateFixedPostVar()) {
            if ($this->needToMigrateFixedPostVar()) {
                if ($this->migrateFixedPostVars()) {
                    $content .= '<p class="alert alert-success">Pages "FixedPostVar" where migrated!</p>';
                } else {
                    $content .= '<p class="alert alert-danger">Pages "FixedPostVar" where not migrated!</p>';
                }
            } else {
                $content .= '<p class="alert alert-info">Don\'t need to migrate pages "FixedPostVar"</p>';
            }
        } else {
            $content .= '<p class="alert alert-warning">' . $this->getCannotMigrateFixedPostVarMessage() . '</p>';
        }

        if ($this->canMigrateMenus()) {
            if ($this->needToMigrateMenus()) {
                if ($this->migrateMenus()) {
                    $content .= '<p class="alert alert-success">Content element of type menu where migrated!</p>';
                } else {
                    $content .= '<p class="alert alert-danger">Content element of type menu where not migrated!</p>';
                }
            } else {
                $content .= '<p class="alert alert-info">Don\'t need to migrate content elements of type Menu</p>';
            }
        } else {
            $content .= '<p class="alert alert-warning">' . $this->getCannotMigrateMenusMessage() . '</p>';
        }

        if ($this->canMigrateTwbsButton()) {
            if ($this->needToMigrateTwbsButton()) {
                if ($this->migrateTwbsButton()) {
                    $content .= '<p class="alert alert-success">Content element of type twbsButton where migrated!</p>';
                } else {
                    $content .= '<p class="alert alert-danger">Content element of type twbsButton where not migrated!</p>';
                }
            } else {
                $content .= '<p class="alert alert-info">Don\'t need to migrate content elements of type twbsButton</p>';
            }
        } else {
            $content .= '<p class="alert alert-warning">' . $this->getCannotMigrateTwbsMessage() . '</p>';
        }

        if ($this->canMigrateMediaToAsset()) {
            if ($this->needToMigrateMediaToAsset()) {
                if ($this->migrateMediaToAsset()) {
                    $content .= '<p class="alert alert-success">Migrated media to assets!</p>';
                } else {
                    $content .= '<p class="alert alert-danger">Could not migrate media to assets!</p>';
                }
            } else {
                $content .= '<p class="alert alert-info">Don\'t need to migrate media to assets</p>';
            }
        } else {
            $content .= '<p class="alert alert-warning">' . $this->getCannotMigrateMediaToAssets() . '</p>';
        }
        return  $content;
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

    protected function canMigrateFixedPostVar()
    {
        return isset($this->pagesDefiniton['tx_t3kitextensiontools_fixed_post_var_conf'])
            && isset($this->pagesDefiniton['tx_themet3kit_fixed_post_var_conf']);
    }

    protected function getCannotMigrateFixedPostVarMessage()
    {
        $message = 'Can\'t migrate FixedPostVars';
        if (!isset($this->pagesDefiniton['tx_t3kitextensiontools_fixed_post_var_conf'])) {
            $message .= ', field "tx_t3kitextensiontools_fixed_post_var_conf" doesn\'t exist in table tt_content';
        }
        if (!isset($this->pagesDefiniton['tx_themet3kit_fixed_post_var_conf'])) {
            $message .= ', field "tx_themet3kit_fixed_post_var_conf" doesn\'t exist in table tt_content';
        }
        return $message;
    }

    protected function needToMigrateFixedPostVar()
    {
        $pages = [];
        if ($this->canMigrateFixedPostVar()) {
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
                    ),
                    $queryBuilder->expr()->neq(
                        'tx_t3kitextensiontools_fixed_post_var_conf',
                        $queryBuilder->quoteIdentifier('tx_themet3kit_fixed_post_var_conf')
                    )
                )
                ->execute()
                ->fetchAll();
        }
        return count($pages) > 0;
    }

    protected function migrateFixedPostVars()
    {
        $result = false;
        if ($this->canMigrateFixedPostVar()) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
            $queryBuilder
                ->update('pages')
                ->where(
                    $queryBuilder->expr()->neq(
                        'tx_t3kitextensiontools_fixed_post_var_conf',
                        $queryBuilder->createNamedParameter('')
                    ),
                    $queryBuilder->expr()->neq(
                        'tx_t3kitextensiontools_fixed_post_var_conf',
                        $queryBuilder->createNamedParameter('0')
                    ),
                    $queryBuilder->expr()->neq(
                        'tx_t3kitextensiontools_fixed_post_var_conf',
                        $queryBuilder->quoteIdentifier('tx_themet3kit_fixed_post_var_conf')
                    )
                )
                ->set('tx_themet3kit_fixed_post_var_conf', $queryBuilder->quoteIdentifier('tx_t3kitextensiontools_fixed_post_var_conf'), false)
                ->execute();
            $result = true;
        }
        return $result;
    }

    protected function canMigrateMenus()
    {
        return isset($this->ttContentDefinition['CType'])
            && isset($this->ttContentDefinition['menu_type']);
    }

    protected function getCannotMigrateMenusMessage()
    {
        $message = 'Can\'t migrate content elements of type menu';
        if (!isset($this->ttContentDefinition['CType'])) {
            $message .= ', field "CType" doesn\'t exist in table pages';
        }
        if (!isset($this->ttContentDefinition['menu_type'])) {
            $message .= ', field "menu_type" doesn\'t exist in table pages';
        }
        return $message;
    }

    protected function needToMigrateMenus()
    {
        $ttContent = [];
        if ($this->canMigrateMenus()) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $ttContent = $queryBuilder
                ->select('uid', 'CType', 'menu_type')
                ->from('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    )
                )
                ->execute()
                ->fetchAll();
        }
        return count($ttContent) > 0;
    }

    protected function migrateMenus()
    {
        $result = false;
        if ($this->canMigrateMenus()) {
            // Menu of selected pages
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('0')
                    )
                )
                ->set('CType', 'menu_pages')
                ->execute();

            // Menu of subpages of selected pages
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('1')
                    )
                )
                ->set('CType', 'menu_subpages')
                ->execute();

            // Menu of subpages of selected pages including abstracts
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('4')
                    )
                )
                ->set('CType', 'menu_abstract')
                ->execute();

            // Menu of subpages of selected pages including sections
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('7')
                    )
                )
                ->set('CType', 'menu_section_pages')
                ->execute();

            // Sitemap
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('2')
                    )
                )
                ->set('CType', 'menu_sitemap')
                ->execute();

            // Sitemaps of selected pages
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('8')
                    )
                )
                ->set('CType', 'menu_sitemap_pages')
                ->execute();

            // Section index (page content marked for section menus)
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('3')
                    )
                )
                ->set('CType', 'menu_section')
                ->execute();

            // Recently updated pages
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('5')
                    )
                )
                ->set('CType', 'menu_recently_updated')
                ->execute();

            // Related pages (based on keywords)
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('6')
                    )
                )
                ->set('CType', 'menu_related_pages')
                ->execute();

            // Pages for selected categories
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('categorized_pages')
                    )
                )
                ->set('CType', 'menu_categorized_pages')
                ->execute();

            // Content elements for selected categories
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('menu')
                    ),
                    $queryBuilder->expr()->eq(
                        'menu_type',
                        $queryBuilder->createNamedParameter('categorized_content')
                    )
                )
                ->set('CType', 'menu_categorized_content')
                ->execute();

            $result = true;
        }
        return $result;
    }

    protected function canMigrateTwbsButton()
    {
        return isset($this->ttContentDefinition['CType']);
    }

    protected function getCannotMigrateTwbsMessage()
    {
        $message = 'Can\'t migrate content elements of type twbsButton';
        if (!isset($this->ttContentDefinition['CType'])) {
            $message .= ', field "CType" doesn\'t exist in table pages';
        }
        return $message;
    }

    protected function needToMigrateTwbsButton()
    {
        $ttContent = [];
        if ($this->canMigrateMenus()) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $ttContent = $queryBuilder
                ->select('uid', 'CType')
                ->from('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('twbsButton')
                    )
                )
                ->execute()
                ->fetchAll();
        }

        return count($ttContent) > 0;
    }

    protected function migrateTwbsButton()
    {
        $result = false;
        if ($this->canMigrateTwbsButton()) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('twbsButton')
                    )
                )
                ->set('CType', 'button')
                ->execute();
            $result = true;
        }
        return $result;
    }

    /**
     * Load table definitions
     *
     * @return void
     */
    protected function loadTableDefinitions()
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $pages = $queryBuilder
            ->select('*')
            ->from('pages')
            ->setMaxResults(1)
            ->execute()
            ->fetchAll();
        
        foreach ($pages[0] as $column => $value) {
            $this->pagesDefiniton[$column] = true;
        }

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $pages = $queryBuilder
            ->select('*')
            ->from('tt_content')
            ->setMaxResults(1)
            ->execute()
            ->fetchAll();

        foreach ($pages[0] as $column => $value) {
            $this->ttContentDefinition[$column] = true;
        }
    }

    protected function canMigrateMediaToAsset()
    {
        return isset($this->ttContentDefinition['assets'])
            && isset($this->ttContentDefinition['media']);
    }

    protected function getCannotMigrateMediaToAsset()
    {
        $message = 'Can\'t migrate assets to media';
        if (!isset($this->ttContentDefinition['assets'])) {
            $message .= ', field "assets" doesn\'t exist in table pages';
        }
        if (!isset($this->ttContentDefinition['media'])) {
            $message .= ', field "media" doesn\'t exist in table pages';
        }
        return $message;
    }

    protected function needToMigrateMediaToAsset()
    {
        $ttContent = [];
        $sysFileReference = [];

        if ($this->canMigrateMediaToAsset()) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $ttContent = $queryBuilder
                ->select('uid', 'header', 'media', 'assets', 'CType')
                ->from('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'assets',
                        $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)
                    ),
                    $queryBuilder->expr()->neq(
                        'media',
                        $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)
                    ),
                    $queryBuilder->expr()->neq(
                        'assets',
                        $queryBuilder->quoteIdentifier('media')
                    ),
                    $queryBuilder->expr()->in(
                        'CType',
                        $queryBuilder->createNamedParameter(
                            ['imageTextLink', 'responsiveVideo'],
                            Connection::PARAM_STR_ARRAY
                        )
                    )
                )
                ->execute()
                ->fetchAll();

            $uidList = [];
            foreach ($ttContent as $index => $values) {
                $uidList[] = $values['uid'];
            }

            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_file_reference');
            $sysFileReference = $queryBuilder
                ->select('uid', 'tablenames', 'uid_foreign', 'fieldname')
                ->from('sys_file_reference')
                ->where(
                    $queryBuilder->expr()->eq(
                        'tablenames',
                        $queryBuilder->createNamedParameter('tt_content')
                    ),
                    $queryBuilder->expr()->eq(
                        'fieldname',
                        $queryBuilder->createNamedParameter('media')
                    ),
                    $queryBuilder->expr()->in(
                        'uid_foreign',
                        $queryBuilder->createNamedParameter(
                            $uidList,
                            Connection::PARAM_INT_ARRAY
                        )
                    )
                )
                ->execute()
                ->fetchAll();
        }

        return count($ttContent) > 0 && count($sysFileReference) > 0;
    }

    protected function migrateMediaToAsset()
    {
        $result = false;
        if ($this->canMigrateMediaToAsset()) {

            $ttContent = [];
            $sysFileReference = [];

            // Fetch content for migration
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $ttContent = $queryBuilder
                ->select('uid', 'header', 'media', 'assets', 'CType')
                ->from('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'assets',
                        $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)
                    ),
                    $queryBuilder->expr()->neq(
                        'media',
                        $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)
                    ),
                    $queryBuilder->expr()->neq(
                        'assets',
                        $queryBuilder->quoteIdentifier('media')
                    ),
                    $queryBuilder->expr()->in(
                        'CType',
                        $queryBuilder->createNamedParameter(
                            ['imageTextLink', 'responsiveVideo'],
                            Connection::PARAM_STR_ARRAY
                        )
                    )
                )
                ->execute()
                ->fetchAll();

            $uidList = [];
            foreach ($ttContent as $index => $values) {
                $uidList[] = $values['uid'];
            }

            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $queryBuilder
                ->update('tt_content')
                ->where(
                    $queryBuilder->expr()->in(
                        'uid',
                        $queryBuilder->createNamedParameter(
                            $uidList,
                            Connection::PARAM_INT_ARRAY
                        )
                    )
                )
                ->set('assets', $queryBuilder->quoteIdentifier('media'), false)
                ->set('media', 0)
                ->execute();

            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_file_reference');
            $sysFileReference = $queryBuilder
                ->update('sys_file_reference')
                ->where(
                    $queryBuilder->expr()->eq(
                        'tablenames',
                        $queryBuilder->createNamedParameter('tt_content')
                    ),
                    $queryBuilder->expr()->eq(
                        'fieldname',
                        $queryBuilder->createNamedParameter('media')
                    ),
                    $queryBuilder->expr()->in(
                        'uid_foreign',
                        $queryBuilder->createNamedParameter(
                            $uidList,
                            Connection::PARAM_INT_ARRAY
                        )
                    )
                )
                ->set('fieldname', 'assets')
                ->execute();
            $result = true;
        }
        return $result;
    }
}
