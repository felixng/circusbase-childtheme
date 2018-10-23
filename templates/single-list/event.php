<?php
$event_id   =   get_post_meta( $post->ID, 'event_id', true );

if(  get_post_status( $event_id ) === false ) return false;
if( isset( $event_id ) && !empty( $event_id ) ):
   $timeNow    =   strtotime( 'now' );
   $event_date =   get_post_meta( $event_id, 'event-date', true );
   if( $timeNow > $event_date ) return false;
    $event_time =   get_post_meta( $event_id, 'event-time', true );
    $event_loc =   get_post_meta( $event_id, 'event-loc', true );
    $event_ticket_url =   get_post_meta( $event_id, 'ticket-url', true );
    $event_img =   get_post_meta( $event_id, 'event-img', true );

    $event_object = get_post( $event_id );
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    $attending_users    =   get_post_meta( $event_id, 'attending-users', true );
    $attendies_count    =   0;
    if( !empty( $attending_users ) && is_array( $attending_users ) )
    {
        $attendies_count    =   count( $attending_users );
    }

    ?>
    <div class="sidebar-post event-sidebar-wrapper">
        <div class="widget-box lp-event-outer">
            <?php
            if( !empty( $event_img ) ):
                ?>
                <div class="lp-event-image-container">
                    <img src="<?php echo $event_img; ?>" alt="<?php echo get_the_title( $event_id ); ?>">
                </div>
            <?php endif; ?>
            <div class="lp-event-outer-container">
                <div class="lp-event-outer-content margin-bottom-10">
                    <?php
                    if( !empty( $event_date ) ):
                        ?>
                        <div class="lp-evnt-date-container">
                            <div class="lp-evnt-date-container-inner">
                                <span><?php echo date( 'd', $event_date ); ?></span>
                                <span><?php echo date( 'M', $event_date ); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="lp-evnt-content-container">
                        <h3><?php echo wp_trim_words(get_the_title( $event_id ), 3, '...'); ?></h3>
                        <h4><?php echo esc_html__('Hosted by','listingpro');?> <?php echo wp_trim_words(get_the_title( $post->ID ), 2, '...'); ?></h4>
						<?php if(!empty($event_object)){ ?>
                        <p><?php echo $event_object->post_content; ?></p>
						<?php } ?>
                        <div class="lp-event-text-shadow"></div>
                    </div>
                </div>
                <div class="lp-events-btns-outer">
                    <?php
                    if( is_user_logged_in() ):
                        if( is_array( $attending_users ) && in_array( $user_id, $attending_users ) ):
                            ?>
                            <button type="button"><?php echo esc_html__( 'already going', 'listingpro' ); ?></button>
                        <?php else: ?>
                            <button type="button" id="attend-event" data-event="<?php echo $event_id; ?>" data-uid="<?php echo $user_id; ?>"><?php echo esc_html__( 'Yes! i am going', 'listingpro' ); ?></button>
                        <?php endif; ?>
                    <?php else: ?>
                        <button type="button" class="md-trigger" data-modal="modal-3"><?php echo esc_html__( 'Yes! i am going', 'listingpro' ); ?></button>
                    <?php endif; ?>
                    <button type="button" class="total-going"><?php echo $attendies_count; ?> <?php echo esc_html__( 'going', 'listingpro' ); ?></button>
                </div>
                <div class="lp-event-list-area">
                    <ul class="clearfix">
                        <?php
                        if( !empty( $event_time ) ):
                            ?>
                            <li><h5><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $event_time; ?> <?php echo esc_html__( '-', 'listingpro' ); ?> <?php echo date( 'l', $event_date); ?></h5>
                                <?php if(!empty( $event_date)): ?>
                                    <span><?php echo date_i18n( get_option('date_format'), $event_date); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <li>
                            <?php
                            if( !empty( $event_loc ) ):
                                ?>
                                <h5><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $event_loc;?></h5>                         
                                <h6 id="lp-map-hide-show"><?php echo esc_html__( 'Show Map', 'listingpro' ); ?></h6>
                                <div class="lp-event-map-section">Map Section</div>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <?php
                    if( !empty( $event_ticket_url ) ): ?>
                        <a target="_blank" href="<?php echo $event_ticket_url; ?>" class="lp-event-ticket"><i class="fa fa-tag" aria-hidden="true"></i><?php echo esc_html__( 'Get Tickets', 'listingpro' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>