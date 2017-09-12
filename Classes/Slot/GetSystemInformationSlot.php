<?php
namespace T3kit\themeT3kit\Slot;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Toolbar\Enumeration\InformationStatus;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\TypoScript\ExtendedTemplateService;
use TYPO3\CMS\Core\Utility\RootlineUtility;
use TYPO3\CMS\Extbase\Service\TypoScriptService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;

/**
 * Render custom system info to toolbar item
 */
class GetSystemInformationSlot
{
    /**
     * Signal slot getSystemInformation
     *
     * @param SystemInformationToolbarItem $sysInfoToolbarItem sysInfoToolbarItem
     *
     * @return void
     */
    public function getSystemInformation($sysInfoToolbarItem)
    {
        $this->getThemeMode($sysInfoToolbarItem);
    }

    /**
     * Get theme mode to system information
     *
     * @param SystemInformationToolbarItem $sysInfoToolbarItem sysInfoToolbarItem
     *
     * @return void
     */
    protected function getThemeMode($sysInfoToolbarItem)
    {
        if (ExtensionManagementUtility::isLoaded('themes')) {

            $rootSysTemplates = $this->getRootSysTemplates();

            if (!empty($rootSysTemplates) && is_array($rootSysTemplates)) {
                foreach ($rootSysTemplates as $index => $rootSysTemplate) {

                    $themeConfiguration = $this->getThemeConfiguration(
                        $rootSysTemplate
                    );
                    if (!empty($themeConfiguration)
                        && is_array($themeConfiguration)
                    ) {

                        $inProductionMode
                            = $themeConfiguration['isDevelopment'] === '0';

                        $themeMode = $inProductionMode
                            ? 'Production'
                            : 'Development';

                        $themeStatus = $inProductionMode
                            ? InformationStatus::STATUS_OK
                            : InformationStatus::STATUS_WARNING;
            
                        $sysInfoToolbarItem->addSystemInformation(
                            'Theme mode [' . $rootSysTemplate['pid'] . ']',
                            $themeMode,
                            'sysinfo-application-context',
                            $themeStatus
                        );
                    }
                }
            }
        }
    }

    /**
     * Get root templates
     *
     * @return array
     */
    protected function getRootSysTemplates()
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_template');
        $rootSysTemplates = $queryBuilder
            ->select('*')
            ->from('sys_template')
            ->where(
                $queryBuilder->expr()->eq(
                    'root',
                    $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)
                )
            )
            ->execute()
            ->fetchAll();
        return $rootSysTemplates;
    }

    /**
     * Fetch theme configuration constants
     *
     * @param array $sysTemplate System Template
     *
     * @return array
     */
    protected function getThemeConfiguration($sysTemplate)
    {
        $themeConfiguration = false;
        $templateService = GeneralUtility::makeInstance(
            ExtendedTemplateService::class
        );
        $typoScriptService = GeneralUtility::makeInstance(
            TypoScriptService::class
        );
        $templateService->init();

        $templateUid = $sysTemplate['uid'];
        $pageId = $sysTemplate['pid'];

        $rootlineUtility = GeneralUtility::makeInstance(
            RootlineUtility::class,
            $pageId
        );
        $rootLine = $rootlineUtility->get();

        $templateService->runThroughTemplates($rootLine, $templateUid);
        $templateService->generateConfig();

        $themeConfiguration = $templateService
            ->setup_constants['themes.']['configuration.'];

        if (!empty($themeConfiguration) && is_array($themeConfiguration)) {
            $themeConfiguration = $typoScriptService
                ->convertTypoScriptArrayToPlainArray(
                    $themeConfiguration
                );
        }

        return  $themeConfiguration;
    }
}
