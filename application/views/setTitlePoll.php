<?php echo form_open(); ?>
<div class="container">
			
			<div class="row">
				<div class="col-md-4">
					<div class="title">
						<h2>Créer un sondage</h2>
					</div>
					<p>Remplissez soigneusement toutes les cases.<br/>Veuillez cliquer sur "Confirmer" pour passer à l'étape suivante.</p>


				</div>

				<div class="col-md-8">


			<form method="post" action="send.php" id="contact-form" role="form" class="contact-form">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h2>Titre</h2>
							<?php echo form_input(array('id' => 'title', 'name' => 'title', 'value' => $title)); ?>
						</div>
						<div class="form-group">
							<h2>Lieu</h2>
							<?php echo form_input(array('id' => 'place', 'name' => 'place', 'value' => $place)); ?>
						</div>
						<div class="form-group">
							<h2>Description</h2>
							<?php echo form_input(array('id' => 'str', 'name' => 'str', 'value' => $description)); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9">
					</div>
					<div class="col-md-3">
						<div class="text-right">
							<?php echo form_submit('edit', 'Confirmer'); ?>
							<?php if($title !== NULL) { echo form_submit('next', 'Etape suivante') ; } ?>
						</div>
					</div>
				</div>
			</form>
			</div>
			</div>
		</div>

<?php echo form_close(); ?>
