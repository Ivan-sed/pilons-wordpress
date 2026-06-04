(function () {
  var marquee = document.querySelector('.trust__marquee');
  if (!marquee) return;

  var track = marquee.querySelector('.trust__track');
  var row = marquee.querySelector('.trust__logos');
  if (!track || !row) return;

  var clone = row.cloneNode(true);
  clone.setAttribute('aria-hidden', 'true');
  clone.querySelectorAll('img').forEach(function (img) {
    img.alt = '';
  });
  track.appendChild(clone);
})();
