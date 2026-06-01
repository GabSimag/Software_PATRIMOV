const tabelaAuditoria = document.getElementById("tabelaAuditoria");
const campoBuscaAuditoria = document.getElementById("campoBuscaAuditoria");

let logs = [];
let logsFiltrados = [];
let paginaAtualAuditoria = 1;
const itensPorPaginaAuditoria = 10;

async function carregarAuditoria() {
  try {
    const resposta = await fetch("../api/auditoria/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaAuditoria.innerHTML =
        `<tr><td colspan="6">Erro ao carregar auditoria.</td></tr>`;
      return;
    }

    logs = resultado.dados;
    logsFiltrados = logs;
    paginaAtualAuditoria = 1;
    renderizarAuditoria();
  } catch (erro) {
    tabelaAuditoria.innerHTML =
      `<tr><td colspan="6">Erro de conexão com a API.</td></tr>`;
  }
}

function renderizarAuditoria() {
  if (logsFiltrados.length === 0) {
    tabelaAuditoria.innerHTML =
      `<tr><td colspan="6">Nenhum registro encontrado.</td></tr>`;

    renderizarPaginacao(
      "paginacaoAuditoria",
      0,
      paginaAtualAuditoria,
      itensPorPaginaAuditoria,
      mudarPaginaAuditoria
    );

    return;
  }

  const listaPaginada = paginarLista(
    logsFiltrados,
    paginaAtualAuditoria,
    itensPorPaginaAuditoria
  );

  tabelaAuditoria.innerHTML = listaPaginada.map(log => `
    <tr>
      <td>${log.data_hora}</td>
      <td>${log.usuario ?? "Sistema"}</td>
      <td>
        <span class="badge badge-primary">
          ${log.acao}
        </span>
      </td>
      <td>${log.tabela_afetada ?? "-"}</td>
      <td>${log.registro_id ?? "-"}</td>
      <td>${log.detalhes ?? "-"}</td>
    </tr>
  `).join("");

  renderizarPaginacao(
    "paginacaoAuditoria",
    logsFiltrados.length,
    paginaAtualAuditoria,
    itensPorPaginaAuditoria,
    mudarPaginaAuditoria
  );
}

function mudarPaginaAuditoria(pagina) {
  paginaAtualAuditoria = pagina;
  renderizarAuditoria();
}

campoBuscaAuditoria.addEventListener("input", () => {
  const termo = campoBuscaAuditoria.value.toLowerCase();

  logsFiltrados = logs.filter(log =>
    (log.usuario ?? "").toLowerCase().includes(termo) ||
    (log.acao ?? "").toLowerCase().includes(termo) ||
    (log.tabela_afetada ?? "").toLowerCase().includes(termo) ||
    (log.detalhes ?? "").toLowerCase().includes(termo)
  );

  paginaAtualAuditoria = 1;
  renderizarAuditoria();
});

carregarAuditoria();