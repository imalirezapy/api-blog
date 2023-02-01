<?php
return [
    "200" => [
        "message" => "OK",
        "data" => "Successful HTTP requests response."
    ],

    "400" => [
        "message" => "Bad Request",
        "data" => "Invalid request data framing."
    ],
    "401" => [
        "message" => "Unauthorized",
        "data" => "The response must include a Authenticate header field with Token."
    ],
    "403" => [
        "message" => "Forbidden",
        "data" => "You doesn't have the necessary permissions."
    ],
    "404" => [
        "message" => "Not Found",
        "data" => "The requested resource couldn't be found."
    ],
    "500" => [
        "message" => "Internal Server Error",
        "data" => "Unexpected condition was encountered."
    ],
    "502" => [
        "message" => "Bad Gateway",
        "data" => "Server received an invalid response."
    ],
    "504" => [
        "message" => "Gateway Timeout",
        "data" => "Server didn't receive a timely response."
    ],
];
