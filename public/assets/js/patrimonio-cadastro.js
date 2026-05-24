document
  .getElementById("formPatrimonio")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const form = e.target;
    const dados = new FormData(form);

    try {
      const resposta = await fetch("../api/patrimonio/cadastrar.php", {
        method: "POST",
        body: dados,
      });

      const resultado = await resposta.json();

      if (resultado.sucesso) {
        alert("Patrimônio cadastrado com sucesso!");
        window.location.href = "patrimonios.php";
      } else {
        alert(resultado.erro || "Erro ao cadastrar patrimônio.");
      }
    } catch (erro) {
      alert("Erro de conexão com a API.");
    }
  });
