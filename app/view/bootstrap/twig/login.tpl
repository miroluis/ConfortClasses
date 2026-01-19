<form method="post" action="index.php?a=login">

<!-- utilizador | Text input-->
<div class="form-group row">
    <label class="col-md-4 col-form-label" for="login">Utilizador</label>
    <div class="col-md-4">
        <input id="login" name="user" type="text" class="form-control input-md" required>
    </div>
</div>

<!-- Senha | Password input-->
<div class="form-group row">
    <label class="col-md-4 col-form-label" for="pass">Senha</label>
    <div class="col-md-4">
        <input id="pass" name="pass" type="password" class="form-control input-md" required>
    </div>
</div>

<!-- Button -->
<div class="form-group row">
    <label class="col-md-4 col-form-label" for="singlebutton"></label>
    <div class="col-md-4">
        <button type="submit" id="singlebutton" class="btn btn-primary">Entrar</button>
    </div>
</div>

</form>
