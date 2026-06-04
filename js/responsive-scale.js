/*
 * Scales the whole 1920px-wide design down to fit narrower viewports.
 *
 * The layout is built at a fixed 1920px width with absolute positioning, so
 * between 1440-1920px the right-hand elements would otherwise overflow. We use
 * the CSS `zoom` property (applied to <html>) rather than `transform: scale`
 * because `zoom` reflows layout (page height stays correct) and keeps the
 * body-level position:fixed overlays (.menu / .modal) covering the viewport.
 */
(function () {
  var DESIGN_WIDTH = 1920;
  var docEl = document.documentElement;
  var frame = null;

  var lastScale = null;

  function apply(scale) {
    // scale === 1 -> clear the property so >=1920 viewports are untouched.
    docEl.style.zoom = scale >= 1 ? '' : String(scale);
    lastScale = scale;
    // Expose the active scale for scripts that must convert between the zoomed
    // layout space and the unzoomed scroll space (see scenarios-stack.js).
    window.__designScale = scale;
  }

  function compute() {
    frame = null;
    // Reset first so clientWidth reports the true available width (excluding
    // the vertical scrollbar) without feedback from the zoom we just applied.
    docEl.style.zoom = '';
    var available = docEl.clientWidth;
    if (!available) return;
    var prev = lastScale;
    var scale = Math.min(1, available / DESIGN_WIDTH);
    apply(scale);
    // The zoom change moves where every pixel lands, so any ScrollTrigger pin
    // distances must be recomputed against the new scale. Refresh once the zoom
    // is applied (ScrollTrigger's 'refresh' re-runs the pin-spacer compensation).
    if (prev !== scale && window.ScrollTrigger) {
      window.ScrollTrigger.refresh();
    }
  }

  function schedule() {
    if (frame) return;
    var raf = window.requestAnimationFrame || function (cb) { return setTimeout(cb, 16); };
    frame = raf(compute);
  }

  // Set an approximate scale immediately to avoid a flash of the unscaled
  // (overflowing) layout before the document is ready.
  apply(Math.min(1, window.innerWidth / DESIGN_WIDTH));

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', compute);
  } else {
    compute();
  }
  window.addEventListener('load', compute);
  window.addEventListener('resize', schedule);
  window.addEventListener('orientationchange', schedule);
})();
