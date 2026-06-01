const temaAtual = document.getElementById("temaAtual");
const btnLimparTema = document.getElementById("btnLimparTema");

function atualizarTemaAtual() {
  const tema = localStorage.getItem("tema");

  temaAtual.value = tema === "dark" ? "Escuro" : "Claro";
}

btnLimparTema.addEventListener("click", function () {
  localStorage.removeItem("tema");

  document.body.classList.remove("dark-mode");

  atualizarTemaAtual();

  alert("Tema padrão restaurado.");
});

atualizarTemaAtual();