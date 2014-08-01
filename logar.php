<?php

include("include/conectar.php");

include("include/biblioteca.php");

$url = $ambiente->url();

$pass = addslashes($_POST['senha']);
$logon = addslashes($_POST['login']);
if($pass && $logon) {

	$encript = base64_encode($pass);
	
	$sql = "SELECT id_usuario, tipusuario, id_estabelecimento, Nome FROM stabusuario WHERE login = '$logon' AND Senha = '$encript' AND status = 'A'";
	
	$query = mysql_query($sql);
	$result = mysql_num_rows($query);
	if($result > 0) {
		$dados = mysql_fetch_array($query);
		$marcador = $dados["id_usuario"];
		$id = $dados["id_usuario"];
		$nome = $dados["Nome"];
		$tipo = $dados["tipusuario"];
		$stab = $dados["id_estabelecimento"];
		$sql_cid = "SELECT codcidade FROM scadestabelecimento INNER JOIN stabusuario ON scadestabelecimento.id_estabelecimento = 
		stabusuario.id_estabelecimento WHERE stabusuario.id_usuario = '" . $id . "'";
		$query_cid = mysql_query($sql_cid);
		$cid = mysql_fetch_array($query_cid);
		$id_cids = $cid["codcidade"];
		
		session_start();

		$_SESSION["marcador"] = $marcador;
		$_SESSION["id"] = $id;
		$_SESSION["tipo"] = $tipo;
		$_SESSION["stab"] = $stab;
		$_SESSION["id_cids"] = $id_cids;
		$_SESSION['cidade'] = "teixeira";
		
		$_SESSION['user'] = [
			'id'=>$id,
			'nome'=>$nome,
			'username'=> $logon,
			'estabelecimento_id'=> $stab,
			'cidade_id'=> $id_cids,
			'tipo_usuario'=>$tipo,
		];

		setcookie('usuario', convert_uuencode(base64_encode(json_encode($_SESSION))));

		if($_SESSION['tipo'] >= 192) {
			header("Location: /samu/atendimento");
		} elseif($_SESSION["tipo"] == 1 || $_SESSION["tipo"] == 4){
			header("Location: index.php");
		}else{
			$horario = date("Y-m-d");
			$sql_dialiberado = "SELECT COUNT(*) FROM logar WHERE dia = '" . $horario . "'";
			$query_dialiberado = mysql_query($sql_dialiberado);
			$dialiberado = mysql_fetch_array($query_dialiberado);
			//if($dialiberado[0] > 0){
			if($dialiberado[0] > 0){
				header("Location: index.php");
			}else{
				session_destroy();
				header("Location: ".$url."/login.php?horario=1");
			}

		}
	} else {
		header("Location: ".$url."/login.php?erro=1");
	}
} else {
	header("Location: ".$url."/login.php?vazio=1");
}
?>
