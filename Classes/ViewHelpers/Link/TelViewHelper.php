<?php
namespace T3kit\themeT3kit\ViewHelpers\Link;

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

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * Tel link view helper.
 * Generates an tel link
 *
 * = Examples
 *
 * <code title="basic tel link">
 * {namespace t3kit=T3kit\themeT3kit\ViewHelpers}
 * <t3kit:link.tel tel="+46 (0) 40-01 ma 23 45 67" />
 * </code>
 * <output>
 * <a href="tel:+464001234567">+46 (0) 40-01 ma 23 45 67</a>
 * </output>
 */
class TelViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Arguments initialization
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('tel', 'string', 'The telephone number to be turned into a link', true);
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
    }

    /**
     * @return string Rendered tel link
     */
    public function render()
    {
        $tel = $this->arguments['tel'];

        $linkHref = 'tel:' . preg_replace('/\(0\)|\s|[^\d+]/', '', $tel);
        $linkText = htmlspecialchars($tel);
        $escapeSpecialCharacters = true;

        $tagContent = $this->renderChildren();
        if ($tagContent !== null) {
            $linkText = $tagContent;
        }
        $this->tag->setContent($linkText);
        $this->tag->addAttribute('href', $linkHref, $escapeSpecialCharacters);
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
