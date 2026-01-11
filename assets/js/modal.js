console.log("modal.js loaded");

const modal = document.getElementById("modal-booking");
const overlay = modal?.querySelector('div[data-modal-close]'); 
const panel = modal?.querySelector(".relative.z-20");  

let isClosing = false;

function openModal() {
  if (!modal || !overlay || !panel) return;

  isClosing = false; 

  modal.hidden = false;
  modal.setAttribute("aria-hidden", "false");
  modal.querySelector("[data-booking-success]")?.setAttribute("hidden", "");
  document.body.style.overflow = "hidden";

  requestAnimationFrame(() => {
    modal.classList.remove("opacity-0", "pointer-events-none");
    modal.classList.add("opacity-100");

    overlay.classList.remove("opacity-0");
    overlay.classList.add("opacity-100");

    panel.classList.remove("opacity-0", "translate-y-3", "scale-[0.98]");
    panel.classList.add("opacity-100", "translate-y-0", "scale-100");
  });

  setTimeout(() => {
    modal.querySelector("input, textarea, select, button")?.focus();
  }, 220);
}

function closeModal() {
  if (!modal || !overlay || !panel || isClosing) return;
  isClosing = true;

  modal.classList.add("opacity-0", "pointer-events-none");
  modal.classList.remove("opacity-100");

  overlay.classList.add("opacity-0");
  overlay.classList.remove("opacity-100");

  panel.classList.add("opacity-0", "translate-y-3", "scale-[0.98]");
  panel.classList.remove("opacity-100", "translate-y-0", "scale-100");

  const onEnd = (e) => {
    if (e.target !== panel) return;  
    modal.hidden = true;
    modal.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
    panel.removeEventListener("transitionend", onEnd);
    isClosing = false;
  };

  panel.addEventListener("transitionend", onEnd);
}

document.addEventListener("click", (e) => {
  const openBtn = e.target.closest("[data-modal-open]");
  if (openBtn) {
    e.preventDefault();
    openModal();
    return;
  }

  const closeBtn = e.target.closest("[data-modal-close]");
  if (closeBtn) {
    e.preventDefault();
    closeModal();
  }
});

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && modal && !modal.hidden) closeModal();
});

document.addEventListener("wpcf7mailsent", () => {
  if (!modal || modal.hidden) return;

  modal.querySelector("[data-booking-success]")?.removeAttribute("hidden");

  setTimeout(closeModal, 3200);
});

document.addEventListener("wpcf7submit", () => {
  if (!modal) return;
  modal.querySelector("[data-booking-success]")?.setAttribute("hidden", "");
});
