document.addEventListener("DOMContentLoaded", function () {
    loadFinance();

    // Set today's date as default
    const today = new Date().toISOString().split('T')[0];
    if (document.getElementById('trxDate')) {
        document.getElementById('trxDate').value = today;
    }

    document.getElementById('trxForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let type = document.getElementById('typeIn').checked ? 'income' : 'expense';
        let amount = document.getElementById('trxAmount').value;
        let desc = document.getElementById('trxDesc').value;
        let date = document.getElementById('trxDate').value;

        let payload = {
            type: type,
            amount: amount,
            description: desc,
            date: date
        };

        fetch('../../api/finance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    Swal.fire('Tersimpan', res.message, 'success');
                    bootstrap.Modal.getInstance(document.getElementById('addTrxModal')).hide();
                    this.reset();
                    if (document.getElementById('trxDate')) {
                        document.getElementById('trxDate').value = today;
                    }
                    loadFinance();
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            })
            .catch(err => {
                Swal.fire('Error', 'Terjadi kesalahan jaringan/server', 'error');
                console.error(err);
            });
    });
});

function loadFinance() {
    fetch('../../api/finance.php')
        .then(response => response.json())
        .then(data => {
            // Render Stats
            const fmt = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
            document.getElementById('statBalance').innerText = fmt.format(data.stats.balance);
            document.getElementById('statIncome').innerText = "+ " + fmt.format(data.stats.income);
            document.getElementById('statExpense').innerText = "- " + fmt.format(data.stats.expense);

            // Render Table
            const container = document.getElementById('trxList');
            container.innerHTML = '';

            data.transactions.forEach(trx => {
                let typeBadge = trx.type === 'income'
                    ? '<span class="badge bg-success-subtle text-success border border-success-subtle">Pemasukan</span>'
                    : '<span class="badge bg-danger-subtle text-danger border border-danger-subtle">Pengeluaran</span>';

                let textClass = trx.type === 'income' ? 'text-success' : 'text-danger';
                let sign = trx.type === 'income' ? '+' : '-';

                const html = `
                    <tr>
                        <td class="ps-4">${trx.date}</td>
                        <td>
                            <span class="fw-bold d-block text-navy">${trx.desc}</span>
                            <small class="text-muted">${trx.category}</small>
                        </td>
                        <td>${typeBadge}</td>
                        <td class="text-end pe-4 fw-bold ${textClass}">
                            ${sign} ${fmt.format(trx.amount)}
                        </td>
                    </tr>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });
        });
}