<h2>Salas</h2>

<div class="mb-3">
    <a href="index.php?a=empresas" class="btn btn-secondary">
        ← Voltar para Empresas
    </a>

    <a href="index.php?a=sala_create&id_empresa={{ id_empresa }}" class="btn btn-success">
        + Nova Sala
    </a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        {% for sala in salas %}
        <tr>
            <td>{{ sala.id_sala }}</td>
            <td>{{ sala.nome }}</td>
            <td>
                <a href="index.php?a=dispositivos&id_sala={{ sala.id_sala }}"
                class="btn btn-primary btn-sm">
                    Dispositivos
                </a>

                <a href="index.php?a=salas_delete&id={{ sala.id_sala }}&id_empresa={{ id_empresa }}" 
                onclick="return confirm('Tem certeza que deseja apagar esta sala?');"
                class="btn btn-danger btn-sm">
                    Apagar
                </a>
            </td>

        </tr>
        {% else %}
        <tr>
            <td colspan="3">Nenhuma sala encontrada.</td>
        </tr>
        {% endfor %}
    </tbody>
</table>