<div class="modal-overlay" id="modalBaixa">

    <div class="modal-content">

        <div class="modal-header">
            <h2>Baixar Patrimônio</h2>
        </div>

        <div class="modal-body">

            <input type="hidden" id="baixaId">

            <div class="form-group">
                <label>Motivo da baixa</label>

                <textarea
                    id="motivoBaixa"
                    rows="4"
                    placeholder="Informe o motivo..."
                ></textarea>
            </div>

        </div>

        <div class="modal-actions">

            <button
                class="btn-secondary"
                onclick="fecharModalBaixa()"
            >
                Cancelar
            </button>

            <button
                class="btn-primary"
                onclick="confirmarBaixa()"
            >
                Confirmar Baixa
            </button>

        </div>

    </div>

</div>