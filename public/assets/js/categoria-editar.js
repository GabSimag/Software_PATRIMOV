const formCategoriaEditar = document.getElementById("formCategoriaEditar");

formCategoriaEditar.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formCategoriaEditar);

  try {
    const resposta = await fetch("../api/categoria/editar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Categoria atualizada com sucesso!");
      window.location.href = "categorias.php";
    } else {
      alert(resultado.erro || "Erro ao atualizar categoria.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});
