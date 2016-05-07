<?php 

get_header(); 
global $post; ?>
	
	<div class="container">
		<h1 class="title-single"><?php the_title(); ?></h1>
		<div class="main-portfolio ">
			<div class="left-content">
				<figure>
					<div class="single-img">
						<?php the_post_thumbnail(); ?>
					</div>
				</figure>
			</div>

			<div class="right-content">
				<div class="shot-desc">
					<p><?php echo $post->post_content; ?></p>
				</div>

				<div class="portofolio-meta">
					<div class="tags-section">
						<h3 class="meta-head">Category</h3>
						<ol id="tags" class="popular-tags">
							<?php 
								$terms = get_the_terms( get_the_ID(), 'portfoliox_category' );
								if ( ! empty( $terms ) ) {
									foreach ($terms as $value) {
										echo "<li class='cat'>" . $value->name . " ,</li>";
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
										echo "<li class='cat'>" . $value->name . " ,</li>";
									}
								}
							?>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
get_footer();