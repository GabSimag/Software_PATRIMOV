/* =========================================================
   GLOBAL: variáveis, reset, body, tipografia, inputs,
   tabelas base, modais, header operacional e responsivo
   ========================================================= */

:root {
  --azul-primario: #0046AD;
  --azul-escuro:   #002D6E;
  --azul-suave:    #E8F0FE;
  --branco:        #FFFFFF;
  --cinza-texto:   #333333;
  --cinza-secundario: #666666;
  --verde-sucesso: #28A745;
  --amarelo-alerta:#FFC107;
  --vermelho-erro: #DC3545;
}

* { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }

body {
  background-color: var(--azul-suave);
  color: var(--cinza-texto);
  min-height: 100vh;
}

/* CONTEÚDO PRINCIPAL */
.main-content { transition: margin-left 0.3s ease; }
body.logado .main-content { margin-left: 260px !important; padding: 40px; }

/* TÍTULOS DE PÁGINA */
.page-title    { color: var(--azul-primario); font-size: 30px; font-weight: 800; margin-bottom: 8px; }
.page-subtitle { color: var(--cinza-secundario); font-size: 14px; }

/* INPUTS / FORMULÁRIOS */
.input-group { position: relative; margin-bottom: 15px; }
.input-group input,
.input-group select,
.input-group textarea {
  width: 100%; padding: 12px 15px 12px 45px;
  border: 1px solid #ddd; border-radius: 8px;
  background: var(--azul-suave); font-size: 14px;
}
.input-group i.fas-input {
  position: absolute; left: 15px; top: 13px;
  color: var(--azul-primario); font-size: 18px; z-index: 10;
}
#toggleIcon {
  position: absolute; right: 15px; top: 13px;
  cursor: pointer; color: var(--cinza-secundario); z-index: 10;
}

/* CARDS DE DASHBOARD */
.card-info {
  border: 1px solid rgba(0,0,0,0.04);
  background: white;
  border-radius: 22px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: transform .25s ease, box-shadow .25s ease;
  min-height: 240px;
  display: flex; flex-direction: column; justify-content: space-between;
}
.card-info:hover { transform: translateY(-6px) scale(1.01); box-shadow: 0 18px 40px rgba(0,0,0,0.08); }

.card-body { padding: 26px; }
.card-top  { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:28px; }
.card-left { display:flex; align-items:center; gap:18px; }

.card-main-icon {
  width:72px; height:72px; border-radius:22px;
  display:flex; align-items:center; justify-content:center;
  font-size:30px; color:white; flex-shrink:0;
}
.card-side-icon  { font-size:18px; color:#c8d2e4; }
.card-title      { font-size:14px; color: var(--cinza-secundario); margin-bottom:8px; font-weight:600; }
.card-value      { font-size:42px; font-weight:800; color: var(--azul-escuro); line-height:1; }
.card-description{ margin-top:18px; font-size:13px; line-height:1.5; color: var(--cinza-secundario); }

.card-footer {
  padding:18px 26px;
  background: linear-gradient(to bottom, rgba(0,0,0,0.02), rgba(0,0,0,0.03));
  border-top: 1px solid rgba(0,0,0,0.04);
}
.card-link    { display:inline-flex; align-items:center; gap:8px; text-decoration:none; font-size:14px; font-weight:700; color: var(--azul-primario); }
.card-link i  { font-size:12px; }

/* VARIAÇÕES DE CARDS */
.card-primary .card-main-icon { background: var(--azul-primario); }
.card-success .card-main-icon { background: var(--verde-sucesso); }
.card-warning .card-main-icon { background: var(--amarelo-alerta); color:#333; }
.card-purple  .card-main-icon { background:#6f42c1; }

.action-card { cursor: pointer; }
.action-card .card-main-icon { width:70px; height:70px; font-size:28px; }

/* GRID PADRÃO */
.dashboard-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:24px; }
.section-spacing{ margin-top:40px; }

/* TABELAS BASE */
.table-container {
  background:#FFFFFF; border-radius:18px; padding:10px;
  box-shadow: 0 4px 18px rgba(0,0,0,0.04);
  border: 1px solid rgba(0,0,0,0.04);
  overflow-x:auto;
}
table { width:100%; border-collapse: collapse; }
table th { background: var(--azul-suave) !important; padding:15px; text-align:left; color: var(--azul-escuro); font-size:14px; }
table td { padding:15px; border-bottom:1px solid #eee; font-size:14px; }

.table-modern tbody tr { transition: background .2s ease; }
.table-modern tbody tr:hover { background: rgba(0,0,0,0.02); }

/* STATUS */
.status-success { color: var(--verde-sucesso); font-weight:700; }
.status-warning { color: var(--amarelo-alerta); font-weight:700; }
.status-danger  { color: var(--vermelho-erro); font-weight:700; }

/* HEADER OPERACIONAL */
.header-operacional {
  display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:30px;
}

/* MODAIS */
.floating-page {
  display:none; position:fixed; top:50%; left:50%;
  transform: translate(-50%, -50%); width:90%; max-width:600px;
  background:#FFFFFF !important; z-index:2000; border-radius:12px;
  padding:40px; box-shadow:0 0 50px rgba(0,0,0,0.5);
}
.modal-blindado {
  display:none;
  position: fixed !important;
  top:50% !important; left:50% !important;
  transform: translate(-50%, -50%) !important;
  width:90% !important; max-width:600px !important;
  background:#FFFFFF !important;
  z-index: 10001 !important;
  padding:30px !important;
  border-radius:12px !important;
  box-shadow:0 0 50px rgba(0,0,0,0.5) !important;
}

/* RESPONSIVO MOBILE */
@media (max-width: 768px) {
  h1 { font-size: 1.2rem !important; }
  p, span, li, td, th { font-size: 12px !important; }

  #btn-menu {
    display:flex !important;
    z-index: 9999 !important;
    visibility:visible !important; opacity:1 !important;
  }

  body.logado .sidebar {
    left: -260px !important;
    padding-top: 80px !important;
    z-index: 9998;
  }
  body.logado .sidebar.active { left:0 !important; }

  body.logado .main-content {
    margin-left:0 !important;
    padding: 100px 15px 30px 15px !important;
    width:100% !important;
    position:relative; z-index:1 !important;
  }

  .header-operacional { flex-direction: column !important; align-items:flex-start !important; gap:15px; }
  .header-operacional button { width:100% !important; }

  .table-container { overflow-x:auto !important; padding:15px; }
  table { min-width: 500px; }
  .login-container { width:90% !important; max-width:320px !important; }
}
