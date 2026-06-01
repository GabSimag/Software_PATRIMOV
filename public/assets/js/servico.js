const tabelaServicos = document.getElementById("tabelaServicos");
const campoBuscaServico = document.getElementById("campoBuscaServico");

let servicos = [];
let servicosFiltrados = [];
let paginaAtualServicos = 1;
const itensPorPaginaServicos = 10;

async function carregarServicos() {
  try {
    const resposta = await fetch("../api/servicos/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaServicos.innerHTML = `
        <tr>
          <td colspan="5">Erro ao carregar serviços.</td>
        </tr>
      `;
      return;
    }

    servicos = resultado.dados;
    servicosFiltrados = servicos;
    paginaAtualServicos = 1;
    renderizarServicos();
  } catch (erro) {
    tabelaServicos.innerHTML = `
      <tr>
        <td colspan="5">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarServicos() {
  if (servicosFiltrados.length === 0) {
    tabelaServicos.innerHTML = `
      <tr>
        <td colspan="5">Nenhum serviço encontrado.</td>
      </tr>
    `;

    renderizarPaginacao(
      "paginacaoServicos",
      0,
      paginaAtualServicos,
      itensPorPaginaServicos,
      mudarPaginaServicos
    );

    return;
  }

  const listaPaginada = paginarLista(
    servicosFiltrados,
    paginaAtualServicos,
    itensPorPaginaServicos
  );

  tabelaServicos.innerHTML = listaPaginada.map(servico => `
    <tr>
      <td>#${servico.id}</td>
      <td>${servico.unidade ?? "-"}</td>
      <td>${servico.tipo_servico ?? "-"}</td>
      <td>
        <span class="badge ${classeStatusServico(servico.status)}">
          ${formatarStatusServico(servico.status)}
        </span>
      </td>
      <td>
        ${
          String(servico.status).trim().toUpperCase() !== "CONCLUIDO"
            ? `
              <a href="realizar_servico.php?id=${servico.id}" class="btn-manage" style="text-decoration:none;">
                <i class="fas fa-gear"></i>
                Realizar
              </a>
            `
            : `
              <span class="badge badge-success">
                Finalizado
              </span>
            `
        }
      </td>
    </tr>
  `).join("");

  renderizarPaginacao(
    "paginacaoServicos",
    servicosFiltrados.length,
    paginaAtualServicos,
    itensPorPaginaServicos,
    mudarPaginaServicos
  );
}

function mudarPaginaServicos(pagina) {
  paginaAtualServicos = pagina;
  renderizarServicos();
}

function classeStatusServico(status) {
  const s = String(status).trim().toUpperCase();

  if (s === "SOLICITADO") return "badge-warning";
  if (s === "EM_ANDAMENTO") return "badge-primary";
  if (s === "CONCLUIDO") return "badge-success";
  if (s === "CANCELADO") return "badge-danger";

  return "badge-primary";
}

function formatarStatusServico(status) {
  const s = String(status).trim().toUpperCase();

  if (s === "SOLICITADO") return "Solicitado";
  if (s === "EM_ANDAMENTO") return "Em andamento";
  if (s === "CONCLUIDO") return "Concluído";
  if (s === "CANCELADO") return "Cancelado";

  return status || "-";
}

campoBuscaServico.addEventListener("input", function () {
  const termo = campoBuscaServico.value.toLowerCase();

  servicosFiltrados = servicos.filter(
    servico =>
      String(servico.id).toLowerCase().includes(termo) ||
      String(servico.unidade).toLowerCase().includes(termo) ||
      String(servico.tipo_servico).toLowerCase().includes(termo) ||
      String(servico.status).toLowerCase().includes(termo)
  );

  paginaAtualServicos = 1;
  renderizarServicos();
});

carregarServicos();