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
    'faqs' => [
        [
            'category_id' => 1,
            'sub_category_id' => 1,
            'question' => 'What are the common reason for payment delays?',
            'answers' => json_encode([
                [
                    "answer" => "Invoicing errors or delays in processing payments.",
                ]
            ]),
        ],
        [
            'category_id' => 1,
            'sub_category_id' => 1,
            'question' => 'How can I prevent payment delays?',
            'answers' => json_encode([
                [
                    'answer' => 'Set clear payment terms and send timely invoices.'
                ],
                [
                    'answer' => 'Offer multiple payment options that are popular in the Philippines, such as GCash, PayMaya, and bank transfers.'
                ]
            ]),
        ],
        [
            'category_id' => 1,
            'sub_category_id' => 1,
            'question' => 'What should I do if a payment is delayed?',
            'answers' => json_encode([
                [
                    'answer' => 'Contact the customer support politely to inquire about the delay.'
                ]
            ]),
        ],

        [
            'category_id' => 1,
            'sub_category_id' => 2,
            'question' => 'What are the common reasons for payment errors?',
            'answers' => json_encode([
                [
                    'answer' => 'Entering wrong card details, expiration dates, or billing addresses.'
                ],
                [
                    'answer' => 'The account may not have enough balance to cover the transaction.'
                ],
                [
                    'answer' => 'The card might have transaction limits, be blocked for security reasons, or not be enabled for online/international transactions.'
                ],
                [
                    'answer' => 'Banks may flag suspicious transactions for verification, leading to temporary payment holds.'
                ]
            ])
        ],
        [
            'category_id' => 1,
            'sub_category_id' => 2,
            'question' => 'How can I prevent payment errors?',
            'answers' => json_encode([
                [
                    'answer' => 'Carefully review all payment details before submitting.'
                ],
                [
                    'answer' => 'Ensure the account has enough funds to cover the transaction, considering any applicable fees.'
                ],
                [
                    'answer' => 'Use a reliable internet connection to avoid interruptions during payment processing.'
                ],
                [
                    'answer' => 'Verify with the bank that the card is active and enabled for the intended transaction type.'
                ],
                [
                    'answer' => 'If unsure about any restrictions or holds, contact the bank for clarification.'
                ]
            ])
        ],
        [
            'category_id' => 1,
            'sub_category_id' => 2,
            'question' => 'What should I do if a payment error occurs?',
            'answers' => json_encode([
                [
                    'answer' => 'If the error persists, contact the bank or card issuer for assistance.'
                ],
                [
                    'answer' => 'If possible, try using a different card or payment option.'
                ],
                [
                    'answer' => "If the issue seems related to the merchant's system, reach out to their customer support."
                ],
            ])
        ],
        [
            'category_id' => 1,
            'sub_category_id' => 2,
            'question' => 'How can I protect myself from payment errors and fraud?',
            'answers' => json_encode([
                [
                    'answer' => 'Use unique, complex passwords for online banking and payment accounts.'
                ],
                [
                    'answer' => 'Check bank and card statements frequently for any unauthorized transactions.'
                ],
                [
                    'answer' => 'Immediately report any suspected fraud to the bank or card issuer.'
                ],
            ])
        ],
        [
            'category_id' => 1,
            'sub_category_id' => 2,
            'question' => 'What are the potential consequences of payment errors?',
            'answers' => json_encode([
                [
                    'answer' => 'The payment may be processed later or declined altogether.'
                ],
                [
                    'answer' => 'May need to retry the payment or use an alternative method.'
                ],
                [
                    'answer' => 'In rare cases, payment errors can expose sensitive information, increasing the risk of fraud.',
                ]
            ])
        ],

        [
            'category_id' => 1,
            'sub_category_id' => 3,
            'question' => 'What are the common reasons for declined transactions?',
            'answers' => json_encode([
                [
                    'answer' => 'The payment may be processed later or declined altogether.'
                ],
                [
                    'answer' => 'May need to retry the payment or use an alternative method.'
                ],
                [
                    'answer' => 'In rare cases, payment errors can expose sensitive information, increasing the risk of fraud.'
                ],
            ])
        ],
        [
            'category_id' => 2,
            'sub_category_id' => 3,
            'question' => 'How can I prevent declined transactions?',
            'answers' => json_encode([
                [
                    'answer' => 'Ensure the account has enough funds to cover the transaction, considering any applicable fees.'
                ],
                [
                    'answer' => 'Carefully review all payment details before submitting.'
                ],
                [
                    'answer' => 'Verify with the bank that the card is active and enabled for the intended transaction type.'
                ],
                [
                    'answer' => 'Avoid making payments on public Wi-Fi networks.'
                ],
                [
                    'answer' => 'If unsure about any restrictions or holds, contact the bank for clarification.'
                ]
            ])
        ],

        [
            'category_id' => 2,
            'sub_category_id' => 4,
            'question' => 'What are common reasons why features might not work?',
            'answers' => json_encode([
                [
                    'answer' => 'The website/webapp might not be fully compatible with your browser version or type.'
                ],
                [
                    'answer' => "Problems with the website's server or hosting can cause features to be unavailable or malfunction."
                ],
            ])
        ],

        [
            'category_id' => 2,
            'sub_category_id' => 5,
            'question' => 'What are the common causes of connection issues?',
            'answers' => json_encode([
                [
                    'answer' => 'Issues with your internet service provider (ISP), signal strength, or network congestion can cause slow or intermittent connections.'
                ],
                [
                    'answer' => 'Scheduled maintenance or unexpected outages from your ISP can lead to temporary connection problems.'
                ],
            ])
        ],
        [
            'category_id' => 2,
            'sub_category_id' => 5,
            'question' => "What should I do if I'm experiencing connection issues?",
            'answers' => json_encode([
                [
                    'answer' => 'Verify that your device is connected to the internet and that the signal strength is good.'
                ],
                [
                    'answer' => 'Power cycle your router and device to refresh the connection.'
                ],
                [
                    'answer' => "Visit your ISP's website or social media pages to see if there are any reported outages in your area."
                ],
            ])
        ],

        [
            'category_id' => 3,
            'sub_category_id' => 6,
            'question' => 'What are the common reasons for account creation issues?',
            'answers' => json_encode([
                [
                    'answer' => "Entering inaccurate or missing details during registration, such as invalid email addresses or passwords that don't meet requirements."
                ],
                [
                    'answer' => "Attempting to create an account with an email address or username that's already in use."
                ],
                [
                    'answer' => 'Temporary server errors or website malfunctions can hinder account creation.'
                ],
            ])
        ],
        [
            'category_id' => 3,
            'sub_category_id' => 6,
            'question' => "What should I do if I'm unable to create an account?",
            'answers' => json_encode([
                [
                    'answer' => "Review all entered details carefully for accuracy and completeness."
                ],
                [
                    'answer' => "If the chosen username or email is already taken, try a different one."
                ],
                [
                    'answer' => 'Try creating an account on a different browser or device to rule out compatibility problems.'
                ],
            ])
        ],
        [
            'category_id' => 3,
            'sub_category_id' => 6,
            'question' => "How can I ensure a smooth account creation process?",
            'answers' => json_encode([
                [
                    'answer' => "Create a password that's difficult to guess and not used for other accounts."
                ],
                [
                    'answer' => "Double-check all details before submitting the registration form."
                ],
            ])
        ],

        [
            'category_id' => 3,
            'sub_category_id' => 7,
            'question' => "What are common reasons for login failures?",
            'answers' => json_encode([
                [
                    'answer' => "Entering the wrong username, email, or password. This is the most frequent cause of login failures."
                ],
                [
                    'answer' => "Multiple failed login attempts may trigger a temporary account lock for security reasons."
                ],
                [
                    'answer' => "Users might genuinely forget their passwords, especially if they haven't logged in for a while."
                ],
                [
                    'answer' => 'Server problems, website maintenance, or internet connectivity issues can prevent successful logins.]'
                ]
            ])
        ],
        [
            'category_id' => 3,
            'sub_category_id' => 7,
            'question' => "What should I do if I can't log in?",
            'answers' => json_encode([
                [
                    'answer' => 'Carefully review your username/email and password for accuracy.'
                ],
            ])
        ],
        [
            'category_id' => 3,
            'sub_category_id' => 7,
            'question' => "How can I prevent login failures?",
            'answers' => json_encode([
                [
                    'answer' => "Create a password that's difficult to guess and not used for other accounts. Consider using a password manager."
                ],
                [
                    'answer' => 'Avoid clicking on suspicious links or providing your login credentials to unknown sources.'
                ]
            ],)
        ],

        [
            'category_id' => 3,
            'sub_category_id' => 8,
            'question' => "How do I initiate a password reset request?",
            'answers' => json_encode([
                [
                    'answer' => 'Most websites and apps have a "Forgot Password" or similar link on the login page. Click on it to start the process.'
                ],
                [
                    'answer' => "If you can't find the reset option, contact the service provider's customer support for assistance."
                ]
            ],)
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
    ]
];
