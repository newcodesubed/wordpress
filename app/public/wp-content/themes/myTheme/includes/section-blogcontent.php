<?php if(have_posts()): while(have_posts()): the_post();?>
    <p>

        <?php echo get_the_date('l jS F, Y');?>
    </p> 
<?php the_content();?>
<?php
$Fname = get_the_author_meta('first_name');
$Lname = get_the_author_meta('last_name');
$fullName = $Fname . ' ' . $Lname;
?>
<p>Written by <?php echo $fullName;?></p>

<?php
$tags = get_the_tags();
if($tags):
    foreach ($tags as $tag) :
?>
        <a class="badge bg-success text-decoration-none" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
            <?php echo esc_html($tag->name); ?>
        </a>
<?php
    endforeach; endif;
?>

<?php
$categories = get_the_category();
if($categories):
    foreach ($categories as $category) :
?>
        <a class="badge bg-primary text-decoration-none" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
            <?php echo esc_html($category->name); ?>
        </a>   
<?php
    endforeach; endif;
?>
<?php endwhile; else: endif;?>                