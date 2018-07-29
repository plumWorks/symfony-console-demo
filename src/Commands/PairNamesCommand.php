<?php
  namespace App\Commands;

  use Symfony\Component\Console\Command\Command;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Output\OutputInterface;
  use Symfony\Component\Console\Input\InputArgument;
  use Symfony\Component\Validator\Constraints as Assert;

  class PairNamesCommand extends Command {

    protected $searchNames = ['John', 'Mary'];

    protected function configure() {
      $this
        ->setName('app:pair-names')
        ->setDescription('Check if given string has equal number of two names')
        ->setHelp('Command takes the argument to search and count two names \'John\' and Mary \'Mary\', then return 1 when accur this same amount of time if not 0 will be display')
        ->addArgument(
          'pool',
          InputArgument::REQUIRED,
          'What text should be searched for names?'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
      $pool = $input->getArgument('pool');
      $checkCount;
      $equal;

      foreach ($this->searchNames as $name) {
          $count = preg_match_all("/({$name})/mi", $pool);

          if ($count === false) {
            $message = array_flip(get_defined_constants(true)['pcre'])[preg_last_error()];
            throw new \Exception($message, 1);
          }

          if (!isset($checkCount, $equal)) {
            $checkCount = $count;
            $equal = true;
          } else {
            $equal = $checkCount === $count;
            $checkCount = $count;

            if (!$equal)
              break;
          }
      }

      $output->writeln($equal ? "1" : "0");
    }
  }
