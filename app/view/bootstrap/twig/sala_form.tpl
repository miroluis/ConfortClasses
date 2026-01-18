<h2>Nova Sala</h2>
<form method="post" action="index.php?a={{ action }}">
    <input type="hidden" name="id_empresa" value="{{ id_empresa }}">

    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Sala</label>
        <input type="text" class="form-control" name="nome" value="{{sala.nome|e }}">   
        {% if errors.nome is defined %}
            <div class="text-danger">{{ errors.nome }}</div>
        {% endif %}
    </div>


    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="index.php?a=salas&id_empresa={{ id_empresa }}" class="btn btn-secondary">Cancelar</a>
</form>