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
    ]
];
