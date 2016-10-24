<?php foreach($result as $key){?>
<div class="radio">
	<label>
		<input type="radio"    name="red_paper" class="red_paper" value="<?php echo $key['id'];?>"> <?php echo $key['title'];?> 省<?php echo $key['monkey'];?>元
	</label>
</div>
<?php }?>
