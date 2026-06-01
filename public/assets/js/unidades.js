const tabelaUnidades = document.getElementById("tabelaUnidades");
const campoBuscaUnidade = document.getElementById("campoBuscaUnidade");

let unidades = [];
let unidadesFiltradas = [];
let paginaAtualUnidades = 1;
const itensPorPaginaUnidades = 10;

async function carregarUnidades() {
  try {
    const resposta = await fetch("../api/unidade/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaUnidades.innerHTML = `
        <tr>
          <td colspan="6">Erro ao carregar unidades.</td>
        </tr>
      `;
      return;
    }

    unidades = resultado.dados;
    unidadesFiltradas = unidades;
    paginaAtualUnidades = 1;
    renderizarUnidades();
  } catch (erro) {
    tabelaUnidades.innerHTML = `
      <tr>
        <td colspan="6">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarUnidades() {
  if (unidadesFiltradas.length === 0) {
    tabelaUnidades.innerHTML = `
      <tr>
        <td colspan="6">Nenhuma unidade encontrada.</td>
      </tr>
    `;

    renderizarPaginacao(
      "paginacaoUnidades",
      0,
      paginaAtualUnidades,
      itensPorPaginaUnidades,
      mudarPaginaUnidades
    );

    return;
  }

  const listaPaginada = paginarLista(
    unidadesFiltradas,
    paginaAtualUnidades,
    itensPorPaginaUnidades
  );

  tabelaUnidades.innerHTML = listaPaginada.map(unidade => `
    <tr>
      <td>${unidade.nome ?? "-"}</td>
      <td>${unidade.ug ?? "-"}</td>
      <td>${unidade.endereco ?? "-"}</td>
      <td>${unidade.telefone ?? "-"}</td>
      <td>
        <span class="badge ${unidade.status === "ATIVO" ? "badge-success" : "badge-danger"}">
          ${unidade.status}
        </span>
      </td>
      <td>
        <a href="unidade_editar.php?id=${unidade.id}" class="btn-manage" style="text-decoration:none;">
          <i class="fas fa-edit"></i>
          Editar
        </a>

        <button class="btn-manage" onclick="alterarStatusUnidade(${unidade.id})">
          <i class="fas fa-power-off"></i>
          ${unidade.status === "ATIVO" ? "Inativar" : "Ativar"}
        </button>
      </td>
    </tr>
  `).join("");

  renderizarPaginacao(
    "paginacaoUnidades",
    unidadesFiltradas.length,
    paginaAtualUnidades,
    itensPorPaginaUnidades,
    mudarPaginaUnidades
  );
}

function mudarPaginaUnidades(pagina) {
  paginaAtualUnidades = pagina;
  renderizarUnidades();
}

campoBuscaUnidade.addEventListener("input", function () {
  const termo = campoBuscaUnidade.value.toLowerCase();

  unidadesFiltradas = unidades.filter(
    unidade =>
      String(unidade.nome).toLowerCase().includes(termo) ||
      String(unidade.ug).toLowerCase().includes(termo) ||
      String(unidade.endereco).toLowerCase().includes(termo) ||
      String(unidade.telefone).toLowerCase().includes(termo)
  );

  paginaAtualUnidades = 1;
  renderizarUnidades();
});

async function alterarStatusUnidade(id) {
  try {
    const dados = new FormData();
    dados.append("id", id);

    const resposta = await fetch("../api/unidade/status.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      carregarUnidades();
    } else {
      alert(resultado.erro || "Erro ao alterar status.");
    }
  } catch (erro) {
    alertaErro("Erro de conexão com a API.");
  }
}

carregarUnidades();