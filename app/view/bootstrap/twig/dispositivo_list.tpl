<h2>Dispositivos</h2>

<form method="get" action="index.php" style="margin-bottom: 12px;">
  <input type="hidden" name="a" value="dispositivos">

  <label>Sala:</label>
  <select name="id_sala">
    <option value="0">— Todas —</option>
    {% for s in salas %}
      <option value="{{ s.id_sala }}" {% if id_sala == s.id_sala %}selected{% endif %}>
        {{ s.nome }}
      </option>
    {% endfor %}
  </select>

  <button type="submit">Filtrar</button>

  <a href="index.php?a=dispositivo_create&id_sala={{ id_sala }}">+ Novo dispositivo</a>
</form>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>Sala</th>
      <th>Nome</th>
      <th>MAC</th>
      <th>Ativo</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    {% for d in dispositivos %}
      <tr>
        <td>{{ d.id_dispositivo }}</td>
        <td>{{ d.id_sala }}</td>
        <td>{{ d.nome }}</td>
        <td>{{ d.mac_address }}</td>
        <td>{{ d.ativo ? 'Sim' : 'Não' }}</td>
        <td>
          <a href="index.php?a=dispositivo_edit&id_dispositivo={{ d.id_dispositivo }}">Editar</a>
          |
          <a href="index.php?a=dispositivo_delete&id_dispositivo={{ d.id_dispositivo }}"
             onclick="return confirm('Apagar este dispositivo?');">Apagar</a>
        </td>
      </tr>
    {% else %}
      <tr><td colspan="6">Sem dispositivos.</td></tr>
    {% endfor %}
  </tbody>
</table>
