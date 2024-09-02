<?php
namespace blocks;

class scripts {

    public static function register_blocks() {
        $blocks = [
            "post-list",
        ];
        foreach ( $blocks as $value ) {
            wp_register_script(
                'testeNucleo-' . $value . '-editor-script',
                get_template_directory_uri() . '/build/' . $value . '/index.js',
                array( 'wp-blocks', 'wp-element', 'wp-editor' ),
                filemtime( get_template_directory() . '/build/' . $value . '/index.js' )
            );
            wp_register_script(
                'testeNucleo-' . $value . '-view-script',
                get_template_directory_uri() . '/build/' . $value . '/view.js',
                array( 'wp-blocks', 'wp-element', 'wp-editor' ),
                filemtime( get_template_directory() . '/build/' . $value . '/view.js' )
            );
            wp_register_style(
                'testeNucleo-' . $value . '-editor-style',
                get_template_directory_uri() . '/build/' . $value . '/index.css',
                array( 'wp-edit-blocks' ),
                filemtime( get_template_directory() . '/build/' . $value . '/index.css' )
            );
            wp_register_style(
                'testeNucleo-' . $value . '-view-style',
                get_template_directory_uri() . '/build/' . $value . '/style-index.css',
                array( 'wp-edit-blocks' ),
                filemtime( get_template_directory() . '/build/' . $value . '/style-index.css' )
            );
            register_block_type( get_template_directory() . '/build/' . $value, array(
                'editor_script'   => 'testeNucleo-' . $value . '-editor-script',
                'editor_style'    => 'testeNucleo-' . $value . '-editor-style',
                'style'           => 'testeNucleo-' . $value . '-view-style',
                'view_script'     => 'testeNucleo-' . $value . '-view-script',
            ) );
        }
    }
    public function limitText($text, $limit = 80){
        if (strlen($text) > $limit) {
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text . '...';
        }
        return $text;
    }

}
