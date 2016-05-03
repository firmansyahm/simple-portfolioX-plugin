<?php 

get_header(); 
global $post; ?>

<div id="content">
	<div class="container">
		<h1 class="title-single"><?php the_title(); ?></h1>
		<div class="main-shot ">
			<div class="the-shot" data-screenshot_id="2194714" data-img-src="https://d13yacurqjgara.cloudfront.net/users/360131/screenshots/2194714/gif-testtube-good.gif">
				<div class="single group">
					<div class="single-grid">
						<div class="single-img">
							<?php the_post_thumbnail(); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="screenshot-info-wrapper">
				<div class="screenshot-conversation">
					<div class="shot-desc">
						<?php echo $post->post_content; ?>
					</div>
				</div>

				<div class="screenshot-meta">
					<div class="tags-section">
						<h3 class="meta-head">Category</h3>
						<ol id="tags" class="popular-tags">
							<?php 
								$terms = get_the_terms( get_the_ID(), 'portfoliox_category' );
								if ( ! empty( $terms ) ) {
									foreach ($terms as $value) {
										echo "<li class='cat'>" . $value->name . "</li>";
									}
								}
							?>
						</ol>
					</div>
					<div class="tags-section">
						<h3 class="meta-head">Tags</h3>
						<ol id="tags" class="popular-tags">
							<?php 
							$terms = get_the_terms( get_the_ID(), 'portofoliox_taxonomy' );

								if ( ! empty( $terms ) ) {
									foreach ($terms as $value) {
										echo "<li class='cat'>" . $value->name . "</li>";
									}
								}
							?>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();