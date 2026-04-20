/**
 * Portfolio Main JavaScript
 * Attractive animations and interactions
 */

document.addEventListener('DOMContentLoaded', () => {
  initNavigation();
  initScrollAnimations();
  initSmoothScroll();
  initScrollTop();
  initNavbarScroll();
});

/**
 * Navigation functionality
 */
function initNavigation() {
  const nav = document.getElementById('nav');
  const navToggle = document.getElementById('navToggle');

  if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
      nav.classList.toggle('open');
      navToggle.textContent = nav.classList.contains('open') ? '✕' : '☰';
    });
  }

  document.querySelectorAll('.nav a').forEach(link => {
    link.addEventListener('click', () => {
      if (nav) nav.classList.remove('open');
      if (navToggle) navToggle.textContent = '☰';
    });
  });
}

/**
 * Navbar scroll effect
 */
function initNavbarScroll() {
  const topbar = document.querySelector('.topbar');
  if (topbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        topbar.classList.add('scrolled');
      } else {
        topbar.classList.remove('scrolled');
      }
    });
  }
}

/**
 * Scroll reveal animations
 */
function initScrollAnimations() {
  const revealElements = document.querySelectorAll('.reveal');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

  revealElements.forEach(el => observer.observe(el));
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        const offset = 80;
        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });
}

/**
 * Scroll to top button
 */
function initScrollTop() {
  const scrollTopBtn = document.createElement('button');
  scrollTopBtn.innerHTML = '↑';
  scrollTopBtn.className = 'scroll-top';
  document.body.appendChild(scrollTopBtn);

  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 500) {
      scrollTopBtn.classList.add('visible');
    } else {
      scrollTopBtn.classList.remove('visible');
    }
  });

  scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

/**
 * Magnetic button effect
 */
document.querySelectorAll('.btn').forEach(btn => {
  btn.addEventListener('mousemove', (e) => {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left - rect.width / 2;
    const y = e.clientY - rect.top - rect.height / 2;
    btn.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px)`;
  });

  btn.addEventListener('mouseleave', () => {
    btn.style.transform = '';
  });
});

/**
 * Certificate Modal Functions
 */
window.handleCertClick = function(element, imageSrc, title, issuer) {
  console.log('Certificate clicked!');
  console.log('Image:', imageSrc);
  console.log('Title:', title);
  console.log('Issuer:', issuer);
  
  // Add a visual feedback
  element.style.transform = 'scale(0.98)';
  setTimeout(() => {
    element.style.transform = '';
  }, 150);
  
  // Open the modal
  window.openCertModal(imageSrc, title, issuer);
}

window.openCertModal = function(imageSrc, title, issuer) {
  console.log('Opening modal:', imageSrc, title, issuer);
  const modal = document.getElementById('certModal');
  const modalImage = document.getElementById('certModalImage');
  const modalTitle = document.getElementById('certModalTitle');
  const modalIssuer = document.getElementById('certModalIssuer');
  
  if (!imageSrc) {
    console.log('No image source provided');
    return;
  }
  
  modalImage.src = imageSrc;
  modalTitle.textContent = title;
  modalIssuer.textContent = issuer;
  
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
  console.log('Modal opened successfully');
}

window.closeCertModal = function() {
  const modal = document.getElementById('certModal');
  modal.classList.remove('active');
  document.body.style.overflow = '';
  console.log('Modal closed');
}

// Close modal with Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    closeCertModal();
  }
});
