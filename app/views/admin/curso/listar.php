<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['mensagem']) && isset($_SESSION['tipoMsg'])) {

  $msg = $_SESSION['mensagem'];
  $tipo = $_SESSION['tipoMsg'];

  // tipo de mensagem que irei exibir no site

  if ($tipo == 'sucesso') {
    echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
  } else if ($tipo == 'erro') {
    echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
  }

  unset($_SESSION['mesagem']);
  unset($_SESSION['tipoMsg']);
}


?>

<div class="card mb-10">
  <div class="card-header">
    <h3 class="card-title">Listar Cursos</h3>

    <div class="ajusteNOVO">

      <a href="<?= URL_BASE ?>curso/adicionar" class="btn btn-primary ">

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
          <th>Nivel</th>
          <th>Modalidade</th>
          <th>Valor</th>
          <th>CH</th>
          <th>Área</th>
          <th>Pré-Requisito</th>
          <th>Status</th>
          <th>Publicar</th>
          <th>Editar</th>
          <th>Desativar</th>
        </tr>
      </thead>
      <tbody>

        <!-- linha e repetida de acordo com quanto cursos tem no banco de dados -->

        <?php foreach ($cursos as $linha): ?>

          <tr class="align-middle">
            <td><img style="width: 100px" src="<?= URL_BASE ?>uploads/curso/<?= $linha['foto_curso'] ?>" alt=""></td>
            <td> <?= $linha['nome_curso']; ?> </td>
            <td> <?= $linha['nivel_curso']; ?> </td>
            <td> <?= $linha['modalidade_curso']; ?> </td>
            <td> | R$ <?= $linha['valor_curso']; ?> | </td>
            <td> <?= $linha['carga_horaria_curso']; ?> </td>
            <td> <?= $linha['area_curso']; ?> </td>
            <td> <?= $linha['pre_requisito_curso']; ?> </td>
            <td> <?= $linha['status_curso']; ?> </td>

            <td style="text-align: center;">
              <input
                class="form-check-input toggle-status"
                type="checkbox"
                role="switch"
                data-id="<?= $linha['id_curso'] ?>"
                <?= $linha['status_curso'] === 'Ativo' ? 'checked' : '' ?>>
            </td>

            <td><a href="<?= URL_BASE ?>curso/editar/<?= $linha['id_curso'] ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>

            <td><a href="#" class="btn btn-danger" onclick="abrirModalDesativar(<?= $linha['id_curso']; ?>); return false;">
                <i class="bi bi-x-circle"></i></a></td>
          </tr>

        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="desativarCurso" tabindex="-1" role="dialog" aria-labelledby="desativarCursoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarCursoLabel">Desativar Curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja desativar esse curso?</p>
        <input type="hidden" id="idCurso" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary" id="simDesativar">Sim</button>
      </div>
    </div>
  </div>
</div>


<script>
document.querySelectorAll('.toggle-status').forEach(input => {
        input.addEventListener('change', function() {
 
            const id = this.dataset.id;
            const status = this.checked ? 'Ativo' : 'Pendente';
 
            //requisição AJAX com fetch
            fetch('<?= URL_BASE ?>curso/atualizarStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/jason'
                    },
                    body: JSON.stringify({
                        id_curso: id,
                        status_curso: status
                    })
 
                })
 
                .then(response => response.json()) // Corrigido "=" para "=>"
                .then(data => {
                    if (!data.sucesso) {
                        alert('Erro ao atualizar status');
                        this.checked = !this.checked;
                    }
                })
                .catch(() => { // Corrigido "cath" para "catch"
                    alert('Erro de comunicação'); // Corrigido "comunicaçao" para "comunicação" (opcional, se quiser corrigir o português)
                    this.checked = !this.checked;
                });
 
        })
    })

  // script para abrir o modal e desativar o curso
  function abrirModalDesativar(idCurso) {


    if ($('#desativarCurso').hasClass('show')) {
      return;
    }

    // ao clicar no botão SIM - pega iD
    document.getElementById('idCurso').value = idCurso
    $('#desativarCurso').modal('show');

    document.getElementById('simDesativar').addEventListener('click', function() {
      const idCurso = document.getElementById('idCurso').value

      if (idCurso) {
        desativarCurso(idCurso)
      }

    })

    //função em AJAX para realizar uma solicitação ao ControllerCurso, chamando o método desativar


    // `` usando isso, conseguimos utilizar tanto variavel quanto escrita no mesmo ligar
    function desativarCurso(idCurso) {
      fetch(`<?= URL_BASE ?>curso/desativar/${idCurso}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'

          }
        })

        .then(response => {
          //se o código de resposta não for OK - exibir ERRO

          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`)

          }
          return response.json()
        })

        .then(data => {
          // se a resposta for OK, Fechar 0 modal e atualiza a página
          if (data.sucesso) {
            console.log("Curso desativado com sucesso!")
            $('#desativarCurso').modal('hide');
            setTimeout(() => {
              location.reload();
            }, 500 ) //Delay de carregamento

          } else {
            console.log("Ocorreu um erro ao desativar o curso!")
            alert(data.mensagem)
          }
          
        })

        .catch(error => {
          console.error('Erro: ', error)
          alert(data.mensagem)
        })

    }

  }
</script>