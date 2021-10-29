<?php

return [
    'theme'       => env('CMS_THEME', 'default'),           // Theme used by the CMS
    'minify'      => env('CMS_HTML_MINIFY', false),         // HTML must be minified ?
    'title'       => [
        'prepend' => env('CMS_TITLE_PREPEND', ''),          // Text prepend to meta title
        'append'  => env('CMS_TITLE_APPEND', ''),           // Text append to meta title
    ],
    'og:image'    => env('CMS_OG_IMAGE', ''),               // Opengraph image
    'front_edit_button' => true,                            // Display an edit button on front (if has permission)
    'paginator_bootstrap' => true,                          // Use Bootstrap paginator instead of Tailwind (search widget)
    'fontawesome' => false,                                 // Enable Font Awesome button for TinyMCE
    'icons' => [                                            // FontAwesome icons sets
        'brands'  => true,
        'solid'   => true,
        'regular' => true,
    ],
];
