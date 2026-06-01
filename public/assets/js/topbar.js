const btnUserMenu = document.getElementById("btnUserMenu");
const userDropdown = document.getElementById("userDropdown");

if (btnUserMenu && userDropdown) {
  btnUserMenu.addEventListener("click", function (e) {
    e.stopPropagation();
    userDropdown.classList.toggle("active");
  });

  document.addEventListener("click", function () {
    userDropdown.classList.remove("active");
  });
}