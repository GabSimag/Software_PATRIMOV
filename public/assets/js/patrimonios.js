const tabela = document.getElementById("tabelaPatrimonios");
const campoBusca = document.getElementById("campoBusca");

let patrimonios = [];

async function carregarPatrimonios() {
  try {
    const resposta = await fetch("../api/patrimonio/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabela.innerHTML = `
                        <tr>
                            <td colspan="7">Erro ao carregar patrimônios.</td>
                        </tr>
                    `;
      return;
    }

    patrimonios = resultado.dados;
    renderizarTabela(patrimonios);
  } catch (erro) {
    tabela.innerHTML = `
                    <tr>
                        <td colspan="7">Erro de conexão com a API.</td>
                    </tr>
                `;
  }
}

function renderizarTabela(lista) {
  if (lista.length === 0) {
    tabela.innerHTML = `
                    <tr>
                        <td colspan="7">Nenhum patrimônio encontrado.</td>
                    </tr>
                `;
    return;
  }

  tabela.innerHTML = lista
    .map(
      (item) => `
                <tr>
                    <td>${item.codigo_patrimonial ?? "-"}</td>
                    <td>${item.descricao ?? "-"}</td>
                    <td>${item.categoria ?? "-"}</td>
                    <td>${item.unidade ?? "-"}</td>
                    <td>${item.estado_conservacao ?? "-"}</td>
                    <td>
                        <span class="badge ${classeStatus(item.status)}">
                            ${formatarStatus(item.status)}
                        </span>
                    </td>
                    <td>
                        <a href="patrimonio_visualizar.php?id=${item.id}" class="btn-manage" style="text-decoration:none;">
                            <i class="fas fa-eye"></i>
                            Ver
                        </a>
                        <a href="patrimonio_editar.php?id=${item.id}" class="btn-manage"style="text-decoration:none;">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>
                        ${
                          item.status !== "BAIXADO"
                            ? `
                            <a href="#"onclick="abrirModalBaixa(${item.id}); return false;"class="btn-manage"style="text-decoration:none;"><i class="fas fa-archive"></i>
                                Baixar
                            </a>
                            `
                            : ""
                        }
                    </td>
                </tr>
            `,
    )
    .join("");
}

function classeStatus(status) {
  const statusFormatado = String(status).trim().toLowerCase();

  if (statusFormatado === "ativo") return "badge-success";
  if (statusFormatado === "manutencao") return "badge-warning";
  if (statusFormatado === "baixado") return "badge-danger";

  return "badge-primary";
}
function formatarStatus(status) {
  const statusFormatado = String(status).trim().toLowerCase();

  if (statusFormatado === "ativo") return "Ativo";
  if (statusFormatado === "manutencao") return "Manutenção";
  if (statusFormatado === "baixado") return "Baixado";

  return status || "-";
}
campoBusca.addEventListener("input", function () {
  const termo = campoBusca.value.toLowerCase();

  const filtrados = patrimonios.filter(
    (item) =>
      String(item.codigo_patrimonial).toLowerCase().includes(termo) ||
      String(item.descricao).toLowerCase().includes(termo) ||
      String(item.categoria).toLowerCase().includes(termo) ||
      String(item.unidade).toLowerCase().includes(termo),
  );

  renderizarTabela(filtrados);
});
function abrirModalBaixa(id) {
  document.getElementById("baixaId").value = id;
  document.getElementById("motivoBaixa").value = "";
  document.getElementById("modalBaixa").classList.add("active");
}

function fecharModalBaixa() {
  document.getElementById("modalBaixa").classList.remove("active");
}

async function confirmarBaixa() {
  const id = document.getElementById("baixaId").value;
  const motivo = document.getElementById("motivoBaixa").value;

  if (!motivo.trim()) {
    alert("Informe o motivo da baixa.");
    return;
  }

  const dados = new FormData();
  dados.append("id", id);
  dados.append("motivo_baixa", motivo);

  try {
    const resposta = await fetch("../api/patrimonio/baixar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      fecharModalBaixa();
      alert("Patrimônio baixado com sucesso!");
      carregarPatrimonios();
    } else {
      alert(resultado.erro || "Erro ao baixar patrimônio.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
}
carregarPatrimonios();
