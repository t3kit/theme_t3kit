<?php
namespace T3kit\themeT3kit\ViewHelpers;

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

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Viewhelper to store values in the TSFE register
 *
 * @package TYPO3
 * @subpackage
 * @author Markus Goldbach <markus.goldbach@dkd.de>
 */
class RegisterViewHelper extends AbstractViewHelper implements CompilableInterface
{
    use CompileWithRenderStatic;

    /**
     * Initialize all arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('key', 'string', 'the rigster where the value will be stored');
        $this->registerArgument('value', 'string', 'the value which will be stored');
    }

    /**
     * start to render the viewhelper
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
     * @return void
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $GLOBALS['TSFE']->register[$arguments['key']] = $arguments['value'];
    }

}
