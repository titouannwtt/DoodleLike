

<table>
	<tr>
		<td> Participants </td>
 </tr>
	<?php foreach($participants as $participant) { ?>
	<tr>
		<td> <?php echo $participant->idUser; ?> </td>
	</tr>
<?php } ?>
</table>
<?php if($over == false) { 
if($creator == true) {?>
 <a href="<?php echo site_url("PollManager/close/".$login.'/'.$poll); ?>" ><button type="submit" > Clôturer le sondage </button> </a> 
 <a href="<?php echo site_url("PollManager/setTitle/".$login.'/'.$poll); ?>" ><button type="submit" > Modifier</button> </a>  
 <a href="<?php echo site_url("ParticipantManager/add/".$login.'/'.$poll); ?>" ><button type="submit" > Ajouter des participants</button> </a>  
 <?php }} ?>
 <a href="<?php echo site_url("DashBoard/displayDashBoard/".$login); ?>" ><button type="submit" > Retour </button> </a>  
