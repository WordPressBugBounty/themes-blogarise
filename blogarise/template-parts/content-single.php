<?php
/**
 * The template for displaying the Single content.
 * @package Blogarise
 */
?>
<!--==================== breadcrumb section ====================-->
        <!--col-lg-->
        <?php $blogarise_single_page_layout = get_theme_mod('blogarise_single_page_layout','single-align-content-right');
        if($blogarise_single_page_layout == "single-align-content-left") { ?>
        	<aside class="col-lg-3">
            	<?php get_sidebar();?>
        	</aside>
        <?php } ?>

        <div class="<?php echo esc_attr($blogarise_single_page_layout == 'single-full-width-content' ? 'col-lg-12' : 'col-lg-9') ?>">
          <?php if(have_posts())
            {
          while(have_posts()) { the_post(); ?>
            <div class="bs-blog-post single"> 
              <div class="bs-header">
                <?php $blogarise_single_post_category = esc_attr(get_theme_mod('blogarise_single_post_category','true'));
                  if($blogarise_single_post_category == true){ ?>
                      <div class="bs-blog-category justify-content-start">
                        <?php blogarise_post_categories(); ?>
                      </div>
                <?php } ?>
                <h1 class="title">
                  <?php the_title(); ?>
                </h1>

                <div class="bs-info-author-block">
                  <div class="bs-blog-meta mb-0"> 
                  <?php $blogarise_single_post_admin_details = esc_attr(get_theme_mod('blogarise_single_post_admin_details','true'));
                  if($blogarise_single_post_admin_details == true){ ?>
                    <span class="bs-author"><a class="auth" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"> <?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?></a> <?php esc_html_e('By','blogarise'); ?>
                    <a class="ms-1" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></span>
                  <?php } ?>
                    
                    <?php $blogarise_single_post_date = esc_attr(get_theme_mod('blogarise_single_post_date','true'));
                    if($blogarise_single_post_date == true){ blogarise_date_content(); } ?>
                    <?php $blogarise_single_post_tag = esc_attr(get_theme_mod('blogarise_single_post_tag','true'));
                    if($blogarise_single_post_tag == true){
                    $tag_list = get_the_tag_list();
                    if($tag_list){ ?>
                    <span class="tag-links">
                      <a href="<?php the_permalink(); ?>"><?php the_tags("#" , ", #", ' ', ''); ?></a>
                    </span>
                    
                  <?php } } ?>
                  </div>
                </div>
              </div>
              <?php
              $single_show_featured_image = esc_attr(get_theme_mod('single_show_featured_image','true'));
              if($single_show_featured_image == true) {
                if(has_post_thumbnail()){
                  $thumbnail_id = get_post_thumbnail_id();
                  $caption = get_post($thumbnail_id)->post_excerpt;

                  if (!empty($caption)) {
                    echo '<a class="bs-blog-thumb caption" href="'.esc_url(get_the_permalink()).'">';
                    the_post_thumbnail( '', array( 'class'=>'img-fluid' ) );
                    echo '</a>';
                    
                    echo '<span class="featured-image-caption">' . esc_html($caption) . '</span>';
                  } else {
                    echo '<div class="bs-blog-thumb" href="'.esc_url(get_the_permalink()).'">';
                    the_post_thumbnail( '', array( 'class'=>'img-fluid' ) );
                    echo '</div>'; 
                  }

                } 
              } ?>
              <article class="small single">
                <?php the_content(); ?>
                <?php blogarise_edit_link(); ?>
                <?php  blogarise_social_share_post($post); ?>
                <div class="clearfix mb-3"></div>
                <?php
                  $prev =  (is_rtl()) ? " fa-angle-double-right" : " fa-angle-double-left";
                  $next =  (is_rtl()) ? " fa-angle-double-left" : " fa-angle-double-right";
                  the_post_navigation(array(
                      'prev_text' => '<div class="fa' .$prev.'"></div><span></span> %title ',
                      'next_text' => ' %title <div class="fa' .$next.'"></div><span></span>',
                      'in_same_term' => true,
                  ));
                  wp_link_pages(array(
                      'before' => '<div class="single-nav-links">',
                      'after' => '</div>',
                  ));
                ?>
              </article>
            </div>
          <?php }  
          
          do_action('blogarise_action_single_author_box');
          do_action('blogarise_action_single_related_box');

        } 
                  do_action('blogarise_action_single_comments_box'); 
                  ?>
      </div>

      <?php if($blogarise_single_page_layout == "single-align-content-right") { ?>
        <!--sidebar-->
            <!--col-lg-3-->
              <aside class="col-lg-3">
                    <?php get_sidebar();?>
              </aside>
            <!--/col-lg-3-->
        <!--/sidebar-->
      <?php } ?>