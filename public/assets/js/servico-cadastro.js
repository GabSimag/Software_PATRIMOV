const formServico = document.getElementById("formServico");
const tipoVinculo = document.getElementById("tipoVinculo");
const blocoExistente = document.getElementById("blocoPatrimonioExistente");
const blocoNovo = document.getElementById("blocoNovoPatrimonio");

tipoVinculo.addEventListener("change", function () {
  if (tipoVinculo.value === "novo") {
    blocoExistente.style.display = "none";
    blocoNovo.style.display = "block";
  } else {
    blocoExistente.style.display = "flex";
    blocoNovo.style.display = "none";
  }
});
formServico.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formServico);

  try {
    const resposta = await fetch("../api/servicos/cadastrar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Serviço cadastrado com sucesso!");
      window.location.href = "servicos.php";
    } else {
      alert(resultado.erro || "Erro ao cadastrar serviço.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});
