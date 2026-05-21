<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Bukti Pengembalian — {{ $borrowing->book->title }}</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:Arial,sans-serif;background:#f5f5f5;padding:32px 16px;color:#333}
    .wrap{max-width:520px;margin:0 auto;display:flex;flex-direction:column;gap:16px}
    .receipt{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.12)}
    .receipt-header{background:linear-gradient(135deg,#15803d,#166534);padding:28px 28px 22px;text-align:center;color:#fff}
    .receipt-header .icon{font-size:2.2rem;margin-bottom:8px}
    .receipt-header h1{font-size:1.15rem;font-weight:700;margin-bottom:4px}
    .receipt-header p{font-size:.78rem;opacity:.75}
    .receipt-body{padding:24px 28px}
    .row{display:flex;align-items:flex-start;padding:10px 0;border-bottom:1px solid #f0f0f0}
    .row:last-child{border-bottom:none}
    .label{font-size:.73rem;color:#888;min-width:150px;flex-shrink:0;padding-top:1px}
    .value{font-size:.83rem;font-weight:600;color:#222;flex:1}
    .value.danger{color:#c0392b}
    .status-wrap{text-align:center;padding:18px 0 10px}
    .status-badge{display:inline-block;background:#15803d;color:#fff;padding:5px 18px;border-radius:20px;font-size:.8rem;font-weight:700}
    .receipt-footer{background:#f9f9f9;border-top:1px dashed #ddd;padding:14px 28px;display:flex;align-items:center;justify-content:space-between}
    .footer-text{font-size:.7rem;color:#aaa}
    .btn-print{background:#15803d;color:#fff;border:none;padding:9px 22px;border-radius:8px;cursor:pointer;font-size:.82rem;font-weight:700;display:inline-flex;align-items:center;gap:7px}

    /* Review card */
    .review-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.12)}
    .review-card-header{background:linear-gradient(135deg,#1c6b46,#145235);padding:18px 24px;color:#fff;text-align:center}
    .review-card-header h2{font-size:1rem;font-weight:700;margin-bottom:2px}
    .review-card-header p{font-size:.75rem;opacity:.8}
    .review-card-body{padding:22px 24px}
    .star-row{display:flex;justify-content:center;gap:8px;margin-bottom:16px}
    .sp-star{font-size:2rem;cursor:pointer;color:#ddd;transition:color .12s,transform .1s;user-select:none}
    .sp-star:hover{transform:scale(1.15)}
    .sp-star.on{color:#e6a817}
    .star-hint{text-align:center;font-size:.78rem;font-weight:600;color:#1c6b46;min-height:1.2em;margin-bottom:12px}
    .field-lbl{display:block;font-size:.68rem;font-weight:700;color:#666;margin-bottom:6px;text-transform:uppercase;letter-spacing:.04em}
    .field-ta{width:100%;padding:10px 12px;border-radius:9px;border:1.5px solid #ddd;font-family:inherit;font-size:.88rem;color:#333;outline:none;resize:none;transition:border-color .2s}
    .field-ta:focus{border-color:#1c6b46;box-shadow:0 0 0 3px rgba(28,107,70,.1)}
    .field-ta::placeholder{color:#aaa}
    .btn-review{width:100%;margin-top:14px;background:#1c6b46;color:#fff;border:none;padding:12px;border-radius:9px;font-size:.88rem;font-weight:700;cursor:pointer;transition:background .2s;display:flex;align-items:center;justify-content:center;gap:8px}
    .btn-review:hover{background:#145235}
    .review-note{margin-top:10px;font-size:.72rem;color:#888;text-align:center}
    .review-done{text-align:center;padding:22px;color:#1c6b46}
    .review-done .stars{font-size:1.2rem;letter-spacing:2px;margin-bottom:6px}
    .review-done p{font-size:.82rem;color:#555}

    @media print{
      body{background:#fff;padding:0}
      .receipt{box-shadow:none;border-radius:0}
      .review-card,.btn-print{display:none!important}
    }
  </style>
</head>
<body>
  <div class="wrap">
    {{-- Receipt --}}
    <div class="receipt">
      <div class="receipt-header">
        <div class="icon">✅</div>
        <h1>Bukti Pengembalian Buku</h1>
        <p>DigiLib — Perpustakaan Digital</p>
      </div>
      <div class="receipt-body">
        <div class="row"><span class="label">Nama Peminjam</span><span class="value">{{ $borrowing->user->name }}</span></div>
        <div class="row"><span class="label">Judul Buku</span><span class="value">{{ $borrowing->book->title }}</span></div>
        <div class="row"><span class="label">Penulis</span><span class="value">{{ $borrowing->book->author }}</span></div>
        <div class="row"><span class="label">Penerbit</span><span class="value">{{ $borrowing->book->publisher }}</span></div>
        <div class="row"><span class="label">Tanggal Pinjam</span><span class="value">{{ $borrowing->borrow_date->format('d M Y') }}</span></div>
        <div class="row"><span class="label">Tanggal Kembali</span><span class="value">{{ $borrowing->return_date->format('d M Y') }}</span></div>
        <div class="row"><span class="label">Tgl Dikembalikan</span><span class="value">{{ $borrowing->actual_return_date ? $borrowing->actual_return_date->format('d M Y') : '-' }}</span></div>
        <div class="row"><span class="label">No. Peminjaman</span><span class="value">#{{ str_pad($borrowing->id, 6, '0', STR_PAD_LEFT) }}</span></div>
        @if($borrowing->fine_amount > 0)
        <div class="row"><span class="label">Denda Keterlambatan</span><span class="value danger">Rp {{ number_format($borrowing->fine_amount, 0, ',', '.') }}</span></div>
        @endif
        <div class="status-wrap"><span class="status-badge">Dikembalikan</span></div>
      </div>
      <div class="receipt-footer">
        <span class="footer-text">Dicetak: {{ now()->format('d M Y H:i') }}</span>
        <button class="btn-print" onclick="window.print()">🖨️ Cetak</button>
      </div>
    </div>

    {{-- Review Card — hanya tampil jika belum ada ulasan --}}
    @if(!$borrowing->review)
    <div class="review-card" id="reviewCard">
      <div class="review-card-header">
        <h2>⭐ Tulis Ulasan Buku</h2>
        <p>Bagikan pengalamanmu kepada pembaca lain</p>
      </div>
      <div class="review-card-body">
        <form method="POST" action="{{ route('user.borrow.review', $borrowing) }}">
          @csrf
          <input type="hidden" name="rating" id="rating-input" required>
          <div class="star-row" id="starRow">
            @for($i=1;$i<=5;$i++)
            <span class="sp-star" data-v="{{ $i }}">★</span>
            @endfor
          </div>
          <div class="star-hint" id="starHint">Pilih bintang untuk memberi nilai</div>
          <div style="margin-bottom:12px">
            <label class="field-lbl">Ulasan</label>
            <textarea name="comment" class="field-ta" rows="4" placeholder="Ceritakan pengalamanmu membaca buku ini..." maxlength="500"></textarea>
          </div>
          <button type="submit" class="btn-review" id="btnSubmit">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            Kirim Ulasan
          </button>
          <p class="review-note">Ulasan Anda membantu sesama pembaca memilih buku yang tepat.</p>
        </form>
      </div>
    </div>
    @else
    <div class="review-card">
      <div class="review-card-header"><h2>✅ Ulasan Sudah Dikirim</h2><p>Terima kasih atas ulasan Anda!</p></div>
      <div class="review-done">
        <div class="stars">@for($i=1;$i<=5;$i++){{ $i<=$borrowing->review->rating ? '★' : '☆' }}@endfor</div>
        @if($borrowing->review->comment)<p>{{ $borrowing->review->comment }}</p>@endif
      </div>
    </div>
    @endif
  </div>

  <script>
  (function(){
    const stars = [...document.querySelectorAll('#starRow .sp-star')];
    const input = document.getElementById('rating-input');
    const hint  = document.getElementById('starHint');
    const labels = ['','Sangat Buruk 😞','Kurang Bagus 😐','Cukup Bagus 😊','Bagus Sekali 😄','Luar Biasa! 🤩'];
    let selected = 0;
    stars.forEach(s=>{
      s.addEventListener('mouseenter',()=>{ const v=+s.dataset.v; stars.forEach((x,i)=>x.classList.toggle('on',i<v)); });
      s.addEventListener('mouseleave',()=>{ stars.forEach((x,i)=>x.classList.toggle('on',i<selected)); });
      s.addEventListener('click',()=>{
        selected = +s.dataset.v;
        if(input) input.value = selected;
        if(hint){ hint.textContent = labels[selected]; }
      });
    });
  })();
  </script>
</body>
</html>
