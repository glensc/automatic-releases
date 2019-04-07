<?php

declare(strict_types=1);

namespace Doctrine\AutomaticReleases\Environment;

use Assert\Assert;

final class Variables
{
    /** @var string */
    private $githubOrganisation;

    /** @var string */
    private $githubToken;

    /** @var string */
    private $signingSecretKey;

    /** @var string */
    private $githubHookSecret;


    private function __construct()
    {
    }

    public static function fromEnvironment() : self
    {
        $instance = new self();

        $instance->githubOrganisation = self::getenv('GITHUB_ORGANISATION');
        $instance->githubToken = self::getenv('GITHUB_TOKEN');
        $instance->signingSecretKey = self::getenv('SIGNING_SECRET_KEY');
        $instance->githubHookSecret = self::getenv('GITHUB_HOOK_SECRET');

        return $instance;
    }

    private static function getenv(string $key) : string
    {
        Assert::that($key)
            ->notEmpty();

        $value = getenv($key);

        Assert::that($value)
            ->string()
            ->notEmpty();

        \assert(is_string($value));

        return $value;
    }

    public function githubOrganisation() : string
    {
        return $this->githubOrganisation;
    }

    public function githubToken() : string
    {
        return $this->githubToken;
    }

    public function signingSecretKey() : string
    {
        return $this->signingSecretKey;
    }

    public function githubHookSecret() : string
    {
        return $this->githubHookSecret;
    }
}
