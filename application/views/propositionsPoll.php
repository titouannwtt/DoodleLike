<table>
	<tr>
		<td> Propositions </td>
	</tr>
			<?php
			 foreach($propositions as $proposition) { ?>
			<tr> <td> <?php echo $proposition->proposition; ;?> <td> 
					<td> <a href="<?php echo site_url("PollManager/removeProposition/".$login.'/'.$idPoll.'/'.$proposition->proposition); ?>" ><button type="submit" > Supprimer </button> </a> </td>   
</tr>
		<?php } ?>
</table>
<?php echo form_open_multipart();
echo form_label('Proposition');
echo form_input(array('id' => 'proposition', 'name' => 'proposition'));
echo form_submit('previous', 'Etape précédente');
echo form_submit('submit', 'Ajouter une proposition'); 
echo form_submit('next', 'Etape suivante'); 

echo form_close(); ?>
