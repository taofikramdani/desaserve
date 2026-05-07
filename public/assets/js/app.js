document.addEventListener('DOMContentLoaded', function () {
  var alerts = document.querySelectorAll('.alert');
  if (alerts.length) {
    setTimeout(function () {
      alerts.forEach(function (alert) {
        alert.classList.add('fade');
      });
    }, 3500);
  }
});
