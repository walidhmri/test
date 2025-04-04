document.addEventListener("DOMContentLoaded", () => {
    // Mobile Menu Toggle
    const menuToggle = document.querySelector(".menu-toggle")
    const navList = document.querySelector(".nav-list")
  
    if (menuToggle && navList) {
      menuToggle.addEventListener("click", () => {
        navList.classList.toggle("active")
        document.body.classList.toggle("menu-open")
      })
    }
  
    // Close menu when clicking outside
    document.addEventListener("click", (event) => {
      if (
        navList &&
        navList.classList.contains("active") &&
        !event.target.closest(".main-nav") &&
        !event.target.closest(".menu-toggle")
      ) {
        navList.classList.remove("active")
        document.body.classList.remove("menu-open")
      }
    })
  
    // Theme Toggle
    const themeToggle = document.querySelector(".theme-toggle")
  
    if (themeToggle) {
      // Check for saved theme preference or respect OS preference
      const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)")
      const storedTheme = localStorage.getItem("theme")
  
      if (storedTheme === "dark" || (!storedTheme && prefersDarkScheme.matches)) {
        document.documentElement.classList.add("dark-mode")
        document.body.classList.add("dark-mode")
      }
  
      themeToggle.addEventListener("click", () => {
        document.documentElement.classList.toggle("dark-mode")
        document.body.classList.toggle("dark-mode")
  
        // Save preference to localStorage
        if (document.documentElement.classList.contains("dark-mode")) {
          localStorage.setItem("theme", "dark")
        } else {
          localStorage.setItem("theme", "light")
        }
      })
    }
  
    // Testimonials Slider - Auto scroll
    const testimonialsSlider = document.querySelector(".testimonials-slider")
  
    if (testimonialsSlider && testimonialsSlider.children.length > 3) {
      let scrollAmount = 0
      const slideWidth =
        testimonialsSlider.querySelector(".testimonial-card").offsetWidth +
        Number.parseInt(getComputedStyle(testimonialsSlider).columnGap)
      const maxScroll = testimonialsSlider.scrollWidth - testimonialsSlider.clientWidth
  
      function autoScroll() {
        scrollAmount += slideWidth
        if (scrollAmount > maxScroll) {
          scrollAmount = 0
        }
  
        testimonialsSlider.scrollTo({
          left: scrollAmount,
          behavior: "smooth",
        })
      }
  
      // Auto scroll every 5 seconds
      let scrollInterval = setInterval(autoScroll, 5000)
  
      // Pause auto scroll when user interacts with the slider
      testimonialsSlider.addEventListener("mouseenter", () => {
        clearInterval(scrollInterval)
      })
  
      testimonialsSlider.addEventListener("mouseleave", () => {
        clearInterval(scrollInterval)
        scrollInterval = setInterval(autoScroll, 5000)
      })
    }
  
    let scrollInterval
  
    // Animate elements on scroll
    const animateElements = document.querySelectorAll(".feature-card, .service-card, .testimonial-card")
  
    function checkScroll() {
      animateElements.forEach((element) => {
        const elementTop = element.getBoundingClientRect().top
        const elementVisible = 150
  
        if (elementTop < window.innerHeight - elementVisible) {
          element.classList.add("animate-in")
        }
      })
    }
  
    // Initial check
    checkScroll()
  
    // Check on scroll
    window.addEventListener("scroll", checkScroll)
  
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        e.preventDefault()
  
        const targetId = this.getAttribute("href")
        if (targetId === "#") return
  
        const targetElement = document.querySelector(targetId)
        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: "smooth",
          })
  
          // Close mobile menu if open
          if (navList && navList.classList.contains("active")) {
            navList.classList.remove("active")
            document.body.classList.remove("menu-open")
          }
        }
      })
    })
  })
  
  // Add CSS animation class
  document.head.insertAdjacentHTML(
    "beforeend",
    `
  <style>
      .feature-card, .service-card, .testimonial-card {
          opacity: 0;
          transform: translateY(30px);
          transition: opacity 0.6s ease, transform 0.6s ease;
      }
      
      .feature-card.animate-in, .service-card.animate-in, .testimonial-card.animate-in {
          opacity: 1;
          transform: translateY(0);
      }
      
      .feature-card:nth-child(1) { transition-delay: 0.1s; }
      .feature-card:nth-child(2) { transition-delay: 0.2s; }
      .feature-card:nth-child(3) { transition-delay: 0.3s; }
      .feature-card:nth-child(4) { transition-delay: 0.4s; }
      
      .service-card:nth-child(1) { transition-delay: 0.1s; }
      .service-card:nth-child(2) { transition-delay: 0.2s; }
      .service-card:nth-child(3) { transition-delay: 0.3s; }
      .service-card:nth-child(4) { transition-delay: 0.4s; }
  </style>
  `,
  )
  
  