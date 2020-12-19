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
		<td> <a href="<?php echo site_url("PollManager/removeSchedule/".$login.'/'.$poll.'/'.$date->idScheduler); ?>" ><button type="submit" > Supprimer </button> </a> </td>   
	</tr>
<?php } ?>
</table>

<?php echo form_open_multipart(); ?>
<select name="year" id="year">
	<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
  <option value="<?php echo date('Y', strtotime('+1 year')); ?>"><?php echo date('Y', strtotime('+1 year')); ?></option>
</select>
 
<select name="month" id="month">
	<?php for($i = 1; $i <= 12; $i++) { ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>

<select name="day" id="day">
	<?php for($i = 1; $i <= 31; $i++) { ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>

<select name="hourstart" id="hourstart">
	<?php for($i = 0; $i <= 23; $i++) { ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>

<select name="minutestart" id="minutestart">
	<?php for($i = 0; $i <= 55; $i = $i + 5) { ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>

<select name="hourend" id="hourend">
	<?php for($i = 0; $i <= 23; $i++) { ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>

<select name="minuteend" id="minuteend">
	<?php for($i = 0; $i <= 55; $i = $i + 5) { ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
	</select>
<?php echo form_submit('previous', 'Etape précédente'); ?> 
<?php echo form_submit('submit' ,'Ajouter date'); ?>
<?php echo form_submit('next', 'Etape suivante'); ?> 
<?php form_close(); ?>

