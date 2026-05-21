<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<title>Laporan Buku — Perpustakaan DigiLib</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial,sans-serif;font-size:11px;color:#222;background:#fff}
.header{text-align:center;padding:20px 0 14px;border-bottom:2px solid #1c6b46;margin-bottom:16px}
.header h1{font-size:18px;color:#1c6b46;margin-bottom:4px}
.header p{font-size:10px;color:#666}
.meta{display:flex;justify-content:space-between;margin-bottom:14px;font-size:10px;color:#555}
table{width:100%;border-collapse:collapse}
thead th{background:#1c6b46;color:#fff;padding:8px 10px;text-align:left;font-size:10px}
tbody td{padding:7px 10px;border-bottom:1px solid #eee;font-size:10px}
tbody tr:nth-child(even){background:#f9f9f9}
.badge{padding:2px 8px;border-radius:99px;font-size:9px;font-weight:bold}
.badge-green{background:#eaf3ee;color:#1c6b46}
.badge-red{background:#fef2f2;color:#c0392b}
.footer{margin-top:18px;text-align:center;font-size:9px;color:#999;border-top:1px solid #eee;padding-top:10px}
@media print{
  body{-webkit-print-color-adjust:exact;print-color-adjust:exact}
  .no-print{display:none}
}
</style>
</head>
<body>
<div class="no-print" style="padding:12px;background:#f0faf5;text-align:center;margin-bottom:16px">
  <button onclick="window.print()" style="background:#1c6b46;color:#fff;padding:8px 20px;border:none;border-radius:8px;cursor:pointer;font-size:13px">🖨 Cetak / Simpan PDF</button>
  <a href="{{ route('admin.reports.books') }}" style="margin-left:12px;color:#1c6b46;font-size:13px">← Kembali</a>
</div>
<div class="header">
  <h1>📚 Laporan Koleksi Buku</h1>
  <p>Perpustakaan DigiLib &nbsp;|&nbsp; Dihasilkan: {{ now()->format('d F Y, H:i') }}</p>
</div>
<div class="meta">
  <span>Total: {{ $books->count() }} buku &nbsp;|&nbsp; Total Stok: {{ $books->sum('stock') }} &nbsp;|&nbsp; Total Dipinjam: {{ $books->sum('borrowed_count') }}</span>
  <span>Stok Habis: {{ $books->where('stock',0)->count() }} buku</span>
</div>
<table>
  <thead>
    <tr>
      <th style="width:28px">#</th>
      <th>Judul</th>
      <th>Penulis</th>
      <th>Kategori</th>
      <th>ISBN</th>
      <th>Stok</th>
      <th>Dipinjam</th>
    </tr>
  </thead>
  <tbody>
    @foreach($books as $i => $b)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $b->title }}</td>
      <td>{{ $b->author }}</td>
      <td>{{ $b->category->name ?? '-' }}</td>
      <td>{{ $b->isbn ?? '—' }}</td>
      <td><span class="badge {{ $b->stock > 0 ? 'badge-green' : 'badge-red' }}">{{ $b->stock }}</span></td>
      <td>{{ $b->borrowed_count }}×</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="footer">Laporan ini digenerate secara otomatis oleh sistem Perpustakaan DigiLib</div>
</body>
</html>
