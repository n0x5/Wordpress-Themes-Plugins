<?php get_header(); ?>
<div class="content">
		<div class="metainfo">
		<div class="metatitle1">


		<div class="time2"><?php the_time('F jS, Y') ?></div>
                <div class="category"><?php the_category(', '); ?></div>
<span class="post-format">
                                <a class="format-standard" href="?post_format=standard"><?php echo get_post_format_string( 'standard' ); ?></a>
                        </span>


                </div>
		</div>
		<div class="entry">
			<h2>Audio: <?php the_title(); ?></h2>
			
			<div class="post-entry"><?php the_content(); ?></div>
			<p><video controls> <source src='<?php echo wp_get_attachment_url(); ?>' type='video/mp4'>Your browser does not support the video/audio tag.</video></p>
			
			<?php
$uploaded = esc_attr(get_the_time());
$date3 = get_the_date();
$url3 = esc_url(wp_get_attachment_url());
$post_url = esc_url(get_permalink($post->post_parent));
$post_title = get_the_title($post->post_parent);
?>
			<h2>Metadata:</h2>
			<?php
			$metadata = wp_get_attachment_metadata();
			$fsize = $metadata['filesize'];
			$length = $metadata['length_formatted'];
			$encoder = $metadata['encoder'];
			$encoder_options = $metadata['encoder_options'];
			$fformat = $metadata['fileformat'];
			$dformat = $metadata['dataformat'];
			$audio_codec = $metadata['codec'];
			$sample_rate = $metadata['sample_rate'];
			$channels = $metadata['channels'];
			$bitrate_mode = $metadata['bitrate_mode'];
			$lossless = $metadata['lossless'];
			$compression_ratio = $metadata['compression_ratio'];
			$channelmode = $metadata['channelmode'];
			$artist = $metadata['artist'];
			$album = $metadata['album'];
			?>
			Uploaded: <?php echo $date3; ?> <?php echo $uploaded; ?> <br>
			File Url: <?php echo $url3; ?> <br>
			Mime type: <?php echo get_post_mime_type(); ?> <br><br>
			
			
			Length: <?php echo $length; ?> <br>
			Format: <?php echo $fformat; ?> <br>
			Audio codec: <?php echo $audio_codec; ?> <br>
			Encoder: <?php echo $encoder; ?> <br>
			Encoder options: <?php echo $encoder_options; ?> <br>
			Compression ratio: <?php echo $compression_ratio; ?> <br>
			Channels: <?php echo $channels; ?> <br>
			Bitrate mode: <?php echo $bitrate_mode; ?> <br>
			Channel mode: <?php echo $channelmode; ?> <br>
			Artist: <?php echo $artist; ?> <br>
			Album: <?php echo $album; ?> <br>
		</div>
</div>

<?php get_footer(); ?>