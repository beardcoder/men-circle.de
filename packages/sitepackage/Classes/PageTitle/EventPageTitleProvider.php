<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\PageTitle;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

final class EventPageTitleProvider extends AbstractPageTitleProvider
{
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
