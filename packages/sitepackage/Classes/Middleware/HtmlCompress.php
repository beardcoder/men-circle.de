<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\StreamFactory;
use voku\helper\HtmlMin;
use WyriHaximus\HtmlCompress\Factory;

readonly class HtmlCompress implements MiddlewareInterface
{
    public function __construct(
        private StreamFactory $streamFactory,
        private HtmlMin $htmlMin
    ) {}

    #[\Override]
    public function process(ServerRequestInterface $serverRequest, RequestHandlerInterface $requestHandler): ResponseInterface
    {
        $response = $requestHandler->handle($serverRequest);
        if (!$this->isTypeNumSet($serverRequest) && !$this->isDownload($response)) {
            $stream = $response->getBody();
            $stream->rewind();
            $content = $stream->getContents();
            $newBody = $this->streamFactory->createStream($this->compressHtml($content));
            $response = $response->withBody($newBody);
        }

        return $response;
    }

    protected function isTypeNumSet(ServerRequestInterface $serverRequest): bool
    {
        return $serverRequest->getAttribute('routing')->getPageType() > 0;
    }

    private function isDownload(ResponseInterface $response): bool
    {
        return $response->hasHeader('Content-Disposition') && str_starts_with($response->getHeaderLine('Content-Disposition'), 'attachment');
    }

    protected function compressHtml(string $html): string
    {
        $this->htmlMin->doRemoveComments(false);

        return Factory::construct()->withHtmlMin($this->htmlMin)->compress($html);
    }
}
