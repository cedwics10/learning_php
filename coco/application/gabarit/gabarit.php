<!DOCTYPE html>
<html>
	<head>
		<?php require "../application/gabarit/inc_head.php" ?>
	</head>
	<body>
		<a class="visually-hidden-focusable" href="#divmenu">Aller au menu</a>
		<a class="visually-hidden-focusable" href="#main">Aller au contenu principal</a>
		<div class="container">
			<header>
				<?php require "../application/gabarit/inc_entete.php" ?>
			</header>

			<div id="divmenu">
			<?php require "../application/gabarit/inc_menu.php"; ?>
			</div>
			
			<?php require "../application/gabarit/inc_message.php"; ?>
			<div id="main">				
				<?php require $this->vue; ?>				
			</div>
			<hr>
			<footer>
				<?php require "../application/gabarit/inc_pied.php"; ?>
			</footer>
		</div>
	</body>
</html>