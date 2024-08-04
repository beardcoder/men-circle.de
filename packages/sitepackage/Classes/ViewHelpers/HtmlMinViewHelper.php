<?php

namespace MensCircle\Sitepackage\ViewHelpers;

use Closure;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use voku\helper\HtmlMin;
use WyriHaximus\HtmlCompress\Factory;

class HtmlMinViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    #[\Override]
    public static function renderStatic(array $arguments, Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {
        $htmlMin = GeneralUtility::makeInstance(HtmlMin::class);
        assert($htmlMin instanceof HtmlMin);

        $htmlMin->doRemoveComments(false);

        return Factory::construct()->withHtmlMin($htmlMin)->compress((string)$renderChildrenClosure());
    }
}
