<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<title>Laporan User — Perpustakaan DigiLib</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial,sans-serif;font-size:10px;color:#222;background:#fff}
.header{text-align:center;padding:20px 0 14px;border-bottom:2px solid #1c6b46;margin-bottom:16px}
.header h1{font-size:18px;color:#1c6b46;margin-bottom:4px}
.header p{font-size:10px;color:#666}
.meta{display:flex;justify-content:space-between;margin-bottom:14px;font-size:10px;color:#555}
table{width:100%;border-collapse:collapse}
thead th{background:#1c6b46;color:#fff;padding:8px 10px;text-align:left;font-size:9px}
tbody td{padding:7px 10px;border-bottom:1px solid #eee;font-size:9px}
tbody tr:nth-child(even){background:#f9f9f9}
.badge{padding:2px 8px;border-radius:99px;font-size:8px;font-weight:bold}
.badge-green{background:#eaf3ee;color:#1c6b46}
.badge-muted{background:#f2f0eb;color:#6a655b}
.footer{margin-top:18px;text-align:center;font-size:9px;color:#999;border-top:1px solid #eee;padding-top:10px}
@media print{body{-webkit-print-color-adjust:exact;print-color-adjust:exact}.no-print{display:none}}
</style>
</head>
<body>
<div class="no-print" style="padding:12px;background:#f0faf5;text-align:center;margin-bottom:16px">
  <button onclick="window.print()" style="background:#1c6b46;color:#fff;padding:8px 20px;border:none;border-radius:8px;cursor:pointer;font-size:13px">🖨 Cetak / Simpan PDF</button>
  <a href="{{ route('admin.reports.users') }}" style="margin-left:12px;color:#1c6b46;font-size:13px">← Kembali</a>
</div>
<div class="header">
  <h1>👥 Laporan Data Anggota</h1>
  <p>Perpustakaan DigiLib &nbsp;|&nbsp; Dihasilkan: {{ now()->format('d F Y, H:i') }}</p>
</div>
<div class="meta">
  <span>Total: {{ $users->count() }} anggota &nbsp;|&nbsp; Aktif: {{ $users->where('is_active',true)->count() }}</span>
  <span>Total Pinjaman: {{ $users->sum('borrowings_count') }}</span>
</div>
<table>
  <thead>
    <tr>
      <th style="width:22px">#</th>
      <th>Nama</th>
      <th>Username</th>
      <th>Email</th>
      <th>No HP</th>
      <th>Kota</th>
      <th>Status</th>
      <th>Total Pinjam</th>
      <th>Bergabung</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $i => $u)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $u->name }}</td>
      <td>{{ $u->username }}</td>
      <td>{{ $u->email }}</td>
      <td>{{ $u->phone ?? '—' }}</td>
      <td>{{ $u->city ?? '—' }}</td>
      <td><span class="badge {{ $u->is_active ? 'badge-green' : 'badge-muted' }}">{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
      <td style="text-align:center">{{ $u->borrowings_count }}</td>
      <td>{{ $u->created_at->format('d/m/Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="footer">Laporan ini digenerate secara otomatis oleh sistem Perpustakaan DigiLib</div>
</body>
</html>
