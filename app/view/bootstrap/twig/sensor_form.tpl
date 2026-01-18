<h2>{% if mode == 'edit' %}Editar{% else %}Novo{% endif %} Sensor</h2>

<p>Dispositivo: <strong>{{ dispositivo.nome }}</strong></p>

<form method="post"
      action="index.php?a={% if mode == 'edit' %}sensor_update&id_sensor={{ sensor.id_sensor }}{% else %}sensor_store{% endif %}">

  <input type="hidden" name="id_dispositivo" value="{{ id_dispositivo }}">

  <div style="margin-bottom: 10px;">
    <label>Unidade de medida</label><br>
    <select name="id_unidade" required>
      <option value="">— selecionar —</option>
      {% for u in unidades %}
        <option value="{{ u.id_unidade }}" {% if sensor.id_unidade == u.id_unidade %}selected{% endif %}>
          {{ u.nome ?? ('Unidade #' ~ u.id_unidade) }}
        </option>
      {% endfor %}
    </select>
  </div>

  <div style="margin-bottom: 10px;">
    <label>Nome</label><br>
    <input type="text" name="nome" value="{{ sensor.nome }}" maxlength="100">
  </div>

  <div style="margin-bottom: 10px;">
    <label>Tipo de sensor</label><br>
    <input type="text" name="tipo_sensor" value="{{ sensor.tipo_sensor }}" maxlength="50">
  </div>

  <div style="margin-bottom: 10px;">
    <label>Token (único)</label><br>
    <input type="text" name="token" value="{{ sensor.token }}" maxlength="100" required>
  </div>

  <div style="margin-bottom: 10px;">
    <label>Ordem de leitura</label><br>
    <input type="number" name="ordem_leitura" value="{{ sensor.ordem_leitura }}">
  </div>

  <div style="margin-bottom: 10px;">
    <label>Ativo</label><br>
    <select name="ativo">
      <option value="1" {% if sensor.ativo == 1 %}selected{% endif %}>Sim</option>
      <option value="0" {% if sensor.ativo == 0 %}selected{% endif %}>Não</option>
    </select>
  </div>

  <button type="submit">Guardar</button>
  <a href="index.php?a=sensores&id_dispositivo={{ id_dispositivo }}">Cancelar</a>
</form>
