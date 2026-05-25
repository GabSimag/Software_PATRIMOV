const tabelaMovimentacoes = document.getElementById("tabelaMovimentacoes");
const campoBuscaMovimentacao = document.getElementById(
  "campoBuscaMovimentacao",
);

let movimentacoes = [];

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
    renderizarMovimentacoes(movimentacoes);
  } catch (erro) {
    tabelaMovimentacoes.innerHTML = `
      <tr>
        <td colspan="6">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarMovimentacoes(lista) {
  if (lista.length === 0) {
    tabelaMovimentacoes.innerHTML = `
      <tr>
        <td colspan="6">Nenhuma movimentação encontrada.</td>
      </tr>
    `;
    return;
  }

  tabelaMovimentacoes.innerHTML = lista
    .map(
      (mov) => `
    <tr>
      <td>${mov.codigo_patrimonial} - ${mov.patrimonio}</td>
      <td>${mov.tipo_movimentacao ?? "-"}</td>
      <td>${mov.unidade_origem ?? "-"}</td>
      <td>${mov.unidade_destino ?? "-"}</td>
      <td>${mov.data_movimentacao ?? "-"}</td>
      <td>${mov.observacao ?? "-"}</td>
    </tr>
  `,
    )
    .join("");
}

campoBuscaMovimentacao.addEventListener("input", function () {
  const termo = campoBuscaMovimentacao.value.toLowerCase();

  const filtradas = movimentacoes.filter(
    (mov) =>
      String(mov.codigo_patrimonial).toLowerCase().includes(termo) ||
      String(mov.patrimonio).toLowerCase().includes(termo) ||
      String(mov.tipo_movimentacao).toLowerCase().includes(termo) ||
      String(mov.unidade_origem).toLowerCase().includes(termo) ||
      String(mov.unidade_destino).toLowerCase().includes(termo),
  );

  renderizarMovimentacoes(filtradas);
});

carregarMovimentacoes();
