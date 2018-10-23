<?phpglobal $listingpro_options;$lp_detail_page_styles  =   $listingpro_options['lp_detail_page_styles'];?><?php$lp_listing_menus   =   get_post_meta( get_the_ID(), 'lp-listing-menu', true );if( is_array( $lp_listing_menus ) && !empty( $lp_listing_menus ) ):    require_once (THEME_PATH . "/include/aq_resizer.php");    ?>    <h4 class="lp-detail-section-title"><?php echo esc_html__( 'Menu', 'listingpro' ); ?></h4>    <div class="lp-listing-menuu-wrap" id="lp-listing-menuu-wrap">        <div class="lp-listing-menuu lp-listing-menuu-slider">            <?php            foreach ( $lp_listing_menus as $menu_type => $lp_listing_menu ):                ?>                <div class="lp-listing-menuu-slide">                    <div class="lp-listing-menu-top">                        <span><?php echo $menu_type; ?></span>                    </div>                    <div class="lp-listing-menu-list">                        <div class="lp-listing-menu-items">                            <?php                            foreach ( $lp_listing_menu as $menu_group => $listing_menu ):                                $total_menus    =   count( $listing_menu );                                ?>                                <h6><?php echo $menu_group; ?></h6>                                <?php                                $menu_counter   =   0;                                foreach ( $listing_menu as $lp_menu ):                                    $menu_counter++;                                    $img_url    =   $lp_menu['mImage'];                                    if( empty( $img_url ) )                                    {                                        $img_url    =   get_template_directory_uri().'/assets/images/menu-placeholder.jpg';                                    }                                    else                                    {                                        $img_url  = aq_resize( $img_url, '65', '65', true, true, true);                                    }                                    ?>                                    <div class="lp-listing-menu-item <?php if( $menu_counter == $total_menus ){ echo 'last-item'; } ?>">                                        <div class="lp-menu-item-thumb">                                            <img src="<?php echo $img_url; ?>">                                        </div>                                        <div class="lp-menu-item-detail">                                            <a <?php if( $lp_menu['mLink'] ): echo 'href="'. $lp_menu['mLink'] .'"'; endif; ?> class="lp-menu-item-title"><?php echo $lp_menu['mTitle']; ?></a>                                            <?php                                            if( !empty( $lp_menu['mDetail'] ) ):                                                ?>                                                <span class="lp-menu-item-tags"><?php echo $lp_menu['mDetail']; ?></span>                                            <?php endif; ?>                                        </div>                                        <div class="lp-menu-item-price">                                            <?php                                            if( $lp_menu['mOldPrice'] ):                                                ?>                                                <span class="old-price"><?php echo $lp_menu['mOldPrice']; ?></span>                                            <?php endif; ?>                                            <?php                                            if( $lp_menu['mNewPrice'] ):                                                ?>                                                <span><?php echo $lp_menu['mNewPrice']; ?></span>                                            <?php endif; ?>                                        </div>                                        <div class="clearfix"></div>                                    </div>                                <?php endforeach; ?>                            <?php endforeach; ?>                        </div>                    </div>                </div>            <?php endforeach;; ?>        </div>    </div><?php endif; ?>