This project shows you how to use and test [Symfony](https://symfony.com) Console Application using [Docker](https://www.docker.com).

## How to install

It's recommended using docker for application stability. If you don't have one, please [install](https://docs.docker.com/install/). It's possible to run application directly on your os but have in mind that was testing using dockerfile.

First move to project directory and build image provided within this project by running this:
```
docker build -t cmd-demo .
```
Then run image with this command:
```
docker run -it -v $PWD:/app -w /app --network host cmd-demo
```
At last, install components and run tests:
```
composer install && ./bin/phpunit
```

## Usage

There are available only two simple commands:
```
./bin/console app:pair-names '<pool>'
./bin/console app:sorting-products '<products>'
```

First command is searching both names **John** and **Mary** then if they are occur at this same amount, function will display 1 when not 0. Variable ```<pool>``` is *string* of names.

Second one sort array of products by price and title ascending. Replace ```<products>``` with JSON array of products with given instance:

```
	{
		"title": "Magento Enterprise License",
		"price": 1999.99,
		"inventory": 9999
	}
```

## Report the error or possibly improvement
If you find error, please create issue and describe it.

Also you are free to create issue for comment of given code or else.
