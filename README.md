# PATRIMOV

Sistema de Gestão Patrimonial desenvolvido como Projeto Integrador da Fatec Araras.

O PATRIMOV tem como objetivo auxiliar no controle e gerenciamento de bens patrimoniais, permitindo o cadastro, movimentação, acompanhamento, auditoria e geração de relatórios patrimoniais em um ambiente web moderno e centralizado.

---

## Funcionalidades

### Autenticação

* Login de usuários
* Controle de sessão
* Alteração de senha
* Controle de acesso por usuário

### Dashboard

* Indicadores patrimoniais
* Patrimônios ativos
* Patrimônios baixados
* Serviços cadastrados
* Movimentações recentes

### Patrimônios

* Cadastro de patrimônios
* Edição de patrimônios
* Visualização detalhada
* Baixa patrimonial
* Controle de estado de conservação
* Controle de status

### Categorias

* Cadastro de categorias
* Edição de categorias
* Organização dos patrimônios por categoria

### Unidades Gestoras (UGs)

* Cadastro de UGs
* Edição de UGs
* Controle por origem administrativa

### Unidades

* Cadastro de unidades
* Edição de unidades
* Associação entre unidades e UGs
* Controle de localização e responsáveis

### Serviços

* Cadastro de serviços
* Vinculação a patrimônio existente
* Patrimonialização de novos bens
* Controle de status de execução
* Registro de informações administrativas

### Movimentações

* Transferência de patrimônios
* Empréstimos
* Controle de origem e destino
* Histórico de movimentações

### Relatórios

* Relatórios patrimoniais
* Relatórios de movimentações
* Relatórios de serviços
* Exportação em PDF

### Auditoria

* Registro automático de ações
* Histórico de alterações
* Rastreabilidade das operações

---

## Tecnologias Utilizadas

### Back-end

* PHP
* MySQL

### Front-end

* HTML5
* CSS3
* JavaScript

### Ferramentas

* XAMPP
* phpMyAdmin
* Git
* GitHub

### Bibliotecas

* Font Awesome
* Plus Jakarta Sans

---

## Estrutura do Projeto

```text
Software_PATRIMOV/
│
├── api/
├── config/
├── database/
├── models/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   │
│   ├── includes/
│   ├── components/
│   │
│   ├── home.php
│   ├── patrimonios.php
│   ├── servicos.php
│   ├── movimentacoes.php
│   ├── relatorios.php
│   ├── auditoria.php
│   ├── usuarios.php
│   ├── configuracoes.php
│   └── demais páginas do sistema
│
└── README.md
```

---

## Banco de Dados

Principais tabelas:

* usuarios
* patrimonios
* categorias
* unidades
* ugs
* servicos
* movimentacoes
* auditoria

### Regras de Negócio

* Uma UG possui várias unidades.
* Uma unidade pertence a uma UG.
* Um patrimônio pertence a uma unidade.
* Movimentações atualizam a localização do patrimônio.
* Serviços podem ser vinculados a patrimônios existentes ou novos patrimônios.
* Auditorias são registradas automaticamente.

---

## Como Executar o Projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/GabSimag/Software_PATRIMOV.git
```

### 2. Mover para o diretório do XAMPP

Copie a pasta do projeto para:

```text
C:\xampp\htdocs\
```

### 3. Iniciar os serviços

Abra o XAMPP e inicie:

* Apache
* MySQL

### 4. Configurar o banco de dados

Crie o banco de dados MySQL e execute os scripts presentes na pasta:

```text
database/
```

### 5. Configurar a conexão

Verifique as configurações em:

```text
config/database.php
```

Exemplo:

```php
$host = "localhost";
$dbname = "patrimov";
$user = "root";
$password = "";
```

### 6. Executar o sistema

Acesse:

```text
http://localhost/Software_PATRIMOV/public/
```

---

## Objetivo Acadêmico

Este projeto foi desenvolvido como atividade do Projeto Integrador da Fatec Araras, aplicando conceitos de:

* Desenvolvimento Web
* Banco de Dados
* Engenharia de Software
* Gestão de Projetos
* Controle Patrimonial
* Versionamento de Código

---

## Status do Projeto

🚧 Em desenvolvimento

Atualmente o sistema possui os principais módulos funcionais implementados e continua recebendo melhorias visuais, funcionais e estruturais.

---

## Equipe

Desenvolvido por:

* Gabriel Sima
* Rinaldo
* Wagner

Projeto Integrador – Fatec Araras
