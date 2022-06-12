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

use Symfony\Component\Filesystem\Filesystem;

trait FilesystemTrait
{
    /**
     * @internal
     */
    private static ?Filesystem $filesystem = null;

    protected static function getFilesystem(): Filesystem
    {
        if (!self::$filesystem instanceof \Symfony\Component\Filesystem\Filesystem) {
            self::$filesystem = new Filesystem();
        }

        return self::$filesystem;
    }
}
