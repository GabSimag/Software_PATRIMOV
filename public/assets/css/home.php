/* =========================================================
   HOME DASHBOARD
   ========================================================= */

.home-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 24px;
  align-items: start;
}

.home-panel {
  background: white;
  border-radius: 24px;
  padding: 28px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.home-header {
  display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;
}
.home-user h1 { font-size:32px; color: var(--azul-escuro); font-weight:800; margin-bottom:8px; }
.home-user p  { color: var(--cinza-secundario); font-size:14px; }

.home-badge {
  background: rgba(0,70,173,0.08);
  color: var(--azul-primario);
  padding: 12px 18px;
  border-radius: 14px;
  font-size: 13px; font-weight: 700;
}

/* QUICK ACTIONS */
.quick-actions {
  display:grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap:18px; margin-top:25px;
}
.quick-card {
  background:white; border-radius:22px; padding:22px;
  text-decoration:none; border:1px solid rgba(0,0,0,0.05);
  transition: transform .25s ease, box-shadow .25s ease;
}
.quick-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.07); }

.quick-icon {
  width:62px; height:62px; border-radius:18px;
  display:flex; align-items:center; justify-content:center;
  color:white; font-size:24px; margin-bottom:18px;
}
.quick-title       { font-size:16px; font-weight:700; color: var(--azul-escuro); margin-bottom:8px; }
.quick-description { font-size:13px; color: var(--cinza-secundario); line-height:1.5; }

.quick-primary { background: var(--azul-primario); }
.quick-success { background: var(--verde-sucesso); }
.quick-warning { background: var(--amarelo-alerta); color:#333; }
.quick-purple  { background: #6f42c1; }

@media (max-width: 1100px) {
  .home-grid { grid-template-columns: 1fr; }
}
