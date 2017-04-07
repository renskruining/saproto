<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OmNomCom Stores
    |--------------------------------------------------------------------------
    |
    | Defines the OmNomCom stores available, which products to show, and which
    | people or IP addresses are allowed to view them.
    |
    */

    'stores' => [
        'protopolis' => (object)[
            'name' => 'Protopolis',
            'categories' => [12, 1, 4, 5, 6, 22, 24, 7, 9, 11],
            'addresses' => ['130.89.190.22', '2001:67c:2564:318:9ab:3c5a:78f5:5fd'],
            'roles' => ['board', 'omnomcom'],
            'cash_allowed' => false,
        ],
        'pilscie' => (object)[
            'name' => 'PilsCie',
            'categories' => [15, 18],
            'addresses' => [],
            'roles' => ['board', 'pilscie'],
            'cash_allowed' => true
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Alfred Account
    |--------------------------------------------------------------------------
    |
    | Defines the the financial account ID for Alfred's products.
    |
    */

    'alfred-account' => 43,

    /*
    |--------------------------------------------------------------------------
    | Mollie Settings
    |--------------------------------------------------------------------------
    |
    | Defines various configuration options for the Mollie integration.
    |
    */

    'mollie' => [
        'fixed_fee' => .3,
        'variable_fee' => .02,
        'fee_id' => 887
    ],

    /*
    |--------------------------------------------------------------------------
    | Membership Fee Settings
    |--------------------------------------------------------------------------
    |
    | Defines the products for membership fees.
    |
    */

    'fee' => [
        'regular' => 292,
        'reduced' => 293,
        'remitted' => 889,
    ],

    /*
    |--------------------------------------------------------------------------
    | ProTube Skip Product
    |--------------------------------------------------------------------------
    |
    | Defines the product for ProTube skip
    |
    */

    'protube-skip' => 40,

];
