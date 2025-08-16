<div class="card mb-10">
                  <div class="card-header">
                    <h3 class="card-title">Listar Cursos</h3>
                    
                    <div class="ajusteNOVO">

                    <a href="#"class="btn btn-primary "> 

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
                          <th>Nome</th>
                          <th>Sigla</th>
                          <th >Observação</th>
                          <th >Data da Matricula</th>
                          <th >Status</th>
                          <th >Editar</th>
                          <th >Desativar</th>
                        </tr>
                      </thead>
                      <tbody>

                      <!-- linha e repetida de acordo com quanto cursos tem no banco de dados -->

                      <?php foreach($matriculas as $linha):?> 

                        <tr class="align-middle">
                          <!-- <td><img style="width: 100px" src="<?= URL_BASE?>assets/img/categorias/<?= $linha['foto_funcionario'] ?>" alt=""></td> -->
                          <td> <?= $linha['nome_aluno'];?>  </td>
                          <td> <?= $linha['nome_sigla'];?>  </td>
                          <td> <?= $linha['obs_matricula'];?>  </td>
                          <td> <?= $linha['data_matricula'];?>  </td>
                          <td> <?= $linha['status_matricula'];?>  </td>
                          <td><i class="bi bi-pencil-square"></i></td>
                          <td ><i class="bi bi-x-circle"></i></td>
                          <!-- <td><span class="badge text-bg-danger">55%</span></td> -->
                        </tr>

                        <?php endforeach;?>

                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>