window.HERO_SCREEN_DATA = {
  frame: {
    id: '278:1502',
    width: 1920,
    height: 1080,
  },
  spread: {
    unit: { left: 194, top: 153, width: 1532, height: 811 },
    reflection: { left: 194, top: 953, width: 1532, height: 127 },
    panels: { left: 3, top: 0, width: 1524, height: 771 },
    items: [
      { left: 0, width: 231.385 },
      { left: 265.385, width: 231.385 },
      { left: 530.77, width: 462.768 },
      { left: 1027.539, width: 231.385 },
      { left: 1292.922, width: 231.385 },
    ],
    bezels: [
      { left: 0, width: 235, role: 'side-left' },
      { left: 269, width: 230, role: 'center' },
      { left: 535, width: 230, role: 'center' },
      { left: 766, width: 230, role: 'center' },
      { left: 1031, width: 230, role: 'center' },
      { left: 1297, width: 235, role: 'side-right' },
    ],
    shadows: [
      { left: 0, width: 230 },
      { left: 267, width: 228 },
      { left: 533, width: 228 },
      { left: 764, width: 228 },
      { left: 1028, width: 228 },
      { left: 1295, width: 228 },
    ],
  },
  joined: {
    unit: { left: 263, top: 153, width: 1395, height: 811 },
    reflection: { left: 263, top: 953, width: 1395, height: 127 },
    panels: { left: 3, top: 0, width: 1387, height: 771 },
    items: [
      { left: 0, width: 231.385 },
      { left: 231.387, width: 231.385 },
      { left: 462.773, width: 462.768 },
      { left: 925.543, width: 231.385 },
      { left: 1156.93, width: 231.385 },
    ],
    bezels: [
      { left: 0, width: 235, role: 'side-left' },
      { left: 236, width: 230, role: 'center' },
      { left: 467, width: 230, role: 'center' },
      { left: 698, width: 230, role: 'center' },
      { left: 929, width: 230, role: 'center' },
      { left: 1160, width: 235, role: 'side-right' },
    ],
    shadows: [
      { left: 0, width: 230 },
      { left: 233, width: 228 },
      { left: 464, width: 228 },
      { left: 695, width: 228 },
      { left: 926, width: 228 },
      { left: 1157, width: 228 },
    ],
  },
  reflectionOpacity: 0.05,
  panelUnitShadow:
    '-0.8125rem 0 1.75rem 0 rgba(0, 18, 61, 0.14), ' +
    '-3.1875rem 0 3.1875rem 0 rgba(0, 18, 61, 0.12), ' +
    '-7.125rem 0 4.3125rem 0 rgba(0, 18, 61, 0.07), ' +
    '-12.6875rem 0 5.0625rem 0 rgba(0, 18, 61, 0.02), ' +
    '-19.875rem 0 5.5625rem 0 rgba(0, 18, 61, 0)',
  bezel: {
    // Texture cropped to the visible strip (was 1592×1940 → now 420×81); the
    // sprite %s below are remapped so the same window shows through the clip.
    height: 41,
    sideImg: { leftPct: -1.7107, widthPct: 102.9422, topPct: -7.0423, heightPct: 114.0843 },
    centerImg: { leftPct: -4.0094, widthPct: 105.2638, topPct: -7.0423, heightPct: 114.0843 },
  },
  // shadow artboard: 1572×147, clip content 1532×127 @ (20,20); filter bleed → 167
  shadowArtboard: {
    width: 1572,
    height: 147,
    renderHeight: 167,
    padLeft: 20,
    padTop: 20,
    contentWidth: 1532,
  },
  assets: (function () {
    var base = (typeof screenlTheme !== 'undefined' && screenlTheme.assetsUri)
      ? screenlTheme.assetsUri
      : './assets';
    return {
      screen: base + '/hero/screen-panel.webp',
      screenFallback: base + '/hero/screen-panel.png',
      bezel: base + '/hero/bezel-texture.png',
      bezelFallback: base + '/hero/bezel-texture-fallback.png',
      shadowPanels: base + '/hero/shadow-panels-joined.png',
      shadowPanelsJoined: base + '/hero/shadow-panels-joined.png',
    };
  })(),
  texture: {
    widthRatio: 1.2154,
    heightRatio: 1.2102,
    leftRatio: -0.2046,
    topRatio: -0.105,
  },
  timing: {
    duration: 1.9,
    ease: 'power2.inOut',
    hold: 0,
    delay: 0.45,
    productGap: 0.22,
  },
};
