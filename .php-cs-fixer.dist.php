<?php

$header = <<<EOM
This file is part of the gilbertsoft/phpunit-tools package.

(c) Gilbertsoft LLC (gilbertsoft.org)

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOM;

$config = \TYPO3\CodingStandards\CsFixerConfig::create();
$config
    ->setHeader($header, true)
    ->addRules([
        '@PER' => true,
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'ordered_imports' => ['imports_order' => ['class', 'function', 'const'], 'sort_algorithm' => 'alpha'],
        'modernize_strpos' => false,
        'no_unneeded_import_alias' => true,
    ])
    ->getFinder()
    ->exclude('tools')
    ->exclude('var')
    ->exclude('vendor')
    ->in(__DIR__)
;

return $config;
