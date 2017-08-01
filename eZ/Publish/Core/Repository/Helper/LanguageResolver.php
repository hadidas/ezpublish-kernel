<?php

namespace eZ\Publish\Core\Repository\Helper;

/**
 * @todo Inject languages in a way that it gets updated if SiteAccess changes
 * @todo add getUseAlwaysAvailable() and take from new setting, use in places like search service
 */
class LanguageResolver
{
    protected $languages;

    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    public function getLanguages(array $override = [], $fallback = null)
    {
        $languages = empty($override)
            ? $this->languages
            : $override;

        if (!empty($fallback)) {
            $languages[] = $fallback;
        }

        return $languages;
    }
}
