<header id="header-topo-fixo">
    <div class="site">
        <div>
            <div class="header-contato" id="headerContato">
                <div>
                    <ul>
                        <li> <a href="https://web.whatsapp.com/"><i class="fa-solid fa-phone fa-sm"
                                    style="color: #ffffff;"> +</i>55 11 91234-5678</a></li>
                    </ul>
                    <ul>
                        <li><a> <i class="fa-solid fa-location-dot fa-sm" style="color: #ffffff;"></i>
                                AV.PAULISTA, 1000 - SÃO PAULO, BRASIL</a></li>
                    </ul>
                </div>

                <div>
                    <p>ENCONTRE-NOS EM: </p>

                    <a href=""><img class="header-icon"
                            src="<?= URL_BASE ?>assets/img/icon/facebook_32x32-transp.png" alt="Ícone do Facebook"></a>

                    <a href=""><img class="header-icon"
                            src="<?= URL_BASE ?>assets/img/icon/instagram_32x32.png" alt="Ícone do Instagram"></a>

                    <a href=""><img class="header-icon"
                            src="<?= URL_BASE ?>assets/img/icon/linkedin-32x32-transp.png" alt="Ícone do LinkedIn"></a>
                </div>
            </div>

            <div class="header-menu">
                <a href="#">
                    <h1><a href="home"><img src="<?= URL_BASE ?>assets/img/logo/logo-futuedu-branco.svg" alt="Logotipo da FuturEdu em branco"></a></h1>
                </a>

                <nav class="header-menu-nav">
                    <ul>
                        <li class="ativo">
                            <a href="home" class="ativo">Inicio +</a>
                        </li>

                        <li class="menu-item">

                            <a href="curso">Cursos +</a>

                            <ul class="submenu" style="display: none;">
                                <li><a href="curso">Básico</a></li>
                                <li><a href="curso-intermediario">Intermediário</a></li>
                                <li><a href="curso-avancado">Avançado</a></li>

                            </ul>

                        </li>

                        <li class="menu-item">

                            <a href="#">Sobre +</a>

                            <ul class="submenu">

                                <li><a href="sobre-historia">História</a></li>
                                <li><a href="sobre-missao">Missão</a></li>
                                <li><a href="sobre-valores">Valores</a></li>

                            </ul>

                        </li>

                        <li class="ativo"> <a href="contato">Contato +</a> </li>

                    </ul>

                </nav>

                <div class="header-menu-acesso">
                    <a href="login" id="abrirLogin" class="header-btn-entrar"><img class="header-icon"
                            src="<?= URL_BASE ?>assets/img/icon/sombra-de-usuario-masculino.png" alt="Ícone de usuário para botão Entrar">
                        ENTRAR</a>

                    <a href="cadastrar" class="header-btn-cad"><img class="header-icon"
                            src="<?= URL_BASE ?>assets/img/icon/multiple-users-32x32-white.png" alt="Ícone de múltiplos usuários para botão Cadastrar-se">
                        CADASTRAR-SE</a>

                </div>
                <div id="loginModal" class="modal-login" style="display:none;">
                    <div class="modal-login-content">
                        <span class="fechar"></span>



                        <form method="POST" action="login/entrar">

                            <label for="email">Usuário ou E-mail</label>
                            <input type="text" id="email" name="email" required>

                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" required>

                            <div class="botão-login">
                                <button type="submit">Entrar</button>
                                <button type="submit">Fechar</button>
                            </div>

                        </form>


                        <hr>
                        <p>Não tem conta? <a href="#" id="abrirCadastro">Cadastre-se</a></p>
                        <div id="cadastroBox" style="display:none;">

                            <h2>Cadastrar-se</h2>

                            <form method="POST" action="cadastrar">

                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" required>

                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" required>

                                <label for="senha_cad">Senha</label>
                                <input type="password" id="senha_cad" name="senha" required>

                                <div class="botão-login">
                                    <button type="submit">Cadastrar</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>