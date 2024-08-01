<?php

return [

    /* vincoli cors: ho avuto molti problemi e difficoltà nel capirli ma bene o male adesso so a cosa servono */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST'],

    'allowed_origins' => ['http://localhost:8000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type', 'X-CSRF-TOKEN'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
