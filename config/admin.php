<?php

return [
      'jqadm' => [
        'navbar' => [
            'swordbros'=>['swordbros/sardes', 'swordbros/slider', 'swordbros/blog']
         ],
        'resource' =>[
            'swordbros' => [
                'groups' => ['admin', 'editor', 'super'],
                'sardes' =>[
                    'groups' => ['admin', 'editor', 'super'],
                    'key' => 'SF',
                ],
                'slider' =>[
                    'groups' => ['admin', 'editor', 'super'],
                    'key' => 'SS',
                ],
                'blog' =>[
                    'groups' => ['admin', 'editor', 'super'],
                    'key' => 'SB',
                ],
            ],
        ],
    ],
	'jsonadm' => [
	],
];