<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

function limitText($text, $limit) {
    if (strlen($text) > 100){
        $newText = explode(' ', substr($text, $limit , 150), 50);
        echo $text = substr($text, 0, $limit) . $newText[0] . "...";
        return;
    }
    echo $text;
}
$block_wrapper_attributes = get_block_wrapper_attributes();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$pageType = is_page() ? 'page' : 'paged';
$post  = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'paged'          => $paged,
] );
?>
<section <?php echo $block_wrapper_attributes; ?>>
    <div class="header-post">
        <h2>ÚLTIMAS NOTÍCIAS</h2>
        <h1>VER TODAS AS NOTÍCIAS</h1>
    </div>
    <?php
    if ( $post->have_posts() ) {
        $count = 0;
        ?>
        <div class="post-pages" style="display: flex;">
            <?php
            while ( $post->have_posts() ) {
                $post->the_post();
                $count++;
                ?>
                <a href="<?php the_permalink(); ?>">
                    <article class="post-page">
                        <div class="post-thumb"><?php the_post_thumbnail(); ?></div>
                        <p> <?php echo get_the_date(); ?> </p>
                        <h2><?php limitText(get_the_title(), 100); ?></h2>
                    </article>
                </a>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        echo 'Nenhum post encontrado.';
    }

    $big = 99999;

    echo paginate_links( array(
        'show_all'  => false,
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'end_size'  => 2,
        'prev_next' => true,
        'prev_text' => '«',
        'next_text' => '»',
        'current'   => max( 1, get_query_var( 'paged' ) ),
        'total'     => $post->max_num_pages,
    ) );
    ?>
</section>
