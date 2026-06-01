const tabelaCategorias = document.getElementById("tabelaCategorias");
const campoBuscaCategoria = document.getElementById("campoBuscaCategoria");

let categorias = [];
let categoriasFiltradas = [];
let paginaAtualCategorias = 1;
const itensPorPaginaCategorias = 10;

async function carregarCategorias() {
  try {
    const resposta = await fetch("../api/categoria/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaCategorias.innerHTML = `
        <tr>
          <td colspan="4">Erro ao carregar categorias.</td>
        </tr>
      `;
      return;
    }

    categorias = resultado.dados;
    categoriasFiltradas = categorias;
    paginaAtualCategorias = 1;
    renderizarCategorias();
  } catch (erro) {
    tabelaCategorias.innerHTML = `
      <tr>
        <td colspan="4">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarCategorias() {
  if (categoriasFiltradas.length === 0) {
    tabelaCategorias.innerHTML = `
      <tr>
        <td colspan="4">Nenhuma categoria encontrada.</td>
      </tr>
    `;

    renderizarPaginacao(
      "paginacaoCategorias",
      0,
      paginaAtualCategorias,
      itensPorPaginaCategorias,
      mudarPaginaCategorias
    );

    return;
  }

  const listaPaginada = paginarLista(
    categoriasFiltradas,
    paginaAtualCategorias,
    itensPorPaginaCategorias
  );

  tabelaCategorias.innerHTML = listaPaginada.map(categoria => `
    <tr>
      <td>${categoria.nome ?? "-"}</td>
      <td>${categoria.descricao ?? "-"}</td>
      <td>
        <span class="badge ${categoria.status === "ATIVO" ? "badge-success" : "badge-danger"}">
          ${categoria.status}
        </span>
      </td>
      <td>
        <a href="categoria_editar.php?id=${categoria.id}" class="btn-manage" style="text-decoration:none;">
          <i class="fas fa-edit"></i>
          Editar
        </a>

        <button class="btn-manage" onclick="alterarStatusCategoria(${categoria.id})">
          <i class="fas fa-power-off"></i>
          ${categoria.status === "ATIVO" ? "Inativar" : "Ativar"}
        </button>
      </td>
    </tr>
  `).join("");

  renderizarPaginacao(
    "paginacaoCategorias",
    categoriasFiltradas.length,
    paginaAtualCategorias,
    itensPorPaginaCategorias,
    mudarPaginaCategorias
  );
}

function mudarPaginaCategorias(pagina) {
  paginaAtualCategorias = pagina;
  renderizarCategorias();
}

campoBuscaCategoria.addEventListener("input", function () {
  const termo = campoBuscaCategoria.value.toLowerCase();

  categoriasFiltradas = categorias.filter(
    categoria =>
      String(categoria.nome).toLowerCase().includes(termo) ||
      String(categoria.descricao).toLowerCase().includes(termo)
  );

  paginaAtualCategorias = 1;
  renderizarCategorias();
});

async function alterarStatusCategoria(id) {
  try {
    const dados = new FormData();
    dados.append("id", id);

    const resposta = await fetch("../api/categoria/status.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      carregarCategorias();
    } else {
      alert(resultado.erro || "Erro ao alterar status.");
    }
  } catch (erro) {
    alertaErro("Erro de conexão com a API.");
  }
}

carregarCategorias();