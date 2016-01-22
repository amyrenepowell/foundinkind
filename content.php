<?php
    $post_format 	= get_post_format();
    $slider_id 		= rand(100,10000);
    $postClass 		= et_post_class();
    $read_more 		= et_get_read_more();
    $post_content 	= get_the_content( $read_more );
    $gallery_filter = et_gallery_from_content( $post_content );
	$lightbox = etheme_get_option('blog_lightbox');
	$postId = get_the_ID();
?>

<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>" >
	<div>
		<?php if($post_format == 'gallery'): ?>
            <?php if(count($gallery_filter['ids']) > 0): ?>
                <div class="nav-type-small<?php if (count($gallery_filter['ids'])>1): ?> images-slider<?php endif; ?> slider_id-<?php echo $slider_id; ?>">
                    <?php foreach($gallery_filter['ids'] as $attach_id): ?>
                        <div>
                            <?php echo wp_get_attachment_image($attach_id, 'large'); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
    
                <script type="text/javascript">
                	<?php et_owl_init( '.slider_id-' . $slider_id ); ?>
                </script>
            <?php endif; ?>
	    
		<?php elseif(has_post_thumbnail()): ?>
			<!-- this is where the thumbnail went. removed by request -->
		<?php endif; ?>
	    
		<?php if($post_format != 'quote'): ?>
	
			<h3 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php et_byline( array( 'author' => 1 ) ); ?>
			
	    <?php endif; ?>
	
	    <?php if($post_format != 'gallery'): ?>
	        <div class="post-description entry-content">
                <?php the_content($read_more); ?>
	        </div>
	    <?php elseif($post_format == 'gallery'): ?>
	        <div class="post-description ">
	            <?php echo $gallery_filter['filtered_content']; ?>
	        </div>
	    <?php endif; ?>

    </div>
    <div class="clear"></div>
</article>