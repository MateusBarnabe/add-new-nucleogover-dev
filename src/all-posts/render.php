<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

function limitText( $text, $limit ) {
    if ( strlen( $text ) > 100 ) {
        $newText = explode( ' ', substr( $text, $limit, 150 ), 50 );
        echo $text = substr( $text, 0, $limit ) . $newText[0] . "...";

        return;
    }
    echo $text;
}

$block_wrapper_attributes = get_block_wrapper_attributes();
$paged                    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$pageType                 = is_page() ? 'page' : 'paged';
$post                     = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'paged'          => $paged,
] );
?>
<section <?php echo $block_wrapper_attributes; ?>>
    <div class="header-post">
        <h2><b>TODAS AS NOTÍCIAS</b></h2>
    </div>
    <?php
    if ( $post->have_posts() ) {
        $count = 0;
        ?>
        <div class="post-pages" style="display: flex;">
            <?php
            while ( $post->have_posts() ) {
                $post->the_post();
                $count ++;
                ?>
                <a href="<?php the_permalink(); ?>">
                    <article class="post-page">
                        <?php if ( has_post_thumbnail() ) {
                            the_post_thumbnail();
                        } else {
                            echo "<div class='post-thumb'></div>";
                        } ?>
                        <div class="post-text">
                            <p style="font-size: 12px; color: #6DC94C"> <?php echo get_the_date(); ?> </p>
                            <h6><b><?php limitText( get_the_title(), 100 ); ?></b></h6>
                            <p><?php the_excerpt(); ?></p>
                        </div>
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
    if($post->max_num_pages > 1):
    ?>
    <div class="post-paginate">
        <?php
        echo '<div class="pagination">';
        $prev_link = get_previous_posts_page_link();
        $next_link = get_next_posts_page_link();

        if($paged === 1){
            echo '<span class="prev page-numbers">«</span>';
        }


        echo paginate_links( array(
            'show_all'  => false,
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'end_size'  => 1,
            'prev_next' => true,
            'prev_text' => __('«'),
            'next_text' => __('»'),
            'current'   => max( 1, get_query_var( 'paged' ) ),
            'total'     => $post->max_num_pages,
        ) );
        if($paged == $post->max_num_pages){
            echo '<span class="next page-numbers">»</span>';
        }
        echo '</div>';
        endif;
        ?>
    </div>
</section>
