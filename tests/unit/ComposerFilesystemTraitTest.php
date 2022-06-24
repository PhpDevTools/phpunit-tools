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

use Gilbertsoft\PHPUnit\Tools\ComposerFilesystemTrait;

/**
 * @covers \Gilbertsoft\PHPUnit\Tools\ComposerFilesystemTrait
 */
final class ComposerFilesystemTraitTest extends TestCase
{
    use ComposerFilesystemTrait;

    public function testGetComposerFilesystem(): void
    {
        self::assertSame(self::getComposerFilesystem(), self::getComposerFilesystem());
    }
}
