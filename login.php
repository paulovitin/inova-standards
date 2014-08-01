<?php

include "include/config.php";

include("include/Ambiente.php");
$ambiente = new Ambiente();

session_start();

if(isset($_SESSION["id"]) == 0) {

	header("Location: ".$ambiente->urlLogout());

} else {
	header("Location: index.php");
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

$splash = array('field.jpg', 'nature.jpg', 'poppy.jpg', 'tulip.jpg');


$imagens = [];

$diretorio = new DirectoryIterator('splashPage/images/');

foreach ($diretorio as $arquivo) {
	
	if($arquivo->getFileName() == '..' || $arquivo->getFileName() == '.') { continue; }

	$imagens[] = $arquivo->getFileName();

}
$quantidade_imagens = count($imagens);
$atual = rand(0, $quantidade_imagens - 1);
?>
<!DOCTYPE html>
<html class="no-js" lang="pt-br">
	<head>
		
		<title><?=TITULO_APLICACAO . ' ' . SECRETARIA . ', ' . CIDADE . ' - ' . UF?></title>
	</head>
	<body>

		<div id="splash">
			<img src="splashPage/images/<?php echo $imagens[$atual] ?>" />
		</div>

		<div id="geral">
			<div class="container">
			<header><h1>Inova<span>Cidade</span></h1></header>
			<div class="frase">
				<p><strong>Seja bem vindo ao sistema <span>InovaCidade</span>. Uma poderosa ferramenta de gerenciamento de informações municipais.</strong></p>
			</div>

			<fieldset>
				<?php
				if($_GET['horario']) {
					echo '<div class="alert alert-error">O sistema ainda não foi liberado pela regulação.</div>';
				} else if($_GET['erro']) {
					echo '<div class="alert alert-error">Usuário ou senha não conferem.</div>';
				} else if($_GET['vazio'] == 1) {
					echo '<div class="alert alert-info">Informe o usuário e a senha!</div>';
				}
				?>
				<form class="form-inline" method="post" action="logar.php">
	  				<input type="text" name="login" id="login" class="input-small" placeholder="Login">
	  				<input type="password" name="senha" id="senha" class="input-small" placeholder="Senha">
	  				<button type="submit" class="btn btn-inverse">Entrar</button>
				</form>
			</fieldset>
			<div class="Copyright"><a href="http://pt.wikipedia.org/wiki/Computa%C3%A7%C3%A3o_em_nuvem" target="blank"><img src="splashPage/cloud.png" alt="Cloud Computing" title="Cloud Computing" align="left"></a><p align="right">Software Desenvolvido por <br><span class="inova">Inova Tecnologia e Gestão</span></p>
									
			</div>
		</div>

	</body>
</html>
