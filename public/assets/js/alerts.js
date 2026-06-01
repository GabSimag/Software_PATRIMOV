function alertaSucesso(mensagem) {
  Swal.fire({
    icon: "success",
    title: "Sucesso",
    text: mensagem,
    confirmButtonColor: "#0046AD",
  });
}

function alertaErro(mensagem) {
  Swal.fire({
    icon: "error",
    title: "Erro",
    text: mensagem,
    confirmButtonColor: "#DC3545",
  });
}

function alertaAviso(mensagem) {
  Swal.fire({
    icon: "warning",
    title: "Atenção",
    text: mensagem,
    confirmButtonColor: "#FFC107",
  });
}

async function confirmarAcao(titulo, texto) {
  const resultado = await Swal.fire({
    title: titulo,
    text: texto,
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#0046AD",
    cancelButtonColor: "#6B7280",
    confirmButtonText: "Sim",
    cancelButtonText: "Cancelar",
  });

  return resultado.isConfirmed;
}