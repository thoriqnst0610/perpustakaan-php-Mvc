<?php

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=perpus",
                "username" => "root",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=perpus",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}
