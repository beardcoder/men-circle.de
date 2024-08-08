<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\StreamFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use voku\helper\HtmlMin;
use WyriHaximus\HtmlCompress\Factory;

/**
 * Class HtmlCompress
 */
class HtmlCompress implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        if ($this->isTypeNumSet($request) === false) {
            $stream = $response->getBody();
            $stream->rewind();
            $content = $stream->getContents();
            $newBody = (new StreamFactory())->createStream($this->compressHtml($content));
            $response = $response->withBody($newBody);
        }
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    protected function isTypeNumSet(ServerRequestInterface $request): bool
    {
        return $request->getAttribute('routing')->getPageType() > 0;
    }

    /**
     * @param string $html
     * @return string
     */
    protected function compressHtml(string $html): string
    {
        $htmlMin = GeneralUtility::makeInstance(HtmlMin::class);
        assert($htmlMin instanceof HtmlMin);

        $htmlMin->doRemoveComments(false);
        return Factory::construct()->withHtmlMin($htmlMin)->compress($html);
    }
}
