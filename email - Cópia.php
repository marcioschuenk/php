<?php
    if(empty($_GET['id'])){
        header("Location: perfil.php");
    }
    $id = $_GET['id'];
    include "modelo/banco.php";
    $query = mysqli_query($con, "select * from evento where id = $id");
    if($evento = mysqli_fetch_assoc($query)){
        $titulo = $evento['titulo'];
        $email = $_COOKIE['email'];
        $emailbanco = $evento['organizador'];
        if($email != $emailbanco){
            header("Location: perfil.php");
        }
    }
    $participar = mysqli_query($con, "select * from participar where idevento = $id");
    $total = mysqli_num_rows($participar);
    if($total == 0){
        header("Refresh:5, meuseventos.php");
        include "anterior.php";
        echo "<p> Não tem inscritos, você será redirecionado para a página anterior.</p>";
    }else{
?>        
        

        <form action="mail_send.php" method="post">
            <fieldset>
                <input required name="email" value="<?php echo $email; ?>" type="hidden">
                <input required name="titulo" value="<?php echo $titulo; ?>" type="hidden">
                <input required name="id" value="<?php echo $id; ?>" type="hidden">
            </fieldset>
            <div class="form-group">
              <label for="descricao">Mensagem</label>
              <textarea required class="form-control" name="mensagem" id="descricao" placeholder="Digite a mensagem para todos os inscritos"></textarea>
            </div>
            <fieldset>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </fieldset>
        </form>
<?php
    }
    include "posterior.php";
?>