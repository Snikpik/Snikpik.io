<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |

     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => [],
    'allowedHeaders' => ['Accept', 'Authorization'],
    'allowedMethods' => ['GET'],
    'exposedHeaders' => [
        'X-RequestLimit-Limit',
        'X-RequestLimit-Remaining',
        'X-RateLimit-Limit',
        'X-RateLimit-Remaining'
    ],
    'maxAge' => 0,
    'hosts' => [],
];

