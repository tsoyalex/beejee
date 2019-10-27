<?php if ($_SESSION['alerts']['error']):?>
	<?php foreach ($_SESSION['alerts']['error'] as $error):?>
		<div class="alert alert-danger" role="alert">
			<?=$error?>
		</div>
	<?php endforeach?>
<?php endif?>