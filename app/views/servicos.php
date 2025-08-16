<?php require_once('template/head.php'); ?>


<?php require_once('template/header.php'); ?>

<section class="banner">

            <div class="banner-texto">

                <p class="banner-titulo">EDUCACÃO PARA O FUTURO</p>

                <P class="banner-subtitulo">Transforme seu<br>Conhecimento<br>com a FuturEdu</P>

                <p class="banner-descricao">Cursos online e presenciais com especialistas renomados.<br>Desenvolva

                    habilidades essenciais e conquiste novas<br>oportunidades no mercado de trabalho!</p>

            </div>

            <div class="banner-imagem">

                <img src="assets/img/banner/banner-img-homen.png" alt="imagem criada por IA de um homem no celular">

            </div>

</section>

<section class="categorias">
            <h2>Cursos Populares</h2>
            <h3>Principais Cursos de Desenvolvimento</h3>
            <div class="categorias-container">


                <?php foreach ($cursos as $linha): ?>

                    <?php $link = $this->gerarLinkCurso($linha['nome_curso']) ?>

                    <div>  
                        <!-- php echo (serve para mostrar algo na tela) pode ser substituido para "=" -->
                        <img src="assets/img/categorias/<?= $linha['foto_curso'] ?>" alt="foto do curso">
                        
                        <a href="curso/detalhe/<?= $link ?>"> <p> <?= $linha['nome_curso'];?> </p> </a>

                        <p> <?= $linha['carga_horaria_curso'] . ' horas | R$'  . $linha ['valor_curso'] ; ?></p>

                    </div>

                <?php endforeach; ?>
          
            </div>
        
            <button> <a href="curso" class="categorias-btn">Se Inscrevas</a></button>
        
        </section>
        
        <?php require_once('template/footer.php');?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="js/wow.min.js"></script>

    <script src="js/slick.min.js"></script>

    <script src="assets/js/animacao.js"></script>