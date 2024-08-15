<?php

return [
    'ticket_types' => [
        [
            'name' => 'Bureau of Quarantine',
            'short_name' => 'BOQ',
        ],
        [
            'name' => 'Land Transportation Franchising and Regulatory Board',
            'short_name' => 'LTFRB',
        ],
        [
            'name' => 'MARINA Integrated Seafarers Management Online',
            'short_name' => 'MISMO',
        ],
    ],
    'categories' => [
        [
            'name' => 'Payment',
            'sub_categories' => [
                ['name' => 'Payment Delays'],
                ['name' => 'Payment Errors'],
                ['name' => 'Declined Transactions'],
            ]
        ],
        [
            'name' => 'Technical Issues',
            'sub_categories' => [
                ['name' => 'Features Not Working'],
                ['name' => 'Connection Issues'],
            ]
        ],
        [
            'name' => 'Account Management',
            'sub_categories' => [
                ['name' => 'Account Creation Issues'],
                ['name' => 'Login Failures'],
                ['name' => 'Password Reset Requests'],
            ]
        ],
    ]
];
