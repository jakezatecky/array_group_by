# array_group_by

[![Packagist](https://img.shields.io/packagist/v/jakezatecky/array_group_by.svg?style=flat-square)](https://packagist.org/packages/jakezatecky/array_group_by)
[![Build Status](https://img.shields.io/travis/jakezatecky/array_group_by/master.svg?style=flat-square)](https://travis-ci.org/jakezatecky/array_group_by)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/jakezatecky/array_group_by/master/LICENSE.txt)

> A PHP function to group an array by a key or set of keys shared between all array members.

## Installation

To get the latest version of `array_group_by`, simply require the project using Composer:

``` shell
$ composer require jakezatecky/array_group_by
```

Need support for PHP 5.6? Then run the following:

``` shell
$ composer require jakezatecky/array_group_by:^1.1.0
```

If you do not want to use Composer, you can just `require` the `src/array_group_by.php` file.

## Usage

To use `array_group_by`, simply pass an array with any number of keys to group by:

``` php
$records = [
    [
        'state'  => 'IN',
        'city'   => 'Indianapolis',
        'object' => 'School bus',
    ],
    [
        'state'  => 'IN',
        'city'   => 'Indianapolis',
        'object' => 'Manhole',
    ],
    [
        'state'  => 'IN',
        'city'   => 'Plainfield',
        'object' => 'Basketball',
    ],
    [
        'state'  => 'CA',
        'city'   => 'San Diego',
        'object' => 'Light bulb',
    ],
    [
        'state'  => 'CA',
        'city'   => 'Mountain View',
        'object' => 'Space pen',
    ],
];

$grouped = array_group_by($records, 'state', 'city');
```

Example output:

``` text
Array
(
    [IN] => Array
        (
            [Indianapolis] => Array
                (
                    [0] => Array
                        (
                            [state] => IN
                            [city] => Indianapolis
                            [object] => School bus
                        )

                    [1] => Array
                        (
                            [state] => IN
                            [city] => Indianapolis
                            [object] => Manhole
                        )

                )

            [Plainfield] => Array
                (
                    [0] => Array
                        (
                            [state] => IN
                            [city] => Plainfield
                            [object] => Basketball
                        )

                )

        )

    [CA] => Array
        (
            [San Diego] => Array
                (
                    [0] => Array
                        (
                            [state] => CA
                            [city] => San Diego
                            [object] => Light bulb
                        )

                )

            [Mountain View] => Array
                (
                    [0] => Array
                        (
                            [state] => CA
                            [city] => Mountain View
                            [object] => Space pen
                        )

                )

        )
)
```

### Using a Callback

If more complex grouping behavior is desired, you can also pass in a callback function to determine the group key:

``` php
$grouped = array_group_by($records, function ($row) {
    return $row->city;
});
```
