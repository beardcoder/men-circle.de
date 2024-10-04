<?php
declare(strict_types=1);

namespace MensCircle\Sitepackage\ViewHelpers;

use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class UuidViewHelper extends AbstractViewHelper
{
    /**
     * @return string
     */
    public function render(): string
    {
        return StringUtility::getUniqueId('uuid_');
    }
}
