<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Core\Http\StreamFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use voku\helper\HtmlMin;
use WyriHaximus\HtmlCompress\Factory;

/**
 * Class HtmlCompress
 */
class StoreCache implements MiddlewareInterface
{
    public function __construct(
        private readonly FrontendInterface $cache,
    )
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        $response = $handler->handle($request);
        if ($this->cache->get(GeneralUtility::md5int($uri))) {
            return $response;
        }

        if ($this->isTypeNumSet($request) === false) {
            $stream = $response->getBody();
            $stream->rewind();
            $content = $stream->getContents();
            $this->cache->set(GeneralUtility::md5int($uri), $content);
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
}
