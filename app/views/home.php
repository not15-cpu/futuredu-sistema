<?php require_once('template/head.php'); ?>

<body>

    <!-- Botão de voltar ao topo -->
    <button id="btn-voltar-topo" class="voltar-topo">
        ^
    </button>

    <div class="background-header-e-banner">
        <?php require_once('template/header.php'); ?>

        <section class="banner">
            <div class="banner-texto">
                <p class="banner-titulo">EDUCACÃO PARA O FUTURO</p>
                <p class="banner-subtitulo">Transforme seu<br>Conhecimento<br>com a FuturEdu</p>
                <p class="banner-descricao">Cursos online e presenciais com especialistas renomados.<br>Desenvolva
                    habilidades essenciais e conquiste novas<br>oportunidades no mercado de trabalho!</p>
            </div>

            <div class="banner-imagem">
                <img src="<?= URL_BASE;?>assets/img/banner/banner-img-homen.png" alt="Homem usando celular">
            </div>
        </section>
        
    </div>

    <main>

        <section class="carrossel">

            <div class="carrossel-container">

                <div class="carrossel-imagens">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/c++.png" alt="Logo da linguagem C++">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/c-sharp.png" alt="Logo da linguagem C#">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/excel.png" alt="Logo do Microsoft Excel">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/git.png" alt="Logo do Git">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/mysql.png" alt="Logo do MySQL">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/ts.png" alt="Logo do TypeScript">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/html.png" alt="">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/css.png" alt="">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/php.png" alt="">

                    <img src="<?= URL_BASE;?>assets/img/logo-linguagens/js.png" alt="">



                    <img src="assets/img/logo-linguagens/c++.png" alt="Logo da linguagem C++">

                    <img src="assets/img/logo-linguagens/c-sharp.png" alt="Logo da linguagem C#">

                    <img src="assets/img/logo-linguagens/excel.png" alt="Logo do Microsoft Excel">

                    <img src="assets/img/logo-linguagens/git.png" alt="Logo do Git">

                    <img src="assets/img/logo-linguagens/mysql.png" alt="Logo do MySQL">

                    <img src="assets/img/logo-linguagens/ts.png" alt="Logo do TypeScript">

                    <img src="assets/img/logo-linguagens/html.png" alt="">

                    <img src="assets/img/logo-linguagens/css.png" alt="">

                    <img src="assets/img/logo-linguagens/php.png" alt="">

                    <img src="assets/img/logo-linguagens/js.png" alt="">

                </div>
            </div>

        </section>

        <section class="categorias">

            <h2>Cursos Populares</h2>

            <h3>Principais Cursos de Desenvolvimento</h3>

            <div class="categorias-container">

                <?php foreach ($cursos as $linha): ?>

                    <div>

                        <img src="assets/img/categorias/<?php echo $linha['foto_curso'] ?>"
                            alt="Imagem representando o curso <?php echo $linha['nome_curso']; ?>">

                        <p><?php echo $linha['nome_curso']; ?></p>
                    
                        <p><?php echo $linha['carga_horaria_curso'] . ' horas | R$' . $linha['valor_curso']; ?></p>

                    </div>

                <?php endforeach; ?>

            </div>

            <div class="button"><a href="curso" class="categorias-btn">Ver todos os Cursos</a></div>

        </section>

        <section class="cursos-destaque">

            <h3 class="cursos-tit-1">CURSOS EM DESTAQUE</h3>

            <h2 class="cursos-tit-2">Escolha um Curso para Começar</h2>

            <div class="cursos-lista">

                <div class="curso">

                    <img src="assets/img/categorias/PHP-e-Desenvolvimento-Back-End.png"
                        alt="Imagem ilustrativa do curso de PHP e MySQL">

                    <div class="curso-detalhes">

                        <span class="curso-categoria" style="width: 120px; background-color: #eec93d;">PHP E
                            MYSQL</span>

                        <div class="curso-avaliacao">
                            <i class="fa-solid fa-star fa-xs" style="color: #5830c5;"></i>
                            <i class="fa-solid fa-star fa-xs" style="color: #5830c5;"></i>
                            <i class="fa-solid fa-star fa-xs" style="color: #5830c5;"></i>
                            <i class="fa-solid fa-star fa-xs" style="color: #5830c5;"></i>
                            <i class="fa-solid fa-star fa-xs" style="color: #5830c5;"></i>
                            <span>10 avaliações</span>
                        </div>

                        <p class="curso-titulo">CRIAÇÃO DE APLICAÇÃO WEB COM PHP <br> E MYSQL</p>

                        <div class="curso-info">
                            <p><img class="curso-info-img" src="assets/img/icon/reprodutor-de-video-32x32.png"
                                    alt="Ícone de reprodutor de vídeo"> 28 Aulas</p>
                            <p><img class="curso-info-img" src="assets/img/icon/grafico-de-barras-32x32.png"
                                    alt="Ícone de gráfico de barras"> Curso Online</p>
                        </div>

                        <div class="curso-professor">
                            <div class="curso-professor-detalhes" style="flex-direction: column;">
                                <img src="assets/img/professor/Lucas-Fernandes.png"
                                    alt="Foto do professor Lucas Fernandes">
                                <a href="#" class="curso-saiba-mais">Saiba Mais<i
                                        class="fa-solid fa-arrow-up-right-from-square fa-2xs"
                                        style="color: #512bc5;"></i></a>
                            </div>

                            <p style="color: black; font-size: 0.8em;">LUCAS FERNANDES</p>

                        </div>

                    </div>

                </div>

            </div>
        </section>

        <section class="sobre">

            <div class="sobre-imagem">

                <div class="sobre-fundo"></div>

                <img src="assets/img/sobre/instalacoes.png" alt="Foto das instalações da empresa FuturEdu">

            </div>

            <div class="sobre-descricao">
                <h3 class="sobre-titulo-pequeno">SOBRE A FUTUREDU</h3>
                <h2 class="sobre-titulo-grande">Qualificação Profissional e<br>Habilidades para o Futuro</h2>
                <p class="sobre-texto">
                    Na FuturEdu, conectamos tecnologia e aprendizado para preparar você para o mercado de trabalho.
                    Oferecemos cursos dinâmicos e atualizados, com foco em desenvolvimento de software, análise de dados
                    e inovação digital.
                    Nossa metodologia combina ensino interativo, práticas reais e certificações reconhecidas.
                </p>

                <div class="sobre-instrutores">
                    <div class="instrutor">
                        <img src="assets/img/professor/Carlos-Silva.png" alt="Foto do professor Carlos Silva">
                        <div class="instrutor-info">
                            <h3>INSTRUTORES ESPECIALIZADOS</h3>
                            <p>Nossos professores são profissionais do mercado, trazendo experiência real para dentro da
                                sala de aula.</p>
                        </div>
                    </div>
                    <div class="instrutor">
                        <img src="assets/img/professor/Lucas-Fernandes.png" alt="Foto do professor Lucas Fernandes">
                        <div class="instrutor-info">
                            <h3>CERTIFICAÇÃO VALORIZADA</h3>
                            <p>Ao concluir nossos cursos, você recebe um certificado que comprova suas habilidades e
                                impulsiona sua carreira.</p>
                        </div>
                    </div>
                    <div class="instrutor">
                        <img src="assets/img/professor/Mariana-Rocha.png" alt="Foto da professora Mariana Rocha">
                        <div class="instrutor-info">
                            <h3>AULAS ONLINE E FLEXÍVEIS</h3>
                            <p>Estude no seu ritmo com nossa plataforma moderna e acessível de qualquer lugar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php require_once('template/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?= URL_BASE;?>assets/js/wow.min.js"></script>
    <script src="<?= URL_BASE;?>assets/js/slick.min.js"></script>
    <script src="<?= URL_BASE;?>assets/js/animacao.js"></script>

</body>

</html>