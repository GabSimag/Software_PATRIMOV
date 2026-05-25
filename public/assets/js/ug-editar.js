const formUgEditar = document.getElementById("formUgEditar");

formUgEditar.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formUgEditar);

  try {

    const resposta = await fetch("../api/ug/editar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {

      alert("UG atualizada com sucesso!");

      window.location.href = "ugs.php";

    } else {

      alert(resultado.erro || "Erro ao atualizar UG.");

    }

  } catch (erro) {

    alert("Erro de conexão com a API.");

  }
});