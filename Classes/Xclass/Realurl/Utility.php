<?php


namespace T3kit\themeT3kit\Xclass\Realurl;

use T3kit\themeT3kit\Utility\HelperUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class Utility
 * @package T3kit\themeT3kit\Xclass\Realurl\Utility
 */
class Utility extends \DmitryDulepov\Realurl\Utility
{
    /**
     * Array of replacement characters
     *
     * @var array
     */
    protected static $replacements = [
        'ä' => 'a',
        'å' => 'a',
        'ö' => 'o',
        'Å' => 'a',
        'Ä' => 'a',
        'Ö' => 'o'
    ];

    /**
     * Xclass standard Reaurl utility to remove some specials characters
     *
     * @param string $processedTitle
     * @param string $spaceCharacter
     * @param bool $strToLower
     * @return string
     */
    public function convertToSafeString($processedTitle, $spaceCharacter = '-', $strToLower = true)
    {
        $processedTitle = str_replace(
            array_keys($this->getFinalCharsReplacements()),
            $this->getFinalCharsReplacements(),
            $processedTitle
        );

        return parent::convertToSafeString($processedTitle, $spaceCharacter, $strToLower);
    }

    /**
     * Check in extension configuration for additional replacements
     *
     * @return array|null
     */
    protected function getFinalCharsReplacements()
    {
        static $finalReplacements = null;

        if ($finalReplacements === null) {
            $t3kitExtToolConf = HelperUtility::getExtConf();
            $additionalChars = [];

            if (!empty($t3kitExtToolConf['additionalCharacters'])) {

                $charsSet = GeneralUtility::trimExplode(',', $t3kitExtToolConf['additionalCharacters']);

                foreach ($charsSet as $charSet) {
                    list($find, $replace) = GeneralUtility::trimExplode('=>', $charSet, true);
                    $additionalChars[$find] = $replace;
                }
            }

            $finalReplacements = array_merge(self::$replacements, $additionalChars);
        }

        return $finalReplacements;
    }
}