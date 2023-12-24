<?php

return [
  'enabled' => [
    'users-management' => true,
    'media-library' => true,
    'file-library' => true,
    'block-editor' => true,
    'buckets' => true,
    'users-image' => true,
    'settings' => true,
    'dashboard' => true,
    'search' => true,
    'users-description' => false,
    'activitylog' => false,
    'users-2fa' => false,
    'users-oauth' => false,
    'permissions-management' => false,
  ],
  'dashboard' => [
    'modules' => [
      'App\Models\Page' => [
        // module name if you added a morph map entry for it, otherwise FQN of the model (eg. App\Models\Project)
        'name' => 'pages', // module name
        'label' => 'Seiten', // optional, if the name of your module above does not work as a label
        'label_singular' => 'Seite', // optional, if the automated singular version of your name/label above does not work as a label
        'count' => true, // show total count with link to index of this module
        'create' => true, // show link in create new dropdown
        'activity' => true, // show activities on this module in activities list
        'draft' => true, // show drafts of this module for current user
        'search' => false, // show results for this module in global search
      ],
    ],
  ],
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
      'event' => [
        'mobile' => [
          [
            'name' => 'Mobile',
            'ratio' => 1,
          ],
        ],
        'desktop' => [
          [
            'name' => 'Desktop',
            'ratio' => 8 / 9,
          ],
        ],
      ],
      'event_map' => [
        'mobile' => [
          [
            'name' => 'Mobile',
            'ratio' => 1,
          ],
        ],
        'desktop' => [
          [
            'name' => 'Desktop',
            'ratio' => 16 / 5,
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
