<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\StreamFactory;
use TYPO3\CMS\Core\SingletonInterface;
use voku\helper\HtmlMin;
use WyriHaximus\HtmlCompress\Factory;

readonly class HtmlCompress implements MiddlewareInterface, SingletonInterface
{
    public function __construct(
        private StreamFactory $streamFactory,
        private HtmlMin $htmlMin
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        if (!$this->isTypeNumSet($request)) {
            $stream = $response->getBody();
            $stream->rewind();
            $content = $stream->getContents();
            $newBody = $this->streamFactory->createStream($this->compressHtml($content));
            $response = $response->withBody($newBody);
        }

        return $response;
    }

    protected function isTypeNumSet(ServerRequestInterface $request): bool
    {
        return $request->getAttribute('routing')->getPageType() > 0;
    }

    protected function compressHtml(string $html): string
    {
        $this->htmlMin->doRemoveComments(false);

        return Factory::construct()->withHtmlMin($this->htmlMin)->compress($html);
    }
}
