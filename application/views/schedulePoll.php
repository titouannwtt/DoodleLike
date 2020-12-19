<table>
	<tr>
		<td> Jour </td>
		<td> Heure de départ </td>
		<td> Heure de fin </td>
 </tr>
	<?php foreach($dates as $date) { ?>
	<tr>
		<td> <?php echo $date->day.'/'.$date->month.'/'.$date->year; ?> </td>
		<td> <?php echo $date->hourstart.':'.$date->minutestart; ?> </td>
		<td> <?php echo $date->hourend.':'.$date->minuteend; ?> </td>
		<td> <?php echo form_checkbox('accept', FALSE); ?> <td>
	</tr>
<?php } ?>
</table>

<a href="<?php echo site_url("ParticipantManager/remove/".$login.'/'.$poll.'/'.$login); ?>" ><button type="submit" > Ne pas participer </button> </a>