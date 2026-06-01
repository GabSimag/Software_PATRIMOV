const formAlterarSenha = document.getElementById("formAlterarSenha");

formAlterarSenha.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formAlterarSenha);

  try {
    const resposta = await fetch("../api/usuario/alterar_senha.php", {
      method: "POST",
      body: dados,
    });

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alert("Senha alterada com sucesso!");
      window.location.href = "perfil.php";
    } else {
      alert(resultado.erro || "Erro ao alterar senha.");
    }
  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});