function redirectToEpisode() {
  window.location.href = 'episode.php';
}

let isMenuOpen = false;

document.addEventListener('DOMContentLoaded', () => {
  const menuItem = document.querySelector('.menu-item.menu-image.mobile');
  const menuCollapse = document.querySelector('.menu-collapse');

  function checkWindowSize() {
    if (window.innerWidth < 720) {
      menuItem.classList.remove('mobile');
      menuItem.classList.add('mobile-visible');
      menuCollapse.classList.add('menu-collapse-mobileversion');
      if (!isMenuOpen) {
        menuCollapse.classList.add('hide'); // Assuming 'hide' is predefined in your CSS to hide elements
      }
    } else {
      menuItem.classList.remove('mobile-visible');
      menuItem.classList.add('mobile');
      menuCollapse.classList.remove('menu-collapse-mobileversion');
      if (!isMenuOpen) {
        menuCollapse.classList.remove('hide');
      } else {
        toggleMenu();
      }
    }
  }

  // Initial check
  checkWindowSize();

  // Listen for resize events
  window.addEventListener('resize', checkWindowSize);

  function toggleMenu() {
    isMenuOpen = !isMenuOpen;

    // Get header element
    const header = document.querySelector('header');

    // Animate bars
    if (isMenuOpen) {
      document.getElementById('animTop').beginElement();
      document.getElementById('animMoveBeg').beginElement();
      document.getElementById('animBottom').beginElement();
      document.getElementById('textGroup').classList.add('hidden');
      document.querySelector(".menu-bar").classList.add("mobile-bar");
      document.querySelector(".menu-collapse").classList.remove('hide');
      document.querySelector(".menu-collapse").classList.add("menu-collapse-mobile");

      // Inject pseudo-menu placeholder
      if (!document.getElementById('pseudoMenu')) {
        const pseudoMenu = document.createElement('div');
        pseudoMenu.id = 'pseudoMenu';
        pseudoMenu.className = 'pseudo-menu';
        pseudoMenu.innerHTML = '<div class="brand"><p class="paragraph" dir="auto"> <span class="line-break">Grauzone</span> <span class="line-break">Pott</span> </p></div>';
        header.insertBefore(pseudoMenu, header.firstChild);
      }

    } else {
      document.getElementById('animTopBack').beginElement();
      document.getElementById('animMoveEnd').beginElement();
      document.getElementById('animBottomBack').beginElement();
      document.getElementById('textGroup').classList.remove('hidden');
      document.querySelector(".menu-bar").classList.remove("mobile-bar");
      document.querySelector(".menu-collapse").classList.add('hide');
      document.querySelector(".menu-collapse").classList.remove("menu-collapse-mobile");

      // Remove pseudo-menu placeholder
      const pseudoMenu = document.getElementById('pseudoMenu');
      if (pseudoMenu) {
        header.removeChild(pseudoMenu);
      }
    }
  }


  // Get the menu icon element and set up the click event listener
  const menuIcon = document.getElementById("menu-icon");
  menuIcon.addEventListener("click", toggleMenu);

  // Navigate to a specific episode
  document.querySelectorAll('.navigate-to-episode').forEach(element => {
    element.addEventListener('click', () => {
      const id = element.getAttribute('data-id');
      const slug = element.getAttribute('data-slug');
      if (id && slug) {
        window.location.href = `/episode/${id}/${slug}`;
      } else {
        console.log('Missing data-id or data-slug for episode navigation.');
      }
    });
  });

  // Navigate to the episodes page
  const episodesButton = document.querySelector('.navigate-to-episodes');
  if (episodesButton) {
    episodesButton.addEventListener('click', () => {
      window.location.href = '/episoden';
    });
  } else {
    console.log('No element found with class "navigate-to-episodes".');
  }

});

document.addEventListener('DOMContentLoaded', function () {
  const consentPeriod = 30 * 24 * 60 * 60 * 1000; // 30 days in milliseconds

  function checkAndShowCookieConsent() {
      const cookieBanner = document.getElementById('cookie-consent-banner');
      const acceptButton = document.getElementById('cookie-consent-accept');

      if (!cookieBanner || !acceptButton) {
          console.warn('Cookie banner or accept button not found in the DOM.');
          return;
      }

      const now = new Date().getTime();
      const cookieConsent = JSON.parse(localStorage.getItem('cookieConsent'));

      // Show the banner if no consent or expired consent
      if (!cookieConsent || now > cookieConsent.expiry) {
          cookieBanner.style.display = 'block';
      } else {
          cookieBanner.style.display = 'none'; // Hide the banner if consent is valid
      }

      // Handle the "Accept" button click
      acceptButton.addEventListener('click', function () {
          const consentExpiry = new Date().getTime() + consentPeriod; // Set expiration time for consent
          console.log('Setting consent expiry to:', consentExpiry);
          localStorage.setItem('cookieConsent', JSON.stringify({ consent: true, expiry: consentExpiry }));
          cookieBanner.style.display = 'none'; // Hide the banner
      });
  }

  // Initial call for direct page load
  checkAndShowCookieConsent();

  // Event listener for dynamic content injection
  document.addEventListener('contentUpdated', function () {
      checkAndShowCookieConsent();
  });
});