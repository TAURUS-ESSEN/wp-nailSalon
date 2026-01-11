document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll("[data-reveal]");
  if (!items.length) return;
 
  if (!("IntersectionObserver" in window)) {
    items.forEach((el) => el.classList.add("is-revealed"));
    return;
  }

  const io = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;

        const el = entry.target;
        const delay = Number(el.dataset.revealDelay || 0);
        setTimeout(() => el.classList.add("is-revealed"), delay);

        obs.unobserve(el);  
      });
    },
    {
      threshold: 0.12,
      rootMargin: "0px 0px -10% 0px",
    }
  );

  items.forEach((el) => io.observe(el));
});
