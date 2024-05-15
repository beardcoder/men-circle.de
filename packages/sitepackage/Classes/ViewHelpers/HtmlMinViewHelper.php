<?php

namespace MensCircle\Sitepackage\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use WyriHaximus\HtmlCompress\Factory;

class HtmlMinViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    #[\Override]
    public static function renderStatic(array $arguments, \Closure $childClosure, RenderingContextInterface $renderingContext)
    {
        return Factory::construct()->compress((string) $childClosure());
    }
}
