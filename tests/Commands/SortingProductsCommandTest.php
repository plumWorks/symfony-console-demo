<?php
  namespace App\Tests\Commands;

  use Symfony\Component\Console\Tester\CommandTester;
  use Symfony\Bundle\FrameworkBundle\Console\Application;
  use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

  class SortingProductsCommandTest extends KernelTestCase {
      use \App\Tests\Traits\RunCommand;
      use \App\Tests\Traits\Assets;

      const PRODUCTS_FILES = [
        "valid" => "products.json",
        "invalid" => "products-invalid.json",
        "corrupted" => "products-corrupted.json",
        "sorted" => "products-sorted.json"
      ];

      protected function setUp() {
        $this->application = $this->initApplication();

        parent::setUp();
      }

      public function testValidateJSON() {
        $this->expectExceptionCode(2);

        foreach (self::PRODUCTS_FILES as $type => $fileName) {
          switch ($type) {
            case 'corrupted':
              // TODO: add expectException
              break;
            case 'invalid':
              // TODO: add expectException
              break;
            default:
              break;
          }

          $products = $this->getFileContents($fileName);
          $output = $this->executeCommandWithArguments('app:sorting-products', ['products' => $products]);
        }
      }

      public function testExecute() {
        $products = $this->getFileContents(self::PRODUCTS_FILES['valid']);
        $output = $this->executeCommandWithArguments('app:sorting-products', ['products' => $products]);

        $sortedFilePath = $this->getFilePath(self::PRODUCTS_FILES['sorted']);
        $this->fileExistsAt($sortedFilePath);
        $this->assertJsonStringEqualsJsonFile($sortedFilePath, $output, 'Products are not sorted right.');
      }
  }
