<div id="loginModal" class="modal">
    <div class="modal-content">

        <button class="btn-fechar-pequeno" style="position: absolute; top: 10px; right: 10px;">&times;</button>
        
        <h2>Bem-vindo!</h2>

        <div class="tabs">
            <button id="btnLogin" class="tab-btn active">Login</button>
            <button id="btnCadastro" class="tab-btn">Cadastro</button>
        </div>

        <form id="formLogin" class="formulario" method="POST" action="login/entrar" >
            <input type="text" placeholder="CPF">
            <input type="password" placeholder="Senha">
            <button>Entrar</button>
        </form>



        <form id="formCadastro" class="formulario" style="display: none;" method="POST" action="login/entrar">

            <div class="tipo-usuario" style="margin-bottom: 10px;">
                <label>
                    <input type="name" name="tipo_usuario" value="cliente" checked> Cliente
                </label>
                <label>
                    <input type="text" name="tipo_usuario" value="proprietario"> Proprietário
                </label>
            </div>

            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="text" name="cpf" placeholder="CPF" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>

            <div>
            <button type="submit">Cadastrar</button>
            <button type="submit">Fechar</button>
        </div>
        
        </form>

        <button class="btn-fechar" style="margin-top: 20px;">Fechar</button>
    </div>
</div>

