<?php
  namespace App\Tests\Commands;

  use Symfony\Component\Console\Tester\CommandTester;
  use Symfony\Bundle\FrameworkBundle\Console\Application;
  use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

  class PairNamesCommandTest extends KernelTestCase {

    const POOL_NAMES_EQUAL = "John Mary JohnMary John Mary";
    const POOL_NAMES_DIFF = "John JohnMary John Mary";

    private $application;

    protected function setUp() {
      $kernel = static::createKernel();
      $kernel->boot();

      $this->application = new Application($kernel);

      parent::setUp();
    }

    protected function executeCommandWithArguments(string $commandName, array $args = []): string {
      if (isset($args['command'])) {
        unset($args['command']);
      }

      $command = $this->application->find($commandName);
      $commandTester = new CommandTester($command);
      $commandTester->execute([
        'command' => $command->getName()
      ] + $args);

      return $commandTester->getDisplay();
    }

    public function testExecute() {
      $output = $this->executeCommandWithArguments("app:pair-names", ['pool' => self::POOL_NAMES_EQUAL]);
      $this->assertContains("1", $output);

      $output = $this->executeCommandWithArguments("app:pair-names", ['pool' => self::POOL_NAMES_DIFF]);
      $this->assertContains("0", $output);
    }
  }
