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

use Composer\Util\Filesystem as ComposerFilesystem;

trait ComposerFilesystemTrait
{
    /**
     * @internal
     */
    private static ?ComposerFilesystem $composerFilesystem = null;

    protected static function getComposerFilesystem(): ComposerFilesystem
    {
        if (!self::$composerFilesystem instanceof \Composer\Util\Filesystem) {
            self::$composerFilesystem = new ComposerFilesystem();
        }

        return self::$composerFilesystem;
    }
}
