<?php require_once('template/head.php'); ?>
<?php require_once('template/header.php'); ?>

<section class="banner-contato">
    <div class="banner-texto">
        <p class="banner-titulo">EDUCACÃO PARA O FUTURO</p>
        <p class="banner-subtitulo">Contate-nos aqui!</p>
    </div>

</section>

<section class="form_contato">


    <form action="contato/enviarEmail" method="POST">
        <h2>Entre em Contato</h2>

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>

        <label for="telefone">Telefone</label>
        <input type="text" id="fone" name="fone">

        <label for="assunto">Assunto</label>
        <input type="text" id="assunto" name="assunto">

        <label for="mensagem">Mensagem</label>
        <textarea id="msg" name="msg" rows="8" placeholder="digite sua mensagem" required></textarea>

        <button type="submit">Enviar Mensagem</button>
    </form>

    <p class="form-message">

        <?php
        
        if(@$status == 'contato'){

                echo $mensagem;

            }else if(@$status == 'erro'){

                echo $nome . ', ' . $mensagem;
            }
        
        ?>


    </p>

</section>

<?php require_once('template/footer.php');?>