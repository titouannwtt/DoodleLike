<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<div class="container">
			<div class="row">

				<div class="col-md-2"></div>
				<div class="col-md-8">

					<div class="title">
						<h2>Connexion</h2>
					</div>

					<form id="contact-form" role="form" class="contact-form">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Login</label></br>
										<?php echo form_input(array('id' => 'login', 'name' => 'login'),'','required'); ?>
								</div>
								<div class="form-group">
									<label>Mot de passe</label></br>
										<?php echo form_input(array('id' => 'pass', 'name' => 'pass', 'type' => 'password')); ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<?php echo form_submit(array('id' => 'submit', 'value' => 'Valider')); ?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

<?php echo form_close(); ?>