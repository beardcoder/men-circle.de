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
    private readonly Configuration $configuration;

    public function __construct()
    {
        $this->configuration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText(getenv('JWT_SECRET')),
        );
    }

    public function generateToken(?array $claims = [], int $validForSeconds = 86400): string
    {
        $now = new \DateTimeImmutable();

        $builder = $this->configuration->builder()
            ->issuedAt($now)
            ->expiresAt($now->modify("+{$validForSeconds} seconds"));

        foreach ($claims as $key => $value) {
            $builder->withClaim($key, $value);
        }

        return $builder->getToken($this->configuration->signer(), $this->configuration->signingKey())
            ->toString();
    }

    public function validateToken(string $token): bool
    {
        try {
            $parsedToken = $this->configuration->parser()
                ->parse($token);
            $constraints = [
                new SignedWith($this->configuration->signer(), $this->configuration->signingKey()),
                new LooseValidAt(SystemClock::fromUTC()),
            ];

            return $this->configuration->validator()
                ->validate($parsedToken, ...$constraints);
        } catch (\Throwable) {
            return false;
        }
    }

    public function parseToken(string $token): ?array
    {
        try {
            $parsedToken = $this->configuration->parser()
                ->parse($token);

            if (! $this->validateToken($token)) {
                return null;
            }

            return array_map(static fn($value) => $value, $parsedToken->claims()->all());
        } catch (\Throwable) {
            return null;
        }
    }
}
