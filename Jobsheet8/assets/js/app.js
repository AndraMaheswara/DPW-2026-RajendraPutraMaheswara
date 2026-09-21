
function initSakuraDecor() {
    if (document.querySelector('.sakura-container')) return;
    const container = document.createElement('div');
    container.className = 'sakura-container';
    container.setAttribute('aria-hidden', 'true');
    for (let i = 0; i < 12; i++) {
        const petal = document.createElement('span');
        petal.className = 'petal';
        petal.style.left = (Math.random() * 100) + '%';
        petal.style.width = (5 + Math.random() * 7) + 'px';
        petal.style.height = (8 + Math.random() * 8) + 'px';
        petal.style.opacity = (0.20 + Math.random() * 0.35).toFixed(2);
        petal.style.animationDuration = (7 + Math.random() * 7) + 's, ' + (3 + Math.random() * 3) + 's';
        petal.style.animationDelay = (-Math.random() * 10) + 's, ' + (-Math.random() * 5) + 's';
        container.appendChild(petal);
    }
    document.body.prepend(container);
}

function initNavToggle() {
    const toggleBtn = document.getElementById('nav-toggle-btn');
    const nav = document.querySelector('header nav');
    if (!toggleBtn || !nav) return;
    toggleBtn.addEventListener('click', () => {
        const open = nav.classList.toggle('nav-open');
        toggleBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
}


function initTableFilter() {
    const input = document.getElementById('search-input');
    const table = document.querySelector('.table-responsive table');
    if (!input || !table) return;
    input.addEventListener('input', () => {
        const keyword = input.value.toLowerCase();
        table.querySelectorAll('tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
        });
    });
}

function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement('span');
    span.className = 'error';
    span.textContent = pesan;
    input.insertAdjacentElement('afterend', span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains('error')) next.remove();
}

function initValidasiForm() {
    const form = document.getElementById('form-tambah');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        let valid = true;

        form.querySelectorAll('[required]').forEach(input => {
            if (!input.value.trim()) {
                tampilkanError(input, 'Field ini wajib diisi.');
                valid = false;
            } else {
                hapusError(input);
            }
        });

        const email = form.querySelector("[name='email']");
        if (email && email.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            tampilkanError(email, 'Format email belum valid.');
            valid = false;
        }

        const harga = form.querySelector("[name='harga']");
        if (harga && harga.value && Number(harga.value) <= 0) {
            tampilkanError(harga, 'Harga harus lebih besar dari 0.');
            valid = false;
        }

        const stok = form.querySelector("[name='stok']");
        if (stok && stok.value && Number(stok.value) < 0) {
            tampilkanError(stok, 'Stok tidak boleh negatif.');
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initSakuraDecor();
    initNavToggle();
    initTableFilter();
    initValidasiForm();
});
