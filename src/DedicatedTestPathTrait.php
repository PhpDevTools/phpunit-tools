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

use RuntimeException;

use function defined;

use const DIRECTORY_SEPARATOR;

trait DedicatedTestPathTrait
{
    use FilesystemTrait;
    use ProjectTrait;

    /**
     * @internal
     */
    private static string $testBaseFolder = 'var' . DIRECTORY_SEPARATOR . 'tests';

    /**
     * @internal
     */
    private ?string $testPath = null;

    /**
     * @internal
     */
    private string $oldWorkingDirectory;

    /**
     * Set to true to remove the test folder at teardown. Does not work on Windows.
     */
    protected bool $cleanupTestPath = false;

    protected static function getTestBaseFolder(): string
    {
        return self::$testBaseFolder;
    }

    protected static function setTestBaseFolder(string $path): void
    {
        self::$testBaseFolder = $path;
    }

    protected function getTestPath(?string $subFolder = null): string
    {
        if ($this->testPath === null) {
            $this->testPath = $this->getAbsoluteTestBasePath() . DIRECTORY_SEPARATOR . $this->getTestDirectory(
                $this->getAbsoluteTestBasePath(),
                'test_'
            );
        }

        $testPath =  $this->testPath;
        if ($subFolder !== null) {
            $testPath .= DIRECTORY_SEPARATOR . $subFolder;
        }

        $filesystem = self::getFilesystem();
        $filesystem->mkdir($testPath);

        return $testPath;
    }

    /**
     * @before
     * @internal
     */
    public function setUpDedicatedFolder(): void
    {
        if (($cwd = getcwd()) === false) {
            // @codeCoverageIgnoreStart
            throw new RuntimeException('Could not determine current working directory.', 1_655_057_178);
            // @codeCoverageIgnoreEnd
        }

        $this->oldWorkingDirectory = $cwd;
        chdir($this->getTestPath());
    }

    /**
     * @after
     * @internal
     */
    public function tearDownDedicatedTestPath(): void
    {
        if (
            !defined('PHP_WINDOWS_VERSION_BUILD') &&
            $this->cleanupTestPath &&
            self::getFilesystem()->exists($this->getTestPath())
        ) {
            // @todo does currently not work on Windows
            self::getFilesystem()->remove($this->getTestPath());
        }

        $this->testPath = null;
        chdir($this->oldWorkingDirectory);
    }

    /**
     * @internal
     */
    private function getTestDirectory(string $dir, string $prefix): string
    {
        $filesystem = self::getFilesystem();

        // Loop until we create a valid test directory or have reached 10 attempts
        for ($i = 0; $i < 10; ++$i) {
            // Create a unique directory name
            $testDir = $prefix . uniqid((string)random_int(0, mt_getrandmax()), true);

            if ($filesystem->exists($dir . DIRECTORY_SEPARATOR . $testDir)) {
                continue;
            }

            return $testDir;
        }

        throw new RuntimeException('A test directory could not be created.', 1_655_057_177);
    }

    /**
     * @internal
     */
    private function getAbsoluteTestBasePath(): string
    {
        return self::getProjectRootPath() . DIRECTORY_SEPARATOR . self::getTestBaseFolder();
    }
}
