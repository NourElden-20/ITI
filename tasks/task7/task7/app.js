(function () {
  const nameInput = document.getElementById('nameInput');
  const imageInput = document.getElementById('imageInput');
  const fontSelect = document.getElementById('fontSelect');
  const incBtn = document.getElementById('incBtn');
  const decBtn = document.getElementById('decBtn');
  const showBtn = document.getElementById('showBtn');
  const greeting = document.getElementById('greeting');
  const nameError = document.getElementById('nameError');
  const nameHint = document.getElementById('nameHint');
  const imageError = document.getElementById('imageError');
  const sizeInfo = document.getElementById('sizeInfo');
  const preview = document.getElementById('preview');
  const mover = document.getElementById('mover');
  const container = document.getElementById('displayArea');

  // Validation rules
  const NAME_REGEX = /^[A-Za-z\u0600-\u06FF]{2,}(?:\s+[A-Za-z\u0600-\u06FF]{2,})*$/; // English or Arabic letters
  const IMG_REGEX = /\.(?:png|jpe?g)$/i;

  let fontSizePx = 16; 
  let moverShiftX = 0; 

  function setError(el, msg) {
    el.textContent = msg;
    el.style.display = msg ? '' : 'none';
  }

  function updateFontSize() {
    if (fontSizePx < 10) fontSizePx = 10;
    if (fontSizePx > 40) fontSizePx = 40;
    greeting.style.fontSize = fontSizePx + 'px';
    sizeInfo.textContent = `font-size: ${fontSizePx}px`;
    incBtn.disabled = fontSizePx >= 40;
    decBtn.disabled = fontSizePx <= 10;
  }

  function updateFontFamily() {
    greeting.style.fontFamily = fontSelect.value;
  }

  function validateAll() {
    const name = nameInput.value.trim();
    const img = imageInput.value.trim();

    let valid = true;

    if (!name || !NAME_REGEX.test(name)) {
      nameError.style.display = '';
      nameHint.style.display = 'none';
      valid = false;
    } else {
      nameError.style.display = 'none';
      nameHint.style.display = '';
    }

    if (!img) {
      setError(imageError, 'invalid');
      valid = false;
    } else if (!IMG_REGEX.test(img)) {
      setError(imageError, 'photo must be jpg or png');
      valid = false;
    } else {
      setError(imageError, '');
    }

    return valid;
  }

  function showGreeting() {
    const name = nameInput.value.trim();
    if (name && NAME_REGEX.test(name)) {
      greeting.textContent = `welcome ${name}`;
    } else {
      greeting.textContent = '';
    }
  }

  function showImage() {
    const val = imageInput.value.trim();
    if (!val || !IMG_REGEX.test(val)) { preview.style.display = 'none'; return; }
    preview.src = val;
    preview.onload = () => { preview.style.display = 'block'; };
    preview.onerror = () => { preview.style.display = 'none'; };
  }

  // Font-size controls
  incBtn.addEventListener('click', () => { fontSizePx += 2; updateFontSize(); });
  decBtn.addEventListener('click', () => { fontSizePx -= 2; updateFontSize(); });

  // Font selector
  fontSelect.addEventListener('change', updateFontFamily);

  // Main action with validation for all fields
  showBtn.addEventListener('click', () => {
    const ok = validateAll();
    if (!ok) { greeting.textContent = ''; preview.style.display = 'none'; return; }
    showGreeting();
    showImage();
  });

  // Plus inside the box: enlarge image until it would overflow the box
  function resetMoverState() {
    mover.style.opacity = '1';
    mover.style.cursor = 'pointer';
    mover.removeAttribute('aria-disabled');
  }

  function enlargeOnce() {
    if (mover.getAttribute('aria-disabled') === 'true') return;
    if (preview.style.display === 'none' || !preview.src) return;

    const step = 20; // increase width by 20px each click, keep aspect ratio

    const currentWidth = preview.clientWidth || 0;
    const currentHeight = preview.clientHeight || 0;
    if (!currentWidth || !currentHeight) return;

    const ratio = currentWidth / currentHeight;
    const nextWidth = currentWidth + step;
    const nextHeight = Math.round(nextWidth / ratio);

    const imgRect = preview.getBoundingClientRect();
    const containerRect = container.getBoundingClientRect();
    const paddings = getComputedStyle(container);
    const padRight = parseFloat(paddings.paddingRight) || 0;
    const padBottom = parseFloat(paddings.paddingBottom) || 0;

    const maxWidthAllowed = containerRect.right - padRight - imgRect.left;
    const maxHeightAllowed = containerRect.bottom - padBottom - imgRect.top;

    const fits = nextWidth <= maxWidthAllowed && nextHeight <= maxHeightAllowed;

    if (fits) {
      preview.style.width = nextWidth + 'px';
      preview.style.height = nextHeight + 'px';
    } else {
      mover.style.opacity = '.6';
      mover.style.cursor = 'default';
      mover.setAttribute('aria-disabled', 'true');
    }
  }
  mover.addEventListener('click', enlargeOnce);

  nameInput.addEventListener('input', validateAll);
  imageInput.addEventListener('input', () => { validateAll(); resetMoverState(); });

  // Initialize UI
  updateFontSize();
  updateFontFamily();

  preview.addEventListener('load', () => {
    preview.style.width = '320px';
    preview.style.height = '200px';
    resetMoverState();
  });
})();


