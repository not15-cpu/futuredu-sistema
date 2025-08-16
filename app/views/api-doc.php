<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentação - FuturEdu</title>
    <style>
        :root {
            --first-color: #1F3A93;
            --segunda-color: #8E44AD;
            --terceira-cor: #3498DB;
            --quarta-cor: #BDC3C7;
            --quinta-cor: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--quinta-cor);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, var(--first-color), var(--segunda-color));
            color: white;
            padding: 3rem 0;
            text-align: center;
            margin-bottom: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(31, 58, 147, 0.2);
        }

        .header h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .nav-tabs {
            display: flex;
            background: white;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .nav-tab {
            flex: 1;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
            color: var(--quinta-cor);
            font-weight: 500;
        }

        .nav-tab:hover {
            background: rgba(31, 58, 147, 0.1);
        }

        .nav-tab.active {
            background: var(--first-color);
            color: white;
        }

        .content-section {
            display: none;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .content-section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .endpoint {
            background: #f8f9fa;
            border-left: 4px solid var(--terceira-cor);
            padding: 1.5rem;
            margin: 1rem 0;
            border-radius: 0 10px 10px 0;
        }

        .method {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-right: 1rem;
        }

        .method.get { background: #28a745; color: white; }
        .method.post { background: #007bff; color: white; }
        .method.put { background: #ffc107; color: #212529; }
        .method.delete { background: #dc3545; color: white; }

        .code-block {
            background: var(--quinta-cor);
            color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            overflow-x: auto;
            margin: 1rem 0;
            font-family: 'Courier New', monospace;
            position: relative;
        }

        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--terceira-cor);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .copy-btn:hover {
            background: var(--segunda-color);
        }

        .parameter-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        .parameter-table th,
        .parameter-table td {
            padding: 0.8rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .parameter-table th {
            background: linear-gradient(135deg, var(--first-color), var(--terceira-cor));
            color: white;
        }

        .status-code {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            border-radius: 5px;
            font-weight: bold;
            margin-right: 0.5rem;
        }

        .status-200 { background: #d4edda; color: #155724; }
        .status-400 { background: #f8d7da; color: #721c24; }
        .status-401 { background: #fff3cd; color: #856404; }
        .status-500 { background: #f8d7da; color: #721c24; }

        .quick-start {
            background: linear-gradient(135deg, var(--terceira-cor), var(--segunda-color));
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .auth-info {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }

        .example-response {
            background: #f1f3f4;
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .section-title {
            color: var(--first-color);
            border-bottom: 2px solid var(--terceira-cor);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📘 Documentação API FuturEdu</h1>
            <p>Sistema de Gestão Educacional - API REST v1.0</p>
        </div>

        <div class="quick-start">
            <h2>🚀 Quick Start</h2>
            <p>Base URL: <strong><?=URL_BASE;?>api/</strong></p>
            <p>Autenticação: Bearer Token via Header Authorization</p>
        </div>

        <div class="nav-tabs">
            <button class="nav-tab active" onclick="showSection('overview')">Visão Geral</button>
            <button class="nav-tab" onclick="showSection('auth')">Autenticação</button>
            <button class="nav-tab" onclick="showSection('users')">Usuários</button>
            <button class="nav-tab" onclick="showSection('courses')">Cursos</button>
            <button class="nav-tab" onclick="showSection('enrollment')">Matrículas</button>
            <button class="nav-tab" onclick="showSection('errors')">Códigos de Erro</button>
        </div>

        <!-- Seção Visão Geral -->
        <div id="overview" class="content-section active">
            <h2 class="section-title">🎯 Visão Geral da API</h2>
            
            <p>A API FuturEdu é uma API RESTful que permite integração completa com nosso sistema de gestão educacional. Oferece endpoints para gerenciar usuários, cursos, matrículas e muito mais.</p>

            <h3>Características Principais:</h3>
            <ul style="margin: 1rem 0; padding-left: 2rem;">
                <li>✅ Autenticação via JWT Token</li>
                <li>✅ Formato JSON para requests e responses</li>
                <li>✅ Rate limiting: 1000 requests/hora</li>
                <li>✅ Suporte HTTPS obrigatório</li>
                <li>✅ Versionamento da API</li>
            </ul>

            <div class="auth-info">
                <strong>⚠️ Importante:</strong> Todas as requisições devem incluir o header <code>Content-Type: application/json</code>
            </div>
        </div>

        <!-- Seção Autenticação -->
        <div id="auth" class="content-section">
            <h2 class="section-title">🔐 Autenticação</h2>

            <div class="endpoint">
                <div>
                    <span class="method post">POST</span>
                    <strong>/api/LoginAluno</strong>
                </div>
                <p>Realiza login e retorna token de acesso</p>
            </div>

            <h4>Parâmetros de Entrada:</h4>
            <table class="parameter-table">
                <thead>
                    <tr>
                        <th>Parâmetro</th>
                        <th>Tipo</th>
                        <th>Obrigatório</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>email_aluno</td>
                        <td>string</td>
                        <td>Sim</td>
                        <td>Email do aluno</td>
                    </tr>
                    <tr>
                        <td>senha_aluno</td>
                        <td>string</td>
                        <td>Sim</td>
                        <td>Senha do aluno</td>
                    </tr>
                </tbody>
            </table>

            <h4>Exemplo de Requisição:</h4>
            <div class="code-block">
                <button class="copy-btn" onclick="copyCode(this)">Copiar</button>
curl -X POST <?=URL_BASE;?>api/LoginAluno \
  -H "Content-Type: application/json" \
  -d '{
    "email": "usuario@exemplo.com",
    "password": "minhasenha123"
  }'
            </div>

            <h4>Resposta de Sucesso:</h4>
            <div class="example-response">
                <span class="status-code status-200">200 OK</span>
                <div class="code-block">
{
  "success": true,
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "expires_in": 3600,
    "user": {
      "id": 123,
      "name": "João Silva",
      "email": "usuario@exemplo.com",
      "role": "student"
    }
  }
}
                </div>
            </div>
        </div>

        <!-- Seção Usuários -->
        <div id="users" class="content-section">
            <h2 class="section-title">👥 Gerenciamento de Usuários</h2>

            <div class="endpoint">
                <div>
                    <span class="method get">GET</span>
                    <strong>/ListarAlunos</strong>
                </div>
                <p>Lista todos os usuários (requer autenticação)</p>
            </div>

            <h4>Headers Obrigatórios:</h4>
            <div class="code-block">
Authorization: Bearer {seu_token}
Content-Type: application/json
            </div>

            <h4>Parâmetros de Query:</h4>
            <table class="parameter-table">
                <thead>
                    <tr>
                        <th>Parâmetro</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>page</td>
                        <td>integer</td>
                        <td>Número da página (padrão: 1)</td>
                    </tr>
                    <tr>
                        <td>limit</td>
                        <td>integer</td>
                        <td>Items por página (padrão: 20, máx: 100)</td>
                    </tr>
                    <tr>
                        <td>role</td>
                        <td>string</td>
                        <td>Filtrar por role: student, teacher, admin</td>
                    </tr>
                </tbody>
            </table>

            <div class="endpoint">
                <div>
                    <span class="method post">POST</span>
                    <strong>/cadastroAluno</strong>
                </div>
                <p>Criar novo usuário</p>
            </div>

            <h4>Exemplo de Criação de Usuário:</h4>
            <div class="code-block">
                <button class="copy-btn" onclick="copyCode(this)">Copiar</button>
{
  "name": "Maria Santos",
  "email": "maria@exemplo.com",
  "password": "senha123",
  "role": "student",
  "profile": {
    "phone": "(11) 99999-9999",
    "birth_date": "1995-05-15"
  }
}
            </div>

            <div class="endpoint">
                <div>
                    <span class="method get">GET</span>
                    <strong>/users/{id}</strong>
                </div>
                <p>Obter detalhes de um usuário específico</p>
            </div>

            <div class="endpoint">
                <div>
                    <span class="method put">PUT</span>
                    <strong>/users/{id}</strong>
                </div>
                <p>Atualizar dados de um usuário</p>
            </div>

            <div class="endpoint">
                <div>
                    <span class="method delete">DELETE</span>
                    <strong>/users/{id}</strong>
                </div>
                <p>Remover um usuário</p>
            </div>
        </div>

        <!-- Seção Cursos -->
        <div id="courses" class="content-section">
            <h2 class="section-title">📚 Gerenciamento de Cursos</h2>

            <div class="endpoint">
                <div>
                    <span class="method get">GET</span>
                    <strong>/courses</strong>
                </div>
                <p>Lista todos os cursos disponíveis</p>
            </div>

            <h4>Parâmetros de Query:</h4>
            <table class="parameter-table">
                <thead>
                    <tr>
                        <th>Parâmetro</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>category</td>
                        <td>string</td>
                        <td>Filtrar por categoria</td>
                    </tr>
                    <tr>
                        <td>status</td>
                        <td>string</td>
                        <td>Filtrar por status: active, inactive, draft</td>
                    </tr>
                    <tr>
                        <td>instructor_id</td>
                        <td>integer</td>
                        <td>Filtrar por ID do instrutor</td>
                    </tr>
                </tbody>
            </table>

            <h4>Exemplo de Resposta:</h4>
            <div class="example-response">
                <span class="status-code status-200">200 OK</span>
                <div class="code-block">
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Introdução ao Python",
      "description": "Curso completo de Python para iniciantes",
      "category": "Programação",
      "duration_hours": 40,
      "price": 299.99,
      "status": "active",
      "instructor": {
        "id": 5,
        "name": "Prof. Carlos Silva",
        "email": "carlos@futuredu.com"
      },
      "created_at": "2024-01-15T10:30:00Z"
    }
  ],
  "pagination": {
    "page": 1,
    "limit": 20,
    "total": 150,
    "total_pages": 8
  }
}
                </div>
            </div>

            <div class="endpoint">
                <div>
                    <span class="method post">POST</span>
                    <strong>/courses</strong>
                </div>
                <p>Criar novo curso</p>
            </div>

            <div class="endpoint">
                <div>
                    <span class="method get">GET</span>
                    <strong>/courses/{id}</strong>
                </div>
                <p>Obter detalhes de um curso específico</p>
            </div>

            <div class="endpoint">
                <div>
                    <span class="method put">PUT</span>
                    <strong>/courses/{id}</strong>
                </div>
                <p>Atualizar informações de um curso</p>
            </div>
        </div>

        <!-- Seção Matrículas -->
        <div id="enrollment" class="content-section">
            <h2 class="section-title">🎓 Sistema de Matrículas</h2>

            <div class="endpoint">
                <div>
                    <span class="method post">POST</span>
                    <strong>/enrollments</strong>
                </div>
                <p>Matricular um estudante em um curso</p>
            </div>

            <h4>Exemplo de Matrícula:</h4>
            <div class="code-block">
                <button class="copy-btn" onclick="copyCode(this)">Copiar</button>
{
  "student_id": 123,
  "course_id": 45,
  "payment_method": "credit_card",
  "discount_code": "PROMO2024"
}
            </div>

            <div class="endpoint">
                <div>
                    <span class="method get">GET</span>
                    <strong>/enrollments</strong>
                </div>
                <p>Listar todas as matrículas</p>
            </div>

            <div class="endpoint">
                <div>
                    <span class="method get">GET</span>
                    <strong>/students/{id}/enrollments</strong>
                </div>
                <p>Obter matrículas de um estudante específico</p>
            </div>

            <div class="endpoint">
                <div>
                    <span class="method put">PUT</span>
                    <strong>/enrollments/{id}/progress</strong>
                </div>
                <p>Atualizar progresso de um estudante no curso</p>
            </div>

            <h4>Exemplo de Atualização de Progresso:</h4>
            <div class="code-block">
{
  "lesson_id": 15,
  "completed": true,
  "score": 85,
  "time_spent": 3600
}
            </div>
        </div>

        <!-- Seção Códigos de Erro -->
        <div id="errors" class="content-section">
            <h2 class="section-title">⚠️ Códigos de Erro</h2>

            <h3>Códigos HTTP Padrão:</h3>
            
            <div style="margin: 1rem 0;">
                <span class="status-code status-200">200</span> OK - Requisição bem-sucedida
            </div>
            
            <div style="margin: 1rem 0;">
                <span class="status-code status-400">400</span> Bad Request - Dados inválidos na requisição
            </div>
            
            <div style="margin: 1rem 0;">
                <span class="status-code status-401">401</span> Unauthorized - Token de autenticação inválido ou ausente
            </div>
            
            <div style="margin: 1rem 0;">
                <span class="status-code status-500">500</span> Internal Server Error - Erro interno do servidor
            </div>

            <h3>Formato de Resposta de Erro:</h3>
            <div class="example-response">
                <span class="status-code status-400">400 Bad Request</span>
                <div class="code-block">
{
  "success": false,
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Os dados fornecidos são inválidos",
    "details": [
      {
        "field": "email",
        "message": "Email deve ter um formato válido"
      },
      {
        "field": "password",
        "message": "Senha deve ter pelo menos 8 caracteres"
      }
    ]
  }
}
                </div>
            </div>

            <h3>Códigos de Erro Específicos:</h3>
            <table class="parameter-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>HTTP Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>INVALID_TOKEN</td>
                        <td>Token de autenticação inválido</td>
                        <td>401</td>
                    </tr>
                    <tr>
                        <td>USER_NOT_FOUND</td>
                        <td>Usuário não encontrado</td>
                        <td>404</td>
                    </tr>
                    <tr>
                        <td>COURSE_FULL</td>
                        <td>Curso com vagas esgotadas</td>
                        <td>409</td>
                    </tr>
                    <tr>
                        <td>ALREADY_ENROLLED</td>
                        <td>Estudante já matriculado no curso</td>
                        <td>409</td>
                    </tr>
                    <tr>
                        <td>RATE_LIMIT_EXCEEDED</td>
                        <td>Limite de requisições excedido</td>
                        <td>429</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            // Esconder todas as seções
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Remover classe active dos tabs
            const tabs = document.querySelectorAll('.nav-tab');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            // Mostrar seção selecionada
            document.getElementById(sectionId).classList.add('active');
            
            // Ativar tab correspondente
            event.target.classList.add('active');
        }

        function copyCode(button) {
            const codeBlock = button.nextSibling;
            const textContent = codeBlock.textContent || codeBlock.innerText;
            
            navigator.clipboard.writeText(textContent.trim()).then(() => {
                const originalText = button.textContent;
                button.textContent = 'Copiado!';
                button.style.background = '#28a745';
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = '';
                }, 2000);
            }).catch(() => {
                alert('Erro ao copiar código');
            });
        }

        // Smooth scroll para seções
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelector('.content-section.active').scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>