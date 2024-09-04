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
$page                     = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
$pageType                 = is_page() ? 'page' : 'paged';
$post                     = new WP_Query( [
    'post_type'           => 'post',
    'posts_per_page'      => 4,
    'paged'               => $page,
    'ignore_sticky_posts' => 1,
] );

?>
<section <?php echo $block_wrapper_attributes; ?>>
    <div class="header-post">
        <h2><b>ÚLTIMAS NOTÍCIAS</b></h2>
        <a href="/noticias" style="display: flex; gap: 12px; margin-right: 20px"><p><b>VER TODAS AS NOTÍCIAS </b></p>
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11 0H2C0.9 0 0 0.9 0 2V11C0 11.55 0.45 12 1 12C1.55 12 2 11.55 2 11V2H11C11.55 2 12 1.55 12 1C12 0.45 11.55 0 11 0ZM15 4H6C4.9 4 4 4.9 4 6V15C4 15.55 4.45 16 5 16C5.55 16 6 15.55 6 15V6H15C15.55 6 16 5.55 16 5C16 4.45 15.55 4 15 4ZM18 8H10C8.9 8 8 8.9 8 10V18C8 19.1 8.9 20 10 20H18C19.1 20 20 19.1 20 18V10C20 8.9 19.1 8 18 8Z"
                    fill="#6DC94C"/>
            </svg>
        </a>
    </div>
    <?php
    if ( $post->have_posts() ) {
        ?>
        <div class="post-pages" style="display: flex;">
            <?php
            while ( $post->have_posts() ) {
                $post->the_post();
                ?>
                <a href="<?php the_permalink(); ?>">
                    <article class="post-page">
                        <?php if ( has_post_thumbnail() ) {
                            the_post_thumbnail();
                        } else {
                            echo "<div class='post-thumb'></div>";
                        } ?>
                        <div class="post-text">
                            <p style="font-size: 12px"> <?php echo get_the_date(); ?> </p>
                            <h6><b><?php limitText( get_the_title(), 100 ); ?></b></h6>
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
    wp_reset_postdata();
    $big = 99999;
    if ( $post->max_num_pages > 1 ){
    ?>
    <div class="post-paginate">
        <?php
        echo '<div class="pagination">';

        if ( $page === 1 ) {
            echo '<span class="prev page-numbers">«</span>';
        }


        echo paginate_links( array(
            'show_all'  => false,
            'base'      => add_query_arg( 'page', '%#%' ),
            'format'    => '?page=%#%',
            'end_size'  => 1,
            'prev_text' => '«',
            'next_text' => '»',
            'current'   => max( 1, get_query_var( 'page' ) ),
            'total'     => $post->max_num_pages,
        ) );
        if ( $page == $post->max_num_pages ) {
            echo '<span class="next page-numbers">»</span>';
        }
        echo '</div>';
        }
        ?>
    </div>
</section>
