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

use Gilbertsoft\PHPUnit\Tools\Extension;
use PHPUnit\Runner\BeforeTestHook;

use function class_implements;

/**
 * @covers \Gilbertsoft\PHPUnit\Tools\Extension
 */
final class ExtensionTest extends TestCase
{
    public function testImplementsRequiredInterfaces(): void
    {
        $interfaces = class_implements(Extension::class);
        self::assertIsArray($interfaces);
        self::assertContains(BeforeTestHook::class, $interfaces);
    }

    public function testExecuteBeforeTest(): void
    {
        $extension = new Extension();
        $extension->executeBeforeTest('test');
        self::assertFileEquals(__DIR__ . '/Fixtures/FinalClass.txt', __DIR__ . '/Fixtures/FinalClass.php');
    }
}
