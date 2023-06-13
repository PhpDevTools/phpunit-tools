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

use Gilbertsoft\PHPUnit\Tools\FileFixturesTrait;
use Iterator;
use RuntimeException;

use const DIRECTORY_SEPARATOR;

/**
 * @covers \Gilbertsoft\PHPUnit\Tools\FileFixturesTrait
 * @uses \Gilbertsoft\PHPUnit\Tools\FilesystemTrait
 * @noRector \Rector\Privatization\Rector\Class_\ChangeReadOnlyVariableWithDefaultValueToConstantRector
 */
final class FileFixturesTraitTest extends TestCase
{
    use FileFixturesTrait;

    protected function tearDown(): void
    {
        self::tearDownFileFixtures();
    }

    public function testGetFixturePathThrowsWithoutInit(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionCode(1_655_065_709);
        $this->expectExceptionMessage('No fixture paths are registered by calling self::registerFixturesPath().');

        self::getFixturePath();
    }

    public function testRegisterAndGetFixturesPath(): void
    {
        self::registerFixturesPath(__DIR__ . '/Fixtures');
        self::registerFixturesPath(__DIR__ . '/Fixtures/Subfolder', 'SUBFOLDER');
        self::assertSame(
            __DIR__ . DIRECTORY_SEPARATOR . 'Fixtures',
            self::getFixturePath()
        );
        self::assertSame(
            __DIR__ . DIRECTORY_SEPARATOR . 'Fixtures' . DIRECTORY_SEPARATOR . 'Subfolder',
            self::getFixturePath('SUBFOLDER')
        );
    }

    public function testRegisterFixturesPathThrowsOnInvalidPath(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionCode(1_655_066_221);
        $this->expectExceptionMessage('Fixtures path "invalid" not found.');

        self::registerFixturesPath('invalid');
    }

    public function testGetFixturePathThrowsOnInvalidPrefix(): void
    {
        self::registerFixturesPath(__DIR__ . '/Fixtures');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionCode(1_636_451_407);
        $this->expectExceptionMessage('Fixture prefix (invalid) was not registered.');

        self::getFixturePath('invalid');
    }

    public function testGetFixtureFilename(): void
    {
        self::registerFixturesPath(__DIR__ . '/Fixtures', 'TEST');
        self::assertSame(
            __DIR__ . DIRECTORY_SEPARATOR . 'Fixtures' . DIRECTORY_SEPARATOR . 'test_root_file',
            self::getFixtureFilename('TEST:test_root_file')
        );
    }

    public function testCreateFixtures(): void
    {
        self::registerFixturesPath(__DIR__ . '/Fixtures', 'TEST');
        self::createFixtures(__DIR__ . '/../../var/tests', [
            'test_root_file' => 'TEST:test_root_file',
            'test_subfolder_file' => 'TEST:Subfolder/test_subfolder_file',
            '/test_subfolder_file' => 'TEST:Subfolder/test_subfolder_file',
        ]);

        self::assertFileExists(__DIR__ . '/../../var/tests/test_root_file');
        self::assertFileExists(__DIR__ . '/../../var/tests/test_subfolder_file');
        self::assertFileExists(__DIR__ . '/../../var/tests/Subfolder/test_subfolder_file');
    }

    public function testTearDownResetsFixturePaths(): void
    {
        self::tearDownFileFixtures();
        self::assertEmpty(self::$fixturePaths);
    }

    /**
     * @dataProvider combinedProvider
     */
    public function testExplodePrefixAndFilename(
        string $combined,
        string $expectedPrefix,
        string $expectedFilename
    ): void {
        $prefix = '';
        $filename = '';

        self::explodePrefixAndFilename($combined, $prefix, $filename);

        self::assertSame($expectedPrefix, $prefix);
        self::assertSame($expectedFilename, $filename);
    }

    /**
     * @return Iterator<string, array{combined: string, expectedPrefix: string, expectedFilename: string}>
     */
    public function combinedProvider(): Iterator
    {
        yield 'prefix and filename' => [
            'combined' => 'TEST:filename',
            'expectedPrefix' => 'TEST',
            'expectedFilename' => 'filename',
        ];
        yield 'filename only' => [
            'combined' => 'filename',
            'expectedPrefix' => 'DEFAULT',
            'expectedFilename' => 'filename',
        ];
        yield 'multiple separators' => [
            'combined' => 'TEST:filename:suffix',
            'expectedPrefix' => 'TEST',
            'expectedFilename' => 'filename:suffix',
        ];
    }
}
