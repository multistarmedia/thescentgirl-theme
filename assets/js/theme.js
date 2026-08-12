(function () {
  var toggle = document.querySelector('.tsg-menu-toggle');
  var nav = document.getElementById('tsg-primary-nav');
  if (!toggle || !nav) return;

  toggle.addEventListener('click', function () {
    var open = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', open ? 'false' : 'true');
    if (open) {
      nav.setAttribute('hidden', '');
    } else {
      nav.removeAttribute('hidden');
    }
  });
})();
