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

namespace Gilbertsoft\PHPUnit\Tools\Tests\Unit\Hook;

use Gilbertsoft\PHPUnit\Tools\Hook\BypassFinalsHook;
use Gilbertsoft\PHPUnit\Tools\Tests\Unit\TestCase;
use PHPUnit\Runner\BeforeTestHook;

use function in_array;
use function class_implements;

/**
 * @covers \Gilbertsoft\PHPUnit\Tools\Hook\BypassFinalsHook
 */
final class BypassFinalsHookTest extends TestCase
{
    public function testBypassFinalsHookImplementsRequiredInterface(): void
    {
        $interfaces = class_implements(BypassFinalsHook::class);
        self::assertIsArray($interfaces);
        self::assertTrue(in_array(BeforeTestHook::class, $interfaces, true));
    }

    public function testExecuteBeforeTest(): void
    {
        $bypassFinalsHook = new BypassFinalsHook();
        $bypassFinalsHook->executeBeforeTest('test');
        self::assertFileEquals(__DIR__ . '/../Fixtures/FinalClass.txt', __DIR__ . '/../Fixtures/FinalClass.php');
    }
}
