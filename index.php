<?php

	if ( isset($_GET['lang']) ) {

		setcookie("userLang", $_GET['lang']);

	}

?><!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Language</title>
	<meta name="viewport" content="width=460">
	<style>
		h2 {
			color: red;
		}
		label {
			border:1px solid;padding: 10px;margin: 10px;
		}
	</style>
</head>
<body>

	<h1>
		Язык определяется через:
	</h1>

<?php

	$lang = 'ru';
	$acceptLang = ['en', 'it', 'ru', 'de'];

	if ( isset($_GET['lang']) ) {

		$lang = $_GET['lang'];

		echo 'GET<br>';

	}
	else if ( isset($_COOKIE['userLang']) ) {

		$lang = $_COOKIE['userLang'];

		echo 'COOKIE<br>';

	}
	else {

		$langBrowser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

		if ( in_array($langBrowser, $acceptLang) ) {

			$lang = $langBrowser;

			echo 'Browser<br>';

		}

	}

	require_once "index_{$lang}.php";

?>

	<h3>
		Сменить:
	</h3>

	<form action="/" onchange="this.submit()">

		<?php foreach ( $acceptLang as $_lang ) { ?>

			<label>

				<?php echo $_lang; ?>

				<input type="radio" value="<?php echo $_lang; ?>" name="lang"<?php if ( $_lang === $lang ) echo ' checked="checked"'; ?>>

			</label>

		<?php } ?>

	</form>

<!--  onchange="document.cookie='userLang=<?php echo $_lang; ?>; path=/; expires=Tue, 19 Jan 2038 03:14:07 GMT'" -->

</body>
</html>