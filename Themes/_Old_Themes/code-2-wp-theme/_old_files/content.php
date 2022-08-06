	
  <div class="content">
		<div class="entry">


			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
 <div class="search-celeb">
<?php

$firstname = explode(" ",the_title('','',false));
$firstname1 = $firstname[0];
$lastname = $firstname[1];
echo "Search all <a href='/?s=$firstname1+$lastname'>$firstname1 $lastname</a> posts";
?>

</div>

<?php
$timestamp = get_the_date( 'Y' );
$ourtitle =  get_the_title();
$timestamp2 = date('Y',strtotime('+1 year',strtotime($post->post_date)));

if (strpos($ourtitle, $timestamp) == true ) {
    echo '<div class="newpost">NEW!</div>'; }
elseif (strpos($ourtitle, $timestamp2) == true ) {
      echo '<div class="newpost">NEW!</div>'; }
else {
    echo '<div class="archivepost">ARCHIVE</div>';     
}
?>
	
                        
			<div class="post-entry"> <?php  the_content('more))');  ?></div>



                        <div class="metatitle1"><?php the_time('F jS, Y') ?> <img src="<?php echo get_bloginfo ( 'template_directory' );   ?>/images/nr2.png" alt="Site Logo"></div>
	

         </div>
</div>	
