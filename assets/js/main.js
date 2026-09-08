(function () {
  'use strict';

  /* Header: sombra al hacer scroll + menú móvil ---------------------------- */

  var header = document.querySelector('.header');
  var burger = document.querySelector('.burger');
  var nav = document.querySelector('.nav');

  function onScroll() {
    if (!header) return;
    header.classList.toggle('header--scrolled', window.scrollY > 10);
  }

  function closeMenu() {
    if (!nav || !burger) return;
    nav.classList.remove('nav--open');
    burger.classList.remove('burger--open');
    burger.setAttribute('aria-expanded', 'false');
  }

  function toggleMenu() {
    if (!nav || !burger) return;
    var open = nav.classList.toggle('nav--open');
    burger.classList.toggle('burger--open', open);
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  if (burger) {
    burger.addEventListener('click', toggleMenu);
  }
  if (nav) {
    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', closeMenu);
    });
  }

  /* Tarjetas de trabajo: rotación automática de la galería ------------------ */

  function initWorkCard(card) {
    var slides = card.querySelectorAll('.work-card__slide');
    var dots = card.querySelectorAll('.work-card__dot');
    var categoryBadge = card.querySelector('.work-card__category');
    if (!slides.length) return;

    var active = 0;
    var intervalId = null;

    function render() {
      slides.forEach(function (slide, i) {
        slide.classList.toggle('is-active', i === active);
      });
      dots.forEach(function (dot, i) {
        dot.classList.toggle('is-active', i === active);
      });
      if (categoryBadge) {
        var current = slides[active];
        categoryBadge.classList.toggle('is-visible', current.dataset.type !== 'photo');
      }
    }

    function start() {
      stop();
      intervalId = window.setInterval(function () {
        active = (active + 1) % slides.length;
        render();
      }, 3000);
    }

    function stop() {
      if (intervalId !== null) {
        window.clearInterval(intervalId);
        intervalId = null;
      }
    }

    render();
    start();

    card.addEventListener('mouseenter', stop);
    card.addEventListener('mouseleave', start);
  }

  document.querySelectorAll('.work-card').forEach(initWorkCard);

  /* Carrusel de trabajos: navegación prev/next ------------------------------ */

  document.querySelectorAll('.works-carousel').forEach(function (carousel) {
    var track = carousel.querySelector('.works-carousel__track');
    var prevBtn = carousel.querySelector('.works-carousel__nav--prev');
    var nextBtn = carousel.querySelector('.works-carousel__nav--next');
    if (!track) return;

    function scroll(direction) {
      var item = track.querySelector('.works-carousel__item');
      var gap = 28;
      var amount = item ? item.offsetWidth + gap : track.clientWidth * 0.8;
      track.scrollBy({ left: direction * amount, behavior: 'smooth' });
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { scroll(-1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { scroll(1); });
  });

  /* Formulario de contacto: validación + envío por AJAX --------------------- */

  var form = document.querySelector('.contact-form');
  if (form && window.alaskaContact) {
    var fields = {
      name: { min: 2 },
      email: { pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/ },
      phone: { pattern: /^[+()\d\s-]{6,}$/ },
      service: { required: true },
      message: { min: 10 },
    };

    function showError(fieldName, message) {
      var row = form.querySelector('[data-field="' + fieldName + '"]');
      if (!row) return;
      var error = row.querySelector('.form-error');
      if (!error) {
        error = document.createElement('span');
        error.className = 'form-error';
        row.appendChild(error);
      }
      error.textContent = message;
    }

    function clearError(fieldName) {
      var row = form.querySelector('[data-field="' + fieldName + '"]');
      if (!row) return;
      var error = row.querySelector('.form-error');
      if (error) error.remove();
    }

    function validate(data) {
      var valid = true;

      if (!data.name || data.name.trim().length < fields.name.min) {
        showError('name', 'Ingresá tu nombre (mínimo 2 caracteres).');
        valid = false;
      } else {
        clearError('name');
      }

      if (!data.email || !fields.email.pattern.test(data.email)) {
        showError('email', 'Ingresá un email válido.');
        valid = false;
      } else {
        clearError('email');
      }

      if (!data.phone || !fields.phone.pattern.test(data.phone)) {
        showError('phone', 'Ingresá un teléfono válido.');
        valid = false;
      } else {
        clearError('phone');
      }

      if (!data.service) {
        showError('service', 'Seleccioná un servicio.');
        valid = false;
      } else {
        clearError('service');
      }

      if (!data.message || data.message.trim().length < fields.message.min) {
        showError('message', 'El mensaje debe tener al menos 10 caracteres.');
        valid = false;
      } else {
        clearError('message');
      }

      return valid;
    }

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var data = {
        name: form.name.value,
        email: form.email.value,
        phone: form.phone.value,
        service: form.service.value,
        message: form.message.value,
      };

      if (!validate(data)) return;

      var submitBtn = form.querySelector('button[type="submit"]');
      var submitError = form.querySelector('.form-submit-error');
      if (submitError) submitError.remove();

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Enviando...';
      }

      var body = new FormData();
      body.append('action', 'alaska_contact');
      body.append('nonce', window.alaskaContact.nonce);
      Object.keys(data).forEach(function (key) {
        body.append(key, data[key]);
      });

      fetch(window.alaskaContact.ajaxUrl, { method: 'POST', body: body, credentials: 'same-origin' })
        .then(function (response) { return response.json(); })
        .then(function (json) {
          if (json && json.success) {
            var wrap = form.parentElement;
            var success = wrap.querySelector('.form-success');
            form.hidden = true;
            if (success) success.hidden = false;
          } else {
            var message = (json && json.data && json.data.message) || 'No pudimos enviar tu mensaje. Probá de nuevo o escribinos por WhatsApp.';
            var p = document.createElement('p');
            p.className = 'form-submit-error';
            p.textContent = message;
            form.appendChild(p);
          }
        })
        .catch(function () {
          var p = document.createElement('p');
          p.className = 'form-submit-error';
          p.textContent = 'No pudimos enviar tu mensaje. Probá de nuevo o escribinos por WhatsApp.';
          form.appendChild(p);
        })
        .finally(function () {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Enviar mensaje';
          }
        });
    });

    var newMessageBtn = document.querySelector('[data-action="new-message"]');
    if (newMessageBtn) {
      newMessageBtn.addEventListener('click', function () {
        var wrap = newMessageBtn.closest('.contact-form-wrap');
        if (!wrap) return;
        var success = wrap.querySelector('.form-success');
        var formEl = wrap.querySelector('.contact-form');
        if (success) success.hidden = true;
        if (formEl) {
          formEl.hidden = false;
          formEl.reset();
        }
      });
    }
  }
})();
