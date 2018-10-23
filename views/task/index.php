<div class="jumbotron">
	<h1>Страница приветствия</h1>
	<? if(!$username): ?>
		<p class="lead">Пожалуйста, войдите или зарегистрируйтесь.</p>
	<? else: ?>
		<p class="lead">Добро пожаловать, <?= $username; ?>!</p>
	<? endif; ?>
</div>
