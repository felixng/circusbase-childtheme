<?phpglobal $listingpro_options;$discounts_dashoard =   true;if( isset( $listingpro_options['discounts_dashoard'] ) && $listingpro_options['discounts_dashoard'] == 0 ){    $discounts_dashoard =   false;}if( $discounts_dashoard == false ) return false;$post_author_id = get_post_field( 'post_author', get_the_ID() );$discount_displayin =   get_user_meta( $post_author_id, 'discount_display_area', true );if( $discount_displayin == 'content' || empty( $discount_displayin ) ){    $DDO_design =   $listingpro_options['discount_deals_offers_design'];}else{    $DDO_design =   $listingpro_options['discount_deals_offers_design_sidebar'];}if( isset( $DDO_design ) && !empty( $DDO_design ) ){    $DDO_design =   $DDO_design;}else{    $DDO_design =   1;}$lp_detail_page_styles  =   $listingpro_options['lp_detail_page_styles'];if( $DDO_design == 1 ){    get_template_part( 'templates/single-list/listing-details-style3/content/list-deals' );}if( $DDO_design == 2 ){    get_template_part( 'templates/single-list/listing-details-style3/content/list-offers' );}if( $DDO_design == 3 ){    get_template_part( 'templates/single-list/listing-details-style3/content/list-discount' );}?>