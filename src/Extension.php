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

use DG\BypassFinals;
use PHPUnit\Runner\BeforeTestHook;

use const false;

final class Extension implements BeforeTestHook
{
    private bool $disableBypassFinals = false;

    /**
     * @param array{
     *   disableBypassFinals: bool
     * }|array{} $options
     */
    public function __construct(array $options = [])
    {
        $options['disableBypassFinals'] ??= false;

        $this->disableBypassFinals = $options['disableBypassFinals'];
    }

    public function executeBeforeTest(string $test): void
    {
        if (!$this->disableBypassFinals) {
            BypassFinals::enable();
        }
    }
}
