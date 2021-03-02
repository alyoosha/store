<?php

return [
    'name' => ':attribute должно содержать кириллицу, либо латиницу',
    'address' => ':attribute должнен содержать кириллицу, латиницу, "- , ."',
    'phone' => ':attribute должен содержать цифры и не быть короче 11 символов',
    'postcode' => ':attribute должен содержать цифры и быть длинной в 6 символов',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'attributes' => [],
];
