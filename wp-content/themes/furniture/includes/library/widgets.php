<?php
//--------------- sidebar widgets ---------------
class SH_Recent_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Recent_Posts', /* Name */esc_html__('Blog Recent Posts ','furniture'), array( 'description' => esc_html__('New items with images', 'furniture' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);
		
		echo balanceTags($before_title.$title.$after_title); 
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=post';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		query_posts( $query_string ); 
	
		$this->posts();
		wp_reset_query(); 
		
		echo balanceTags($after_widget);
	}
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Posts', 'furniture');
		$number = ( $instance ) ? esc_attr($instance['number']) : 4;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'furniture'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'furniture'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
       
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'furniture'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'furniture'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
        
		<?php 
	}
	
	function posts()
	{
		if( have_posts() ):?>
        <?php $count = 0; ?>
        
        <div class="row m0 latestPosts">
		
		  <?php while( have_posts() ): the_post(); ?>
			
			<div class="media latestPost">
				<div class="media-left">
					<a href="<?php the_permalink();?>">
						<?php the_post_thumbnail('65x65');?>
					</a>
				</div>
				<div class="media-body">
					<h5 class="heading"><?php the_title();?></h5>
					<p><?php echo get_the_date('M d, Y');?></p>
				</div>
			</div>
		
		<?php endwhile;?>
	
	</div>
            
		<?php endif;
    }
}

// Flicker Gallery
class SH_Flickr extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Flickr', /* Name */esc_html__('Furniture Flickr Feed','furniture'), array( 'description' => esc_html__('Fetch the latest feed from Flickr', 'furniture' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		$flickr_id = $instance['flickr_id'];
		$number = $instance['number'];
	
		echo balanceTags($before_widget);
		wp_enqueue_script('flicker-script');
		$limit = ( $number ) ? $number : 6;?>
            <div class="row m0 flickrPhoto">
             	<?php echo balanceTags($before_title.$title.$after_title);?>               
				<ul class="list-inline flickr flickr-images">
					<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('.flickr-images').jflickrfeed({
							limit: <?php echo esc_js($limit);?> ,
							qstrings: {id: '<?php echo esc_js($flickr_id); ?>'},
							itemTemplate: '<li><a href="{{link}}" title="{{title}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
						});
					});
               		</script>
				
				</ul>
			</div> <!--Shortcode Element-->
			<?php
			
		echo balanceTags($after_widget);
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);

		$instance['flickr_id'] = $new_instance['flickr_id'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Flicker', 'furniture');
		$flickr_id = ($instance) ? esc_attr($instance['flickr_id']) : '52617155@N08';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;?>
		  
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php esc_html_e('Title:', 'furniture');?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" type="text" value="<?php echo esc_attr($title);?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('flickr_id'));?>"><?php esc_html_e('Flickr ID:', 'furniture');?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_id'));?>" name="<?php echo esc_attr($this->get_field_name('flickr_id'));?>" type="text" value="<?php echo esc_attr($flickr_id);?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number'));?>"><?php esc_html_e('Number of Images:', 'furniture');?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number'));?>" name="<?php echo esc_attr($this->get_field_name('number'));?>" type="text" value="<?php echo esc_attr($number);?>" />
        </p>
        <?php 
	}
}

//---------------------Footer Widgets--------------------------

class SH_Foot_Features extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Foot_Features', /* Name */esc_html__('Foot Features','furniture'), array(      'description' => esc_html__('Foot Feature widget ', 'furniture' )) );
	}
	
	/** @see WP_Widget::widget */
    
	 function widget($args, $instance)
	 {
	    extract( $args );
		echo balanceTags($before_widget);
		//$title = apply_filters( 'widget_title', $instance['title'] );
		
		//echo balanceTags($before_title.' '.$title.$after_title);?>
			
		<div class="media">
				<div class="media-left icon">
				
					<?php $img_url =  esc_url($instance['logo_url']);
						  $img2_size = @getimagesize(esc_url($img_url)); 
					?>
					
					<img src="<?php echo esc_url($instance['logo_url']);?>" alt="<?php esc_html_e('image', 'furniture'); ?>" width="<?php echo sh_set( $img2_size, 0 ); ?>" height="<?php echo sh_set( $img2_size, 1 ); ?>">
				</div>
				<div class="media-body texts">
					<h4><?php echo balanceTags($instance['heading1']);?></h4>
					<h2><?php echo balanceTags($instance['heading2']);?></h2>
				</div>
		</div>
		
		<?php echo balanceTags($after_widget);
		
		 
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['logo_url'] = $new_instance['logo_url'];
		$instance['heading1'] = $new_instance['heading1'];
		$instance['heading2'] = $new_instance['heading2'];
		
		return $instance;
	}
	
	 function form($instance)
	{

		$logo_url = ( $instance ) ? esc_attr($instance['logo_url']) : '';
		$heading1 = ( $instance ) ? esc_attr($instance['heading1']) :  esc_html__('free shipping', 'furniture');
		$heading2 = ( $instance ) ? esc_attr($instance['heading2']) : esc_html__('International', 'furniture');?>
		
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('logo_url')); ?>"><?php esc_html_e('Icon Url: ', 'furniture'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_url')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_url')); ?>" type="text" value="<?php echo esc_attr($logo_url); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('heading1')); ?>"><?php esc_html_e('Enter Heading 1:', 'furniture'); ?></label>
            <textarea id="<?php echo esc_attr($this->get_field_id('heading1')); ?>" class='widefat' name='<?php echo esc_attr($this->get_field_name('heading1')); ?>' rows="5" cols="5">
				<?php echo esc_textarea($heading1); ?>
			</textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('heading2')); ?>"><?php esc_html_e('Enter Heading 2:', 'furniture'); ?></label>
            <textarea id="<?php echo esc_attr($this->get_field_id('heading2')); ?>" class='widefat' name='<?php echo esc_attr($this->get_field_name('heading2')); ?>' rows="5" cols="5">
				<?php echo esc_textarea($heading2); ?>
			</textarea>
        </p>
       
        <?php 
	}
}

class SH_About_Us extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_About_Us', /* Name */esc_html__('About us ','furniture'), array(      'description' => esc_html__('About us widget ', 'furniture' )) );
	}
	
	/** @see WP_Widget::widget */
    
	 function widget($args, $instance)
	 {
	    extract( $args );
		echo balanceTags($before_widget);
		$title = apply_filters( 'widget_title', $instance['title'] );
		?>
			
		<div class="row m0">
			<?php echo balanceTags($before_title.$title.$after_title); ?>
			<p><?php echo balanceTags($instance['box_text']);?></p>
			<?php if( sh_set($instance, 'showSocial') ): ?>
			<ul class="list-inline">
				<?php echo sh_get_social_icons(); ?>
			</ul>
			<?php endif; ?>
		</div>
		
		<?php echo balanceTags($after_widget);
		
		 
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['box_text'] = $new_instance['box_text'];
		$instance['showSocial'] = $new_instance['showSocial'];
		
		return $instance;
	}
	
	 function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('About us', 'furniture');
		$box_text = ( $instance ) ? esc_attr($instance['box_text']) :  esc_html__('Enter text', 'furniture');
		$showSocial = ( $instance ) ? esc_attr($instance['showSocial']) : '';?>
		
		 <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'furniture'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('box_text')); ?>"><?php esc_html_e('Enter the text:', 'furniture'); ?></label>
            
            <textarea id="<?php echo esc_attr($this->get_field_id('box_text')); ?>" class='widefat' name='<?php echo esc_attr($this->get_field_name('box_text')); ?>' rows="5" cols="5">
				<?php echo esc_textarea($box_text); ?>
			</textarea>
        </p>
       
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('showSocial')); ?>"><?php esc_html_e('Show Social icons', 'furniture'); ?></label>
            <input class="widefat" <?php checked($instance['showSocial'], 'true');?> id="<?php echo esc_attr( $this->get_field_id('showSocial') ); ?>" name="<?php echo esc_attr( $this->get_field_name('showSocial') ); ?>" type="checkbox" value="true" />
        </p>
        
		<?php 
	}
} 

// Subscribe to our mailing list
class SH_feedburner extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_subscribe_mail_list', /* Name */esc_html__('Furniture Subscribe','furniture'), array( 'description' => esc_html__('create account on http://feedburner.com and allow users to subscribe', 'furniture' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);?>
        
        <div class="row m0">
		
		<?php echo balanceTags($before_title . $title . $after_title) ; ?>
			
			<form target="popupwindow" method="post" id="subscribe" action="http://feedburner.google.com/fb/a/mailverify" accept-charset="utf-8" class="newsletter_form">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" name="email" value="" id="email" placeholder="<?php esc_html_e("EMAIL ADDRESS" , 'furniture') ; ?>">
					<input type="hidden" id="uri" name="uri" value="<?php echo esc_attr($instance['ID']); ?>">
					<input type="hidden" value="en_US" name="loc">
				</div>
				<input type="submit" class="form-control" value="<?php esc_html_e("Subscribe" , 'furniture'); ?>" id="submit" name="submit">
			</form>
		
		</div>
		
		<?php
		
		echo balanceTags($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['ID'] = $new_instance['ID'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Subscribe to Our Mailing List', 'furniture');
		$ID = ($instance) ? esc_attr($instance['ID']) : 'themeforest';
		?>    
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'furniture'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
       
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('ID')); ?>"><?php esc_html_e('Feedburner ID:', 'furniture'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('ID')); ?>" name="<?php echo esc_attr($this->get_field_name('ID')); ?>" type="text" value="<?php echo esc_attr($ID); ?>" />
        </p>
		<?php 
	}
}