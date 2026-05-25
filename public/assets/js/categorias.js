const tabelaCategorias = document.getElementById("tabelaCategorias");
const campoBuscaCategoria = document.getElementById("campoBuscaCategoria");

let categorias = [];

async function carregarCategorias() {
  try {
    const resposta = await fetch("../api/categoria/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      tabelaCategorias.innerHTML = `
        <tr>
          <td colspan="4">Erro ao carregar categorias.</td>
        </tr>
      `;
      return;
    }

    categorias = resultado.dados;
    renderizarCategorias(categorias);
  } catch (erro) {
    tabelaCategorias.innerHTML = `
      <tr>
        <td colspan="4">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarCategorias(lista) {
  if (lista.length === 0) {
    tabelaCategorias.innerHTML = `
      <tr>
        <td colspan="4">Nenhuma categoria encontrada.</td>
      </tr>
    `;
    return;
  }

  tabelaCategorias.innerHTML = lista
    .map(
      (categoria) => `
    <tr>
  <td>${categoria.nome ?? "-"}</td>
  <td>${categoria.descricao ?? "-"}</td>
  <td>
    <span class="badge ${categoria.status === "ATIVO" ? "badge-success" : "badge-danger"}">
      ${categoria.status}
    </span>
  </td>
  <td>
    <a href="categoria_editar.php?id=${categoria.id}" class="btn-manage" style="text-decoration:none;">
      <i class="fas fa-edit"></i>
      Editar
    </a>
    <button
  class="btn-manage"
  onclick="alterarStatusCategoria(${categoria.id})">

  <i class="fas fa-power-off"></i>

  ${categoria.status === "ATIVO" ? "Inativar" : "Ativar"}

</button>
  </td>
</tr>
  `,
    )
    .join("");
}

campoBuscaCategoria.addEventListener("input", function () {
  const termo = campoBuscaCategoria.value.toLowerCase();

  const filtradas = categorias.filter(
    (categoria) =>
      String(categoria.nome).toLowerCase().includes(termo) ||
      String(categoria.descricao).toLowerCase().includes(termo),
  );

  renderizarCategorias(filtradas);
});
async function alterarStatusCategoria(id) {

  try {

    const dados = new FormData();
    dados.append("id", id);

    const resposta = await fetch("../api/categoria/status.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {

      carregarCategorias();

    } else {

      alert(resultado.erro || "Erro ao alterar status.");

    }

  } catch (erro) {

    alert("Erro de conexão.");

  }
}

carregarCategorias();
