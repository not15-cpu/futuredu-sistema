<link rel="stylesheet" href="<?= URL_BASE; ?>assets/css/dash.css">
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Lista de Projetos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Professor Responsável</th>
                    <th>Curso</th>
                    <th>Participantes</th>
                    <th>Link Projeto</th>
                    <th>Editar</th>
                    <th>Desativar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projetos as $projeto): ?>
                    <tr class="align-middle">
                        <td><?= $projeto['titulo_projeto']; ?></td>
                        <td><?= $projeto['descricao_projeto']; ?></td>
                        <td><?= $projeto['nome_professor']; ?></td>
                        <td><?= $projeto['nome_curso']; ?></td>
                        <td><?= $projeto['total_participantes']; ?></td>
                        <td><a href="<?= $projeto['url_projeto']; ?>" target="_blank"><?= $projeto['titulo_projeto']; ?></a></td>
                        <td><button class="text-bg-edit"><a href="<?= URL_BASE; ?>aluno/listar"><i class="bi bi-pencil"></i></button></a></td>
                        <td><button class="text-bg-danger desativar"><a href="<?= URL_BASE; ?>aluno/listar" onclick="return confirm('Tem certeza que deseja desativar este aluno?');"><i class="bi bi-trash"></i></a>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>