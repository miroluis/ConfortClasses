<h2>Empresas</h2>
<a href="index.php?a=empresa_create" class="btn btn-success mb-3">
    + Nova Empresa
</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    {% for empresa in empresas %}
        <tr>
            <td>{{ empresa.id_empresa }}</td>
            <td>{{ empresa.nome }}</td>
            <td>
                <a class="btn btn-sm btn-primary" 
                    href="index.php?a=salas&id_empresa={{ empresa.id_empresa }}">
                    Salas
                </a>

                <a href="index.php?a=empresas_delete&id={{ empresa.id_empresa }}"
                    onclick="return confirm('Apagar esta empresa?');"
                    class="btn btn-sm btn-danger">
                    Apagar
                </a>
            </td>
        </tr>
    {% else %}
        <tr>
            <td colspan="3">Nenhuma empresa encontrada.</td>
        </tr>
    {% endfor %}
    </tbody>
</table>