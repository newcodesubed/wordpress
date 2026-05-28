<?php if(have_posts()): while(have_posts()): the_post();?>

<article class="customcars-post">
    
    <!-- Date & Meta Info -->
    <div class="post-meta-top">
        <span class="post-date"><?php echo get_the_date('l jS F, Y');?></span>
    </div>

    <?php
    $color = get_post_meta(get_the_ID(), 'color', true);
    if (!$color && function_exists('get_field')) {
        $color = get_field('color');
    }
    ?>

    <?php if (!empty($color)) : ?>
        <div class="post-color">
            <p class="color-label">Color: <strong><?php echo esc_html($color); ?></strong></p>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="post-content">
        <?php the_content();?>
    </div>

    <!-- Author Info -->
    <div class="post-author-info">
        <?php
        $Fname = get_the_author_meta('first_name');
        $Lname = get_the_author_meta('last_name');
        $fullName = $Fname . ' ' . $Lname;
        ?>
        <p class="author-label">Written by <strong><?php echo esc_html($fullName);?></strong></p>
    </div>

    <!-- Categories & Tags -->
    <div class="post-taxonomies">
        
        <!-- Categories -->
        <div class="post-categories">
            <?php
            $categories = get_the_category();
            if($categories && is_array($categories)):
                foreach ($categories as $category) :
            ?>
                    <a class="badge bg-primary text-decoration-none" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>   
            <?php
                endforeach; 
            endif;
            ?>
        </div>

        <!-- Tags -->
        <div class="post-tags">
            <?php
            $tags = get_the_tags();
            if($tags && is_array($tags)):
                foreach ($tags as $tag) :
            ?>
                    <a class="badge bg-success text-decoration-none" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                        <?php echo esc_html($tag->name); ?>
                    </a>
            <?php
                endforeach; 
            endif;
            ?>
        </div>
        <?php get_template_part('includes/form', 'enquiry'); ?>
        
    </div>

</article>

<?php endwhile; else: endif;?>                