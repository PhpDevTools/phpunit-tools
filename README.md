# PHPUnit Tools

[![Latest Stable Version](http://poser.pugx.org/gilbertsoft/phpunit-tools/v)](https://packagist.org/packages/gilbertsoft/phpunit-tools)
[![Total Downloads](http://poser.pugx.org/gilbertsoft/phpunit-tools/downloads)](https://packagist.org/packages/gilbertsoft/phpunit-tools)
[![Latest Unstable Version](http://poser.pugx.org/gilbertsoft/phpunit-tools/v/unstable)](https://packagist.org/packages/gilbertsoft/phpunit-tools)
[![License](http://poser.pugx.org/gilbertsoft/phpunit-tools/license)](https://packagist.org/packages/gilbertsoft/phpunit-tools)
[![PHP Version Require](http://poser.pugx.org/gilbertsoft/phpunit-tools/require/php)](https://packagist.org/packages/gilbertsoft/phpunit-tools)
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

This package delivers a PHPUnit extension to simplify the usage. To enable
the extension, add the following line to your PHPUnit configuration file:

```xml
  <extensions>
    <extension class="Gilbertsoft\PHPUnit\Tools\Extension"/>
  </extensions>
```

### BypassFinals

It is not possible to prophesize a final class. This extension uses the
`dg/bypass-finals` package to remove the `final` keyword during PHPUnit
execution.

To disable this feature, add the following argument to your PHPUnit
configuration file:

```xml
  <extensions>
    <extension class="Gilbertsoft\PHPUnit\Tools\Extension">
      <arguments>
        <array>
          <element key="disableBypassFinals">
            <boolean>true</boolean>
          </element>
        </array>
      </arguments>
    </extension>
  </extensions>
```

## Feedback / Bug reports / Contribution

Bug reports, feature requests and pull requests are welcome in the [GitHub
repository](https://github.com/PhpDevTools/phpunit-tools).

For support questions or other discussions please use the [GitHub
Discussions](https://github.com/PhpDevTools/phpunit-tools/discussions).

## License

This package is licensed under the [MIT License](https://github.com/PhpDevTools/phpunit-tools/blob/main/LICENSE).
