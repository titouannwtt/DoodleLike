
<div class="container">
	<div class="row">
		<div class="col-md-12">
				<div class="spacer-sm"></div>
			<div class="title">
				<h2>Sondages en cours</h2>
			</div>
			<table>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-four-cols">
								<thead>
									<tr>
										<th><center>Sondage</center></th>
										<th><center>Titre</center></th>
										<th><center>Endroit</center></th>
										<th><center>Description</center></th>
										<th><center>Suppression</center></th>
									</tr>
								</thead>
									<?php foreach($polls as $poll) { ?>
									<tr>
										<?php if( $poll->over == false) { ?>
										<td> <a href="<?php echo site_url("DashBoard/displayDashBoardPoll/".$login.'/'.$poll->idPoll."/1/0"); ?>" > <?php echo $poll->idPoll; ?>  </td>
										<td> <?php echo $poll->title; ?> </td>
										<td> <?php echo $poll->place; ?> </td>
										<td> <?php echo $poll->description; ?> </td>
										<td> <a href="<?php echo site_url("PollManager/remove/".$login.'/'.$poll->idPoll); ?>" ><button class="btn btn-primary btn-sm" type="submit" > Supprimer </button> </a></td>
										<?php } ?> 
									</tr>
									<?php } ?>
								<tbody>
									
								</tbody>
							</table>
						</div>
			</table>
		<div class="col-md-8">
				<div class="spacer-sm"></div>
			<div class="title">
				<h2>Sondages terminés</h2>
			</div>
			<table>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-four-cols">
								<thead>
									<tr>
										<th><center>Sondage</center></th>
										<th><center>Titre</center></th>
										<th><center>Endroit</center></th>
										<th><center>Description</center></th>
									</tr>
								</thead>
									<?php foreach($polls as $poll) { ?>
									<tr>
										<?php if( $poll->over == true) { ?>
										<td> <a href="<?php echo site_url("DashBoard/displayDashBoardPoll/".$login.'/'.$poll->idPoll."/1/1"); ?>" > <?php echo $poll->idPoll; ?> </a> </td>
										<td> <?php echo $poll->title; ?> </td>
										<td> <?php echo $poll->place; ?> </td>
										<td> <?php echo $poll->description; ?> </td>
										<?php } ?> 
									</tr>
									<?php } ?>
								<tbody>
									
								</tbody>
							</table>
						</div>
			</table>
		</div>
		<div class="col-md-8">
				<div class="spacer-sm"></div>
			<div class="title">
				<h2>Sondages auxquels je participe</h2>
			</div>
			<table>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-four-cols">
								<thead>
									<tr>
										<th><center>Sondage</center></th>
										<th><center>Titre</center></th>
										<th><center>Endroit</center></th>
										<th><center>Description</center></th>
									</tr>
								</thead>
									<?php foreach($pollsPar as $poll) { ?>
									<tr>
										<td> <a href="<?php echo site_url("DashBoard/displayDashBoardPoll/".$login.'/'.$poll->idPoll."/0/0"); ?>" > <?php echo $poll->idPoll; ?> </a> </td>
										<!-- <td> <?php echo $poll->title; ?> </td>
										<td> <?php echo $poll->place; ?> </td>
										<td> <?php echo $poll->description; ?> </td> -->
									</tr>
									<?php } ?>
								<tbody>
									
								</tbody>
							</table>
						</div>
			</table>
		</div>
		<div class="col-md-9">
			<div class="row">
				<center>
					<a href="<?php echo site_url("PollManager/setTitle/".$login); ?>" ><button class="btn btn-primary btn-lg" type="submit" type="submit" > Créer un sondage </button> </a> 
					<p>   </p>
					<a href="<?php echo site_url("UserSession/remove/".$login); ?>" ><button class="btn btn-secondary btn-lg" type="submit" > Supprimer compte </button> </a>
				</center>
			</div>
		</div>
	</div>
</div>
