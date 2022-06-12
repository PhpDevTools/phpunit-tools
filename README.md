# PHPUnit Tools

[![Packagist Version](https://img.shields.io/packagist/v/PhpDevTools/phpunit-tools)](https://packagist.org/packages/PhpDevTools/phpunit-tools)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/PhpDevTools/phpunit-tools)](https://packagist.org/packages/PhpDevTools/phpunit-tools)
[![GitHub issues](https://img.shields.io/github/issues/PhpDevTools/phpunit-tools)](https://github.com/PhpDevTools/phpunit-tools/issues)
[![GitHub forks](https://img.shields.io/github/forks/PhpDevTools/phpunit-tools)](https://github.com/PhpDevTools/phpunit-tools/network)
[![GitHub stars](https://img.shields.io/github/stars/PhpDevTools/phpunit-tools)](https://github.com/PhpDevTools/phpunit-tools/stargazers)
[![GitHub license](https://img.shields.io/github/license/PhpDevTools/phpunit-tools)](https://github.com/PhpDevTools/phpunit-tools/blob/main/LICENSE)
[![GitHub build](https://img.shields.io/github/workflow/status/PhpDevTools/phpunit-tools/Continuous%20Integration%20(CI))](https://github.com/PhpDevTools/phpunit-tools/actions/workflows/continuous-integration.yml)
[![Coveralls](https://img.shields.io/coveralls/github/PhpDevTools/phpunit-tools)](https://coveralls.io/github/PhpDevTools/phpunit-tools)
[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](https://github.com/PhpDevTools/phpunit-tools/blob/main/CODE_OF_CONDUCT.md)

This package contains a collection of traits for PHPUnit to simplify testing
workflows.

## Installation

Require this package with Composer as dev requirement:

```bash
composer require --dev gilbertsoft/phpunit-tools
```

Now you can use the traits in your test classes and activate the desired
extensions.

## Traits

### ComposerFilesystem

Provides the `getComposerFilesystem()` method to access a `\Composer\Util\Filesystem`.

### DedicatedTestPathTrait

Automatically runs each single test in a dedicated temporary folder.

### FileFixturesTrait

Provides support for file fixtures.

### FilesystemTrait

Provides the `getFilesystem()` method to access a `\Symfony\Component\Filesystem\Filesystem`.

### ProjectTrait

Provides the `getProjectRootPath()` method to get the project root path.

## Extensions

### BypassFinals

It is not possible to prophesize a final class. This extension uses the
`dg/bypass-finals` package to remove the `final` keyword during PHPUnit
execution. To enable the extension, add the following line to your
`phpunit.xml` configuration file:

```xml
  <extensions>
    <extension class="Gilbertsoft\PHPUnit\Tools\Hook\BypassFinalsHook"/>
  </extensions>
```

## Feedback / Bug reports / Contribution

Bug reports, feature requests and pull requests are welcome in the [GitHub
repository](https://github.com/PhpDevTools/phpunit-tools).

For support questions or other discussions please use the [GitHub
Discussions](https://github.com/PhpDevTools/phpunit-tools/discussions).

## License

This package is licensed under the [MIT License](https://github.com/PhpDevTools/phpunit-tools/blob/main/LICENSE).
