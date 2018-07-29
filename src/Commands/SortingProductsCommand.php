<?php
  namespace App\Commands;

  use Symfony\Component\Console\Command\Command;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Output\OutputInterface;
  use Symfony\Component\Console\Input\InputArgument;
  use Symfony\Component\Serializer\Serializer;
  use Symfony\Component\Serializer\Encoder\JsonEncoder;
  use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
  use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

  use App\Models\Product;

  class SortingProductsCommand extends Command {

    protected $serializer;

    protected function configure() {
      $this
        ->setName('app:sorting-products')
        ->setDescription('Sorting given products by price, title asc')
        ->setHelp('Command takes the argument array of products in JSON, sort it and return')
        ->addArgument(
          'products',
          InputArgument::REQUIRED,
          'What products should be sort?'
        );

        $encoders = [new JsonEncoder()];
        $normalizers = [new PropertyNormalizer(), new ArrayDenormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
      $products = $input->getArgument('products');
      $products = $this->serializer->deserialize($products, Product::class . '[]', 'json');

      usort($products, function ($left, $right) {
        if ($left->price == $right->price) {
          return $left->title < $right->title ? -1 : 1;
        }

        return $left->price < $right->price ? -1 : 1;
      });

      $products = $this->serializer->serialize($products, 'json');
      $output->writeln($products);
    }
  }
