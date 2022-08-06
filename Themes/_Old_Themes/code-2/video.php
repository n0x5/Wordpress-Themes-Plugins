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
			<h2>Video: <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="post-entry"><?php the_content(); ?></div>
			<p><video controls> <source src='<?php echo wp_get_attachment_url(); ?>' type='video/mp4'>Your browser does not support the video tag.</video></p>
			
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
			$width = $metadata['width'];
			$height = $metadata['height'];
			$fformat = $metadata['fileformat'];
			$dformat = $metadata['dataformat'];
			$audio_codec = $metadata['audio']['codec'];
			$sample_rate = $metadata['audio']['sample_rate'];
			$channels = $metadata['audio']['channels'];
			$bits_per_sample = $metadata['audio']['bits_per_sample'];
			$lossless = $metadata['audio']['lossless'];
			$channelmode = $metadata['audio']['channelmode'];
			?>
			Uploaded: <?php echo $date3; ?> <?php echo $uploaded; ?> <br>
			File Url: <?php echo $url3; ?> <br>
			Mime type: <?php echo get_post_mime_type(); ?> <br><br>
			
			Dimensions: <?php echo $width; ?>x<?php echo $height; ?> <br>
			Length: <?php echo $length; ?> <br>
			Format: <?php echo $fformat; ?> <br>
			Data Format: <?php echo $dformat; ?> <br>
			Audio codec: <?php echo $audio_codec; ?> <br>
			Channels: <?php echo $channels; ?> <br>
			Bits per sample: <?php echo $bits_per_sample; ?> <br>
			Channel mode: <?php echo $channelmode; ?> <br>
			
		</div>
</div>

<?php get_footer(); ?>