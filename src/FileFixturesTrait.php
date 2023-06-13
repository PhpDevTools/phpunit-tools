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

namespace Gilbertsoft\PHPUnit\Tools;

use RuntimeException;

use function explode;
use function sprintf;

use const DIRECTORY_SEPARATOR;

trait FileFixturesTrait
{
    use FilesystemTrait;

    /**
     * @var array<string, string>
     * @internal
     */
    private static array $fixturePaths = [];

    public static function registerFixturesPath(string $path, string $prefix = ''): void
    {
        if (!self::getFilesystem()->exists($path) || ($absolutePath = realpath($path)) === false) {
            throw new RuntimeException(sprintf('Fixtures path "%s" not found.', $path), 1_655_066_221);
        }

        if ($prefix === '') {
            $prefix = 'DEFAULT';
        }

        self::$fixturePaths[$prefix] = $absolutePath;
    }

    protected static function getFixturePath(string $prefix = ''): string
    {
        if (self::$fixturePaths === []) {
            throw new RuntimeException(
                'No fixture paths are registered by calling self::registerFixturesPath().',
                1_655_065_709
            );
        }

        if ($prefix === '') {
            $prefix = 'DEFAULT';
        }

        if (!array_key_exists($prefix, self::$fixturePaths)) {
            throw new RuntimeException(sprintf('Fixture prefix (%s) was not registered.', $prefix), 1_636_451_407);
        }

        return self::$fixturePaths[$prefix];
    }

    protected static function getFixtureFilename(string $fixture): string
    {
        $prefix = '';
        $filename = '';

        self::explodePrefixAndFilename($fixture, $prefix, $filename);

        return self::getFixturePath($prefix) . DIRECTORY_SEPARATOR . $filename;
    }

    /**
     * @param array<string, string> $files
     */
    protected static function createFixtures(string $targetPath, array $files): void
    {
        $filesystem = self::getFilesystem();

        foreach ($files as $target => $source) {
            $prefix = '';
            $originFile = '';

            self::explodePrefixAndFilename($source, $prefix, $originFile);
            $absoluteOriginFile = self::getFixtureFilename($source);

            $targetFile = '';

            if (!$filesystem->isAbsolutePath($target)) {
                $targetFile .= dirname($filesystem->makePathRelative(
                    $absoluteOriginFile,
                    self::getFixturePath($prefix)
                )) . DIRECTORY_SEPARATOR;
            }

            $targetFile .= $target;

            $filesystem->copy($absoluteOriginFile, $targetPath . DIRECTORY_SEPARATOR . $targetFile);
        }
    }

    /**
     * @afterClass
     * @internal
     */
    public static function tearDownFileFixtures(): void
    {
        self::$fixturePaths = [];
    }

    /**
     * @internal
     */
    private static function explodePrefixAndFilename(string $combined, string &$prefix, string &$filename): void
    {
        if (strpos($combined, ':') === false) {
            $filename = $combined;
            $prefix = 'DEFAULT';

            return;
        }

        [$prefix, $filename] = explode(':', $combined, 2);
    }
}
