<div class="card card-info card-outline mb-4">

    <div class="card-header">
        <div class="card-title">Criar um novo Curso</div>
    </div>

    <form class="needs-validation" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-4">
                    <img id="img-form" src="<?= URL_BASE?>uploads/sem_imagem.png"
                        alt="Foto do curso" style="width: 100%; cursor: pointer;" title="Clique na imagem para selecionar uma foto para o curso.">

                    <input type="file" id="foto_curso" name="foto_curso" accept="image/*" style="display: none;">

                </div>

                <div class="col-md-8">

                    <div style="font-weight: 650;" class="row g-3">


                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Nome do Curso: </label>
                            <input type="text" name="nome_curso" class="form-control" id="nome_curso" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Nivel do Curso: </label>
                            <select name="nivel_curso" class="form-select" aria-label="Default select example">
                                <option selected>Selecione o Nivel</option>
                                <option value="Curso Livre">Curso Livre</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Tecnólogo">Tecnólogo</option>
                                <option value="Graduação">Graduação</option>
                                <option value="Pós-graduação">Pós-graduação</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="validationCustom02" class="form-label">Pré-Requisito: </label>
                            <input type="text" name="pre_requisito_curso" class="form-control" id="pre_requisito_curso" required="">
                        </div>
                        <div class="col-md-2">
                            <label for="validationCustom02" class="form-label">Carga Horaria: </label>
                            <input type="number" name="carga_horaria_curso" class="form-control" id="carga_horaria_curso" required="">
                        </div>
                        <div class="col-md-2">
                            <label for="validationCustom02" class="form-label">Modalidade: </label>
                            <select name="modalidade_curso" class="form-select" aria-label="Default select example">
                                <option selected></option>
                                <option value="Presencial">Presencial</option>
                                <option value="Online">Online</option>
                                <option value="Híbrido">Híbrido</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Área: </label>
                            <input type="text" name="area_curso" class="form-control" id="area_curso" required>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Informe o valor: </label>
                            <input type="number" name="valor_curso" class="form-control" id="valor_curso" required step="0.01" min="100">
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Descrição: </label>
                            <textarea type="text" name="descricao_curso" class="form-control" id="descricao_curso" required=""></textarea>
                        </div>
                    </div>

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div style="justify-content: end; display: flex;" class="card-footer">
            <button style="width: 100px; background: #0dcaf0;; color: white;" class="btn btn-info" type="submit">Criar</button>
        </div>
        <!--end::Footer-->
    </form>

    <script>

        document.addEventListener('DOMContentLoaded', function (){

            const visualizarImg  = document.getElementById('img-form');
            const arquivo        = document.getElementById('foto_curso');

            visualizarImg.addEventListener('click', function () {
                // alert("cliquei na img")
                // console.log("clique img")
                arquivo.click();
            });    

            arquivo.addEventListener('change', function(){

                if(arquivo.files && arquivo.files[0]){

                    let render = new FileReader()
                    render.onload = function(e){
                        visualizarImg.src = e.target.result
                    }

                    render.readAsDataURL(arquivo.files[0])

                }

            })

        })

    </script>
    <!--end::Form-->
</div>