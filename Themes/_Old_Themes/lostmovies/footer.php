</div> <!-- #content -->

<?php
// This code pulls in the sidebar:
include(get_template_directory() . '/sidebar.php');
?>
<div style="clear:both;height:1px;"> </div>
</div><!-- #wrap -->

<p class="credit"><!--<?php echo $wpdb->num_queries; ?> queries. <?php timer_stop(1); ?> seconds. --> <cite><?php echo sprintf(__("Powered by <a href='http://wordpress.org' title='%s'><strong>WordPress</strong></a>"), __("Powered by WordPress, state-of-the-art semantic personal publishing platform.")); ?></cite></p><?php do_action('wp_footer', ''); ?>

</body>
</html>