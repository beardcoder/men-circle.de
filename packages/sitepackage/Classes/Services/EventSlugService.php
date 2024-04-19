<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Services;

use TYPO3\CMS\Backend\Form\FormDataProvider\TcaSlug;
use TYPO3\CMS\Core\Site\Entity\Site;

class EventSlugService
{
    public function modifySlug($params): string
    {
        return date('d-m-Y', strtotime($params['record']['start_date']));
    }

    public function getPrefix(array $parameters, TcaSlug $reference): string
    {
        /** @var Site $site */
        $site = $parameters['site'];
        return $site->getConfiguration()['base'] . '/events';
    }
}
