document.addEventListener('DOMContentLoaded', function() {
  let burger = document.getElementById("burger");
  let overlay = document.querySelector("section");
  let showMenu = false; // State to track menu visibility

  burger.addEventListener("click", () => {
      showMenu = !showMenu; // Toggle state

      if (showMenu) {
          burger.classList.add("active"); // Activate burger animation
          overlay.style.display = "block"; // Show overlay menu
          gsap.to(overlay, 1, {
              clipPath: "polygon(0% 0%, 100% 0, 100% 100%, 0% 100%)",
              ease: "expo.in"
          });
      } else {
          burger.classList.remove("active"); // Deactivate burger animation
          gsap.to(overlay, 1, {
              clipPath: "polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)",
              ease: "expo.out",
              onComplete: () => (overlay.style.display = "none") // Hide overlay after animation
          });
      }
  });

  // GSAP animations for hero images and text effects
  let tl = gsap.timeline({
      repeat: -1,
      yoyo: true,
      ease: "expo.out"
  });

  

  gsap.set(["#hero-1 h2, #hero-1 h1, #hero-1 h3"], {
      clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
      transform: "translateY(100px)",
      opacity: 0
  });

  gsap.set(
      [
          `#hero-2 h2, #hero-3 h2, #hero-4 h2, #hero-5 h2,
           #hero-2 h1, #hero-3 h1, #hero-4 h1, #hero-5 h1,
           #hero-2 h3, #hero-3 h3, #hero-4 h3, #hero-5 h3`
      ],
      {
          clipPath: "polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)",
          transform: "translateY(-100px)",
          opacity: 0
      }
  );

  let i = 1;
  while (i < 5) {
      tl.to(`#hero-${i} h2`, 0.9, {
          clipPath: "polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)",
          transform: "translateY(-100px)",
          opacity: 0,
          delay: 3
      })
      .to(`#hero-${i} h1`, 0.9, {
          clipPath: "polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)",
          transform: "translateY(-100px)",
          opacity: 0
      }, "-=0.3")
      .to(`#hero-${i} h3`, 0.9, {
          clipPath: "polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)",
          transform: "translateY(-100px)",
          opacity: 0
      }, "-=0.3")
      .to(`#hero-${i} .hi-${i}`, 0.7, {
          clipPath: "polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)"
      }, "-=1")
      .to(`#hero-${i + 1} h2`, 0.9, {
          clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
          transform: "translateY(0)",
          opacity: 1
      })
      .to(`#hero-${i + 1} h1`, 0.9, {
          clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
          transform: "translateY(0)",
          opacity: 1
      }, "-=0.3")
      .to(`#hero-${i + 1} h3`, 0.9, {
          clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
          transform: "translateY(0)",
          opacity: 1
      }, "-=0.3");

      i++;
  }
});

