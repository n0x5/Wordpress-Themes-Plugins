<div class="content">

	
		<div class="entry">
<div class="mtitle"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> </h2> <div class="meta"><?php the_time('F jS, Y') ?>
                <?php the_category(', '); ?></div></div>
			<?php wp_link_pages('before=Sections:&next_or_number=number&pagelink=Page %'); ?>
			<div class="post-entry"><?php the_content('-> read more'); ?></div>
		</div>
</div>

