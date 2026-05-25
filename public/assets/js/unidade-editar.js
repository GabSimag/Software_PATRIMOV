const formUnidadeEditar = document.getElementById("formUnidadeEditar");

formUnidadeEditar.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formUnidadeEditar);

  try {

    const resposta = await fetch("../api/unidade/editar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {

      alert("Unidade atualizada com sucesso!");

      window.location.href = "unidades.php";

    } else {

      alert(resultado.erro || "Erro ao atualizar unidade.");

    }

  } catch (erro) {

    alert("Erro de conexão com a API.");

  }
});