# Laravel Position

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithkyrian/laravel_position.svg?style=flat-square)](https://packagist.org/packages/codewithkyrian/laravel_position)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/codewithkyrian/laravel-position/Check%20&%20fix%20styling?label=code%20style)](https://github.com/codewithkyrian/laravel-position/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithkyrian/laravel_position.svg?style=flat-square)](https://packagist.org/packages/codewithkyrian/laravel_position)

A simple extensible laravel collection macro that evaluates the position or ranking of items in a collection and appends the position to each item with a key of your choice. The default key is 'position'

## Installation

You can install the package via composer:

```bash
composer require codewithkyrian/laravel_position
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="position-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * The default key to use when adding the position to each item
     * in the collection. It could still be overridden when calling
     * method by passing a string as the second argument.
     */
    'key' => 'position',

    /**
     * Whether to show the total number of items in the collection
     * in the position text eg. 12th out of 30
     */
    'show_total' => false,

    /**
     * The text to join the position and the total number of items
     * in the collection
     */
    'join_text' => 'out of'
];
```

And you're done. You can now use the macro anywhere in your project.

## Usage

To use the macro, you have to call the method `rankBy` on the collection instance while passing the key to be used for the ranking as the first arguement. This package can be used on a collection whether the items in it are arrays or objects. 

```php
$items = collect(
    [
        [ 'name' => 'Mr A', 'score' => 100 ],
        [ 'name' => 'Mr B', 'score' => 74 ],
        [ 'name' => 'Mr C', 'score' => 60 ],
        [ 'name' => 'Mr D', 'score' => 83 ],
        [ 'name' => 'Mr E', 'score' => 89 ],
    ]
);
$rankedItems = $items->rankBy('score');
dd($rankedItems->toArray());

/*
array:5 [▼
  0 => array:3 [▼
    "name" => "Mr A"
    "score" => 100
    "position" => "1st"
  ]
  1 => array:3 [▼
    "name" => "Mr E"
    "score" => 89
    "position" => "3rd"
  ]
  2 => array:3 [▼
    "name" => "Mr D"
    "score" => 83
    "position" => "4th"
  ]
  3 => array:3 [▼
    "name" => "Mr B"
    "score" => 74
    "position" => "5th"
  ]
  4 => array:3 [▼
    "name" => "Mr C"
    "score" => 60
    "position" => "6th"
  ]
]
*/
```

You can also pass a composite key in the dot notation form for collection with nested values.

```php
$users = collect(
    [
        [ 
            'name' => 'Mr A', 
            'result' => [
                'score' => 100, 'status' => 1
            ]
        ],
        [ 
            'name' => 'Mr B', 
            'result' => [
                'score' => 74, 'status' => 1
            ]
        ],
        [ 
            'name' => 'Mr C', 
            'result' => [
                'score' => 60, 'status' => 1
            ]
        ],
        [ 
            'name' => 'Mr D', 
            'result' => [
                'score' => 83, 'status' => 1
            ]
        ]
    ]
);
$rankedUsers = $users->rankBy('result.score');
echo ($rankedUsers->toArray());

/*
array:4 [▼
  0 => array:3 [▼
    "name" => "Mr A"
    "result" => array:2 [▼
      "score" => 100
      "status" => 1
    ]
    "position" => "1st"
  ]
  1 => array:3 [▼
    "name" => "Mr D"
    "result" => array:2 [▼
      "score" => 83
      "status" => 1
    ]
    "position" => "3rd"
  ]
  2 => array:3 [▼
    "name" => "Mr B"
    "result" => array:2 [▼
      "score" => 74
      "status" => 1
    ]
    "position" => "4th"
  ]
  3 => array:3 [▼
    "name" => "Mr C"
    "result" => array:2 [▼
      "score" => 60
      "status" => 1
    ]
    "position" => "5th"
  ]
]
*/
```

To further customize the behaviour of the macro, you could pass a second argument to control the key used to output the position on the items. By default, it is `position`. Remember, you can also change this from the `key` key in the package's config file. 

```php

$rankedItems = $items->rankBy('score', 'class_position');
echo ($rankedItems->toArray());

/*
array:5 [▼
  0 => array:3 [▼
    "name" => "Mr A"
    "score" => 100
    "class_position" => "1st"
  ]
  1 => array:3 [▼
    "name" => "Mr E"
    "score" => 89
    "class_position" => "3rd"
  ]
  2 => array:3 [▼
    "name" => "Mr D"
    "score" => 83
    "class_position" => "4th"
  ]
  3 => array:3 [▼
    "name" => "Mr B"
    "score" => 74
    "class_position" => "5th"
  ]
  4 => array:3 [▼
    "name" => "Mr C"
    "score" => 60
    "class_position" => "6th"
  ]
]
*/

```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Kyrian Obikwelu](https://github.com/CodeWithKyrian)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
