<h2>Nova Empresa</h2>

<form method="post" action="index.php?a={{ action }}">
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input
      type="text"
      id="nome"
      name="nome"
      class="form-control {% if errors.nome %}is-invalid{% endif %}"
      value="{{ empresa.nome|e }}"
      maxlength="120"
      required
    >

    {% if errors.nome %}
      <div class="invalid-feedback">
        {{ errors.nome }}
      </div>
    {% endif %}
  </div>

  <button type="submit" class="btn btn-primary">Guardar</button>
  <a href="index.php?a=empresas" class="btn btn-secondary">Cancelar</a>
</form>
