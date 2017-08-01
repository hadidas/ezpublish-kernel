<?php

namespace eZ\Publish\Core\Repository\SiteAccessAware\Tests;

use eZ\Publish\Core\Repository\Helper\LanguageResolver;
use PHPUnit\Framework\TestCase;

/**
 * Abstract tests for SiteAccessAware Services.
 *
 * Implies convention for methods on these services to either:
 * - Do nothing, pass-through call and optionally (default:true) return value
 * - lookup languages [IF not defined by callee] on one of the arguments given and pass it to next one.
 *
 */
abstract class AbstractServiceTest extends TestCase
{
    /**
     * Purely to attempt to make tests easier to read.
     *
     * As language parameter is ignored from providers and replced with values in tests, this is used to mark value of
     * language argument instead of either askingproviders to use 0, or a valid language array which would then not be
     * used.
     */
    const LANG_ARG = 0;

    /**
     * @var \object|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $innerApiServiceMock;

    /**
     * @var object
     */
    protected $service;

    /**
     * @var \eZ\Publish\Core\Repository\Helper\LanguageResolver|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $languageHelperMock;


    abstract public function getAPIServiceClassName(): string;
    abstract public function getSiteAccessAwareServiceClassName(): string;


    public function setUp()
    {
        parent::setUp();
        $this->innerApiServiceMock = $this->getMockBuilder($this->getAPIServiceClassName())->getMock();
        $this->languageHelperMock = $this->getMockBuilder(LanguageResolver::class)
            ->disableOriginalConstructor()
            ->getMock();
        $serviceClassName = $this->getSiteAccessAwareServiceClassName();

        $this->service = new $serviceClassName(
            $this->innerApiServiceMock,
            $this->languageHelperMock // Not all services needs or expects this, however once they do it will be there
        );
    }

    protected function tearDown()
    {
        unset($this->service);
        unset($this->languageHelperMock);
        unset($this->innerApiServiceMock);
        parent::tearDown();
    }

    /**
     * @return array See signature on {@link testForPassTrough} for arguments and their type.
     */
    abstract public function providerForPassTroughMethods(): array;

    /**
     * Make sure these methods does nothing more then passing the arguments to inner service.
     *
     * Methods tested here are basically those without as languages argument.
     *
     * @dataProvider providerForPassTroughMethods
     *
     * @param string $method
     * @param array $arguments
     * @param boolean $return
     */
    final public function testForPassTrough(string $method, array $arguments, bool $return)
    {
        $this->innerApiServiceMock
            ->expects($this->once())
            ->method($method)
            ->with(...$arguments)
            ->willReturn($return);

        $actualReturn = $this->service->$method(...$arguments);

        if ($return) {
            $this->assertTrue($actualReturn);
        }
    }

    /**
     * @return array See signature on {@link testForLanguageLookup} for arguments and their type.
     *               NOTE: languages / prioritizedLanguage, can be set to 0, it will be replaced by tests methods.
     */
    abstract public function providerForLanguagesLookupMethods(): array;

    /**
     * Test that language aware methods does a language lookup when language is not set
     *
     * @dataProvider providerForLanguagesLookupMethods
     *
     * @param string $method
     * @param array $arguments
     * @param boolean $return
     * @param int $languageArgumentIndex From 0 and up, so the array index on $arguments.
     */
    final public function testForLanguagesLookup(string $method, array $arguments, bool $return, int $languageArgumentIndex)
    {
        $languages = ['eng-GB', 'eng-US'];
        $arguments[$languageArgumentIndex] = [];

        $expectedArguments = $arguments;
        $expectedArguments[$languageArgumentIndex] = $languages;


        $this->languageHelperMock
            ->expects($this->once())
            ->method('getLanguages')
            ->with([])
            ->willReturn($languages);

        $this->innerApiServiceMock
            ->expects($this->once())
            ->method($method)
            ->with(...$expectedArguments)
            ->willReturn($return);


        $actualReturn = $this->service->$method(...$arguments);

        if ($return) {
            $this->assertTrue($actualReturn);
        }
    }


    /**
     * Make sure these methods does nothing more then passing the arguments to inner service.
     *
     * @dataProvider providerForLanguagesLookupMethods
     *
     * @param string $method
     * @param array $arguments
     * @param boolean $return
     * @param int $languageArgumentIndex From 0 and up, so the array index on $arguments.
     */
    final public function testForLanguagesPassTrough(string $method, array $arguments, bool $return, int $languageArgumentIndex)
    {
        $languages = ['eng-GB', 'eng-US'];
        $arguments[$languageArgumentIndex] = $languages;

        $this->languageHelperMock
            ->expects($this->once())
            ->method('getLanguages')
            ->with($languages)
            ->willReturn($languages);

        $this->innerApiServiceMock
            ->expects($this->once())
            ->method($method)
            ->with(...$arguments)
            ->willReturn($return);


        $actualReturn = $this->service->$method(...$arguments);

        if ($return) {
            $this->assertTrue($actualReturn);
        }
    }
}
