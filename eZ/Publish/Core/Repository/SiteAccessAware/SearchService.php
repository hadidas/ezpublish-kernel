<?php

/**
 * SearchService class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Publish\Core\Repository\SiteAccessAware;

use eZ\Publish\API\Repository\SearchService as SearchServiceInterface;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\Core\Repository\Helper\LanguageResolver;

/**
 * SiteAccess aware implementation of SearchService injecting languages where needed.
 */
class SearchService implements SearchServiceInterface
{
    /**
     * Aggregated service.
     *
     * @var \eZ\Publish\API\Repository\SearchService
     */
    protected $service;

    /**
     * Language resolver
     *
     * @var LanguageResolver
     */
    protected $languageResolver;

    /**
     * Construct service object from aggregated service and LanguageResolver.
     *
     * @param \eZ\Publish\API\Repository\SearchService $service
     * @param LanguageResolver $languageResolver
     */
    public function __construct(
        SearchServiceInterface $service,
        LanguageResolver $languageResolver
    ) {
        $this->service = $service;
        $this->languageResolver = $languageResolver;
    }

    public function findContent(Query $query, array $languageFilter = array(), $filterOnUserPermissions = true)
    {
        $languageFilter['languages'] = $this->languageResolver->getLanguages(
            empty($languageFilter['languages']) ? []: $languageFilter['languages']
        );

        return $this->service->findContent($query, $languageFilter, $filterOnUserPermissions);
    }

    public function findContentInfo(Query $query, array $languageFilter = array(), $filterOnUserPermissions = true)
    {
        $languageFilter['languages'] = $this->languageResolver->getLanguages(
            empty($languageFilter['languages']) ? []: $languageFilter['languages']
        );

        return $this->service->findContentInfo($query, $languageFilter, $filterOnUserPermissions);
    }

    public function findSingle(Criterion $filter, array $languageFilter = array(), $filterOnUserPermissions = true)
    {
        $languageFilter['languages'] = $this->languageResolver->getLanguages(
            empty($languageFilter['languages']) ? []: $languageFilter['languages']
        );

        return $this->service->findSingle($filter, $languageFilter, $filterOnUserPermissions);
    }

    public function suggest($prefix, $fieldPaths = array(), $limit = 10, Criterion $filter = null)
    {
        return $this->service->suggest($prefix, $fieldPaths, $limit, $filter);
    }

    public function findLocations(LocationQuery $query, array $languageFilter = array(), $filterOnUserPermissions = true)
    {
        $languageFilter['languages'] = $this->languageResolver->getLanguages(
            empty($languageFilter['languages']) ? []: $languageFilter['languages']
        );

        return $this->service->findLocations($query, $languageFilter, $filterOnUserPermissions);
    }
}
