<?php
  namespace App\Tests\Commands;

  use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

  class PairNamesCommandTest extends KernelTestCase {
    use \App\Tests\Traits\RunCommand;

    const POOL_NAMES_EQUAL = "John Mary JohnMary john Mary";
    const POOL_NAMES_DIFF = "John JohnMary John Mary";

    protected function setUp() {
      $this->application = $this->initApplication();

      parent::setUp();
    }

    public function testExecute() {
      $output = $this->executeCommandWithArguments("app:pair-names", ['pool' => self::POOL_NAMES_EQUAL]);
      $this->assertSame("1\n", $output);

      $output = $this->executeCommandWithArguments("app:pair-names", ['pool' => self::POOL_NAMES_DIFF]);
      $this->assertSame("0\n", $output);
    }
  }
