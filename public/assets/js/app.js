document.addEventListener('DOMContentLoaded', function () {
  var alerts = document.querySelectorAll('.alert');
  if (alerts.length) {
    setTimeout(function () {
      alerts.forEach(function (alert) {
        alert.classList.add('fade');
      });
    }, 3500);
  }

  var modal = document.getElementById('file-preview-modal');
  var modalImage = document.getElementById('file-preview-image');
  if (!modal || !modalImage) {
    return;
  }

  var closeModal = function () {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    modalImage.src = '';
  };

  document.addEventListener('click', function (event) {
    var target = event.target;
    if (!target) {
      return;
    }

    var previewLink = target.closest('[data-preview-url]');
    if (previewLink) {
      event.preventDefault();
      var url = previewLink.getAttribute('data-preview-url');
      if (url) {
        modalImage.src = url;
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
      }
      return;
    }

    if (target.matches('[data-modal-close]') || target.closest('[data-modal-close]')) {
      closeModal();
    }
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && modal.classList.contains('is-open')) {
      closeModal();
    }
  });
});
