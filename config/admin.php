<?php
return [
      'jqadm' => [
        'navbar' => [
            'swordbros'=>['swordbros/sardes', 'swordbros/slider']
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
            ],
        ],
    ],
	'jsonadm' => [
	],
];