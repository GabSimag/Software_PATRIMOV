const btnTheme = document.getElementById("btnTheme");
const iconTheme = document.getElementById("iconTheme");

function aplicarTemaSalvo() {
  const tema = localStorage.getItem("tema");

  if (tema === "dark") {
    document.body.classList.add("dark-mode");
    iconTheme.classList.remove("fa-moon");
    iconTheme.classList.add("fa-sun");
  }
}

function alternarTema() {
  document.body.classList.toggle("dark-mode");

  const darkAtivo = document.body.classList.contains("dark-mode");

  localStorage.setItem("tema", darkAtivo ? "dark" : "light");

  iconTheme.classList.toggle("fa-moon", !darkAtivo);
  iconTheme.classList.toggle("fa-sun", darkAtivo);
}

if (btnTheme) {
  aplicarTemaSalvo();
  btnTheme.addEventListener("click", alternarTema);
}