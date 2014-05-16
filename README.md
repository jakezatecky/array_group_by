# array_group_by

This simple function takes an array and groups its members by a provided key.

# Usage

Example input:

    $records = array (
        array (
            "state" => "IN",
            "city" => "Indianapolis",
            "object" => "School Bus"
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

    $grouped = array_group_by ( $records, "state" );

Example output:

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
                                [object] => School Bus
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