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

namespace Gilbertsoft\PHPUnit\Tools\Build;

use Gilbertsoft\Composer\AbstractReleaseScripts;
use Gilbertsoft\Composer\Release\FileReplaceVersionItem;
use Iterator;

/**
 * @internal
 */
final class ReleaseScripts extends AbstractReleaseScripts
{
    /**
     * @inheritDoc
     */
    protected static function getFiles(): Iterator
    {
        yield new FileReplaceVersionItem(
            '.ddev/config.yaml',
            '/(- COMPOSER_ROOT_VERSION=)\d+.\d+.\d+()/',
            FileReplaceVersionItem::VERSION_PART_PATCH
        );
        yield new FileReplaceVersionItem(
            '.github/workflows/continuous-integration.yml',
            '/(COMPOSER_ROOT_VERSION: )\d+.\d+.\d+()/',
            FileReplaceVersionItem::VERSION_PART_PATCH
        );
        yield new FileReplaceVersionItem(
            'composer.json',
            '/("dev-main": ")\d+.\d+(.x-dev")/',
            FileReplaceVersionItem::VERSION_PART_MINOR
        );
    }
}
