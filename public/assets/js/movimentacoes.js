const tabelaMovimentacoes = document.getElementById("tabelaMovimentacoes");
const campoBuscaMovimentacao = document.getElementById("campoBuscaMovimentacao");

let movimentacoes = [];
let movimentacoesFiltradas = [];
let paginaAtualMovimentacoes = 1;
const itensPorPaginaMovimentacoes = 10;

async function carregarMovimentacoes() {
  try {
    const resposta = await fetch("../api/movimentacao/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaMovimentacoes.innerHTML = `
        <tr>
          <td colspan="6">Erro ao carregar movimentações.</td>
        </tr>
      `;
      return;
    }

    movimentacoes = resultado.dados;
    movimentacoesFiltradas = movimentacoes;
    paginaAtualMovimentacoes = 1;
    renderizarMovimentacoes();
  } catch (erro) {
    tabelaMovimentacoes.innerHTML = `
      <tr>
        <td colspan="6">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarMovimentacoes() {
  if (movimentacoesFiltradas.length === 0) {
    tabelaMovimentacoes.innerHTML = `
      <tr>
        <td colspan="6">Nenhuma movimentação encontrada.</td>
      </tr>
    `;

    renderizarPaginacao(
      "paginacaoMovimentacoes",
      0,
      paginaAtualMovimentacoes,
      itensPorPaginaMovimentacoes,
      mudarPaginaMovimentacoes
    );

    return;
  }

  const listaPaginada = paginarLista(
    movimentacoesFiltradas,
    paginaAtualMovimentacoes,
    itensPorPaginaMovimentacoes
  );

  tabelaMovimentacoes.innerHTML = listaPaginada.map(mov => `
    <tr>
      <td>${mov.codigo_patrimonial} - ${mov.patrimonio}</td>
      <td>${mov.tipo_movimentacao ?? "-"}</td>
      <td>${mov.unidade_origem ?? "-"}</td>
      <td>${mov.unidade_destino ?? "-"}</td>
      <td>${mov.data_movimentacao ?? "-"}</td>
      <td>${mov.observacao ?? "-"}</td>
    </tr>
  `).join("");

  renderizarPaginacao(
    "paginacaoMovimentacoes",
    movimentacoesFiltradas.length,
    paginaAtualMovimentacoes,
    itensPorPaginaMovimentacoes,
    mudarPaginaMovimentacoes
  );
}

function mudarPaginaMovimentacoes(pagina) {
  paginaAtualMovimentacoes = pagina;
  renderizarMovimentacoes();
}

campoBuscaMovimentacao.addEventListener("input", function () {
  const termo = campoBuscaMovimentacao.value.toLowerCase();

  movimentacoesFiltradas = movimentacoes.filter(
    mov =>
      String(mov.codigo_patrimonial).toLowerCase().includes(termo) ||
      String(mov.patrimonio).toLowerCase().includes(termo) ||
      String(mov.tipo_movimentacao).toLowerCase().includes(termo) ||
      String(mov.unidade_origem).toLowerCase().includes(termo) ||
      String(mov.unidade_destino).toLowerCase().includes(termo)
  );

  paginaAtualMovimentacoes = 1;
  renderizarMovimentacoes();
});

carregarMovimentacoes();