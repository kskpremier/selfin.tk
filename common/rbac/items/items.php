<?php
return [
    'manageKey' => [
        'type' => 2,
        'ruleName' => 'propertyOwner',
    ],
    'manageDoorLock' => [
        'type' => 2,
        'ruleName' => 'propertyOwner',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'manageKey',
            'manageDoorLock',
        ],
    ],
];
