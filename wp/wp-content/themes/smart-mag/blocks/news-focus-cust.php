<?php
// danzi.tn@20140401 news_focus_cust
/**
 * Tag or category taxonomy?
 */
$is_tag = $is_cat = false;

if (!empty($cat)) {
	 
	// get latest from the specified category
	$is_cat = true;
	$taxonomy = is_numeric($cat) ? get_category(intval($cat)) : get_category_by_slug($cat);
	
	$link = get_category_link($taxonomy);
}
else if (!empty($tax_tag)) {
	
	$is_tag = true;
	$taxonomy = get_term_by('slug', $tax_tag, 'post_tag');
	
	$link = get_term_link($taxonomy, 'post_tag');
}

/**
 * Setup Main Query
 */
$query_args = array(
	'posts_per_page' => (!empty($posts) ? intval($posts) : 5), 
	'order' => ($sort_order == 'asc' ? 'asc' : 'desc')
);

if ($sort_by == 'modified') {
	$query_args['orderby'] = 'modified';
}
else if ($sort_by == 'random') {
	$query_args['orderby'] = 'rand';
}

// main query
$query = new WP_Query(array_merge($query_args, array(($is_tag ? 'tag' : 'category_name') => $taxonomy->slug)));	

// check if it exists
if (!is_object($taxonomy)) {
	return;
}

if (empty($title)) {
	$title = $taxonomy->name;
}

$highlights = (empty($highlights) ? 1 : intval($highlights));

/**
 * Setup sub-categories to display
 */

// selected sub-cats?
if (!empty($sub_cats)) {
	$sub_cats = get_categories(array('include' => $sub_cats, 'hierarchical' => false));
}
// entered sub tags instead?
else if (!empty($sub_tags)) {
	$sub_cats = array();
	
	foreach ((array) explode(',', $sub_tags) as $_tag) {
		array_push($sub_cats, get_term_by('slug', $_tag, 'post_tag'));
	}
}
else {  
	// empty, default to child sub categories
	$sub_cats = get_categories(array('child_of' => $taxonomy->cat_ID, 'number' => 3, 'hierarchical' => false));
}

?>

<section class="news-focus">

	<div class="section-head heading cat-<?php echo $taxonomy->term_id; ?>">
		<a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>"><?php echo esc_html($title); ?></a>
	
		<?php if (count($sub_cats)): ?>
		<ul class="subcats">

			<li><a href="#" class="active" data-id="0"><?php _e('All', 'bunyad'); ?></a></li>
			
			<?php foreach ($sub_cats as $cat): ?>
				<li><a href="#" data-id="<?php echo $cat->term_id; ?>"><?php echo esc_html($cat->name); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>
	
	<?php 
	
	foreach (array_merge(array($taxonomy), $sub_cats) as $key => $sub_cat): 

		$count = $id = 0;
	
		
		if ($key !== 0) {
			
			if ($sub_cat->taxonomy == 'post_tag') {
				$query = new WP_Query(array_merge($query_args, array('tag' => $sub_cat->slug)));
			}
			else {
				$query = new WP_Query(array_merge($query_args, array('category_name' => $sub_cat->slug)));
			}
			
			$id = $sub_cat->term_id;
		}
		
	?>
	
	<div class="row news-<?php echo $id; ?> highlights">

		<ul class="cust-left column half block posts-list thumb">
		<?php while ($query->have_posts()): $query->the_post();  $count++; ?>
		
			<?php if($count % 2 == 0): ?>
			
				<li>				
				
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-thumbnail', array('title' => strip_tags(get_the_title()))); ?>

					<?php if (class_exists('Bunyad') && Bunyad::options()->review_show_widgets): ?>
						<?php echo apply_filters('bunyad_review_main_snippet', ''); ?>
					<?php endif; ?>
					
					</a>
					
					<div class="content">

						<?php 
							/* $category = current(get_the_category());
						
						<span class="cat-title cat-<?php echo $category->cat_ID; ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></span>
						
						*/ ?>

						<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP'); ?>"><?php echo get_the_date(); ?> </time>

					
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
							<?php if (get_the_title()) the_title(); else the_ID(); ?></a>
																	
					</div>			
					
				</li>
			<?php endif; ?>
		<?php endwhile; ?>
		</ul>
		
		<?php wp_reset_query(); $count=0; ?>
		
		<ul class="column half block posts-list thumb">

		<?php while ($query->have_posts()): $query->the_post();  $count++; ?>
		
			<?php if($count % 2 == 1): ?>
			
				<li>				
				
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-thumbnail', array('title' => strip_tags(get_the_title()))); ?>

					<?php if (class_exists('Bunyad') && Bunyad::options()->review_show_widgets): ?>
						<?php echo apply_filters('bunyad_review_main_snippet', ''); ?>
					<?php endif; ?>
					
					</a>
					
					<div class="content">

						<?php 
							/* $category = current(get_the_category());
						
						<span class="cat-title cat-<?php echo $category->cat_ID; ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></span>
						
						*/ ?>

						<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP'); ?>"><?php echo get_the_date(); ?> </time>

					
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
							<?php if (get_the_title()) the_title(); else the_ID(); ?></a>
																	
					</div>			
					
				</li>
			<?php endif; ?>
		<?php endwhile; ?>
		
		</ul>
			
		<?php wp_reset_query(); ?>
		
	</div>
	
	<?php endforeach; ?>
		
</section>