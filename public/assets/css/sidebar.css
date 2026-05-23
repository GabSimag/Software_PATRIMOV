/* =========================================================
   SIDEBAR + BOTÃO SANDUÍCHE
   ========================================================= */

.sidebar {
  height: 100vh;
  width: 260px;
  position: fixed;
  top: 0; left: 0;
  background: var(--azul-primario);
  transition: left 0.3s ease;
  z-index: 1000;
  display: flex; flex-direction: column;
}

body:not(.logado) .sidebar { left: -260px; padding-top: 80px; }
body:not(.logado) .sidebar.active { left: 0; }

body.logado .sidebar { left: 0 !important; padding-top: 20px; }

/* Botão sanduíche */
#btn-menu {
  position: fixed; top: 20px; left: 20px; z-index: 9999 !important; cursor:pointer;
  background: var(--azul-primario) !important; width:50px; height:50px;
  display:flex; align-items:center; justify-content:center;
  border-radius:8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);
  visibility:visible !important;
}
@media (min-width: 769px) {
  body.logado #btn-menu { display:none !important; }
}

.sanduiche-puro {
  width:25px; height:18px;
  display:flex; flex-direction:column; justify-content:space-between;
}
.sanduiche-puro span {
  display:block; width:100%; height:3px;
  background-color:#FFFFFF !important; border-radius:2px;
}

/* LOGO + MENU */
.sidebar-logo {
  padding:20px; text-align:center;
  border-bottom:1px solid rgba(255,255,255,0.1);
  margin-bottom:10px;
}
.sidebar-logo img { width:120px; border-radius:8px; }

.sidebar-menu {
  list-style:none; padding:20px 12px;
  display:flex; flex-direction:column; gap:10px; flex-grow:1;
}

.sidebar-menu li { border-radius:18px; overflow:hidden; transition: all .25s ease; }
.sidebar-menu li a {
  display:flex; align-items:center; gap:14px;
  padding:18px 20px;
  color:#FFFFFF !important; text-decoration:none; font-weight:500;
  border-radius:18px; transition: all .25s ease;
}
.sidebar-menu li i { width:30px; font-size:18px; }
.sidebar-menu li:hover a { background: rgba(255,255,255,0.08); transform: translateX(4px); }
.sidebar-menu li.active a {
  background: linear-gradient(90deg, #1b4fcf 0%, #0f3ea8 100%);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.sidebar-hr { border:0; border-top:1px solid rgba(255,255,255,0.1); margin:15px 25px; }
