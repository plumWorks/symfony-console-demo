<?php
  namespace App\Tests\Traits;

  use Symfony\Component\Finder\Finder;

  trait Assets {
    private $folderPath = __DIR__ . '/../Assets';

    protected function getFilePath(string $file): string {
      return "{$this->folderPath}/{$file}";
    }

    protected function fileExistsAt(string $filePath) {
      $this->assertFileExists($filePath);
      $this->assertFileIsReadable($filePath);
    }

    protected function getFileContents(string $file): string {
      $filePath = $this->getFilePath($file);;
      $this->fileExistsAt($filePath);

      $content = file_get_contents($filePath);
      $this->assertTrue($content !== false, var_export(error_get_last(), true));

      return $content;
    }
  }
