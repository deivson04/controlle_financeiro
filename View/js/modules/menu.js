/* ==========================
      MENU DASHBOARD 
    ========================== */
export function menuDashboard() {
  const menuToggle = document.querySelector("#menuToggle");
  const sidebar = document.querySelector("#sidebar");
  const backdrop = document.querySelector("#backdrop");

  if (menuToggle && sidebar && backdrop) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.toggle("open-sidebar");
      backdrop.classList.toggle("show");
    });

    backdrop.addEventListener("click", () => {
      sidebar.classList.remove("open-sidebar");
      backdrop.classList.remove("show");
    });
  }
}
