const formUg = document.getElementById("formUg");

formUg.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formUg);

  try {
    const resposta = await fetch("../api/ug/cadastrar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("UG cadastrada com sucesso!");
      window.location.href = "unidades.php";
    } else {
      alert(resultado.erro || "Erro ao cadastrar UG.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});