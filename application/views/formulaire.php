<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<div class="container">
			
			<div class="row">
				<div class="col-md-4">
					<div class="title">
						<h2>Inscription:</h2>
					</div>
					<p>Vous recevrez un justificatif de votre inscription par mail, mais aucune confirmation ne vous sera demandée.<br/><br/>Inscrivez-vous dès maintenant pour créer et participer à des sondages !</p>

					<ul class="contact-info-list">
						<li>
							<span class="icon"><i class="fa fa-envelope"></i></span>
							<a href="mailto:your_email_goes_here">doodle@gmail.com</a>
							
						</li>
					</ul>
				</div>

				<div class="col-md-8">

			<div class="title">
				<h2>Formulaire d'inscription</h2>
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
							<?php echo form_input(array('id' => 'pass', 'name' => 'pass', 'type' => 'password'),'','required'); ?>
						</div>
						<div class="form-group">
							<label>Confirmer mot de passe</label></br>
							<?php echo form_input(array('id' => 'pass2', 'name' => 'pass2', 'type' => 'password'),'','required'); ?>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Nom</label></br>
							<?php echo form_input(array('id' => 'lname', 'name' => 'lname'),'','required'); ?>
						</div>
						<div class="form-group">
							<label>Prénom</label></br>
							<?php echo form_input(array('id' => 'firstname', 'name' => 'firstname'),'','required'); ?>
						</div>
						<div class="form-group">
							<label>Email</label></br>
							<?php echo form_input(array('id' => 'email', 'name' => 'email'),'','required'); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-7">
						<?php if(!isset($error)) { $error=0; } ?>
						<?php if($error == 0) { ?>
							<!-- Ne rien faire -->
						<?php } ?>

						<?php if($error == 1) { ?>
							<div id="response" class="fleft text-left">
								<div class="alert alert-danger fade in">
									<strong>Erreur!</strong> Les deux mots de passes sont différents.
								</div>
							</div>
						<?php } ?>

						<?php if($error == 2) { ?>
							<div id="response" class="fleft text-left">
								<div class="alert alert-danger fade in">
									<strong>Erreur!</strong> Ce login est déjà utilisé.
								</div>
							</div>
						<?php } ?>

					</div>
					<div class="col-md-3">
						<?php echo form_submit(array('id' => 'submit', 'value' => 'Valider')); ?>
					</div>
				</div>
			</form>
			</div>
			</div>
		</div>

<?php echo form_close(); ?>
