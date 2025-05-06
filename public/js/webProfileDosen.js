document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll("[data-slide]");
  const buttons = document.querySelectorAll("[data-button]");
  const dots = document.querySelectorAll(".dot");
  let currentIndex = 0;

  function updateSlide() {
    slides.forEach((slide, i) => {
      slide.style.transform = `translateX(${(i - currentIndex) * 100}%)`;
    });
    dots.forEach((dot, i) => {
      dot.classList.toggle("active", i === currentIndex);
    });
  }

  buttons.forEach(button => {
    button.addEventListener("click", () => {
      if (button.dataset.button === "next") {
        currentIndex = (currentIndex + 1) % slides.length;
      } else {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
      }
      updateSlide();
    });
  });

  dots.forEach(dot => {
    dot.addEventListener("click", () => {
      currentIndex = parseInt(dot.dataset.dot);
      updateSlide();
    });
  });

  updateSlide();
});