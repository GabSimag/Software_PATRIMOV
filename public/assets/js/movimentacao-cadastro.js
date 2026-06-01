const patrimonioSelect = document.getElementById("idPatrimonio");
const ugDestinoSelect = document.getElementById("idUgDestino");
const unidadeDestinoSelect = document.getElementById("idUnidadeDestino");

const unidadeAtualInput = document.getElementById("unidadeAtual");
const ugAtualInput = document.getElementById("ugAtual");

const formMovimentacao = document.getElementById("formMovimentacao");

patrimonioSelect.addEventListener("change", async function () {
  const id = this.value;

  unidadeAtualInput.value = "";
  ugAtualInput.value = "";

  if (!id) return;

  try {
    const resposta = await fetch(
      `../api/movimentacao/buscar_patrimonio.php?id=${id}`
    );

    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      alert(resultado.erro);
      return;
    }

    unidadeAtualInput.value = resultado.dados.unidade;
    ugAtualInput.value =
      resultado.dados.ug_sigla + " - " + resultado.dados.ug_nome;

  } catch (erro) {
    alert("Erro ao carregar patrimônio.");
  }
});

ugDestinoSelect.addEventListener("change", async function () {
  const idUg = this.value;

  unidadeDestinoSelect.innerHTML =
    '<option value="">Carregando...</option>';

  try {
    const resposta = await fetch(
      `../api/movimentacao/unidades_por_ug.php?id_ug=${idUg}`
    );

    const resultado = await resposta.json();

    if (!resultado.sucesso) {
      throw new Error(resultado.erro);
    }

    unidadeDestinoSelect.innerHTML =
      '<option value="">Selecione...</option>';

    resultado.dados.forEach(unidade => {
      unidadeDestinoSelect.innerHTML += `
        <option value="${unidade.id}">
          ${unidade.nome}
        </option>
      `;
    });

  } catch (erro) {
    unidadeDestinoSelect.innerHTML =
      '<option value="">Erro ao carregar</option>';
  }
});

formMovimentacao.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dados = new FormData(formMovimentacao);

  try {
    const resposta = await fetch(
      "../api/movimentacao/cadastrar.php",
      {
        method: "POST",
        body: dados,
      }
    );

    const resultado = await resposta.json();

    if (resultado.sucesso) {
      alertaSucesso("Movimentação registrada com sucesso.");

      window.location.href = "movimentacoes.php";
    } else {
      alert(resultado.erro);
    }

  } catch (erro) {
    alert("Erro de conexão com a API.");
  }
});