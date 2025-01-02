/**
 * Init swiper sliders
 */
function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function (swiperElement) {
      try {
        let configElement = swiperElement.querySelector(".swiper-config");
        if (!configElement) {
          console.warn("Config element not found for swiper:", swiperElement);
          return;
        }
  
        let config = JSON.parse(configElement.innerHTML.trim());
  
        if (swiperElement.classList.contains("swiper-tab")) {
          initSwiperWithCustomPagination(swiperElement, config);
        } else {
          new Swiper(swiperElement, config);
        }
      } catch (error) {
        console.error("Failed to initialize swiper:", error);
      }
    });
  }
  
  window.addEventListener("load", initSwiper);
  
  document.querySelectorAll(".faq-item").forEach((faqItem) => {
    const toggle = faqItem.querySelector(".faq-toggle");
    const content = faqItem.querySelector(".faq-content");
  
    // Verificar que los elementos existan
    if (!toggle || !content) {
      console.warn("Missing toggle or content element for FAQ item:", faqItem);
      return;
    }
  
    // Evento de clic para expandir/contraer
    faqItem.addEventListener("click", () => {
      faqItem.classList.toggle("faq-active");
  
      // Cambiar el ícono de abierto/cerrado
      if (faqItem.classList.contains("faq-active")) {
        toggle.classList.remove("bi-chevron-right");
        toggle.classList.add("bi-chevron-down");
      } else {
        toggle.classList.remove("bi-chevron-down");
        toggle.classList.add("bi-chevron-right");
      }
    });
  });
  
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);