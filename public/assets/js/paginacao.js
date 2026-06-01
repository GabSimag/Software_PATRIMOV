function paginarLista(lista, paginaAtual, itensPorPagina) {
  const inicio = (paginaAtual - 1) * itensPorPagina;
  const fim = inicio + itensPorPagina;

  return lista.slice(inicio, fim);
}

function renderizarPaginacao(containerId, totalItens, paginaAtual, itensPorPagina, callback) {
  const container = document.getElementById(containerId);

  if (!container) {
    return;
  }

  const totalPaginas = Math.ceil(totalItens / itensPorPagina);

  if (totalPaginas <= 1) {
    container.innerHTML = "";
    return;
  }

  let html = "";

  html += `
    <button class="pagination-btn" ${paginaAtual === 1 ? "disabled" : ""} data-page="${paginaAtual - 1}">
      Anterior
    </button>
  `;

  for (let i = 1; i <= totalPaginas; i++) {
    html += `
      <button class="pagination-btn ${i === paginaAtual ? "active" : ""}" data-page="${i}">
        ${i}
      </button>
    `;
  }

  html += `
    <button class="pagination-btn" ${paginaAtual === totalPaginas ? "disabled" : ""} data-page="${paginaAtual + 1}">
      Próxima
    </button>
  `;

  container.innerHTML = html;

  container.querySelectorAll(".pagination-btn").forEach((botao) => {
    botao.addEventListener("click", function () {
      const pagina = Number(this.dataset.page);

      if (!pagina || this.disabled) {
        return;
      }

      callback(pagina);
    });
  });
}