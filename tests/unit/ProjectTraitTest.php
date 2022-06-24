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

use Gilbertsoft\PHPUnit\Tools\ProjectTrait;

/**
 * @covers \Gilbertsoft\PHPUnit\Tools\ProjectTrait
 */
final class ProjectTraitTest extends TestCase
{
    use ProjectTrait;

    public function testProjectRootPathIsSetupCorrectly(): void
    {
        self::assertSame(realpath(__DIR__ . '/../..'), self::getProjectRootPath());
    }

    public function testProjectRootPathCanBeSet(): void
    {
        self::setProjectRootPath('root-test');
        self::assertSame('root-test', self::getProjectRootPath());
    }

    public function testSetUpProject(): void
    {
        self::tearDownProject();
        self::assertSame('', self::$projectRootPath);
        self::setUpProject();
        self::assertSame(realpath(__DIR__ . '/../..'), self::$projectRootPath);
    }
}
