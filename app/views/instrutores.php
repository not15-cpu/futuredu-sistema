<?php require_once('template/head.php'); ?>

<title><?= SITE_NAME; ?> - Instrutores</title>
<main class="instructors">
    <?php foreach ($instrutores as $instrutor): ?>
        <?php $link = $this->gerarLinkInstrutor($instrutor['nome_funcionario']); ?>
        <a href="<?= URL_BASE; ?>instrutores/detalhe/<?= $link; ?>">
            <div class="instrutor">
                <img src="<?= URL_BASE; ?>assets/img/<?= $instrutor['foto_funcionario']; ?>" alt="<?= $instrutor['alt_funcionario'] ?>">
                <h2><?= $instrutor['nome_funcionario']; ?></h2>
            </div>
        </a>
    <?php endforeach; ?>
</main>
</div>
<script>
    // Controle do header transparente/colorido
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        const stacksSection = document.querySelector('.instructors');
        const stacksTop = stacksSection.offsetTop;

        if (window.scrollY >= stacksTop) {
            header.style.background = '#3498D8';
        } else {
            header.style.background = 'transparent';
        }
    });
</script>
<?php require_once('template/footer.php'); ?>
</body>

</html>