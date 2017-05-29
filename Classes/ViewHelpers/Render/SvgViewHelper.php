<?php
namespace T3kit\themeT3kit\ViewHelpers\Render;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Andrii Pozdieiev <andriy.p@pixelant.se>, Mosa Al-Husseini <mosa@pixelant.se>, Pixelant AB
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
class SvgViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @var boolean
     */
    protected $escapeChildren = false;

    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments
     *
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('class', 'string', 'Specifies an alternate class for the svg', false);
        $this->registerArgument('width', 'float', 'Specifies a width for the svg', false);
        $this->registerArgument('height', 'float', 'Specifies a height for the svg', false);
    }

    /**
     * Generate a list from the content
     *
     * @param string $source
     */
    public function render($source)
    {
        $sourceAbs = PATH_site . $source;

        if (!file_exists($sourceAbs)) {
            return '<!-- unable to open file: ' . $source . ' (missing) -->';
        }

        $finfo = \mime_content_type($sourceAbs);

        if ($finfo !== 'image/svg+xml') {
            return '<!-- unable to open file: ' . $source . ' (' . $finfo . ') -->';
        }

        return $this->getInlineSvg($sourceAbs);
    }

    /**
     * Get xml from SVG
     *
     * @param string $source
     *
     * @return string
     */
    protected function getInlineSvg($source)
    {

        if (!file_exists($source)) {
            return '';
        }

        $svgContent = file_get_contents($source);
        $svgContent = preg_replace('/<script[\s\S]*?>[\s\S]*?<\/script>/i', '', $svgContent);
        // Disables the functionality to allow external entities to be loaded when parsing the XML, must be kept
        $previousValueOfEntityLoader = libxml_disable_entity_loader(true);
        $svgElement = simplexml_load_string($svgContent);
        libxml_disable_entity_loader($previousValueOfEntityLoader);

        // remove xml version tag
        $domXml = dom_import_simplexml($svgElement);
        if (isset($this->arguments['class'])) {
            $domXml->setAttribute('class', $this->arguments['class']);
        }
        if (isset($this->arguments['width'])) {
            $domXml->setAttribute('width', $this->arguments['width']);
        }
        if (isset($this->arguments['height'])) {
            $domXml->setAttribute('height', $this->arguments['height']);
        }
        return $domXml->ownerDocument->saveXML($domXml->ownerDocument->documentElement);
    }
}
