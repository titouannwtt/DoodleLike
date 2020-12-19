
<table>
	<tr>
		<td> Participants </td>
 </tr>
	<?php foreach($previousParticipants as $previousParticipant) { ?>
	<tr>
		<td> <?php echo $previousParticipant->idUser; ?> </td>
		<td>
		<?php if($previousParticipant->participate == false)
		{
			echo "n'a pas encore répondu à l'invitation";
		} 
		else
		{
			echo "a accepté de participer au sondage";
		}
		?>
	</td>
		<td>	 <a href="<?php echo site_url("ParticipantManager/remove/".$login.'/'.$poll.'/'.$previousParticipant->idParticipant); ?>" ><button type="submit" > Retirer utilisateur du sondage </button> </a> </td>
	</tr>
<?php } ?>
</table>


<?php echo form_open(); ?>
<select name="newParticipants" id="newParticipants">
	<?php foreach($users as $newParticipant) { ?>
	<option value="<?php echo $newParticipant->login?>"><?php echo $newParticipant->login ?></option>
	<?php } ?>
</select>

<?php echo form_submit(array('id' => 'submit', 'value' => 'Ajouter un participant')); ?>
<?php form_close(); ?>

