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
    'posts_per_page' => 4,
    'paged'          => $paged,
] );
?>
<section <?php echo $block_wrapper_attributes; ?>>
    <div class="header-post">
        <h2><b>MAIS NOTÍCIAS</b></h2>
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
                            <h6><b><?php limitText( get_the_title(), 100 ); ?></b></h6>
                            <div class="post-tags">
                                <p style="font-size: 12px"> <?php echo get_the_date(); ?> </p>
                                <p ></p>
                            </div>
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
    ?>
    <a href="/noticias"><h1 class="see-more"><b>VER MAIS NOTÍCIAS</b></h1></a>
</section>
