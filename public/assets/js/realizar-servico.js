const formRealizarServico = document.getElementById("formRealizarServico");

formRealizarServico.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formRealizarServico);

  try {
    const resposta = await fetch("../api/servicos/realizar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Patrimoniação concluída com sucesso!");
      window.location.href = "servicos.php";
    } else {
      alert(resultado.erro || "Erro ao concluir patrimoniação.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});
