<?php

if (!function_exists('themes_dir')) {
    exit(1);
}

return function () {
    $nome = 'testeNucleo';

    return [
        'name'      => $nome,
        'type'      => 'theme',
        'repo_name' => $nome,
        'local'     => themes_dir( $nome ),
        'archive'   => [
            'channel'      => 'default',
            'run_composer' => true,
            'run_js_build' => true,
        ],
    ];
};
