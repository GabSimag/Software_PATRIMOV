const tabelaUnidades = document.getElementById("tabelaUnidades");
const campoBuscaUnidade = document.getElementById("campoBuscaUnidade");

let unidades = [];

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
    renderizarUnidades(unidades);
  } catch (erro) {
    tabelaUnidades.innerHTML = `
      <tr>
        <td colspan="6">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarUnidades(lista) {
  if (lista.length === 0) {
    tabelaUnidades.innerHTML = `
      <tr>
        <td colspan="6">Nenhuma unidade encontrada.</td>
      </tr>
    `;
    return;
  }

  tabelaUnidades.innerHTML = lista
    .map(
      (unidade) => `
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
  `,
    )
    .join("");
}

campoBuscaUnidade.addEventListener("input", function () {
  const termo = campoBuscaUnidade.value.toLowerCase();

  const filtradas = unidades.filter(
    (unidade) =>
      String(unidade.nome).toLowerCase().includes(termo) ||
      String(unidade.ug).toLowerCase().includes(termo) ||
      String(unidade.endereco).toLowerCase().includes(termo) ||
      String(unidade.telefone).toLowerCase().includes(termo),
  );

  renderizarUnidades(filtradas);
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
    alert("Erro de conexão.");
  }
}
carregarUnidades();
