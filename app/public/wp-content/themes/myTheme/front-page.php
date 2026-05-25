<?php get_header();?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Welcome to My Theme</h1>
            <p>This is the front page of my custom WordPress theme.</p>
        </div>
    </div>
    <h1><?php the_title(); ?></h1>

    <?php get_template_part('includes/section', 'content'); ?>
</div>
<?php get_footer();?>
