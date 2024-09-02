<?php

require 'themes/scripts.php';

class Aplication {
    // protected $type = 'theme';
    // protected $app_root = NW_THEME_PATH;

    public function init_setups() {
        add_action('init', ['blocks\scripts', 'register_blocks']);
    }

    public function __construct() {
        $this->init_setups();
    }

}
new Aplication();
