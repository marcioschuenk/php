<?php
  date_default_timezone_set('America/Sao_Paulo');
	include "controle/confereconexao.php";
	$email = $_COOKIE['email'];
	
	include "anterior.php";
?>
<h1>Criação de Eventos</h1>
<form method="post" action="novoevento2.php">
    <div class="form-group">
      <label for="tipo">Tipo de Evento</label>
      <select name="tipo" class="form-control" id="tipo">
      		<option value="Palestra">Palestra</option>
      		<option value="Curso">Curso</option>
      		<option value="WorkShop">WorkShop</option>
      		<option value="Feira">Feira</option>
      		<option value="Congresso">Congresso</option>
      		<option value="Simpósio">Simpósio</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="titulo">Título do Evento</label>
      <input type="text" required class="form-control" name="titulo" id="titulo" placeholder="Digite aqui o título do evento">
    </div>
    <div class="form-group">
      <label for="tema">Tema do Evento</label>
      <input type="text" required class="form-control" name="tema" id="tema" placeholder="Digite aqui o tema do evento">
    </div>
    <div class="form-group">
      <label for="descricao">Descreva o evento</label>
      <textarea required class="form-control" name="descricao" id="descricao" placeholder="Coloque aqui, informações para o visitante saber mais sobre o seu evento"></textarea>
    </div>
    <div class="form-group">
      <label for="vagas">Vagas</label>
      <input type="number" required min="0" class="form-control" name="vagas" id="vagas" placeholder="Coloque a quantidade de vagas">
    </div>
    <script>
    function copiadata(){
      document.getElementById("datat").value = document.getElementById("datai").value;
    }
    function copiahora(){
      document.getElementById("horat").value = document.getElementById("horai").value;
    }
    </script>
    <div class="form-group">
      <?php
        $atual = date("Y-m-d");
      ?>
      <input type="hidden" id="hoje" value="<?php echo $atual; ?>" />
      <label for="datai">Data Início</label>
      <input type="date" onBlur="copiadata()" required class="form-control" name="datai" id="datai" placeholder="Digite aquia data que inicia o evento" value="<?php echo $atual; ?>" />
    </div>
    <div class="form-group">
      <label for="horai">Hora Início</label>
      <input type="time" required class="form-control" name="horai" id="horai" placeholder="Digite aqui a hora de início do evento">
    </div>
    <div class="form-group">
      <label for="datat">Data Término</label>
      <input type="date" required class="form-control" name="datat" id="datat" placeholder="Digite aquia data que termina o evento" onblur="conferedata()" />
    </div>
    <div class="form-group">
      <label for="horat">Hora Término</label>
      <input type="time" required class="form-control" name="horat" id="horat" placeholder="Digite aqui a hora de início do evento" onblur="conferehora()" />
    </div>
    <div class="form-group">
      <label for="endereco">Endereço do Evento</label>
      <input type="text" required class="form-control" name="endereco" id="endereco" placeholder="Digite aqui o Endereço completo do evento">
    </div>
     <div class="form-group">
      <label for="cidade">Cidade</label>
      <input type="text" required class="form-control" name="cidade" id="cidade" placeholder="Digite aqui a cidade onde ocorrerá o evento">
    </div>
    <div class="form-group">
      <label for="telefone">Telefone de contato</label>
      <input type="tel" required class="form-control telefone" name="telefone" id="telefone" placeholder="Digite aqui um telefone de contato, não se preocupe com o formato">
    </div>
    <div class="form-group">
      <label for="investimento">Valor do Investimento</label>
      <input type="number" required step="any" min="0" class="form-control" name="investimento" id="investimento" placeholder="Caso seja gratuito, digite zero" title="Caso seja um evento gratuito, deixe em branco.">
    </div>
     <div class="form-group">
      <label for="video">Vídeo de Divulgação</label>
      <input type="text" class="form-control" name="video" id="video" placeholder="Cole o endereço do vídeo de divulgação do youtube aqui." title="Somente vídeos do Youtube, caso não tenha, deixe em branco.">
    </div>

    <button type="submit" class="btn btn-danger pull-right">Cadastrar Evento</button>
</form>


<?php
	include "posterior.php";
?>
  <script src="http://digitalbush.com/wp-content/uploads/2014/10/jquery.maskedinput.js"></script>
<script>

jQuery("input.telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
        });
      function conferedata(){
        datai = document.getElementById("datai").value;
        datat = document.getElementById("datat").value;
        hoje = document.getElementById("hoje").value;
        if(datat < datai){
          alert("A data e hora de término, não pode ser menor que a data e hora de início");
          document.getElementById("datat").value = document.getElementById("datai").value;
          document.getElementById("datat").focus();
        }
      }
      function conferehora(){
        datai = document.getElementById("datai").value;
        datat = document.getElementById("datat").value;
        if(datai == datat){
          horai = document.getElementById("horai").value;
          horat = document.getElementById("horat").value;
          if(horat <= horai){
            alert("A data e hora de término, não pode ser menor ou igual que a data e hora de início");
            document.getElementById("horat").value = document.getElementById("horai").value;
            document.getElementById("horat").focus();

          }
        }
      }
  </script>