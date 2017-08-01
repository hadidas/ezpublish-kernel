<?php

namespace eZ\Publish\Core\Repository\SiteAccessAware\Tests;

use eZ\Publish\API\Repository\ContentTypeService as APIContentTypeService;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupCreateStruct;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupUpdateStruct;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeUpdateStruct;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionUpdateStruct;
use eZ\Publish\Core\Repository\SiteAccessAware\ContentTypeService;
use eZ\Publish\Core\Repository\Values\ContentType\ContentType;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeDraft;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeGroup;
use eZ\Publish\Core\Repository\Values\ContentType\FieldDefinition;

/**
 * Abstract tests for SiteAccessAware Services.
 *
 * Implies convention for methods on these services to either:
 * - Do nothing, pass-through call and optionally (default:true) return value
 * - lookup languages [IF not defined by callee] on one of the arguments given and pass it to next one.
 *
 */
class ContentTypeServiceTest extends AbstractServiceTest
{
    public function getAPIServiceClassName(): string
    {
        return APIContentTypeService::class;
    }

    public function getSiteAccessAwareServiceClassName(): string
    {
        return ContentTypeService::class;
    }

    public function providerForPassTroughMethods(): array
    {
        $contentTypeGroupCreateStruct = new ContentTypeGroupCreateStruct();
        $contentTypeGroupUpdateStruct = new ContentTypeGroupUpdateStruct();
        $contentTypeGroup = new ContentTypeGroup();

        $contentTypeCreateStruct = new ContentTypeCreateStruct();
        $contentTypeUpdateStruct = new ContentTypeUpdateStruct();
        $contentType = new ContentType();
        $contentTypeDraft = new ContentTypeDraft();

        $fieldDefinition = new FieldDefinition();
        $fieldDefinitionCreateStruct = new FieldDefinitionCreateStruct();
        $fieldDefinitionUpdateStruct = new FieldDefinitionUpdateStruct();

        // string $method, array $arguments, bool $return
        return [
            ['createContentTypeGroup', [$contentTypeGroupCreateStruct], true],
            ['updateContentTypeGroup', [$contentTypeGroup, $contentTypeGroupUpdateStruct], true],
            ['deleteContentTypeGroup', [$contentTypeGroup], true],
            ['createContentType', [$contentTypeCreateStruct, [$contentTypeGroup]], true],
            ['loadContentTypeDraft', [22], true],
            ['createContentTypeDraft', [$contentType], true],
            ['updateContentTypeDraft', [$contentTypeDraft, $contentTypeUpdateStruct], true],
            ['deleteContentType', [$contentType], true],
            ['copyContentType', [$contentType], true],
            //['copyContentType', [$contentType, $user], true],
            ['assignContentTypeGroup', [$contentType, $contentTypeGroup], true],
            ['unassignContentTypeGroup', [$contentType, $contentTypeGroup], true],
            ['addFieldDefinition', [$contentTypeDraft, $fieldDefinitionCreateStruct], true],
            ['removeFieldDefinition', [$contentTypeDraft, $fieldDefinition], true],
            ['updateFieldDefinition', [$contentTypeDraft, $fieldDefinition, $fieldDefinitionUpdateStruct], true],
            ['publishContentTypeDraft', [$contentTypeDraft], true],
            ['newContentTypeGroupCreateStruct', ['media'], true],
            ['newContentTypeCreateStruct', ['blog'], true],
            ['newContentTypeUpdateStruct', [], true],
            ['newContentTypeGroupUpdateStruct', [], true],
            ['newFieldDefinitionCreateStruct', ['body', 'ezrichtext'], true],
            ['newFieldDefinitionUpdateStruct', [], true],
            ['isContentTypeUsed', [$contentType], true],
        ];
    }


    public function providerForLanguagesLookupMethods(): array
    {
        $contentTypeGroup = new ContentTypeGroup();

        // string $method, array $arguments, bool $return, int $languageArgumentIndex
        return [
            ['loadContentTypeGroup', [33, self::LANG_ARG], true, 1],
            ['loadContentTypeGroupByIdentifier', ['content', self::LANG_ARG], true, 1],
            ['loadContentTypeGroups', [self::LANG_ARG], true, 0],
            ['loadContentType', [22, self::LANG_ARG], true, 1],
            ['loadContentTypeByIdentifier', ['article', self::LANG_ARG], true, 1],
            ['loadContentTypeByRemoteId', ['w4ini3tn4f', self::LANG_ARG], true, 1],
            ['loadContentTypes', [$contentTypeGroup, self::LANG_ARG], true, 1],

        ];
    }
}
