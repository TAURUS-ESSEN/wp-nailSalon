document.addEventListener("click", (e) => {
  const btn = e.target.closest("[data-mobile-toggle]");
  if (!btn) return;

  const menu = document.getElementById("mobile-menu");
  if (!menu) return;

  const isOpen = !menu.classList.contains("hidden");
  menu.classList.toggle("hidden");
  btn.setAttribute("aria-expanded", String(!isOpen));
});