const tabelaUsuarios = document.getElementById("tabelaUsuarios");
const campoBuscaUsuario = document.getElementById("campoBuscaUsuario");

let usuarios = [];
let usuariosFiltrados = [];
let paginaAtualUsuarios = 1;
const itensPorPaginaUsuarios = 10;

async function carregarUsuarios() {
  try {
    const resposta = await fetch("../api/usuario/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaUsuarios.innerHTML = `
        <tr>
          <td colspan="6">Erro ao carregar usuários.</td>
        </tr>
      `;
      return;
    }

    usuarios = resultado.dados;
    usuariosFiltrados = usuarios;
    paginaAtualUsuarios = 1;
    renderizarUsuarios();
  } catch (erro) {
    tabelaUsuarios.innerHTML = `
      <tr>
        <td colspan="6">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarUsuarios() {
  if (usuariosFiltrados.length === 0) {
    tabelaUsuarios.innerHTML = `
      <tr>
        <td colspan="6">Nenhum usuário encontrado.</td>
      </tr>
    `;

    renderizarPaginacao(
      "paginacaoUsuarios",
      0,
      paginaAtualUsuarios,
      itensPorPaginaUsuarios,
      mudarPaginaUsuarios,
    );

    return;
  }

  const listaPaginada = paginarLista(
    usuariosFiltrados,
    paginaAtualUsuarios,
    itensPorPaginaUsuarios,
  );

  tabelaUsuarios.innerHTML = listaPaginada
    .map(
      (usuario) => `
    <tr>
      <td>${usuario.nome}</td>
      <td>${usuario.usuario}</td>
      <td>${usuario.email}</td>
      <td>${usuario.perfil}</td>
      <td>
        <span class="badge ${usuario.status === "ATIVO" ? "badge-success" : "badge-danger"}">
          ${usuario.status}
        </span>
      </td>
      <td>
        <a href="usuario_editar.php?id=${usuario.id}" class="btn-manage" style="text-decoration:none;">
          <i class="fas fa-edit"></i>
          Editar
        </a>

        <button class="btn-manage btn-status" onclick="alterarStatus(${usuario.id})">
          <i class="fas ${usuario.status === "ATIVO" ? "fa-user-slash" : "fa-user-check"}"></i>
          ${usuario.status === "ATIVO" ? "Inativar" : "Ativar"}
        </button>
      </td>
    </tr>
  `,
    )
    .join("");

  renderizarPaginacao(
    "paginacaoUsuarios",
    usuariosFiltrados.length,
    paginaAtualUsuarios,
    itensPorPaginaUsuarios,
    mudarPaginaUsuarios,
  );
}

function mudarPaginaUsuarios(pagina) {
  paginaAtualUsuarios = pagina;
  renderizarUsuarios();
}

async function alterarStatus(id) {
  const confirmou = await confirmarAcao(
    "Alterar status",
    "Deseja alterar o status deste usuário?",
  );

  if (!confirmou) {
    return;
  }

  const dados = new FormData();
  dados.append("id", id);

  try {
    const resposta = await fetch("../api/usuario/status.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      carregarUsuarios();
    } else {
      alertaErro(resultado.erro);
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
}

campoBuscaUsuario.addEventListener("input", function () {
  const termo = campoBuscaUsuario.value.toLowerCase();

  usuariosFiltrados = usuarios.filter(
    (usuario) =>
      usuario.nome.toLowerCase().includes(termo) ||
      usuario.usuario.toLowerCase().includes(termo) ||
      usuario.email.toLowerCase().includes(termo),
  );

  paginaAtualUsuarios = 1;
  renderizarUsuarios();
});

carregarUsuarios();
