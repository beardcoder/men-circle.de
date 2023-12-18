<?php

return [
  'block_editor' => [
    'use_twill_blocks' => [],
    'crops' => [
      'tool_image' => [
        'default' => [
          [
            'name' => 'default',
            'ratio' => 1 / 1,
          ],
        ],
      ],
      'cover' => [
        'mobile' => [
          [
            'name' => 'mobile',
            'ratio' => 1,
          ],
        ],
        'flexible' => [
          [
            'name' => 'free',
            'ratio' => 0,
          ],
          [
            'name' => 'landscape',
            'ratio' => 16 / 9,
          ],
          [
            'name' => 'portrait',
            'ratio' => 3 / 5,
          ],
        ],
      ],
      'flexible' => [
        [
          'name' => 'free',
          'ratio' => 0,
        ],
        [
          'name' => 'landscape',
          'ratio' => 16 / 9,
        ],
        [
          'name' => 'portrait',
          'ratio' => 3 / 5,
        ],
      ],
      'hero' => [
        'desktop' => [
          [
            'name' => 'desktop',
            'ratio' => 16 / 9,
          ],
        ],
        'mobile' => [
          [
            'name' => 'mobile',
            'ratio' => 1,
          ],
        ],
      ],
    ],
  ],
];
