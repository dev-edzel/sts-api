<?php

return [
    'merchants' => [
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
    ],


    'statuses' => [
        [
            'name' => 'open',
            'description' => 'The ticket has been created and is awaiting assignment or action.'
        ],
        [
            'name' => 'in_progress',
            'description' => 'The ticket has been assigned and is being worked on.'
        ],
        [
            'name' => 'pending',
            'description' => 'The ticket is waiting for input or action from someone else, such as the customer or another team.'
        ],
        [
            'name' => 'resolved',
            'description' => 'The issue has been addressed and the ticket is considered complete.'
        ],
        [
            'name' => 'on_hold',
            'description' => 'The ticket is temporarily paused for a specific reason.'
        ],
        [
            'name' => 'escalated',
            'description' => 'The ticket has been flagged for urgent attention or has been escalated to a higher level of support.'
        ],
        [
            'name' => 're_opened',
            'description' => 'A previously resolved ticket has been reopened due to a recurring or unresolved issue.'
        ],
    ],
];
