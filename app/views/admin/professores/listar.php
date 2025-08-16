<link rel="stylesheet" href="<?= URL_BASE; ?>assets/css/dash.css">
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Lista de Professores</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Formação</th>
                    <th>Cargo</th>
                    <th>Editar</th>
                    <th>Desativar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instrutores as $instrutor): ?>
                    <tr class="align-middle professores">
                        <td><img style="width: 120px;border-radius: 20px;" src="<?= URL_BASE; ?>assets/img/professores/<?= $instrutor['foto_funcionario']; ?>" alt=""></td>
                        <td><?= $instrutor['nome_funcionario']; ?></td>
                        <td><?= $instrutor['email_funcionario']; ?></td>
                        <td><?= $instrutor['telefone1_funcionario']; ?></td>
                        <td><?= $instrutor['form_cad_funcionario']; ?></td>
                        <td><?= $instrutor['cargo_funcionario']; ?></td>
                        <td><button class="text-bg-edit"><a href="<?= URL_BASE; ?>aluno/listar"><i class="bi bi-pencil"></i></button></a></td>
                        <td><button class="text-bg-danger desativar"><a href="<?= URL_BASE; ?>aluno/listar" onclick="return confirm('Tem certeza que deseja desativar este aluno?');"><i class="bi bi-trash"></i></a>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>