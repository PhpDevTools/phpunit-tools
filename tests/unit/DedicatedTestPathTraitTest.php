<?php

declare(strict_types=1);

/*
 * This file is part of the gilbertsoft/phpunit-tools package.
 *
 * (c) Gilbertsoft LLC (gilbertsoft.org)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gilbertsoft\PHPUnit\Tools\Tests\Unit;

use Gilbertsoft\PHPUnit\Tools\DedicatedTestPathTrait;
use Prophecy\Argument;
use RuntimeException;
use Symfony\Component\Filesystem\Filesystem;

use function defined;

use const DIRECTORY_SEPARATOR;

/**
 * @covers \Gilbertsoft\PHPUnit\Tools\DedicatedTestPathTrait
 * @uses \Gilbertsoft\PHPUnit\Tools\FilesystemTrait
 * @uses \Gilbertsoft\PHPUnit\Tools\ProjectTrait
 */
final class DedicatedTestPathTraitTest extends TestCase
{
    use DedicatedTestPathTrait;

    protected function tearDown(): void
    {
        self::$testBaseFolder = 'var' . DIRECTORY_SEPARATOR . 'tests';
        $this->testPath = null;
    }

    public function testTestPathBase(): void
    {
        self::assertSame('var' . DIRECTORY_SEPARATOR . 'tests', self::getTestBaseFolder());
        self::assertSame(realpath(__DIR__ . '/../../var/tests'), self::getAbsoluteTestBasePath());

        self::getFilesystem()->mkdir(__DIR__ . '/../../var/tests/base-test');
        self::setTestBaseFolder('var' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'base-test');
        self::assertSame(
            'var' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'base-test',
            self::getTestBaseFolder()
        );
        self::assertSame(realpath(__DIR__ . '/../../var/tests/base-test'), self::getAbsoluteTestBasePath());
    }

    public function testGetTestPath(): void
    {
        $testPath = self::getTestPath('test-subfolder');
        self::assertStringStartsWith(
            realpath(__DIR__ . '/../../' . self::getTestBaseFolder()) . DIRECTORY_SEPARATOR . 'test_',
            $testPath
        );
        self::assertStringEndsWith(DIRECTORY_SEPARATOR . 'test-subfolder', $testPath);
    }

    public function testCleanupTestPath(): void
    {
        if (defined('PHP_WINDOWS_VERSION_BUILD')) {
            self::markTestSkipped('Cleanup TestPath does not work on Windows.');
        }

        $testPath = self::getTestPath('test-cleanup');
        self::assertDirectoryExists($testPath);
        $this->cleanupTestPath = true;
        $this->tearDownDedicatedTestPath();
        self::assertDirectoryNotExists($testPath);
    }

    public function testGetTestDirectoryThrowsOnError(): void
    {
        $objectProphecy = $this->prophesize(Filesystem::class);
        $objectProphecy->exists(Argument::type('string'))->willReturn(true);
        self::$filesystem = $objectProphecy->reveal();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionCode(1_655_057_177);
        $this->expectExceptionMessage('A test directory could not be created.');

        try {
            self::getTestDirectory(__DIR__, '');
        } finally {
            self::$filesystem = null;
        }
    }
}
