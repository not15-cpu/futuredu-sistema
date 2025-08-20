<?php require_once('template/head.php'); ?>
<title><?= SITE_NAME; ?> - <?= $titulo; ?> Detalhes</title>

<!-- Início da página de detalhes do instrutor -->
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <!-- Se existir o instrutor, exibe os detalhes -->

            <!-- Exibindo a foto do instrutor (imagem fictícia) -->
            <div class="text-center">
                <img src="<?= URL_BASE; ?>assets/img/<?= $instrutor['foto_funcionario']; ?>" alt="<?= $instrutor['nome_funcionario']; ?>" class="img-fluid rounded-circle" width="200">
            </div>

            <!-- Informações do instrutor -->
            <div class="instrutor-info mt-4">
                <h3>Informações Pessoais</h3>
                <p><strong>Nome Completo:</strong> <?= $instrutor['nome_funcionario']; ?></p>
                <p><strong>Email:</strong> <?= $instrutor['email_funcionario']; ?></p>
                <p><strong>Telefone:</strong> <?= $instrutor['telefone1_funcionario']; ?></p>
            </div>

            <hr>

            <!-- Especialidades do instrutor -->
            <div class="instrutor-especialidades mt-4">
                <h3>Especialidades</h3>
                <ul>
                    <li><?= $instrutor['form_cad_funcionario']; ?></li>
                </ul>
            </div>

            <hr>

            <hr>
        </div>
    </div>
</div>
</div>
<script>
    // Controle do header transparente/colorido
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        const stacksSection = document.querySelector('.container');
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

</html