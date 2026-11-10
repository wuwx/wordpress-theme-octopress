<?php get_header(); ?>
<div>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article class="hentry" role="article">

        <header>
            <h1 class="entry-title"><?php the_title();?></h1>
            <p class="meta">
                <time datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>" pubdate data-updated="true"><?php the_time('F jS, Y') ?></time>
                | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
            </p>
        </header>

        <div class="entry-content">
            <?php the_content();?>
            <?php wp_link_pages(); ?>
        </div>

        <footer>
            <p class="meta">
                <span class="byline author vcard">Posted by <span class="fn"><?php the_author();?></span></span>
                <time datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>" pubdate data-updated="true"><?php the_time('F jS, Y') ?></time>
                    <span class="categories">
                        <?php the_category(', '); ?>
                    </span>
            </p>
            <p class="meta sharing">
                <?php previous_post_link('上一篇： %link'); ?>
                <?php next_post_link('下一篇： %link'); ?>
            </p>
        </footer>
    </article>

    <section>
        <?php comments_template( '', true ); ?>
    </section>

    <?php endwhile; else: ?>
    <article class="hentry" role="article">
        <?php _e('Sorry, no posts matched your criteria.'); ?>
    </article>
    <?php endif; ?>
</div>

<?php get_sidebar();?>

<?php get_footer();?>