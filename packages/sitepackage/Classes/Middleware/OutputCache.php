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
readonly class OutputCache implements MiddlewareInterface
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
        $response = $handler->handle($request);
        $uri = $request->getUri()->getPath();
        $value = $this->cache->get(GeneralUtility::md5int($uri));
        if ($value) {
            $newBody = (new StreamFactory())->createStream($value);
            return $response->withBody($newBody);
        }

        return $handler->handle($request);
    }
}
