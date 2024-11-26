<?php

namespace MensCircle\Sitepackage\Service;

use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

class TokenService
{
    private Configuration $config;

    public function __construct()
    {
        $this->config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText(getenv('JWT_SECRET'))
        );
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function generateToken(?array $claims = [], int $validForSeconds = 86400): string
    {
        $now = new \DateTimeImmutable();

        $builder = $this->config->builder()
            ->issuedAt($now)
            ->expiresAt($now->modify("+{$validForSeconds} seconds"));

        foreach ($claims as $key => $value) {
            $builder->withClaim($key, $value);
        }

        return $builder->getToken($this->config->signer(), $this->config->signingKey())->toString();
    }

    public function validateToken(string $token): bool
    {
        try {
            $parsedToken = $this->config->parser()->parse($token);
            $constraints = [
                new SignedWith($this->config->signer(), $this->config->signingKey()),
                new LooseValidAt(SystemClock::fromUTC()),
            ];

            return $this->config->validator()->validate($parsedToken, ...$constraints);
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function parseToken(string $token): ?array
    {
        try {
            $parsedToken = $this->config->parser()->parse($token);

            if (!$this->validateToken($token)) {
                return null;
            }

            return array_map(static fn($value) => $value, $parsedToken->claims()->all());
        } catch (\Throwable $e) {
            return null;
        }
    }
}
