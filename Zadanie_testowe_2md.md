### Using Symfony framework and Console component please create two CLI commands: 

1. Command must take a string parameter containing text and will check if “John” and “Mary” names are found the same number of times inside the provided text. This test should be case insensitive. If the number of times is the same it should return 1, if not it should return 0. Please add unit tests if you can.


2. Command must take a string parameter containing array of products in JSON. It should return array of JSON string with products sorted by price ascending, and if price is the same sorted alphabetically ascending.
Sample JSON parameter: 
```
[	
	{
		"title": "H&M T-Shirt White",
		"price": 10.99,
		"inventory": 10
	},
	{
		"title": "Magento Enterprise License",
		"price": 1999.99,
		"inventory": 9999
	},
	{
		"title": "iPad 4 Mini",
		"price": 500.01,
		"inventory": 2
	},
	{
		"title": "iPad Pro",
		"price": 990.20,
		"inventory": 2
	},
	{
		"title": "Garmin Fenix 5",
		"price": 789.67,
		"inventory": 34
	},
	{
		"title": "Garmin Fenix 3 HR Sapphire Performer Bundle",
		"price": 789.67,
		"inventory": 12
	}
]
```


### Acceptance criteria

1. Code delivered in form on git repository (bitbucket, github)
2. Provide basic documentation (English) in markdown format how to run / test the code
