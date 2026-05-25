const formUnidade = document.getElementById("formUnidade");

formUnidade.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formUnidade);

  try {
    const resposta = await fetch("../api/unidade/cadastrar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Unidade cadastrada com sucesso!");

      window.location.href = "unidades.php";
    } else {
      alert(resultado.erro || "Erro ao cadastrar unidade.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});
