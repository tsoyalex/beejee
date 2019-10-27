<?php if ($_SESSION['alerts']['info']):?>
	<?php foreach ($_SESSION['alerts']['info'] as $info):?>
		<div class="alert alert-success" role="alert">
			<?=$info?>
		</div>
	<?php endforeach?>
<?php endif?>