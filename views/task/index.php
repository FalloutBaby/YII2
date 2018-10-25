<div class="jumbotron">
	<h1>Задачи</h1>
	<? if(!$user['username']): ?>
		<p class="lead">Пожалуйста, войдите или зарегистрируйтесь.</p>
		<? else: ?>
			<p class="lead">Добро пожаловать,
				<?= $user['username']; ?>!</p>
			<? foreach ($tasks as $task): ?>
			<div class="col-lg-4">
				<h2><?= $task['title'] . ' ' . $task['id']; ?></h2>

				<p><?= $task['description']; ?></p>

				<p>Создана <?= $task['dateOfCreation']; ?></p>
				<p>Выполнить до <?= $task['deadline']; ?></p>
			</div>
			<? endforeach; ?>
			<? endif; ?>
</div>
