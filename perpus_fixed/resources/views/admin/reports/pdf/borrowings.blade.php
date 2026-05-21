<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<title>Laporan Peminjaman — Perpustakaan DigiLib</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial,sans-serif;font-size:10px;color:#222;background:#fff}
.header{text-align:center;padding:20px 0 14px;border-bottom:2px solid #1c6b46;margin-bottom:16px}
.header h1{font-size:18px;color:#1c6b46;margin-bottom:4px}
.header p{font-size:10px;color:#666}
.meta{display:flex;justify-content:space-between;margin-bottom:14px;font-size:10px;color:#555}
table{width:100%;border-collapse:collapse}
thead th{background:#1c6b46;color:#fff;padding:7px 8px;text-align:left;font-size:9px}
tbody td{padding:6px 8px;border-bottom:1px solid #eee;font-size:9px}
tbody tr:nth-child(even){background:#f9f9f9}
.badge{padding:2px 7px;border-radius:99px;font-size:8px;font-weight:bold}
.b-pending{background:#fef8ed;color:#b8760a}
.b-approved{background:#ebf2f8;color:#1a5280}
.b-returning{background:#fef8ed;color:#b8760a}
.b-returned{background:#f2f0eb;color:#6a655b}
.b-rejected{background:#fef2f2;color:#c0392b}
.footer{margin-top:18px;text-align:center;font-size:9px;color:#999;border-top:1px solid #eee;padding-top:10px}
@media print{body{-webkit-print-color-adjust:exact;print-color-adjust:exact}.no-print{display:none}}
</style>
</head>
<body>
<div class="no-print" style="padding:12px;background:#f0faf5;text-align:center;margin-bottom:16px">
  <button onclick="window.print()" style="background:#1c6b46;color:#fff;padding:8px 20px;border:none;border-radius:8px;cursor:pointer;font-size:13px">🖨 Cetak / Simpan PDF</button>
  <a href="{{ route('admin.reports.borrowings') }}" style="margin-left:12px;color:#1c6b46;font-size:13px">← Kembali</a>
</div>
<div class="header">
  <h1>🔄 Laporan Peminjaman Buku</h1>
  <p>Perpustakaan DigiLib &nbsp;|&nbsp; Dihasilkan: {{ now()->format('d F Y, H:i') }}</p>
</div>
@php $totalFine = $borrowings->sum('fine_amount'); @endphp
<div class="meta">
  <span>Total: {{ $borrowings->count() }} transaksi &nbsp;|&nbsp; Dikembalikan: {{ $borrowings->where('status','returned')->count() }}</span>
  <span>Total Denda: Rp {{ number_format($totalFine, 0, ',', '.') }}</span>
</div>
<table>
  <thead>
    <tr>
      <th style="width:22px">#</th>
      <th>Peminjam</th>
      <th>Buku</th>
      <th>Tgl Pinjam</th>
      <th>Tgl Kembali</th>
      <th>Tgl Aktual</th>
      <th>Status</th>
      <th>Denda</th>
    </tr>
  </thead>
  <tbody>
    @foreach($borrowings as $i => $b)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $b->user->name }}</td>
      <td>{{ \Illuminate\Support\Str::limit($b->book->title, 30) }}</td>
      <td>{{ $b->borrow_date->format('d/m/Y') }}</td>
      <td>{{ $b->return_date->format('d/m/Y') }}</td>
      <td>{{ $b->actual_return_date ? $b->actual_return_date->format('d/m/Y') : '—' }}</td>
      <td><span class="badge b-{{ $b->status }}">{{ $b->status_label }}</span></td>
      <td>{{ $b->fine_amount > 0 ? 'Rp '.number_format($b->fine_amount,0,',','.') : '—' }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="footer">Laporan ini digenerate secara otomatis oleh sistem Perpustakaan DigiLib</div>
</body>
</html>
