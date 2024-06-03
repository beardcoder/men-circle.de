<?php

namespace MensCircle\Sitepackage\ViewHelpers;

use PhpStaticAnalysis\Attributes\Type;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use voku\helper\HtmlMin;
use WyriHaximus\HtmlCompress\Factory;

class HtmlMinViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    #[Type('bool')]
    protected $escapeOutput = false;

    #[\Override]
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {
        $htmlMin = new HtmlMin();
        $htmlMin->doRemoveComments(false);

        return Factory::construct()->withHtmlMin($htmlMin)->compress((string) $renderChildrenClosure());
    }
}
