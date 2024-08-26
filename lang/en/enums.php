<?php

return [
    'sort_products' => [
        'label' => [
            'popularity' => 'За популярністю',
            'cheap' => 'Від дешевих до дорогих',
            'expensive' => 'Від дорогих до дешевих',
        ],
        'column' => [
            'cheap' => 'price',
            'expensive' => 'price',
        ],
        'direction' => [
            'cheap' => 'asc',
            'expensive' => 'desc',
        ]
    ],
    'order_status' => [
        'label' => [
            'new' => 'Новий',
            'process_order' => 'Прийняти замовлення',
            'done' => 'Завершено',
            'failed' => 'Відхилено'
        ]
    ],
    'delivery_status' => [
        'editable' => [
            'not_sent' => 'true',
            'in_process' => '',
            'deliveried' => '',
            'canceled' => '',
            'returned' => '',
        ]
    ],
    'popup_colors' => [
        'success' => 'bg-green-500',
        'danger' => 'bg-red-500',
        'information' => 'bg-blue-500',
        'warning' => 'bg-yellow-500'
    ],
    'debug_colors' => [
        'DEBUG' => 'green-500',
        'INFO' => 'blue-500',
        'NOTICE' => 'purple-500',
        'WARNING' => 'yellow-500',
        'ERROR' => 'red-500',
        'CRITICAL' => 'pink-500',
        'ALERT' => 'black-500',
        'EMERGENCY' => 'white-500',
    ]
];
