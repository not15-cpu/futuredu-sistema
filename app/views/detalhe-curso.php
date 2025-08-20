<title>.: <?php echo $curso['nome_curso']; ?>- FuturEdu :.</title>

<?php
require_once('template/head.php');
?>

<body id="cursos">

    <?php require_once('template/header.php'); ?>

    <section class="banner-detalhe">

        <div class="site">

            <div class="banner-texto">

                <div class="letra-detalhe">

                    <h2>ADOBE XD</h2>
                    <h3>30% OFF</h3>

                </div>
                <p class="banner-subtitulo"><?php echo $curso['nome_curso'] ?></p>
                <p class="detalhe-descricao"><?php echo $curso['descricao_curso'] ?></p>
            </div>

            <div class="detalhe-imagem">
                <img src="<?= URL_BASE ?>assets/img/banner/imagem_ilustrativa.png" alt="Imagem ilustrativa do curso">
            </div>

        </div>
    </section>

    </div>


    <section class="course-container">
        <div class="site">
            <div class="course-left">
                <h2 class="course-title"><?php echo $curso['nome_curso'] ?></h2>

                <p class="course-muted">
                    <?php echo $curso['descricao_curso'] ?>
                </p>

            </div>

            <div class="course-right">
                <div class="course-price">
                    <span class="currency-symbol">R$ <?php echo $curso['valor_curso'] ?></span>
                    <span class="limited-offer">🕛 <?php echo $curso['carga_horaria_curso'] ?></span>
                </div>


                <div class="course-info"><span>📘 Nivel</span><span><?php echo $curso['valor_curso'] ?></span></div>
                <div class="course-info"><span>🕒 Modalidade</span><span><?php echo $curso['modalidade_curso'] ?></span>
                </div>
                <div class="course-info"><span>💻 Area</span><span><?php echo $curso['area_curso'] ?></span></div>
                <div class="course-info"><span>📑
                        Requisito</span><span><?php echo $curso['pre_requisito_curso'] ?></span></div>

                <a href="#" class="enroll-button">FAÇA SUA INSCRIÇÃO</a>
            </div>
        </div>
    </section>
    <?php
    require_once('../app/views/template/footer.php');
    ?>




</body>