const form = document.querySelector('#postcard-form');
const nameInput = document.querySelector('#name');
const noteInput = document.querySelector('#note');
const sendButton = document.querySelector('#send-button');

function updatePreview() {
    const selected = form.querySelector('input[name="picture"]:checked');
    if (selected) {
        document.querySelector('#preview-image').src = selected.dataset.image;
        document.querySelector('#preview-image').alt = selected.dataset.title;
        document.querySelector('#preview-title').textContent = selected.dataset.title;
    }
    document.querySelector('#preview-name').textContent = nameInput.value.trim() || 'kamu';
    document.querySelector('#preview-note').textContent = noteInput.value.trim() || 'Sedikit kejutan untuk bikin harimu lebih seru.';
    document.querySelector('#note-count').textContent = noteInput.value.length + ' / 1000';
}

form.addEventListener('input', updatePreview);
form.addEventListener('change', updatePreview);
form.addEventListener('submit', () => {
    sendButton.disabled = true;
    sendButton.firstElementChild.textContent = 'Mengirim kartu...';
    document.querySelector('#sending-status').textContent = 'Sebentar, kartumu sedang dikirim.';
});
window.addEventListener('pageshow', () => {
    sendButton.disabled = false;
    sendButton.firstElementChild.textContent = 'Kirim kartu sekarang';
    document.querySelector('#sending-status').textContent = '';
    updatePreview();
});
updatePreview();
