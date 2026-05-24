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
          <td colspan="2">Erro ao carregar categorias.</td>
        </tr>
      `;
      return;
    }

    categorias = resultado.dados;
    renderizarCategorias(categorias);
  } catch (erro) {
    tabelaCategorias.innerHTML = `
      <tr>
        <td colspan="2">Erro de conexão com a API.</td>
      </tr>
    `;
  }
}

function renderizarCategorias(lista) {
  if (lista.length === 0) {
    tabelaCategorias.innerHTML = `
      <tr>
        <td colspan="2">Nenhuma categoria encontrada.</td>
      </tr>
    `;
    return;
  }

  tabelaCategorias.innerHTML = lista.map(categoria => `
    <tr>
      <td>${categoria.nome ?? "-"}</td>
      <td>${categoria.descricao ?? "-"}</td>
    </tr>
  `).join("");
}

campoBuscaCategoria.addEventListener("input", function () {
  const termo = campoBuscaCategoria.value.toLowerCase();

  const filtradas = categorias.filter(categoria =>
    String(categoria.nome).toLowerCase().includes(termo) ||
    String(categoria.descricao).toLowerCase().includes(termo)
  );

  renderizarCategorias(filtradas);
});

carregarCategorias();