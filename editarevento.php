<?php
	include "modelo/banco.php";
	include "controle/confereconexao.php";
	date_default_timezone_set('America/Sao_Paulo');
	if(empty($_GET['id'])){
		header("Location:perfil.php");
	}
	$id = $_GET['id'];
	$query = mysqli_query($con, "select * from evento where id=$id");
	$emailc = $_COOKIE['email'];
	if($e = mysqli_fetch_assoc($query)){
		$email = $e['organizador'];
		if($email != $emailc){
			header("Location: meuseventos.php");
		}
		$titulo = $e['titulo'];
		$tema = $e['tema'];
		$vagas = $e['vagas'];
		$descricao= $e['tema'];
		$datainicio = $e['datainicio'];
		$datai = date("Y-m-d", $datainicio);
		$horai = date("H:i", $datainicio);
		$datatermino = $e['datatermino'];
		$datat = date("Y-m-d", $datatermino);
		$horat = date("H:i", $datatermino);
		$endereco = $e['endereco'];
    $telefone = $e['telefone'];
    $investimento = $e['investimento'];
    $video = $e['video'];
    if($video='nao'){
      $video = "";
    }
		$cidade = $e['cidade'];

	}
	include "anterior.php";
?>
<form method="post" action="editarevento2.php">
    <div class="form-group">
      <label for="titulo">Título do Evento</label>
      <input type="text" required class="form-control" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
    </div>
    <div class="form-group">
      <label for="tema">Tema do Evento</label>
      <input type="text" required class="form-control" name="tema" id="tema" value="<?php echo $tema; ?>">
    </div>
    <div class="form-group">
      <label for="descricao">Descreva o evento</label>
      <textarea required class="form-control" name="descricao" id="descricao"><?php echo $descricao; ?></textarea>
    </div>
    <div class="form-group">
      <label for="vagas">Vagas</label>
      <input type="number" required min="0" class="form-control" name="vagas" id="vagas"  value="<?php echo $vagas; ?>">
    </div>
    <div class="form-group">
      <label for="datai">Data Início</label>
      <input type="date" required class="form-control" name="datai" id="datai" value="<?php echo $datai; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
    </div>
    <div class="form-group">
      <label for="horai">Hora Início</label>
      <input type="time" required class="form-control" name="horai" id="horai" value="<?php echo $horai; ?>">
    </div>
    <div class="form-group">
      <label for="datat">Data Término</label>
      <input type="date" required class="form-control" name="datat" id="datat" value="<?php echo $datat; ?>">
    </div>
    <div class="form-group">
      <label for="horat">Hora Término</label>
      <input type="time" required class="form-control" name="horat" id="horat" value="<?php echo $horat; ?>">
    </div>
    <div class="form-group">
      <label for="endereco">Local do Evento</label>
      <input type="text" required class="form-control" name="endereco" id="endereco" value="<?php echo $endereco; ?>">
    </div>
     <div class="form-group">
      <label for="cidade">Cidade</label>
      <input type="text" required class="form-control" name="cidade" id="cidade" value="<?php echo $cidade; ?>">
    </div>
    <div class="form-group">
      <label for="telefone">Telefone de contato</label>
      <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo $telefone; ?>" />
    </div>
    <div class="form-group">
      <label for="investimento">Valor do Investimento</label>
      <input type="number" required step="any" class="form-control" name="investimento" id="investimento" value="<?php echo $investimento; ?>" />
    </div>
     <div class="form-group">
      <label for="video">Vídeo de Divulgação</label>
      <input type="text" class="form-control" name="video" id="video" value="<?php echo $video; ?>" />
    </div>

    <button type="submit" class="btn btn-danger pull-right">Editar Evento</button>
</form>