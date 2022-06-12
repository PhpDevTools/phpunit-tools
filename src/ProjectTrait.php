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

trait ProjectTrait
{
    /**
     * @internal
     */
    private static string $projectRootPath = '';

    protected static function getProjectRootPath(): string
    {
        return self::$projectRootPath;
    }

    protected static function setProjectRootPath(string $path): void
    {
        self::$projectRootPath = $path;
    }

    /**
     * @beforeClass
     * @internal
     */
    public static function setUpProject(): void
    {
        if (self::$projectRootPath === '') {
            if (($projectRootPath = realpath('')) === false) {
                // @codeCoverageIgnoreStart
                throw new RuntimeException('Unable to calculate project root path.', 1_655_048_734);
                // @codeCoverageIgnoreEnd
            }

            self::$projectRootPath = $projectRootPath;
        }
    }

    /**
     * @afterClass
     * @internal
     */
    public static function tearDownProject(): void
    {
        self::$projectRootPath = '';
    }
}
