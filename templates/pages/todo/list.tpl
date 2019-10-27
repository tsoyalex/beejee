<a href="/todo/add" class="btn btn-primary add-button" data-toggle="modal" data-target="#addTaskModal">Добавить задачу</a>
<h1>Список задач</h1>
<?php include('templates/elements/error-list.tpl')?>
<?php include('templates/elements/info-list.tpl')?>

<div class="mt-4 mb-4">
	Сортировать по
	<select class="js-todo-order">
		<option value="">по умолчанию</option>
		<option value="name"<?=$_SESSION['tasks']['order']=='name'?' selected':''?>>имя по возрастанию</option>
		<option value="-name"<?=$_SESSION['tasks']['order']=='-name'?' selected':''?>>имя по убыванию</option>
		<option value="email"<?=$_SESSION['tasks']['order']=='email'?' selected':''?>>email по возрастанию</option>
		<option value="-email"<?=$_SESSION['tasks']['order']=='-email'?' selected':''?>>email по убыванию</option>
		<option value="status"<?=$_SESSION['tasks']['order']=='status'?' selected':''?>>статус по возрастанию</option>
		<option value="-status"<?=$_SESSION['tasks']['order']=='-status'?' selected':''?>>статус по убыванию</option>
	</select>
</div>

<div class="task-list">
	<?php foreach ($this->_vars['taskList'] as $task):?>
	<div class="task mt-3">
		<div class="content">
			<div><b>Имя пользователя:</b> <?=$task['name']?></div>
			<div><b>Email:</b> <?=$task['email']?></div>
			<div class="text"><?=nl2br($task['text'])?></div>
		</div>
		<div class="status status<?=$task['status']?>">
			<?=$task['status']==0?'Не завершена':'Завершена'?>
			<?=$task['edited']==1?', отредактирована администратором':''?>
			<?php if ($this->app->user->isUserAuth()):?>
				<?php if ($task['status']==0):?>
		  		<a href="#" data-id="<?=$task['id']?>" class="js-finish admin-link">Завершить</a>
				<?php endif?>
				<a href="#" data-id="<?=$task['id']?>" class="js-edit admin-link" data-toggle="modal" data-target="#editTaskModal">Редактировать</a>
			<?php endif?>
		</div>
	</div>
	<?php endforeach?>
</div>

<?php include('templates/elements/paginator.tpl')?>

<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="/todo/add">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Добавить новую задачу</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="inputName">Ваше имя</label>
						<input name="name" type="text" class="form-control" id="inputName" placeholder="ФИО" required>
					</div>
					<div class="form-group">
						<label for="inputEmail">Ваш Email</label>
						<input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required>
					</div>
					<div class="form-group">
						<label for="inputText">Задача</label>
						<textarea name="text" class="form-control" id="inputText" placeholder="Описание задачи" required></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
					<button type="submit" class="btn btn-primary">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php if ($this->app->user->isUserAuth()):?>
	<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="post" action="/todo/add" class="js-edit-task">
					<input type="hidden" name="id" value="0">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Редактировать задачу</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="inputText">Задача</label>
							<textarea name="text" class="form-control" id="inputText" placeholder="Описание задачи" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
						<button type="submit" class="btn btn-primary">Сохранить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endif?>