const formUsuario = document.getElementById("formUsuario");

formUsuario.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formUsuario);

  try {
    const resposta = await fetch("../api/usuario/cadastrar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Usuário cadastrado com sucesso!");
      window.location.href = "usuarios.php";
    } else {
      alert(resultado.erro || "Erro ao cadastrar usuário.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});