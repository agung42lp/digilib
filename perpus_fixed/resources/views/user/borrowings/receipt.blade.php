<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <title>Bukti Peminjaman — {{ $borrowing->book->title }}</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:Arial,sans-serif;background:#f5f5f5;display:flex;justify-content:center;align-items:flex-start;min-height:100vh;padding:40px 16px}
    .receipt{background:#fff;max-width:480px;width:100%;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.12)}
    .receipt-header{background:linear-gradient(135deg,#1c6b46,#145235);padding:28px 28px 22px;text-align:center;color:#fff}
    .receipt-header .icon{font-size:2.2rem;margin-bottom:8px}
    .receipt-header h1{font-size:1.15rem;font-weight:700;letter-spacing:-.01em;margin-bottom:4px}
    .receipt-header p{font-size:.78rem;opacity:.75}
    .receipt-body{padding:24px 28px}
    .row{display:flex;align-items:flex-start;padding:10px 0;border-bottom:1px solid #f0f0f0}
    .row:last-child{border-bottom:none}
    .label{font-size:.73rem;color:#888;min-width:140px;flex-shrink:0;padding-top:1px}
    .value{font-size:.83rem;font-weight:600;color:#222;flex:1}
    .status-badge{display:inline-block;background:#1c6b46;color:#fff;padding:5px 18px;border-radius:20px;font-size:.8rem;font-weight:700;letter-spacing:.03em}
    .status-wrap{text-align:center;padding:18px 0 10px}
    .receipt-footer{background:#f9f9f9;border-top:1px dashed #ddd;padding:14px 28px;display:flex;align-items:center;justify-content:space-between}
    .footer-text{font-size:.7rem;color:#aaa}
    .btn-print{background:#1c6b46;color:#fff;border:none;padding:9px 22px;border-radius:8px;cursor:pointer;font-size:.82rem;font-weight:700;display:flex;align-items:center;gap:7px}
    @media print{
      body{background:#fff;padding:0}
      .receipt{box-shadow:none;border-radius:0;max-width:100%}
      .btn-print,.receipt-footer .btn-print{display:none!important}
    }
  </style>
</head>
<body>
  <div class="receipt">
    <div class="receipt-header">
      <div class="icon">📚</div>
      <h1>Bukti Peminjaman Buku</h1>
      <p>DigiLib — Perpustakaan Digital</p>
    </div>
    <div class="receipt-body">
      <div class="row"><span class="label">Nama Peminjam</span><span class="value">{{ $borrowing->user->name }}</span></div>
      <div class="row"><span class="label">Judul Buku</span><span class="value">{{ $borrowing->book->title }}</span></div>
      <div class="row"><span class="label">Penulis</span><span class="value">{{ $borrowing->book->author }}</span></div>
      <div class="row"><span class="label">Penerbit</span><span class="value">{{ $borrowing->book->publisher }}</span></div>
      <div class="row"><span class="label">Tanggal Pinjam</span><span class="value">{{ $borrowing->borrow_date->format('d M Y') }}</span></div>
      <div class="row"><span class="label">Tanggal Kembali</span><span class="value">{{ $borrowing->return_date->format('d M Y') }}</span></div>
      <div class="row"><span class="label">No. Peminjaman</span><span class="value">#{{ str_pad($borrowing->id, 6, '0', STR_PAD_LEFT) }}</span></div>
      <div class="status-wrap">
        <span class="status-badge">Dipinjam</span>
      </div>
    </div>
    <div class="receipt-footer">
      <span class="footer-text">Dicetak: {{ now()->format('d M Y H:i') }}</span>
      <button class="btn-print" onclick="window.print()">🖨️ Cetak</button>
    </div>
  </div>
</body>
</html>
