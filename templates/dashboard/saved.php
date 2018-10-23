<div class="tab-pane fade in active lp-saved" id="lp-listings">
	
	<?php
		global $paged, $wp_query, $listingpro_options;
		$fav = getSaved();
			$args=array(
				'post_type' => 'listing',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'post__in' => $fav,	
				'paged' => $paged,
			);
			
			$deafaultFeatImg = lp_default_featured_image_listing();
			$saved_query = null;
			$saved_query = new WP_Query($args);
	?>
	
			<div class="panel with-nav-tabs panel-default lp-dashboard-tabs col-md-9 lp-left-panel-height">
				<?php
					if(!empty($fav)) {
				?>
					<div class="panel-body">
						<div class="lp-main-title clearfix">
							<div class="col-md-6 lp-first-title"><p><?php esc_html_e('title','listingpro'); ?></p></div>
							<div class="col-md-2"><p><?php esc_html_e('expiry','listingpro'); ?></p></div>
							<div class="col-md-4"><p><?php esc_html_e('status','listingpro'); ?></p></div>
						</div>
						<div class="tab-content clearfix">
							<div class="tab-pane fade in active" id="tab1default">
								<?php
								if( $saved_query->have_posts() ) {
									while ($saved_query->have_posts()) : $saved_query->the_post();
										$listing_status = get_post_status(get_the_ID());
										$expiry = esc_html__('Unlimited', 'listingpro');
										$plan_id = listing_get_metabox('Plan_id');
										$showpaybutton = false;
										if(!empty($plan_id)){
											$plan_duration = get_post_meta($plan_id, 'plan_time', true);
											if(!empty($plan_duration)){
												$expiry = $plan_duration.' '.esc_html__('Days', 'listingpro');
											}
										}
										$payment_status = 'not_paid';
										if($listing_status=="pending" && $payment_status=="not_paid"){
											$showpaybutton = true;
										}
										
									?>
										<div class="lp-listing-outer-container clearfix lp-grid-box-contianer">
											<div class="col-md-6">
												<div class="lp-listing-image-section">
													
													<div class="lp-image-container">
														<?php
															if ( has_post_thumbnail()) {
																$imageAlt = lp_get_the_post_thumbnail_alt(get_the_ID());
																$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'thumbnail' );
															?>
																<img src="<?php echo $image[0]; ?>" />
															<?php }elseif(!empty($deafaultFeatImg)){ ?>
																<img src="<?php echo $deafaultFeatImg; ?>" />
															<?php }else{ ?>
																<img src="<?php echo esc_url('https://placeholdit.imgix.net/~text?txtsize=62&txt=50%C3%97150&w=62&h=50');?>" />
															<?php } ?>
													</div>
													<div class="lp-left-content-container">
														<a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a>
														<?php
															$category_image = '';
															$cats = get_the_terms( get_the_ID(), 'listing-category' );
															if(!empty($cats)){
																$cat = $cats[0];
																$category_image = listing_get_tax_meta($cat->term_id,'category','image');
																if(!empty($category_image)){
																	$category_image = '<img class="icon icons8-Food" src="'.esc_attr($category_image).'">';
																}
														?>
															<a href="<?php echo get_term_link($cat); ?>"> <?php echo $category_image; ?> <?php echo $cat->name; ?></a>
															<?php 
															}
														?>
													</div>
													
												</div>
											</div>
											<div class="col-md-2">
												
												<div class="lp-listing-expire-section">
													<p><?php echo $expiry; ?></p>
												</div>	
											</div>
											<div class="col-md-4">
												
												<div class="lp-status-container pull-left">
													<?php
														if($listing_status=="pending"){
															$pendingArrayIds[get_the_ID()] = get_the_ID();
													?>
															<span><img src="<?php echo listingpro_icons_url('plan_pending'); ?>"></span>
													<?php
														}elseif($listing_status=="publish"){
															$publishArrayIds[get_the_ID()] = get_the_ID();
													?>
															<span><i class="fa fa-check" aria-hidden="true"></i></span>
													<?php
														}
													?>
													<p><?php echo $listing_status; ?></p>
												</div>
												<div class="pull-right">
													<div class="clearfix">
														<div class="pull-right">

                                                            <div class="lp-dot-extra-buttons">
                                                                <div class="remove-fav md-close" data-post-id="<?php echo get_the_ID(); ?>">
                                                                    <i class="fa fa-times"></i>

                                                                </div>

                                                            </div>

														</div>
														<?php if(!empty($showpaybutton)){ ?>
															<div class="lp-listing-pay-outer pull-right">
																<a href="<?php echo esc_attr($checkoutURl); ?>" class="lp-listing-pay-button"><span><i class="fa fa-credit-card" aria-hidden="true"></i></span> <?php esc_html_e('Pay','listingpro'); ?></a>
															</div>
														<?php
														}
														?>
														
													</div>
												</div>
											</div>
										</div>
									<?php						
									endwhile;
									echo listingpro_pagination($saved_query);
								}
								?>
								
							</div>
							
							
						</div>
					</div>
				<?php }else{ ?>
							<div class="lp-blank-section">
								<div class="col-md-12 blank-left-side">
									<img src="<?php echo listingpro_icons_url('lp_blank_trophy'); ?>">
									 <h1><?php echo esc_html__('Nothing but this golden trophy!', 'listingpro'); ?></h1>
					
								</div>								
							</div>
				<?php } ?>
			</div>


<?php
$lpalertsRatings = getAllReviewsArray(false);
$lptotalClicks = lp_get_total_ads_clicks();
set_query_var( 'lptotalClicks', $lptotalClicks );
if( !empty($lpalertsRatings) || !empty($lptotalClicks) ){
    ?>
    <div class="col-md-3 padding-right-0 lp-right-panel-height">
        <div class="lp-ad-click-outer">
            <?php
            if( !empty($lptotalClicks)){ ?>
                <div class="lp-general-section-title-outer">
                    <?php echo get_template_part('templates/dashboard/ads_state'); ?>
                </div>
                <?php
            }
            if( !empty($lpalertsRatings)){
                ?>

                <div class="lp-general-section-title-outer">
                    <p id="reply-title" class="clarfix lp-general-section-title comment-reply-title active"> <?php echo esc_html__('Rating alerts', 'listingpro'); ?> <i class="fa fa-angle-down" aria-hidden="true"></i></p>
                    <div class="lp-ad-click-inner" id="lp-ad-click-inner">
                        <?php echo get_template_part('templates/dashboard/rating_alerts'); ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}else{
	?>
	
	 <div class="col-md-3 padding-right-0 lp-right-panel-height">
        <div class="lp-ad-click-outer">
            <div class="lp-general-section-title-outer">
                    <p id="reply-title" class="clarfix lp-general-section-title comment-reply-title active"> <?php echo esc_html__('Rating alerts', 'listingpro'); ?> <i class="fa fa-angle-down" aria-hidden="true"></i></p>
                    <div class="lp-ad-click-inner" id="lp-ad-click-inner">
                        <?php echo get_template_part('templates/dashboard/rating_alerts'); ?>
                    </div>
                </div>
        </div>
    </div>
	
	<?php
}
?>
	
</div>