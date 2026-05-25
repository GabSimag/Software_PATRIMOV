const formCategoria = document.getElementById("formCategoria");

formCategoria.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formCategoria);

  try {
    const resposta = await fetch("../api/categoria/cadastrar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Categoria cadastrada com sucesso!");
      window.location.href = "categorias.php";
    } else {
      alert(resultado.erro || "Erro ao cadastrar categoria.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});