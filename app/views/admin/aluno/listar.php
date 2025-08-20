<?php
function mascararCPF($cpf)
{
  return substr($cpf, 0, 3) . '.***.***-' . substr($cpf, -2);
} ?>

<?php
function mascararSenha($senha)
{
  return str_repeat('*', strlen($senha));
} ?>

<div class="card mb-20">
  <div class="card-header">
    <h3 class="card-title">Listar Cursos</h3>

    <div class="ajusteNOVO">

      <a href="#" class="btn btn-primary ">

        <i class="bi bi-clipboard2-plus-fill"></i>
        Novo Curso

      </a>

    </div>

  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>Email</th>
          <th>Senha</th>
          <th>Telefone</th>
          <th>Cep</th>
          <th>Editar</th>
          <th>Desativar</th>
        </tr>
      </thead>
      <tbody>


        <!-- linha e repetida de acordo com quanto cursos tem no banco de dados -->

        <?php foreach ($alunos as $linha): ?>

          <tr class="align-middle">
            <td><img style="width: 100px" src="<?= URL_BASE ?>assets/img/categorias/<?= $linha['foto_aluno'] ?>" alt=""></td>
            <td> <?= $linha['nome_aluno']; ?> </td>
            <td> <?= mascararCPF($linha['cpf_aluno']); ?> </td>
            <td> <?= $linha['email_aluno']; ?> </td>
            <td> <?= mascararSenha($linha['senha_aluno']); ?> </td>
            <td> <?= $linha['telefone1_aluno']; ?> </td>
            <td> <?= $linha['cep_aluno']; ?> </td>
            <td><i class="bi bi-pencil-square"></i></td>
            <td><i class="bi bi-x-circle"></i></td>
            <!-- <td><span class="badge text-bg-danger">55%</span></td> -->
          </tr>

        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>