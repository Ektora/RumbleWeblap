<?php
    declare(strict_types=1);


return[
    'families' => [
        'alliance' => [ 
            'displayName' => 'Alliance', 
            'family-type' => 'main-family', 
            'imageSrc' => '/assets/images/icons/alliance.png',
            'statueImageSrc' => ''
        ],
        'allianceundead' => [ 
            'displayName' => 'Alliance/Undead', 
            'family-type'=> 'split-family', 
            'imageSrc' => '/assets/images/icons/allianceundead.png',
            'statueImageSrc' => ''
        ],
        'beast' => [ 
            'displayName' => 'Beast', 
            'family-type'=> 'main-family', 
            'imageSrc' => '/assets/images/icons/beast.png',
            'statueImageSrc' => '' 
            ],
        'blackrock' => [ 
            'displayName' => 'Blackrock', 
            'family-type'=> 'main-family', 
            'imageSrc' => '/assets/images/icons/blackrock.png',
            'statueImageSrc' => ''
            ],
        'cenarion' =>  [ 
            'displayName' => 'Cenarion', 
            'family-type'=> 'main-family', 
            'imageSrc' => '/assets/images/icons/cenarion.png',
            'statueImageSrc' => ''
            ],
        'horde' => [ 
            'displayName' => 'Horde', 
            'family-type'=> 'main-family', 
            'imageSrc' => '/assets/images/icons/horde.png',
            'statueImageSrc' => ''
            ],
        'undead' => [ 
            'displayName' => 'Undead', 
            'family-type'=> 'main-family', 
            'imageSrc'  => '/assets/images/icons/undead.png',
            'statueImageSrc' => ''
            ],
        'undeadbeast' => [ 
            'displayName' => 'Undead/Beast', 
            'family-type'=> 'split-family', 
            'imageSrc' => '/assets/images/icons/undeadbeast.png',
            'statueImageSrc' => ''
            ]
    ],

    'types' => [
        'leader' => [
            'displayName' => 'Leader',
            'imageSrc' => '/assets/images/icons/leader.png'
        ],
        'troop' => [
            'displayName' => 'Troop', 
            'imageSrc' => '/assets/images/icons/troop.png'
        ],
        'spell' => [
            'displayName' => 'Spell',
            'imageSrc' => '/assets/images/icons/spell.png'
        ]
    ],

    'costs' => [
        0 => [
            'imageSrc' => '/assets/images/icons/value_0.png'
        ],
        1 => [ 
            'imageSrc' => '/assets/images/icons/value_1.png'
        ],
        2 => [
            'imageSrc' => '/assets/images/icons/value_2.png'
        ],
        3 => [
            'imageSrc' => '/assets/images/icons/value_3.png'
        ],
        4 => [ 
            'imageSrc' => '/assets/images/icons/value_4.png'
        ],
        5 => [
            'imageSrc' => '/assets/images/icons/value_5.png'
        ],
        6 => [
            'imageSrc' => '/assets/images/icons/value_6.png'
        ],
        7 => [ 
            'imageSrc' => '/assets/images/icons/value_7.png'
        ],
        8 => [
            'imageSrc' => '/assets/images/icons/value_8.png'
        ],
        9 => [
            'imageSrc' => '/assets/images/icons/value_9.png'
        ]
    ],

    'traits' => [
        'ambush' => [],
        'aoe' => [],
        'armored' => []
    ]
]

?>