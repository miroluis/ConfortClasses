<h2>
  {% if mode == 'edit' %}Editar{% else %}Novo{% endif %} Dispositivo
</h2>

<form method="post" action="index.php?a={% if mode == 'edit' %}dispositivo_update&id_dispositivo={{ dispositivo.id_dispositivo }}{% else %}dispositivo_store{% endif %}">
  <div style="margin-bottom: 10px;">
    <label>Sala</label><br>
    <select name="id_sala" required>
      <option value="">— selecionar —</option>
      {% for s in salas %}
        <option value="{{ s.id_sala }}" {% if dispositivo.id_sala == s.id_sala %}selected{% endif %}>
          {{ s.nome }}
        </option>
      {% endfor %}
    </select>
  </div>

  <div style="margin-bottom: 10px;">
    <label>Nome</label><br>
    <input type="text" name="nome" value="{{ dispositivo.nome }}" required maxlength="100">
  </div>

  <div style="margin-bottom: 10px;">
    <label>Descrição</label><br>
    <input type="text" name="descricao" value="{{ dispositivo.descricao }}" maxlength="255">
  </div>

  <div style="margin-bottom: 10px;">
    <label>MAC Address</label><br>
    <input type="text" name="mac_address" value="{{ dispositivo.mac_address }}" maxlength="50">
  </div>

  <div style="margin-bottom: 10px;">
    <label>Ativo</label><br>
    <select name="ativo">
      <option value="1" {% if dispositivo.ativo == 1 %}selected{% endif %}>Sim</option>
      <option value="0" {% if dispositivo.ativo == 0 %}selected{% endif %}>Não</option>
    </select>
  </div>

  <button type="submit">Guardar</button>
  <a href="index.php?a=dispositivos&id_sala={{ id_sala }}">Cancelar</a>
</form>
