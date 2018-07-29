<?php
  namespace App\Tests\Commands;

  use Symfony\Component\Console\Tester\CommandTester;
  use Symfony\Bundle\FrameworkBundle\Console\Application;

  trait RunCommand {
    private $application;

    protected function initApplication(): Application {
        $kernel = static::createKernel();
        $kernel->boot();

        return new Application($kernel);
    }

    protected function executeCommandWithArguments(string $commandName, array $args = []): string {
      if (isset($args['command'])) {
        unset($args['command']);
      }

      if (!isset($this->application)) {
        trigger_error(
          'Please use setUp() method in your TestCase and assaign $application using initApplication() there.',
          E_USER_NOTICE
        );
      }

      $command = $this->application->find($commandName);
      $commandTester = new CommandTester($command);
      $commandTester->execute([
        'command' => $command->getName()
      ] + $args);

      return $commandTester->getDisplay();
    }
  }
