const formUsuarioEditar = document.getElementById("formUsuarioEditar");

formUsuarioEditar.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formUsuarioEditar);

  try {
    const resposta = await fetch("../api/usuario/editar.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Usuário atualizado com sucesso!");
      window.location.href = "usuarios.php";
    } else {
      alert(resultado.erro || "Erro ao atualizar usuário.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});