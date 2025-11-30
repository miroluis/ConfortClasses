<?php
return function($a){ //trata-se de uma função anónima
    return <<< HTML_END_03
<form method="post">
  
<!-- utilizador | Text input-->
<div class="form-group row">
    <label class="col-md-4 col-form-label" for="login">utilizador</label>
    <div class="col-md-4">
        <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="">
        
    </div>
</div>

<!-- Senha | Passwrod input-->
<div class="form-group row">
    <label class="col-md-4 col-form-label" for="Pass">Senha</label>
    <div class="col-md-4">
        <input id="Pass" name="Pass" type="password" placeholder="" class="form-control input-md" required="">
        
    </div>
</div>

<!--  | Button -->
<div class="form-group row">
    <label class="col-md-4 col-form-label" for="singlebutton"></label>
    <div class="col-md-4">
        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Entrar</button>
    </div>
</div>

</form>

HTML_END_03;
}
?>