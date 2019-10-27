<!doctype html>
<html lang="ru" class="h-100">
<head>
	<base href="<?=$this->app->getSiteDomain()?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Пример на bootstrap 4: Прижатый футер отображается в нижней части страницы, когда содержимое окна слишком короткое. Панель навигации в верхней части.">

	<title>Тудушница</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/style.css">

</head>
<body class="d-flex flex-column h-100">
<header>
	<!-- Fixed navbar -->
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="/">Задачник</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
				</li>
			</ul>
			<div class="form-inline mt-2 mt-md-0">
				<?php if ($this->app->user->isUserAuth()):?>
					<a href="/user/logout" class="btn btn-info">Выйти</a>
				<?php else:?>
					<a href="#" class="btn btn-info" data-toggle="modal" data-target="#authModal">Авторизация</a>
				<?php endif?>
			</div>
		</div>
	</nav>
</header>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
	<div class="container">
		<?php include($this->_contentTemplate)?>
	</div>
</main>

<footer class="footer mt-auto py-3">
	<div class="container">
		<span class="text-muted">Тестовое задание от компании BeeJee для Цой Александра</span>
	</div>
</footer>

<?php if (!$this->app->user->isUserAuth()):?>
	<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="post" action="/user/auth">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Добавить новую задачу</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="authLogin">Логин</label>
							<input name="auth_login" type="text" class="form-control" id="authLogin" placeholder="Логин" required>
						</div>
						<div class="form-group">
							<label for="authPwd">Пароль</label>
							<input name="auth_pwd" type="password" class="form-control" id="authPwd" placeholder="Пароль" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
						<button type="submit" class="btn btn-primary">Войти</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php endif?>

<script
	src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="assets/js/tools.js"></script>
</body>
</html>