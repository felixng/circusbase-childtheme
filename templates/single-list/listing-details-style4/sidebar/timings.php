<?php
if( $buisness_hours && !empty( $hours_show ) ):
?>
    <div class="lp-listing-timings lp-widget-inner-wrap">
        <?php get_template_part( 'include/timings' ); ?>
    </div>
    <?php
endif;
