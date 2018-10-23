<div class="lp-listing-title">
    <?php
    $b_logo =   $listingpro_options['business_logo_switch'];
    if( $b_logo == 1 ):
        $business_logo_url  =   '';
        $b_logo_default =   $listingpro_options['business_logo_default']['url'];

        $business_logo = listing_get_metabox_by_ID('business_logo',get_the_ID());

        if( empty( $business_logo ) )
        {
            $business_logo_url  =   $b_logo_default;
        }
        else
        {
            require_once (THEME_PATH . "/include/aq_resizer.php");
            $business_logo_url  =   aq_resize( $business_logo, '82', '82', true, true, true);
        }

        if( !empty( $business_logo_url ) ):



            ?>

            <div class="lp-listing-logo">

               <img src="<?php echo $business_logo_url; ?>" alt="Listing Logo">

            </div>

        <?php endif; endif; ?>

    <div class="lp-listing-name">

        <h2><?php the_title(); ?> <?php echo $claim; ?></h2>
        <p class="lp-listing-name-tagline"><?php echo $tagline_text; ?></p>

    </div>

    <?php

    $allowedReviews = $listingpro_options['lp_review_switch'];

    if( !empty( $allowedReviews ) && $allowedReviews == 1 && get_post_status( $post->ID )== "publish" ):

        ?>

        <div class="lp-listing-title-rating">

            <?php if( $NumberRating > 0 ): ?><span class="lp-rating-avg <?php echo $rating_num_bg; ?>"><?php echo $rating; ?>/<sub>5</sub></span><span class="lp-rating-count"><?php echo $NumberRating; ?> <?php echo esc_html__( 'Reviews', 'listingpro' ); ?></span><?php endif; ?>
			
            <?php
            if( $NumberRating == 0 ):
            ?>
            <span class="lp-rating-count zero-with-top-margin"><?php echo esc_html__( 'Be the first to review', 'listingpro' ); ?></span>
            <?php endif; ?>

        </div>

    <?php endif; ?>

    <div class="clearfix"></div>

</div>