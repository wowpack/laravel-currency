<?php

return [
    'tables' => [
        'currency_base' => 'currencies',
        'users_and_currencies_relational' => 'user_has_currencies',
        'models_and_currencies_relational' => 'model_has_currencies',
    ],
    'models' => [
        'currencies' => \Wowpack\LaravelCurrency\Models\Currency::class,
    ],
    'columns' => [
        'user_currency_morph_name' => 'user',
        'user_currency_morph_key' => 'user_id',
        'model_currency_morph_name' => 'model',
        'model_currency_morph_key' => 'model_id',
    ],
    'relations' => [
        'user_multi_currency' => false,
        'model_multi_currency' => false,
    ],
    'providers' => [
        \Wowpack\LaravelCurrency\Providers\CurrencyServiceProvider::class,
    ],
    'cache' => false,
];
