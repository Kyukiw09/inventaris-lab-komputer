function setKondisi(value) {
    const kondisiInput = document.getElementById('kondisiInput');
    const selectedText = document.getElementById('selectedText');
    if (kondisiInput) kondisiInput.value = value;
    if (selectedText) selectedText.innerText = value;
}

setTimeout(() => {
    const alert = document.querySelector('.custom-alert');
    if (alert) {
        alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => alert.remove(), 300);
    }
}, 4000);

const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#inventarisTable tbody tr');
        rows.forEach(row => {
            const nama = row.cells[0].textContent.toLowerCase();
            const kode = row.cells[1].textContent.toLowerCase();
            row.style.display = (nama.includes(keyword) || kode.includes(keyword)) ? '' : 'none';
        });
    });
}