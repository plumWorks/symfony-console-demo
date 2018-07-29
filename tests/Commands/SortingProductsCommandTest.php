<?php
  namespace App\Tests\Commands;

  use Symfony\Component\Console\Tester\CommandTester;
  use Symfony\Bundle\FrameworkBundle\Console\Application;
  use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

  class SortingProductsCommandTest extends KernelTestCase {
      use RunCommand;

      const PRODUCTS_FILE_PATH = require_once __DIR__ . '/../Assets/products.json';

      protected function setUp() {
        $this->application = $this->initApplication();

        parent::setUp();
      }

      protected function testValidateJSON() {

      }

      protected function testExecute() {

      }
  }
