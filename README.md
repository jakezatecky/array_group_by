# array_group_by

A function that groups/splits an array by the values of a given key or keys.

# Usage

Example input:

``` php
$records = array (
    array (
        "state" => "IN",
        "city" => "Indianapolis",
        "object" => "School bus"
    ),
    array (
        "state" => "IN",
        "city" => "Indianapolis",
        "object" => "Manhole"
    ),
    array (
        "state" => "IN",
        "city" => "Plainfield",
        "object" => "Basketball"
    ),
    array (
        "state" => "CA",
        "city" => "San Diego",
        "object" => "Light bulb"
    ),
    array (
        "state" => "CA",
        "city" => "Mountain View",
        "object" => "Space pen"
    )
);

$grouped = array_group_by ( $records, "state", "city" );
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

# Installation

A Composer package is available for this function. Just add the following to `composer.json`.

``` javascript
{
    "require": {
        "jakezatecky/array_group_by": "~0.7.1"
    }
}
```

Alternatively, you can just include the `src/array_group_by` file.