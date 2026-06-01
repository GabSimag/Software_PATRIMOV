const btnNotificacoes = document.getElementById("btnNotificacoes");
const dropdownNotificacoes = document.getElementById("notificationDropdown");
const listaNotificacoes = document.getElementById("notificationList");
const contadorNotificacoes = document.getElementById("notificationCount");

async function carregarNotificacoes() {
  try {
    const resposta = await fetch("../api/notificacoes/listar.php");
    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      return;
    }

    contadorNotificacoes.textContent = resultado.total;

    if (resultado.total === 0) {
      listaNotificacoes.innerHTML = `
        <div class="notification-empty">
          Nenhuma notificação.
        </div>
      `;
      return;
    }

    listaNotificacoes.innerHTML = resultado.dados.map(item => `
      <div
        class="notification-item"
        onclick="window.location.href='${item.link}'"
        style="cursor:pointer;"
      >
        <div class="notification-title">
          <i class="fas ${item.icone}"></i>
          ${item.titulo}
        </div>

        <div class="notification-description">
          ${item.descricao}
        </div>
      </div>
    `).join("");

  } catch (erro) {
    console.error("Erro ao carregar notificações:", erro);
  }
}

btnNotificacoes.addEventListener("click", function (e) {
  e.stopPropagation();
  dropdownNotificacoes.classList.toggle("show");
});

document.addEventListener("click", function () {
  dropdownNotificacoes.classList.remove("show");
});

carregarNotificacoes();