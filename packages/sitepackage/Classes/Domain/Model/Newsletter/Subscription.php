<?php

namespace MensCircle\Sitepackage\Domain\Model\Newsletter;

use MensCircle\Sitepackage\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Subscription extends AbstractEntity
{
    public string $email;
    #[Validate(['validator' => 'NotEmpty'])]
    public string $firstName;
    #[Validate(['validator' => 'NotEmpty'])]
    public string $lastName;
    public ?FrontendUser $feUser = null;
}
