<?php
require_once('template/head.php');
?>
<title><?= SITE_NAME; ?> - Cursos</title>
<div class="site">
    <?php require_once('template/header.php'); ?>
    <div class="categories categories-cursos">
        <h2 class="categories-title">TODOS OS CURSOS</h2>
        <h2 class="categories-subtitle">Veja todos os cursos disponíveis para impulsionar sua carreira</h2>
        <div class="courses-grid courses-grid-4x4">
            <?php $count = 0;
            foreach ($cursos as $linha): ?>
                <?php $link = $this->gerarLinkCurso($linha['nome_curso']); ?>
                <div class="course-card">
                    <div class="course-img-wrapper">
                        <img class="course-img" src="<?= URL_BASE; ?>uploads/curso/<?= $linha['foto_curso']; ?>" alt="<?= $linha['nome_curso']; ?>">
                    </div>
                    <div class="course-info">
                        <h3 class="course-title"><?= $linha['nome_curso']; ?></h3>
                        <p class="course-hours">CH - <?= $linha['carga_horaria_curso']; ?></p>
                        <a class="course-link" href="<?= URL_BASE; ?>curso/detalhe/<?= $link; ?>">
                            Ver detalhes
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                <path fill="#FFFFFF" d="M13.293 5.293a1 1 0 0 1 1.414 0l5 5a1 1 0 0 1 0 1.414l-5 5a1 1 0 1 1-1.414-1.414L16.586 12H6a1 1 0 1 1 0-2h10.586l-3.293-3.293a1 1 0 0 1 0-1.414z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <?php $count++;
                if ($count % 16 == 0) echo '</div><div class="courses-grid courses-grid-4x4">'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
<script>
    // Controle do header transparente/colorido
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        const stacksSection = document.querySelector('.categories');
        const stacksTop = stacksSection.offsetTop;

        if (window.scrollY >= stacksTop) {
            header.style.background = '#3498D8';
        } else {
            header.style.background = 'transparent';
        }
    });
</script>
<?php require_once('template/footer.php'); ?>