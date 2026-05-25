const tabelaUgs = document.getElementById("tabelaUgs");
const campoBuscaUg = document.getElementById("campoBuscaUg");

let ugs = [];

async function carregarUgs() {
  try {
    const resposta = await fetch("../api/ug/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaUgs.innerHTML = `
        <tr>
          <td colspan="5">Erro ao carregar UGs.</td>
        </tr>
      `;
      return;
    }

    ugs = resultado.dados;
    renderizarUgs(ugs);
  } catch (erro) {
    tabelaUgs.innerHTML = `
      <tr>
        <td colspan="5">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarUgs(lista) {
  if (lista.length === 0) {
    tabelaUgs.innerHTML = `
      <tr>
        <td colspan="5">Nenhuma UG encontrada.</td>
      </tr>
    `;
    return;
  }

  tabelaUgs.innerHTML = lista
    .map(
      (ug) => `
  <tr>
    <td>${ug.codigo}</td>
    <td>${ug.sigla}</td>
    <td>${ug.nome_fantasia}</td>
    <td>${ug.origem}</td>

    <td>
      <span class="badge ${ug.status === "ATIVO" ? "badge-success" : "badge-danger"}">
        ${ug.status}
      </span>
    </td>

    <td>
      <a href="ug_editar.php?id=${ug.id}" class="btn-manage" style="text-decoration:none;">
        <i class="fas fa-edit"></i>
        Editar
      </a>

      <button class="btn-manage" onclick="alterarStatusUg(${ug.id})">
        <i class="fas fa-power-off"></i>
        ${ug.status === "ATIVO" ? "Inativar" : "Ativar"}
      </button>
    </td>
  </tr>
`,
    )
    .join("");
}

campoBuscaUg.addEventListener("input", function () {
  const termo = campoBuscaUg.value.toLowerCase();

  const filtrados = ugs.filter(
    (ug) =>
      String(ug.codigo).toLowerCase().includes(termo) ||
      String(ug.sigla).toLowerCase().includes(termo) ||
      String(ug.nome_fantasia).toLowerCase().includes(termo) ||
      String(ug.origem).toLowerCase().includes(termo),
  );

  renderizarUgs(filtrados);
});
async function alterarStatusUg(id) {
  try {
    const dados = new FormData();
    dados.append("id", id);

    const resposta = await fetch("../api/ug/status.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      carregarUgs();
    } else {
      alert(resultado.erro || "Erro ao alterar status.");
    }
  } catch (erro) {
    alert("Erro de conexão.");
  }
}
carregarUgs();
