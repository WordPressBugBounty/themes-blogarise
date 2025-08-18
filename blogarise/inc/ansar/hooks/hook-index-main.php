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