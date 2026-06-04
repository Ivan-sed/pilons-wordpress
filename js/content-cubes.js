(function () {
  var assetBase = (typeof screenlTheme !== 'undefined' && screenlTheme.assetsUri)
    ? screenlTheme.assetsUri
    : './assets';
  var CUBES_RAW = [[317.625,788.999,97,101,37,"./assets/content/cube-icon-large.png"],[435.63,701,97,101,0,"./assets/content/cube-icon-large.png"],[560.63,775,97,101,0,"./assets/content/cube-icon-large.png"],[560.63,589,97,101,0,"./assets/content/cube-icon-large.png"],[365.621,526.996,97,101,112,"./assets/content/cube-icon-large.png"],[557.63,417,97,101,0,"./assets/content/cube-icon-large.png"],[246.625,368.999,97,101,37,"./assets/content/cube-icon-large.png"],[551.245,268.019,97,101,37,"./assets/content/cube-icon-large.png"],[621.245,68.019,97,101,37,"./assets/content/cube-icon-large.png"],[447.63,283,97,101,0,"./assets/content/cube-icon-large.png"],[292.63,202,97,101,0,"./assets/content/cube-icon-large.png"],[413.63,75,97,101,0,"./assets/content/cube-icon-large.png"],[225.621,23.996,97,101,112,"./assets/content/cube-icon-large.png"],[634.625,242.999,97,101,37,"./assets/content/cube-icon-large.png"],[212.625,526.999,97,101,37,"./assets/content/cube-icon-large.png"],[237.625,643.999,97,101,37,"./assets/content/cube-icon-large.png"],[474.63,786,92,99,0,"./assets/content/cube-icon-medium.png"],[225.63,791,92,99,0,"./assets/content/cube-icon-medium.png"],[335.63,628,92,99,0,"./assets/content/cube-icon-medium.png"],[477.63,613,92,99,0,"./assets/content/cube-icon-medium.png"],[630.63,590,92,99,0,"./assets/content/cube-icon-medium.png"],[448.63,523,92,99,0,"./assets/content/cube-icon-medium.png"],[487.63,418,92,99,0,"./assets/content/cube-icon-medium.png"],[348.63,399,92,99,0,"./assets/content/cube-icon-medium.png"],[562.63,103,92,99,0,"./assets/content/cube-icon-medium.png"],[216.63,435,92,99,0,"./assets/content/cube-icon-medium.png"],[297.63,95,92,99,0,"./assets/content/cube-icon-medium.png"],[413.63,24,92,99,0,"./assets/content/cube-icon-medium.png"],[227.63,184,92,99,0,"./assets/content/cube-icon-medium.png"],[437.63,369,92,99,0,"./assets/content/cube-icon-medium.png"],[402.627,615.003,92,99,112,"./assets/content/cube-icon-medium.png"],[621.63,771,92,99,0,"./assets/content/cube-icon-medium.png"],[579.63,639,92,99,0,"./assets/content/cube-icon-medium.png"],[401.622,797.001,83,88,112,"./assets/content/cube-icon-small.png"],[532.628,699,83,88,-26,"./assets/content/cube-icon-small.png"],[529.628,513,83,88,-26,"./assets/content/cube-icon-small.png"],[536.624,331.994,83,88,19,"./assets/content/cube-icon-small.png"],[641.63,417,83,88,0,"./assets/content/cube-icon-small.png"],[275.63,317,83,88,0,"./assets/content/cube-icon-small.png"],[483.629,125,83,88,-26,"./assets/content/cube-icon-small.png"],[560.63,215,83,88,0,"./assets/content/cube-icon-small.png"],[382.627,223.998,83,88,86,"./assets/content/cube-icon-small.png"],[306.629,474,83,88,-26,"./assets/content/cube-icon-small.png"],[265.623,719.995,83,88,37,"./assets/content/cube-icon-small.png"],[348.63,712,95,90,0,"./assets/content/cube-icon-wide.png"],[286.63,570,95,90,0,"./assets/content/cube-icon-wide.png"],[413.63,450,95,90,0,"./assets/content/cube-icon-wide.png"],[356.627,303.999,95,90,112,"./assets/content/cube-icon-wide.png"],[225.63,249,95,90,0,"./assets/content/cube-icon-wide.png"],[348.63,139,95,90,0,"./assets/content/cube-icon-wide.png"],[512.627,24.995,95,90,37,"./assets/content/cube-icon-wide.png"],[626.63,20,95,90,0,"./assets/content/cube-icon-wide.png"],[630.627,158.995,95,90,37,"./assets/content/cube-icon-wide.png"],[316.63,29,95,90,0,"./assets/content/cube-icon-wide.png"],[221.63,119,95,90,0,"./assets/content/cube-icon-wide.png"],[472.63,197,95,90,0,"./assets/content/cube-icon-wide.png"],[615.63,330,95,90,0,"./assets/content/cube-icon-wide.png"],[612.627,501.999,95,90,112,"./assets/content/cube-icon-wide.png"],[619.627,698.999,95,90,112,"./assets/content/cube-icon-wide.png"]];
  var CUBES = CUBES_RAW.map(function (cube) {
    var c = cube.slice();
    c[5] = c[5].replace(/^\.\/assets\//, assetBase + '/');
    return c;
  });

  var RADIUS = 180;
  var MAX_PUSH = 100;

  function clamp(val, lo, hi) {
    return Math.max(lo, Math.min(hi, val));
  }

  function getRotatedExtents(w, h, deg) {
    var rad = (deg * Math.PI) / 180;
    var cos = Math.abs(Math.cos(rad));
    var sin = Math.abs(Math.sin(rad));
    return {
      halfW: (w / 2) * cos + (h / 2) * sin,
      halfH: (w / 2) * sin + (h / 2) * cos,
    };
  }

  function clampPush(d, rawX, rawY, rotation, bounds) {
    var ext = getRotatedExtents(d.w, d.h, rotation);
    var cx = d.left + d.w / 2;
    var cy = d.top + d.h / 2;

    return {
      x: clamp(rawX, bounds.left + ext.halfW - cx, bounds.right - ext.halfW - cx),
      y: clamp(rawY, bounds.top + ext.halfH - cy, bounds.bottom - ext.halfH - cy),
    };
  }

  function renderCubes(container) {
    container.innerHTML = CUBES.map(function (cube) {
      var style = 'left:' + cube[0] + 'px;top:' + cube[1] + 'px;width:' + cube[2] + 'px;height:' + cube[3] + 'px;';
      if (cube[4]) style += 'transform:rotate(' + cube[4] + 'deg);';
      return '<div class="content__cube" data-base-rot="' + cube[4] + '" style="' + style + '">' +
        '<img class="content__cube-img" alt="" src="' + cube[5] + '" loading="lazy" decoding="async">' +
      '</div>';
    }).join('');
    return container.querySelectorAll('.content__cube');
  }

  function init() {
    var section = document.querySelector('.content');
    var container = document.querySelector('.content__cubes');
    var screenArea = document.querySelector('.content__screen-area');
    if (!section || !container || !screenArea || typeof gsap === 'undefined') return;

    var cubes = renderCubes(container);
    if (!cubes.length) return;

    var data = Array.prototype.map.call(cubes, function (el) {
      var s = getComputedStyle(el);
      var w = parseFloat(s.width);
      var h = parseFloat(s.height);
      var baseRot = parseFloat(el.getAttribute('data-base-rot') || '0');
      return {
        el: el,
        left: parseFloat(s.left),
        top: parseFloat(s.top),
        w: w,
        h: h,
        cx: parseFloat(s.left) + w / 2,
        cy: parseFloat(s.top) + h / 2,
        baseRot: baseRot,
      };
    });

    data.forEach(function (d) {
      gsap.set(d.el, { rotation: d.baseRot, transformOrigin: '50% 50%' });
    });

    function getBounds() {
      var cr = container.getBoundingClientRect();
      var sr = screenArea.getBoundingClientRect();
      return {
        left: sr.left - cr.left,
        top: sr.top - cr.top,
        right: sr.right - cr.left,
        bottom: sr.bottom - cr.top,
      };
    }

    function enforceBounds(d) {
      var b = getBounds();
      var x = Number(gsap.getProperty(d.el, 'x')) || 0;
      var y = Number(gsap.getProperty(d.el, 'y')) || 0;
      var rot = Number(gsap.getProperty(d.el, 'rotation')) || d.baseRot;
      var clamped = clampPush(d, x, y, rot, b);

      if (clamped.x !== x || clamped.y !== y) {
        gsap.set(d.el, { x: clamped.x, y: clamped.y });
      }
    }

    function resetCube(d, duration, ease) {
      gsap.to(d.el, {
        x: 0,
        y: 0,
        rotation: d.baseRot,
        duration: duration,
        ease: ease,
        overwrite: 'auto',
        onComplete: function () {
          enforceBounds(d);
        },
      });
    }

    function onMove(e) {
      var r = container.getBoundingClientRect();
      var mx = e.clientX - r.left;
      var my = e.clientY - r.top;
      var b = getBounds();

      data.forEach(function (d) {
        var dx = d.cx - mx;
        var dy = d.cy - my;
        var dist = Math.hypot(dx, dy);

        if (dist < RADIUS && dist > 0) {
          var force = Math.pow(1 - dist / RADIUS, 1.6);
          var rawX = (dx / dist) * force * MAX_PUSH;
          var rawY = (dy / dist) * force * MAX_PUSH;
          var spin = 0;
          var push = clampPush(d, rawX, rawY, d.baseRot, b);
          spin = (push.x / MAX_PUSH) * 18;
          push = clampPush(d, rawX, rawY, d.baseRot + spin, b);

          gsap.to(d.el, {
            x: push.x,
            y: push.y,
            rotation: d.baseRot + spin,
            duration: 0.25,
            ease: 'power3.out',
            overwrite: 'auto',
            onComplete: function () {
              enforceBounds(d);
            },
          });
        } else {
          resetCube(d, 1.3, 'elastic.out(1, 0.35)');
        }
      });
    }

    function onLeave() {
      data.forEach(function (d) {
        resetCube(d, 1.8, 'elastic.out(1, 0.3)');
      });
    }

    section.addEventListener('mousemove', onMove);
    section.addEventListener('mouseleave', onLeave);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
