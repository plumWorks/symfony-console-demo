<?php
  namespace App\Tests\Commands;

  use Symfony\Component\Console\Tester\CommandTester;
  use Symfony\Bundle\FrameworkBundle\Console\Application;
  use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
  use Symfony\Component\Serializer\Exception\NotEncodableValueException;

  class SortingProductsCommandTest extends KernelTestCase {
      use \App\Tests\Traits\RunCommand;
      use \App\Tests\Traits\Assets;

      const PRODUCTS_FILES = [
        "corrupted" => "products-corrupted.json",
        "invalid" => "products-invalid.json",
        "valid" => "products.json",
        "sorted" => "products-sorted.json"
      ];

      protected function setUp() {
        $this->application = $this->initApplication();

        parent::setUp();
      }

      public function testValidateJSON() {
        foreach (self::PRODUCTS_FILES as $type => $fileName) {

          try {
            $products = $this->getFileContents($fileName);
            $output = $this->executeCommandWithArguments('app:sorting-products', ['products' => $products]);
          } catch (NotEncodableValueException $e) {
            $this->assertTrue($type === 'corrupted', $e->getMessage());
          }
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
