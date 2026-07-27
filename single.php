<?php get_header(); ?>

<div class="l-single l-wrapper">
    <div class="p-single">

        <div class="c-breadcrumb-wrapper">
            <?php get_template_part('template-parts/navigation/breadcrumb'); ?>
        </div>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single__article'); ?>>
                    <h1 class="c-circle-title p-single__title"><?php echo esc_html(get_the_title()) ?></h1>
                    <p class="p-single__time">更新日： <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                    </p>
                    <div class="p-single__content">
                        <?php the_content(); ?>
                    </div>
                </article>

                <?php get_template_part('template-parts/navigation/post-nav'); ?>

        <?php endwhile;
        endif; ?>
    </div>

    <?php
    // 現在の投稿のカテゴリIDを取得
    $categories = get_the_category();
    $category_ids = array();
    if (! empty($categories)) {
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }
    }

    get_template_part('template-parts/components/sidebar', 'posts', array(
        'modifier'       => 'post',
        'title'          => 'Other Posts',
        'post_type'      => 'post',
        'category__in'   => $category_ids,
        'post__not_in'   => array(get_the_ID()),
        'posts_per_page' => 5,
    ));
    ?>

</div>


<?php get_footer(); ?>