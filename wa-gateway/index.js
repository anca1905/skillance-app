const { Client, LocalAuth } = require('whatsapp-web.js');
const qrcode = require('qrcode-terminal');
const express = require('express');

const app = express();
app.use(express.json());

const port = 3000;

// Inisialisasi WhatsApp Client
const client = new Client({
    authStrategy: new LocalAuth(),
    puppeteer: {
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    }
});

let isClientReady = false;

client.on('qr', (qr) => {
    console.log('Scan QR Code ini menggunakan WhatsApp Anda:');
    qrcode.generate(qr, { small: true });
});

client.on('ready', () => {
    console.log('WhatsApp Client sudah SIAP dan terhubung!');
    isClientReady = true;
});

client.on('disconnected', (reason) => {
    console.log('WhatsApp Client terputus:', reason);
    isClientReady = false;
});

client.initialize();

// Endpoint untuk mengirim pesan
app.post('/send', async (req, res) => {
    if (!isClientReady) {
        return res.status(503).json({ status: 'error', message: 'WhatsApp Gateway belum siap. Harap tunggu atau scan QR Code.' });
    }

    const { phone, message } = req.body;

    if (!phone || !message) {
        return res.status(400).json({ status: 'error', message: 'Parameter phone dan message wajib diisi.' });
    }

    try {
        // Format nomor telepon (tambahkan @c.us untuk ID WhatsApp)
        // Pastikan nomor berawal dengan kode negara, contoh 62812...
        let formattedPhone = phone.replace(/[^0-9]/g, '');
        
        // Jika diawali 0, ubah ke 62 (asumsi nomor Indonesia)
        if (formattedPhone.startsWith('0')) {
            formattedPhone = '62' + formattedPhone.substring(1);
        }
        
        const chatId = formattedPhone + '@c.us';

        // Kirim pesan
        await client.sendMessage(chatId, message);
        console.log(`Pesan berhasil dikirim ke ${formattedPhone}`);

        res.json({ status: 'success', message: 'Pesan terkirim' });
    } catch (error) {
        console.error('Gagal mengirim pesan:', error);
        res.status(500).json({ status: 'error', message: 'Gagal mengirim pesan', error: error.message });
    }
});

app.listen(port, () => {
    console.log(`WhatsApp Gateway berjalan di http://localhost:${port}`);
    console.log('Mohon tunggu inisialisasi WhatsApp...');
});
