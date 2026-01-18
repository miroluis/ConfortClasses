<h2>Sensores</h2>

<p>
  Dispositivo: <strong>{{ dispositivo.nome }}</strong>
  {% if dispositivo.mac_address %} — MAC: {{ dispositivo.mac_address }}{% endif %}
</p>

<p>
  <a href="index.php?a=sensor_create&id_dispositivo={{ id_dispositivo }}">+ Novo sensor</a>
  |
  <a href="index.php?a=dispositivos&id_sala={{ dispositivo.id_sala }}">Voltar aos dispositivos</a>
</p>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Tipo</th>
      <th>Unidade</th>
      <th>Token</th>
      <th>Ordem</th>
      <th>Ativo</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    {% for s in sensores %}
      <tr>
        <td>{{ s.id_sensor }}</td>
        <td>{{ s.nome }}</td>
        <td>{{ s.tipo_sensor }}</td>
        <td>{{ s.id_unidade }}</td>
        <td>{{ s.token }}</td>
        <td>{{ s.ordem_leitura }}</td>
        <td>{{ s.ativo ? 'Sim' : 'Não' }}</td>
        <td>
          <a href="index.php?a=leituras&id_sensor={{ s.id_sensor }}">Leituras</a>
          |
          <a href="index.php?a=sensor_edit&id_sensor={{ s.id_sensor }}">Editar</a>
          |
          <a href="index.php?a=sensor_delete&id_sensor={{ s.id_sensor }}"
            onclick="return confirm('Apagar este sensor?');">Apagar</a>
        </td>
      </tr>
    {% else %}
      <tr><td colspan="8">Sem sensores.</td></tr>
    {% endfor %}
  </tbody>
</table>
