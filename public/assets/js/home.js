async function carregarDashboard() {
  try {
    const resposta = await fetch("../api/dashboard/resumo.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      console.error(resultado.erro);
      return;
    }

    const dados = resultado.dados;

    document.getElementById("totalPatrimonios").textContent =
      dados.total_patrimonios;
    document.getElementById("patrimoniosAtivos").textContent =
      dados.patrimonios_ativos;
    document.getElementById("patrimoniosBaixados").textContent =
      dados.patrimonios_baixados;
    document.getElementById("servicosSolicitados").textContent =
      dados.servicos_solicitados;
    document.getElementById("servicosConcluidos").textContent =
      dados.servicos_concluidos;
    document.getElementById("valorTotal").textContent = formatarMoeda(
      dados.valor_total,
    );

    document.getElementById("valorAtivo").textContent = formatarMoeda(
      dados.valor_ativo,
    );

    document.getElementById("valorBaixado").textContent = formatarMoeda(
      dados.valor_baixado,
    );
  } catch (erro) {
    console.error("Erro ao carregar dashboard:", erro);
  }
}
function formatarMoeda(valor) {
  return Number(valor).toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL",
    maximumFractionDigits: 0,
  });
}
async function carregarUltimasMovimentacoes() {
  try {
    const resposta = await fetch("../api/dashboard/movimentacoes.php");
    const resultado = await resposta.json();

    const tabela = document.getElementById("tabelaUltimasMovimentacoes");

    if (!resultado.sucesso) {
      tabela.innerHTML = `
        <tr>
          <td colspan="4">Erro ao carregar movimentações.</td>
        </tr>
      `;
      return;
    }

    const movimentacoes = resultado.dados;

    if (movimentacoes.length === 0) {
      tabela.innerHTML = `
        <tr>
          <td colspan="4">Nenhuma movimentação encontrada.</td>
        </tr>
      `;
      return;
    }

    tabela.innerHTML = movimentacoes
      .map(
        (mov) => `
      <tr>
        <td>#${mov.id}</td>
        <td>${mov.codigo_patrimonial} - ${mov.patrimonio}</td>
        <td>${mov.unidade_origem ?? "-"}</td>
        <td>
          <span class="status-warning">
            ${mov.tipo_movimentacao}
          </span>
        </td>
      </tr>
    `,
      )
      .join("");
  } catch (erro) {
    console.error("Erro ao carregar movimentações:", erro);
  }
}

carregarUltimasMovimentacoes();
carregarDashboard();
