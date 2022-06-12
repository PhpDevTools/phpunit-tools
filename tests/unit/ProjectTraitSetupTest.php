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
final class ProjectTraitSetupTest extends TestCase
{
    use ProjectTrait;

    public static function setUpBeforeClass(): void
    {
        self::setProjectRootPath('root-test-before-setup');
    }

    public function testProjectRootPathCanBeOverwrittenBeforeSetup(): void
    {
        self::assertSame('root-test-before-setup', self::getProjectRootPath());
    }
}
