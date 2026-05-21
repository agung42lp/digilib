<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<title>Laporan Petugas</title>
<style>
  body{font-family:Arial,sans-serif;font-size:11px;color:#333;margin:0;padding:20px}
  h2{text-align:center;color:#1c6b46;margin-bottom:4px}
  .sub{text-align:center;color:#666;font-size:10px;margin-bottom:16px}
  table{width:100%;border-collapse:collapse;margin-top:10px}
  th{background:#1c6b46;color:#fff;padding:7px 8px;text-align:left;font-size:10px}
  td{padding:6px 8px;border-bottom:1px solid #e5e5e5;font-size:10px}
  tr:nth-child(even)td{background:#f5faf7}
  .role-admin{background:#e8f5e9;color:#2e7d32;padding:2px 7px;border-radius:3px;font-weight:bold}
  .role-petugas{background:#e3f2fd;color:#1565c0;padding:2px 7px;border-radius:3px;font-weight:bold}
  .footer{margin-top:20px;text-align:right;font-size:9px;color:#999}
  @media print{body{padding:0}}
  .no-print{text-align:center;margin-top:20px}
  @media print{.no-print{display:none}}
</style>
</head>
<body>
<h2>Laporan Data Petugas</h2>
<div class="sub">DigiLib — Perpustakaan Digital &bull; Dicetak: {{ now()->format('d M Y H:i') }}</div>
<table>
  <thead>
    <tr>
      <th>No</th><th>Nama</th><th>Username</th><th>Email</th><th>No HP</th><th>Kota</th><th>Role</th><th>Usulan</th><th>Diterima</th><th>Bergabung</th>
    </tr>
  </thead>
  <tbody>
    @foreach($staff as $i => $s)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $s->name }}</td>
      <td>{{ $s->username }}</td>
      <td>{{ $s->email }}</td>
      <td>{{ $s->phone ?? '-' }}</td>
      <td>{{ $s->city ?? '-' }}</td>
      <td><span class="role-{{ $s->role }}">{{ ucfirst($s->role) }}</span></td>
      <td style="text-align:center">{{ $s->proposals_count }}</td>
      <td style="text-align:center">{{ $s->proposals_approved }}</td>
      <td>{{ $s->created_at->format('d/m/Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="footer">Total: {{ $staff->count() }} staf &bull; Admin: {{ $staff->where('role','admin')->count() }} &bull; Petugas: {{ $staff->where('role','petugas')->count() }}</div>
<div class="no-print">
  <button onclick="window.print()" style="background:#1c6b46;color:#fff;border:none;padding:8px 24px;border-radius:6px;cursor:pointer;font-size:13px">🖨️ Cetak</button>
  <a href="{{ route('admin.reports.staff') }}" style="margin-left:10px;font-size:12px;color:#666">← Kembali</a>
</div>
</body>
</html>
