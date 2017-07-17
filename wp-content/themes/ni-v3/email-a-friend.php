<div class="modal fade show email-popup" id="email-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-2">
							<a class="logo" href="<?php echo network_site_url(); ?>">
								<svg viewBox="0 0 40 40" preserveAspectRatio="xMaxYMax">
									<use xlink:href="#ni-menu">
								</svg>
							</a>
						</div>

						<div class="col-sm-10">
							<h3 class="modal-title">Share with your friends</h3>
						</div>

					</div>
					
						<form action="<?php bloginfo('template_url'); ?>/bin/email-popup.php" method="post" id="email-popup-form">
						<div class="row mt-5">
							<div class="col-md-3">
								<label for="to-address">To: </label>
							</div>

							<div class="col-md-9">
								<input id="to-address" name="to-address" class="form-control" type="text" value="" placeholder="Email address of recipient" required />
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-md-3">
								<label for="from-address">From: </label>
							</div>

							<div class="col-md-9">
								<input id="from-address" name="from-address" class="form-control" type="text" value="" placeholder="Your email address" />
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-md-3">
								<label for="title">Title: </label>
							</div>

							<div class="col-md-9">
							<?php if ( is_tax( 'company' ) ): ?>
								<input id="title" name="title" class="form-control" type="text" value="<?php echo single_cat_title('',false); ?>" placeholder="The title of your post" />
							<?php else: ?>
								<input id="title" name="title" class="form-control" type="text" value="<?php the_title(); ?>" placeholder="The title of your post" />
							<?php endif; ?>
							</div>
						</div>

						<input type="hidden" name="url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
						<input type="hidden" name="sitename" value="<?php echo get_bloginfo('name'); ?>">

						<div class="row mt-3">
							<div class="col-md-3">
								<label for="message">Message: </label>
							</div>

							<div class="col-md-9">
								<textarea class="form-control" id="message" name="message" placeholder="Let them know what you think"></textarea>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-md-12">
								<button type="submit" class="submit-btn float-right">Send</button>
							</div>
						</div>
					</form>
					
					<div class="row form-message text-center pt-5 pb-5">
						<div class="col-sm-12 form-message-content">
							&nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>