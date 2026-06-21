

document.addEventListener('click', function (e) {
    const item = e.target.closest('[data-hs-combo-box-output-item]');
    if (!item) return;

    const wrapper = item.closest('.js-combo-wrapper');
    if (!wrapper) return;

    const valueElement = item.querySelector('[data-hs-combo-box-value]');
    if (!valueElement) return;

    const value = valueElement.dataset.id ?? '';

    const hiddenInput = wrapper.querySelector('.js-combo-hidden-input');
    if (!hiddenInput) return;

    hiddenInput.value = value;
    hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
    hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
});

document.addEventListener('input', function (e) {
    const comboInput = e.target.closest('[data-hs-combo-box-input]');
    if (!comboInput) return;

    const wrapper = comboInput.closest('.js-combo-wrapper');
    if (!wrapper) return;

    const hiddenInput = wrapper.querySelector('.js-combo-hidden-input');
    if (!hiddenInput) return;

    hiddenInput.value = '';
});

