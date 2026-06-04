(function () {
  var root = document.querySelector('[data-scenarios]');
  if (!root) return;

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reducedMotion) return;

  var tracks = root.querySelectorAll('[data-scenarios-marquee]');
  Array.prototype.forEach.call(tracks, function (track) {
    if (track.getAttribute('data-marquee-ready') === 'true') return;

    var items = Array.prototype.slice.call(track.children);
    if (!items.length) return;

    items.forEach(function (item) {
      var clone = item.cloneNode(true);
      clone.setAttribute('aria-hidden', 'true');
      clone.querySelectorAll('img').forEach(function (img) {
        img.alt = '';
      });
      track.appendChild(clone);
    });

    track.setAttribute('data-marquee-ready', 'true');
  });
})();
