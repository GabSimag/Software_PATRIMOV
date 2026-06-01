const tabelaRelatorio = document.getElementById("tabelaRelatorio");
const filtroStatus = document.getElementById("filtroStatus");
const filtroUnidade = document.getElementById("filtroUnidade");
const filtroCategoria = document.getElementById("filtroCategoria");

let dadosRelatorioAtual = [];
let relatorioFiltrado = [];
let paginaAtualRelatorio = 1;
const itensPorPaginaRelatorio = 10;

async function carregarRelatorio() {
  try {
    const status = filtroStatus.value;
    const unidade = filtroUnidade.value;
    const categoria = filtroCategoria.value;

    const resposta = await fetch(
      `../api/relatorios/patrimonios.php?status=${status}&id_unidade=${unidade}&id_categoria=${categoria}`,
    );

    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      throw new Error(resultado.erro);
    }

    const dados = resultado.dados;

    dadosRelatorioAtual = dados;
    relatorioFiltrado = dados;
    paginaAtualRelatorio = 1;

    renderizarTabela();
    atualizarIndicadores(dados);
  } catch (erro) {
    tabelaRelatorio.innerHTML = `
      <tr>
        <td colspan="6">
          Erro ao carregar relatório.
        </td>
      </tr>
    `;

    console.error(erro);
  }
}

function renderizarTabela() {
  if (relatorioFiltrado.length === 0) {
    tabelaRelatorio.innerHTML = `
      <tr>
        <td colspan="6">
          Nenhum registro encontrado.
        </td>
      </tr>
    `;

    renderizarPaginacao(
      "paginacaoRelatorios",
      0,
      paginaAtualRelatorio,
      itensPorPaginaRelatorio,
      mudarPaginaRelatorio,
    );

    return;
  }

  const listaPaginada = paginarLista(
    relatorioFiltrado,
    paginaAtualRelatorio,
    itensPorPaginaRelatorio,
  );

  tabelaRelatorio.innerHTML = listaPaginada
    .map(
      (item) => `
    <tr>
      <td>${item.codigo_patrimonial}</td>

      <td>${item.descricao}</td>

      <td>${item.categoria ?? "-"}</td>

      <td>${item.unidade ?? "-"}</td>

      <td>${item.status}</td>

      <td>
        ${Number(item.valor).toLocaleString("pt-BR", {
          style: "currency",
          currency: "BRL",
        })}
      </td>
    </tr>
  `,
    )
    .join("");

  renderizarPaginacao(
    "paginacaoRelatorios",
    relatorioFiltrado.length,
    paginaAtualRelatorio,
    itensPorPaginaRelatorio,
    mudarPaginaRelatorio,
  );
}

function mudarPaginaRelatorio(pagina) {
  paginaAtualRelatorio = pagina;
  renderizarTabela();
}

function atualizarIndicadores(dados) {
  document.getElementById("totalPatrimoniosRelatorio").textContent =
    dados.length;

  let total = 0;

  dados.forEach((item) => {
    total += Number(item.valor || 0);
  });

  document.getElementById("valorTotalRelatorio").textContent =
    total.toLocaleString("pt-BR", {
      style: "currency",
      currency: "BRL",
    });
}

async function carregarFiltros() {
  const resposta = await fetch("../api/relatorios/filtros.php");
  const resultado = await resposta.json();

  if (!resultado.sucesso) {
    return;
  }

  filtroUnidade.innerHTML = `<option value="">Todas as Unidades</option>`;
  filtroCategoria.innerHTML = `<option value="">Todas as Categorias</option>`;

  resultado.unidades.forEach((unidade) => {
    filtroUnidade.innerHTML += `
      <option value="${unidade.id}">
        ${unidade.nome}
      </option>
    `;
  });

  resultado.categorias.forEach((categoria) => {
    filtroCategoria.innerHTML += `
      <option value="${categoria.id}">
        ${categoria.nome}
      </option>
    `;
  });
}

document
  .getElementById("btnExportarPdf")
  .addEventListener("click", function () {
    if (dadosRelatorioAtual.length === 0) {
      alert("Nenhum dado para exportar.");
      return;
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF("landscape", "mm", "a4");

    const dataAtual = new Date().toLocaleDateString("pt-BR");

    doc.setFontSize(18);
    doc.text("PATRIMOV", 14, 16);

    doc.setFontSize(11);
    doc.text("Relatório de Patrimônios", 14, 24);

    doc.setFontSize(9);
    doc.text(`Emitido em: ${dataAtual}`, 14, 30);

    const status = filtroStatus.value || "Todos";
    const unidade = filtroUnidade.options[filtroUnidade.selectedIndex].text;
    const categoria =
      filtroCategoria.options[filtroCategoria.selectedIndex].text;

    doc.text(`Status: ${status}`, 14, 38);
    doc.text(`Unidade: ${unidade}`, 70, 38);
    doc.text(`Categoria: ${categoria}`, 150, 38);

    const totalPatrimonios = dadosRelatorioAtual.length;

    const valorTotal = dadosRelatorioAtual.reduce((total, item) => {
      return total + Number(item.valor || 0);
    }, 0);

    doc.setFontSize(11);
    doc.text(`Total de Patrimônios: ${totalPatrimonios}`, 14, 48);
    doc.text(
      `Valor Total: ${valorTotal.toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL",
      })}`,
      80,
      48,
    );

    const linhas = dadosRelatorioAtual.map((item) => [
      item.codigo_patrimonial,
      item.descricao,
      item.categoria ?? "-",
      item.unidade ?? "-",
      item.status,
      Number(item.valor || 0).toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL",
      }),
    ]);

    doc.autoTable({
      startY: 56,
      head: [
        ["Código", "Descrição", "Categoria", "Unidade", "Status", "Valor"],
      ],
      body: linhas,
      styles: {
        fontSize: 9,
        cellPadding: 3,
      },
      headStyles: {
        fillColor: [0, 70, 173],
        textColor: 255,
        fontStyle: "bold",
      },
      alternateRowStyles: {
        fillColor: [245, 247, 251],
      },
      margin: {
        left: 14,
        right: 14,
      },
    });

    const totalPaginas = doc.internal.getNumberOfPages();

    for (let i = 1; i <= totalPaginas; i++) {
      doc.setPage(i);
      doc.setFontSize(8);
      doc.text(
        `Página ${i} de ${totalPaginas}`,
        doc.internal.pageSize.getWidth() - 35,
        doc.internal.pageSize.getHeight() - 10,
      );
    }

    doc.save("relatorio_patrimonios.pdf");
  });

document
  .getElementById("btnFiltrar")
  .addEventListener("click", carregarRelatorio);

carregarFiltros();
carregarRelatorio();