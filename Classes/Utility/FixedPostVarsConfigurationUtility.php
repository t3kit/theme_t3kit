<?php

namespace T3kit\themeT3kit\Utility;

use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * Class FixedPostVarsConfigurationUtility
 * @package T3kit\themeT3kit\Utility
 */
class FixedPostVarsConfigurationUtility
{
    use LoggerAwareTrait;

    /**
     * Update configuration file of fixed post vars
     *
     * @return void
     */
    public function updateConfiguration()
    {
        $filePath = $this->getSaveFilePath();

        if (!$this->canWriteConfiguration($filePath)) {
            $this->logger->error(
                'Could not write realurl configuration to file "' . $filePath . '"'
            );
        }

        $configurations = $this->getConfiguration();
        $varNameToPageFixedUids = [];

        $pages = $this->getFixedPagesUids();

        $content = '<?php' . LF;
        $content .= '$init = function () {' . LF;

        // generate fixed post var config vars
        foreach ($pages as $page) {
            $key = $page['tx_themet3kit_fixed_post_var_conf'];

            if (array_key_exists($key, $configurations)) {
                if (!array_key_exists($key, $varNameToPageFixedUids)) {
                    $varName = '$' . GeneralUtility::underscoredToLowerCamelCase($key);
                    $content .= '    ' . $varName . ' = ';
                    $content .= $this->fixIndent(
                        ArrayUtility::arrayExport(
                            $configurations[$key]['configuration']
                        )
                    );
                    $content .= ';' . LF;

                    // save var name
                    $varNameToPageFixedUids[$key] = [
                        'varName' => $varName,
                        'fixedUids' => [$page['uid']]
                    ];
                } else {
                    $varNameToPageFixedUids[$key]['fixedUids'][] = $page['uid'];
                }
            }
        }

        $fixedPostVarLine = '    ';
        $fixedPostVarLine .= '$GLOBALS[\'TYPO3_CONF_VARS\'][\'EXTCONF\'][\'realurl\'][\'_DEFAULT\'][\'fixedPostVars\']';

        foreach ($varNameToPageFixedUids as $key => $varNameToPageFixedUid) {
            // first write configuration
            $content .= $fixedPostVarLine;
            $content .= sprintf(
                '[\'%s\'] = %s;',
                $key,
                $varNameToPageFixedUid['varName']
            );
            $content .= LF;

            // now add it for each page
            foreach ($varNameToPageFixedUid['fixedUids'] as $fixedUid) {
                $content .= $fixedPostVarLine;
                $content .= sprintf(
                    '[\'%s\'] = \'%s\';',
                    $fixedUid,
                    $key
                );
                $content .= LF;
            }

            $content .= LF;
        }

        $content .= '};' . LF;
        $content .= '$init();' . LF;
        $content .= 'unset($init);' . LF;

        GeneralUtility::writeFile($filePath, $content, true);
    }

    /**
     * Fix indent for configuration array
     *
     * @param $string
     * @return string
     */
    protected function fixIndent($string)
    {
        $lines = explode(PHP_EOL, $string);

        foreach ($lines as &$line) {
            $line = '    ' . $line;
        }

        return ltrim(implode(LF, $lines));
    }

    /**
     * Generate configuration array with associative keys
     *
     * @return array
     */
    protected function getConfiguration()
    {
        $configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['theme_t3kit']['fixedPostVars'];
        $processedConfiguration = [];

        if (is_array($configuration)) {
            foreach ($configuration as $item) {
                $processedConfiguration[$item['key']] = $item;
            }
        }

        return $processedConfiguration;
    }

    /**
     * Get list of pages with fixed post var configuration
     *
     * @return array
     */
    protected function getFixedPagesUids()
    {
        $field = 'tx_themet3kit_fixed_post_var_conf';

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $pages = $queryBuilder
            ->select('uid', 'tx_themet3kit_fixed_post_var_conf')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->neq(
                    $field,
                    $queryBuilder->createNamedParameter('')
                ),
                $queryBuilder->expr()->neq(
                    $field,
                    $queryBuilder->createNamedParameter('0')
                )
            )
            ->execute()
            ->fetchAll();

        return $pages;
    }

    /**
     * Checks if the configuration can be written.
     *
     * @param string $fileLocation
     * @return bool
     */
    protected function canWriteConfiguration($fileLocation)
    {
        $directoryName = PathUtility::dirname($fileLocation);
        return @is_writable($directoryName) && (!file_exists($fileLocation) || @is_writable($fileLocation));
    }

    /**
     * Get path where to save configuration
     *
     * @return string
     */
    public function getSaveFilePath()
    {
        $extConf = HelperUtility::getExtConf();

        if (is_array($extConf) && $extConf['fixedPostVarsSaveFilePath']) {
            $filePath = PATH_site . trim($extConf['fixedPostVarsSaveFilePath']);
        } else {
            $filePath = PATH_site . 'typo3conf/realurl_fixedPostVars_conf.php';
        }

        return PathUtility::getCanonicalPath($filePath);
    }
}
