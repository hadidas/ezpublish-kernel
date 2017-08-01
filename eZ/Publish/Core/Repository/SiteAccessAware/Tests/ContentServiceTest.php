<?php

namespace eZ\Publish\Core\Repository\SiteAccessAware\Tests;

use eZ\Publish\API\Repository\ContentService as APIContentService;
use eZ\Publish\API\Repository\Values\Content\ContentInfo;
use eZ\Publish\API\Repository\Values\Content\ContentMetadataUpdateStruct;
use eZ\Publish\API\Repository\Values\Content\LocationCreateStruct;
use eZ\Publish\Core\Repository\SiteAccessAware\ContentService;
use eZ\Publish\Core\Repository\Values\Content\ContentCreateStruct;
use eZ\Publish\Core\Repository\Values\Content\ContentUpdateStruct;
use eZ\Publish\Core\Repository\Values\Content\VersionInfo;

/**
 * Abstract tests for SiteAccessAware Services.
 *
 * Implies convention for methods on these services to either:
 * - Do nothing, pass-through call and optionally (default:true) return value
 * - lookup languages [IF not defined by callee] on one of the arguments given and pass it to next one.
 *
 */
class ContentServiceTest extends AbstractServiceTest
{
    public function getAPIServiceClassName(): string
    {
        return APIContentService::class;
    }

    public function getSiteAccessAwareServiceClassName(): string
    {
        return ContentService::class;
    }

    public function providerForPassTroughMethods(): array
    {
        $contentInfo = new ContentInfo();
        $versionInfo = new VersionInfo();
        $contentCreateStruct = new ContentCreateStruct();
        $contentUpdateStruct = new ContentUpdateStruct();
        $contentMetaStruct = new ContentMetadataUpdateStruct();
        $locationCreateStruct = new LocationCreateStruct();

        // string $method, array $arguments, bool $return
        return [
            ['loadContentInfo', [42], true],

            ['loadContentInfoByRemoteId', ['f348tj4gorgji4'], true],

            ['loadVersionInfo', [$contentInfo], true],
            ['loadVersionInfo', [$contentInfo, 3], true],

            ['loadVersionInfoById', [42], true],
            ['loadVersionInfoById', [42, 3], true],

            ['createContent', [$contentCreateStruct], true],
            ['createContent', [$contentCreateStruct, [44]], true],

            ['updateContentMetadata', [$contentInfo, $contentMetaStruct], true],

            ['deleteContent', [$contentInfo], true],

            ['createContentDraft', [$contentInfo], true],
            ['createContentDraft', [$contentInfo, $versionInfo], true],
            //['createContentDraft', [$contentInfo, $versionInfo, $user], true],

            ['loadContentDrafts', [], true],
            //['loadContentDrafts', [$user], true],

            ['updateContent', [$versionInfo, $contentUpdateStruct], true],

            ['publishVersion', [$versionInfo], true],

            ['deleteVersion', [$versionInfo], true],

            ['loadVersions', [$contentInfo], true],

            ['copyContent', [$contentInfo, $locationCreateStruct], true],
            ['copyContent', [$contentInfo, $locationCreateStruct, $versionInfo], true],

            ['loadRelations', [$versionInfo], true],

            ['loadReverseRelations', [$contentInfo], true],

            ['addRelation', [$versionInfo, $contentInfo], true],

            ['deleteRelation', [$versionInfo, $contentInfo], true],

            ['removeTranslation', [$contentInfo, 'eng-GB'], true],

            //['newContentCreateStruct', [$contentType, 'eng-GB'], true],
            ['newContentMetadataUpdateStruct', [], true],
            ['newContentUpdateStruct', [], true],
            ['newTranslationInfo', [], true],
            ['newTranslationValues', [], true],
        ];
    }


    public function providerForLanguagesLookupMethods(): array
    {
        $contentInfo = new ContentInfo();
        $versionInfo = new VersionInfo();

        // string $method, array $arguments, bool $return, int $languageArgumentIndex
        return [
            ['loadContentByContentInfo', [$contentInfo], true, 1],
            ['loadContentByContentInfo', [$contentInfo, self::LANG_ARG, 4, false], true, 1],

            ['loadContentByVersionInfo', [$versionInfo], true, 1],
            ['loadContentByVersionInfo', [$versionInfo, self::LANG_ARG, false], true, 1],

            ['loadContent', [42], true, 1],
            ['loadContent', [42, self::LANG_ARG, 4, false], true, 1],

            ['loadContentByRemoteId', ['f348tj4gorgji4'], true, 1],
            ['loadContentByRemoteId', ['f348tj4gorgji4', self::LANG_ARG, 4, false], true, 1],
        ];
    }
}
