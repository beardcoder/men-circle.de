<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Backend\Controller;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class MailController
{
    /** @var ResponseFactoryInterface */
    protected $responseFactory;

    /** @var StreamFactoryInterface */
    protected $streamFactory;

    public function __construct(ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        // Do awesome stuff

        return $this->responseFactory->createResponse()->withBody(
            $this->streamFactory->createStream('Response content from MailController with route path: ' . $request->getAttribute('route')->getPath())
        );
    }
}
