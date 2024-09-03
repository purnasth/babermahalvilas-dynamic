<?php
/*
* Blog Post Lists
*/
if(defined('MAIN_PAGE')){
$res_post='';
ob_start();

$args = array( 'numberposts' => 6, 'post_status'=>"publish", 'post_type'=>"post", 'orderby'=>"post_date");
$postslist = get_posts( $args ); ?>
<div class="content-box row">
	<div class="widget-content">
		<ul id="latest_posts">
 		<?php foreach ($postslist as $post):  
 			setup_postdata($post); ?> 
			<li>
				<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" class="post-title"> <?php the_title(); ?></a>
                <div class="date"><?php the_date(); ?></div>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>
 <?php
$res_post = ob_get_clean();
$jVars['module:blog:post'] = $res_post;

/*
* Blog Tags Lists
*/
$res_tags='';

$tag_args = array( 'smallest' => 10, 'number' => 12, 'echo' => false);
$res_tags.= wp_tag_cloud($tag_args);

$jVars['module:blog:tags'] = $res_tags;
}
?> 