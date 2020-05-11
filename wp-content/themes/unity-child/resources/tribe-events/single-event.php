<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">
  <div class="row">
    <div class="col s12">
      <h1><?php echo get_the_title(); ?></h1>

      <div class="tribe-events-schedule">
        <?php echo tribe_events_event_schedule_details( $event_id ); ?>
        <?php if ( tribe_get_cost() ) : ?>
          <span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
        <?php endif; ?>
      </div>

      <!-- Notices -->
      <?php tribe_the_notices() ?>
    </div>
  </div>

	<?php while ( have_posts() ) :  the_post(); ?>
    <div <?php post_class(); ?>>
      <div class="row">
        <div class="col s12 m6">
          <!-- Event content -->
          <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
          <div class="tribe-events-single-event-description tribe-events-content">
            <?php the_content(); ?>
          </div>
          <!-- .tribe-events-single-event-description -->
          <?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
        </div>
        <?php if (has_post_thumbnail()) : ?>
          <div class="col s12 m6">
            <?php echo tribe_event_featured_image( $event_id, 'large', false ); ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="row">
        <div class="col s12">
          <!-- Event meta -->
          <?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
          <?php tribe_get_template_part( 'modules/meta' ); ?>
          <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
        </div>
      </div>
		</div> <!-- #post-x -->
  <?php endwhile; ?>

  <div class="row">
    <div class="col">
      <p class="tribe-events-back">
        <a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
      </p>
    </div>
  </div>
</div><!-- #tribe-events-content -->
