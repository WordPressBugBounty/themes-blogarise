<?php if (!function_exists('blogarise_main_content')) :
    function blogarise_main_content(){ 
        
        $blogarise_content_layout = esc_attr(get_theme_mod('blogarise_content_layout','align-content-right'));
        if($blogarise_content_layout == "align-content-left" || $blogarise_content_layout == "grid-left-sidebar") { ?>
            <!--col-lg-4-->
            <aside class="col-lg-4 sidebar-left">
                <?php get_sidebar();?>
            </aside>
            <!--/col-lg-4-->
        <?php } ?>
            <!--col-lg-8-->
        <?php if($blogarise_content_layout == "align-content-right" || $blogarise_content_layout == "align-content-left"){ ?>
            <div class="col-lg-8 content-right">
                <?php get_template_part('template-parts/content', get_post_format()); ?>
            </div>
        <?php } elseif($blogarise_content_layout == "full-width-content") { ?>
            <div class="col-lg-12 content-full">
                <?php get_template_part('template-parts/content', get_post_format()); ?>
            </div>
        <?php }  if($blogarise_content_layout == "grid-left-sidebar" || $blogarise_content_layout == "grid-right-sidebar"){ ?>
            <div class="col-lg-8 content-right">
                <?php get_template_part('content','grid'); ?>
            </div>
        <?php } elseif($blogarise_content_layout == "grid-fullwidth") { ?>
            <div class="col-lg-12 content-full">
                <?php get_template_part('content','grid'); ?>
            </div>
        <?php } ?>
            <!--/col-lg-8-->
        <?php if($blogarise_content_layout == "align-content-right" || $blogarise_content_layout == "grid-right-sidebar") { ?>
            <!--col-lg-4-->
            <aside class="col-lg-4 sidebar-right">
                <?php get_sidebar();?>
            </aside>
            <!--/col-lg-4-->
        <?php }        
    }
endif;
add_action('blogarise_action_main_content_layouts', 'blogarise_main_content', 40);


if (!function_exists('blogarise_single_author_box')) :
    function blogarise_single_author_box() { 

        $blogarise_enable_single_admin_details = esc_attr(get_theme_mod('blogarise_enable_single_admin_details',true));
        if($blogarise_enable_single_admin_details == true) { ?> 
        <div class="bs-info-author-block py-4 px-3 mb-4 flex-column justify-content-center text-center">
            <a class="bs-author-pic mb-3" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?></a>
            <div class="flex-grow-1">
              <h4 class="title"><?php esc_html_e('By','blogarise'); ?> <a href ="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></h4>
              <p><?php the_author_meta( 'description' ); ?></p>
            </div>
        </div>
        <?php }
    }
endif;
add_action('blogarise_action_single_author_box', 'blogarise_single_author_box', 40);

if (!function_exists('blogarise_single_related_box')) :
    function blogarise_single_related_box() {
        $blogarise_enable_related_post = esc_attr(get_theme_mod('blogarise_enable_related_post','true'));
        $blogarise_enable_single_post_category = get_theme_mod('blogarise_enable_single_post_category','true');
        $blogarise_enable_single_post_date = get_theme_mod('blogarise_enable_single_post_date','true');
        if($blogarise_enable_related_post == true){ ?>
            <div class="py-4 px-3 mb-4 bs-card-box bs-single-related">
                <!--Start bs-realated-slider -->
                <!-- bs-sec-title -->
                <div class="bs-widget-title  mb-3">
                    <?php $blogarise_related_post_title = get_theme_mod('blogarise_related_post_title', esc_html__('Related Post','blogarise'))?>
                    <h4 class="title"><?php echo esc_html($blogarise_related_post_title);?></h4>
                </div>
                <!-- // bs-sec-title -->
                <div class="related-post">
                    <div class="row">
                        <!-- featured_post -->
                        <?php global $post;
                        $categories = get_the_category($post->ID);
                        $number_of_related_posts = 3;

                        if ($categories) {
                            $cat_ids = array();
                            foreach ($categories as $category) $cat_ids[] = $category->term_id;
                            $args = array(
                                'category__in' => $cat_ids,
                                'post__not_in' => array($post->ID),
                                'posts_per_page' => $number_of_related_posts, // Number of related posts to display.
                                'ignore_sticky_posts' => 1
                            );
                            $related_posts = new wp_query($args);
                            while ($related_posts->have_posts()) {
                                $related_posts->the_post();
                                global $post;
                                $url = blogarise_get_freatured_image_url($post->ID, 'blogarise-featured');
                                ?>
                                <!-- blog -->
                                <div class="col-md-4">
                                  <div class="bs-blog-post three md back-img bshre mb-md-0" <?php if(has_post_thumbnail()) { ?> style="background-image: url('<?php echo esc_url($url); ?>');" <?php } ?>>
                                    <a class="link-div" href="<?php the_permalink(); ?>"></a>
                                    <div class="inner">
                                        <?php if($blogarise_enable_single_post_category == true) { blogarise_post_categories(); } 
                                        $blogarise_enable_single_post_admin_details = esc_attr(get_theme_mod('blogarise_enable_single_post_admin_details','true')); ?>
                                        <h4 class="title sm mb-0"> 
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ','after'  => '') ); ?>">
                                                <?php the_title(); ?>
                                            </a> 
                                        </h4>
                                      <div class="bs-blog-meta">
                                        <?php if($blogarise_enable_single_post_admin_details == true) { blogarise_author_content(); }
                                        if($blogarise_enable_single_post_date == true) { blogarise_date_content(); } ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- blog -->
                            <?php }
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <!--End bs-realated-slider -->
        <?php }
    }
endif;
add_action('blogarise_action_single_related_box', 'blogarise_single_related_box', 40);

if (!function_exists('blogarise_single_comments_box')) :
    function blogarise_single_comments_box() { 
        $blogarise_enable_single_post_comments = esc_attr(get_theme_mod('blogarise_enable_single_post_comments',true));
        if($blogarise_enable_single_post_comments == true) {
            if (comments_open() || get_comments_number()) :
            comments_template();
            endif; 
        }
    }
endif;
add_action('blogarise_action_single_comments_box', 'blogarise_single_comments_box', 40);