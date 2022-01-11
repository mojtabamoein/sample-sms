<?php
return [
        'ghasedak' => [
            'driver'      => \App\SMS\Drivers\Ghasedak::class,
            'line_number' => '0000',
            'api_key'     => 'key'
        ],

        'kavenegar' => [
            'driver'      => \App\SMS\Drivers\Kavenegar::class,
            'line_number' => '0000',
            'api_key'     => 'key'
        ],
];
