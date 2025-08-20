<link rel="stylesheet" href="<?= URL_BASE; ?>assets/css/dash.css">
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Lista de Siglas dos Cursos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome Sigla</th>
                    <th>Curso</th>
                    <th>Editar</th>
                    <th>Desativar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($siglas as $sigla): ?>
                    <tr class="align-middle">
                        <td><?= $sigla['nome_sigla']; ?></td>
                        <td><?= $sigla['nome_curso']; ?></td>
                        <td><button class="text-bg-edit"><a href="<?= URL_BASE; ?>aluno/listar"><i class="bi bi-pencil"></i></button></a></td>
                        <td><button class="text-bg-danger desativar"><a href="<?= URL_BASE; ?>aluno/listar" onclick="return confirm('Tem certeza que deseja desativar este aluno?');"><i class="bi bi-trash"></i></a>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>