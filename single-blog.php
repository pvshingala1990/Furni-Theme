<?php get_header(); ?>


<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>Single Blog</h1>
				</div>
			</div>
			<div class="col-lg-7"></div>
		</div>
	</div>
</div>

<!-- Start Blog Detail Section -->
<div class="untree_co-section">
	<div class="blog-detail-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="post-entry">
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Image" class="img-fluid mb-4">
						<h2 class="section-title mb-3"><?php echo get_the_title(); ?></h2>
						<div class="meta mb-4">
							<span>by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"></a></span>
							<span>on <?php echo get_the_date(); ?></span>
						</div>
						<?php the_content(); ?>
					</div>
					<?php /* <div class="comment-section mt-5">
					<h3 class="mb-5">Comments</h3>
					<ul class="comment-list">
						<li class="comment">
							<div class="vcard bio">
								<img src="images/person-1.png" alt="Image">
							</div>
							<div class="comment-body">
								<h3>Jean Doe</h3>
								<div class="meta">Dec 20, 2021 at 2:21pm</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at est id leo luctus
									gravida eu at lectus.</p>
								<p><a href="#" class="reply">Reply</a></p>
							</div>
						</li>

						<li class="comment">
							<div class="vcard bio">
								<img src="images/person-2.png" alt="Image">
							</div>
							<div class="comment-body">
								<h3>John Smith</h3>
								<div class="meta">Dec 20, 2021 at 3:10pm</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at est id leo luctus
									gravida eu at lectus.</p>
								<p><a href="#" class="reply">Reply</a></p>
							</div>
						</li>
					</ul>
					<div class="comment-form-wrap pt-5">
						<h3 class="mb-5">Leave a comment</h3>
						<form action="#" class="p-5 bg-light">
							<div class="form-group">
								<label for="name">Name *</label>
								<input type="text" class="form-control" id="name">
							</div>
							<div class="form-group">
								<label for="email">Email *</label>
								<input type="email" class="form-control" id="email">
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<textarea id="message" cols="30" rows="10" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" value="Post Comment" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div> */ ?>
					<?php comments_template(); ?>
				</div>

				<!-- Start Sidebar -->
				<div class="col-lg-4 sidebar">
					<div class="sidebar-box">

						<h3 class="heading">Categories</h3>
						<ul class="categories">
							<li><a href="#">Interior Design <span>(12)</span></a></li>
							<li><a href="#">Furniture <span>(22)</span></a></li>
							<li><a href="#">Home Decor <span>(37)</span></a></li>
							<li><a href="#">DIY <span>(42)</span></a></li>
							<li><a href="#">Lifestyle <span>(14)</span></a></li>
						</ul>
					</div>
					<div class="sidebar-box">
						<h3 class="heading">Recent Posts</h3>
						<div class="post-entry-sidebar">
							<ul>
								<?php
								$args = array(
									'post_type'      => 'blog',
									'posts_per_page' => 3,
									'post_status'    => 'publish'
								);

								$recent_posts = new WP_Query($args);

								if ($recent_posts->have_posts()) :

									while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
										<li>
											<a href="<?php the_permalink(); ?>">

												<?php if (has_post_thumbnail()) : ?>

													<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="me-4" width="100px" height="100px">

												<?php else : ?>

													<img src="<?php echo get_template_directory_uri(); ?>/images/default-thumbnail.jpg" alt="Image placeholder" class="me-4">

												<?php endif; ?>

												<div class="text">
													<h4><?php the_title(); ?></h4>
													<div class="post-meta">
														<span class="mr-2"><?php echo get_the_date(); ?></span>
													</div>
												</div>
											</a>
										</li>
										<br>
									<?php endwhile; ?>

									<?php wp_reset_postdata(); ?>

								<?php else : ?>
									<li><?php _e('No recent posts available.', 'textdomain'); ?></li>
								<?php endif; ?>

							</ul>

						</div>
					</div>
				</div>
				<!-- End Sidebar -->

			</div>
		</div>
	</div>
</div>
<!-- End Blog Detail Section -->

<?php get_footer(); ?>