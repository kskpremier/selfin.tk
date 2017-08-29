<?php
return [
    'createDoorLock' => [
        'type' => 2,
        'description' => 'Create a DoorLock',
    ],
    'updateDoorLock' => [
        'type' => 2,
        'description' => 'Update DoorLock',
    ],
    'deleteDoorLock' => [
        'type' => 2,
        'description' => 'Delete DoorLock',
    ],
    'createBooking' => [
        'type' => 2,
        'description' => 'Create a Booking',
    ],
    'updateBooking' => [
        'type' => 2,
        'description' => 'Update Booking',
    ],
    'deleteBooking' => [
        'type' => 2,
        'description' => 'Delete Booking',
    ],
    'createEKey' => [
        'type' => 2,
        'description' => 'Create a E-key',
    ],
    'updateEKey' => [
        'type' => 2,
        'description' => 'Update EKey',
    ],
    'deleteEKey' => [
        'type' => 2,
        'description' => 'Delete EKey',
    ],
    'createKeyboardPwd' => [
        'type' => 2,
        'description' => 'Create a KeyboardPwd',
    ],
    'updateKeyboardPwd' => [
        'type' => 2,
        'description' => 'Update KeyboardPwd',
    ],
    'deleteKeyboardPwd' => [
        'type' => 2,
        'description' => 'Delete KeyboardPwd',
    ],
    'createPhotoImage' => [
        'type' => 2,
        'description' => 'Create a Photo-Image',
    ],
    'updatePhotoImage' => [
        'type' => 2,
        'description' => 'Update Photo-Image',
    ],
    'deletePhotoImage' => [
        'type' => 2,
        'description' => 'Delete Photo-Image',
    ],
    'receptionist' => [
        'type' => 1,
        'children' => [
            'createDoorLock',
            'updateDoorLock',
            'createKeyboardPwd',
            'deleteKeyboardPwd',
            'updateKeyboardPwd',
            'createEKey',
            'deleteEKey',
            'updateEKey',
            'createBooking',
            'updateBooking',
            'deleteBooking',
        ],
    ],
    'tourist' => [
        'type' => 1,
        'children' => [
            'createPhotoImage',
            'createKeyboardPwdByTourist',
            'createEKeyByTourist',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'deleteDoorLock',
            'receptionist',
            'tourist',
        ],
    ],
    'createKeyboardPwdByTourist' => [
        'type' => 2,
        'description' => 'Tourist can create Keyboard password for period of staying',
        'ruleName' => 'isLiving',
        'children' => [
            'createKeyboardPwd',
        ],
    ],
    'createEKeyByTourist' => [
        'type' => 2,
        'description' => 'Tourist can create E-Key for period of staying',
        'ruleName' => 'isLiving',
        'children' => [
            'createEKey',
        ],
    ],
];
