<?php
declare(strict_types=1);

namespace T3kit\themeT3kit\Utility;

/**
 * Class TcaUtility
 * @package T3kit\themeT3kit\Utility
 */
class TcaUtility
{
    /**
     * Default slug replacements
     *
     * @var array
     */
    protected static $slugReplacements = [
        'ä' => 'a',
        'å' => 'a',
        'ö' => 'o',
        'Å' => 'a',
        'Ä' => 'a',
        'Ö' => 'o',
        'ø' => 'o',
        'Ø' => 'o'
    ];

    /**
     * Set replacements for TCA slug field
     *
     * @param string $tableName TCA table name
     * @param string $slugFieldName Slug field name in TCA columns
     * @param array $additionalReplacements Additional replacements for default slug replacements
     */
    public static function setReplacementsForSlugField(
        string $tableName,
        string $slugFieldName = 'slug',
        array $additionalReplacements = []
    ): void {
        if (isset($GLOBALS['TCA'][$tableName]['columns'][$slugFieldName]['config']['generatorOptions'])
            && is_array($GLOBALS['TCA'][$tableName]['columns'][$slugFieldName]['config']['generatorOptions'])
        ) {
            $replacements = array_merge(static::$slugReplacements, $additionalReplacements);
            $generatorOptions = &$GLOBALS['TCA'][$tableName]['columns'][$slugFieldName]['config']['generatorOptions'];
            $generatorOptions['replacements'] = array_merge(
                $generatorOptions['replacements'] ?? [],
                $replacements
            );
        }
    }
}
