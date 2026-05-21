<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>DigiLib — Daftar Akun</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
<style>
:root{
  --green:#1c6b46;--green-2:#145235;--green-3:#0b3021;
  --green-pale:#eaf3ee;--green-pale-2:#c4dfce;--green-mid:rgba(28,107,70,.1);
  --white:#fff;--off:#f9f8f5;--surface:#f2f0eb;
  --border:#e4e2da;--border-2:#c9c5ba;
  --ink:#16140f;--ink-2:#2d2a22;--muted:#6a655b;--muted-2:#a09a90;
  --error:#C0392B;--error-bg:#FDF3F2;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{height:100%;-webkit-font-smoothing:antialiased}
body{height:100%;font-family:'DM Sans',system-ui,sans-serif;background:var(--off);color:var(--ink)}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none;background:none}
input{font-family:inherit}

.shell{display:grid;grid-template-columns:1fr 1fr;min-height:100vh}

/* ── LEFT PANEL ── */
.panel-left{background:var(--green-3);position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:space-between;padding:48px}
.panel-left::before{content:'';position:absolute;inset:0;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='.04'/%3E%3C/svg%3E");pointer-events:none;z-index:0;opacity:.5}
.orb{position:absolute;border-radius:50%;filter:blur(80px);pointer-events:none;z-index:0;animation:orbDrift 12s ease-in-out infinite}
.orb-1{width:400px;height:400px;background:rgba(26,102,72,.35);top:-100px;right:-100px}
.orb-2{width:300px;height:300px;background:rgba(20,82,54,.4);bottom:-80px;left:-60px;animation-delay:-4s}
.orb-3{width:180px;height:180px;background:rgba(212,98,42,.12);top:45%;left:18%;animation-delay:-8s}
@keyframes orbDrift{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(20px,-30px) scale(1.05)}66%{transform:translate(-15px,20px) scale(.95)}}
.plc{position:relative;z-index:1}
.brand{display:flex;align-items:center;gap:10px}
.brand-mark{width:36px;height:36px;background:rgba(255,255,255,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.12)}
.brand-name{font-family:'Instrument Serif',serif;font-size:1.3rem;color:rgba(255,255,255,.92);letter-spacing:-.015em}
.steps-label{font-family:'Syne',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.22);margin-bottom:22px}
.steps{display:flex;flex-direction:column;gap:20px}
.step{display:flex;gap:14px;align-items:flex-start}
.step-num{width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.13);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-family:'Instrument Serif',serif;font-size:.95rem;color:rgba(255,255,255,.65)}
.step-title{font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;letter-spacing:.03em;color:rgba(255,255,255,.68);margin-bottom:3px}
.step-sub{font-size:.74rem;color:rgba(255,255,255,.32);line-height:1.55}
.left-stats{display:flex;gap:28px;padding-top:28px;border-top:1px solid rgba(255,255,255,.08)}
.lstat-n{font-family:'Instrument Serif',serif;font-size:1.5rem;color:rgba(255,255,255,.9);letter-spacing:-.02em;line-height:1}
.lstat-l{font-size:.63rem;color:rgba(255,255,255,.32);margin-top:3px}

/* ── RIGHT PANEL ── */
.panel-right{background:var(--white);display:flex;flex-direction:column;align-items:center;padding:56px 48px 48px;position:relative;overflow-y:auto}
.back-link{position:absolute;top:24px;left:24px;display:flex;align-items:center;gap:6px;font-size:.78rem;font-weight:500;color:var(--muted);transition:color .15s}
.back-link:hover{color:var(--ink)}
.back-arrow{width:28px;height:28px;border-radius:7px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:.75rem;transition:all .15s}
.back-link:hover .back-arrow{border-color:var(--border-2);background:var(--surface)}

.form-wrap{width:100%;max-width:390px;margin-block:auto}
.form-heading{font-family:'Instrument Serif',serif;font-size:1.95rem;color:var(--ink);letter-spacing:-.025em;line-height:1.1;margin-bottom:6px}
.form-heading em{font-style:italic;color:var(--green)}
.form-sub{font-size:.87rem;color:var(--muted);margin-bottom:26px;line-height:1.5}

.alert-error{background:var(--error-bg);border:1px solid rgba(192,57,43,.2);border-radius:10px;padding:12px 14px;margin-bottom:18px;font-size:.8rem;color:var(--error);line-height:1.5}

.fields{display:flex;flex-direction:column;gap:13px;margin-bottom:18px}
.field-row-2{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.flabel{display:block;font-family:'Syne',sans-serif;font-size:.64rem;font-weight:600;color:var(--muted);margin-bottom:5px;letter-spacing:.04em;text-transform:uppercase}
.flabel sup{color:var(--error)}
.finput{width:100%;height:44px;padding:0 13px;border-radius:9px;border:1.5px solid var(--border);background:var(--white);font-size:.88rem;color:var(--ink);outline:none;transition:border-color .2s,box-shadow .2s;-webkit-appearance:none}
.finput::placeholder{color:var(--muted-2)}
.finput:focus{border-color:var(--green);box-shadow:0 0 0 3px var(--green-mid)}
.finput.err{border-color:var(--error);box-shadow:0 0 0 3px rgba(192,57,43,.08)}
.fhint{font-size:.67rem;color:var(--muted-2);margin-top:4px;line-height:1.4}

.pw-wrap{position:relative}
.pw-wrap .finput{padding-right:42px}
.pw-toggle{position:absolute;right:13px;top:50%;transform:translateY(-50%);color:var(--muted-2);cursor:pointer;font-size:.85rem;user-select:none}

/* strength */
.pw-strength{margin-top:5px;display:none}
.pw-bars{display:flex;gap:3px;margin-bottom:3px}
.pw-bar{flex:1;height:3px;border-radius:99px;background:var(--border);transition:background .3s}
.pw-bar.weak{background:#E74C3C}.pw-bar.medium{background:#F39C12}.pw-bar.strong{background:var(--green)}
.pw-str-lbl{font-size:.62rem;font-weight:600;color:var(--muted-2);text-transform:uppercase;letter-spacing:.03em}

.btn-reg{width:100%;height:48px;background:var(--green);color:#fff;border-radius:10px;font-family:'Syne',sans-serif;font-size:.8rem;font-weight:700;letter-spacing:.04em;transition:all .2s;box-shadow:0 1px 3px rgba(26,102,72,.25),0 4px 14px rgba(26,102,72,.2);margin-bottom:16px;display:flex;align-items:center;justify-content:center;gap:8px}
.btn-reg:hover{background:var(--green-2);transform:translateY(-1px);box-shadow:0 2px 8px rgba(26,102,72,.3),0 8px 20px rgba(26,102,72,.25)}
.switch-p{text-align:center;font-size:.78rem;color:var(--muted)}
.switch-p a{color:var(--green);font-weight:600;margin-left:4px;border-bottom:1px solid var(--green-pale)}
.switch-p a:hover{border-color:var(--green)}

@media(max-width:820px){
  .shell{grid-template-columns:1fr}
  .panel-left{display:none}
  .panel-right{padding:48px 24px}
}
</style>
</head>
<body>
<div class="shell">

  <!-- LEFT -->
  <aside class="panel-left">
    <div class="orb orb-1"></div><div class="orb orb-2"></div><div class="orb orb-3"></div>
    <div class="plc">
      <a href="{{ url('/') }}" class="brand">
        <div class="brand-mark"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
        <span class="brand-name">DigiLib</span>
      </a>
    </div>
    <div class="plc">
      <div class="steps-label">Cara Bergabung</div>
      <div class="steps">
        <div class="step"><div class="step-num">1</div><div><div class="step-title">Isi form pendaftaran</div><div class="step-sub">Data diri, email, password. Gratis, tanpa kartu kredit.</div></div></div>
        <div class="step"><div class="step-num">2</div><div><div class="step-title">Aktivasi oleh admin</div><div class="step-sub">Akun aktif dalam 1–2 hari kerja setelah verifikasi.</div></div></div>
        <div class="step"><div class="step-num">3</div><div><div class="step-title">Mulai pinjam buku</div><div class="step-sub">2.400+ koleksi. Ambil di Jl. Kapten Muslihat 21, Bogor.</div></div></div>
      </div>
    </div>
    <div class="left-stats plc">
      <div><div class="lstat-n">2.4K+</div><div class="lstat-l">Koleksi Buku</div></div>
      <div><div class="lstat-n">1.2K</div><div class="lstat-l">Anggota Aktif</div></div>
      <div><div class="lstat-n">Gratis</div><div class="lstat-l">Selamanya</div></div>
    </div>
  </aside>

  <!-- RIGHT -->
  <main class="panel-right">
    <a href="{{ route('login') }}" class="back-link"><div class="back-arrow">←</div>Sudah punya akun?</a>

    <div class="form-wrap">
      <h1 class="form-heading">Mulai <em>perjalanan</em><br>membacamu.</h1>
      <p class="form-sub">Daftar gratis. Tidak perlu kartu kredit.</p>

      @if($errors->any())
        <div class="alert-error">
          @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="fields">
          <div>
            <label class="flabel" for="name">Nama Lengkap <sup>*</sup></label>
            <input class="finput {{ $errors->has('name') ? 'err' : '' }}" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap kamu" autocomplete="name" required>
          </div>
          <div class="field-row-2">
            <div>
              <label class="flabel" for="username">Username <sup>*</sup></label>
              <input class="finput {{ $errors->has('username') ? 'err' : '' }}" type="text" id="username" name="username" value="{{ old('username') }}" placeholder="aufasantoso" autocomplete="username" required>
            </div>
            <div>
              <label class="flabel" for="phone">No. HP</label>
              <input class="finput" type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xx...">
            </div>
          </div>
          <div>
            <label class="flabel" for="email">Email <sup>*</sup></label>
            <input class="finput {{ $errors->has('email') ? 'err' : '' }}" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" required>
          </div>
          <div>
            <label class="flabel" for="city">Kota / Domisili <sup>*</sup></label>
            <input class="finput {{ $errors->has('city') ? 'err' : '' }}" type="text" id="city" name="city" value="{{ old('city') }}" placeholder="Bogor, Jakarta, Depok..." required>
            <div class="fhint">Layanan tersedia di Jabodetabek, Bandung, Surabaya, Yogyakarta</div>
          </div>
          <div>
            <label class="flabel" for="password">Password <sup>*</sup></label>
            <div class="pw-wrap">
              <input class="finput {{ $errors->has('password') ? 'err' : '' }}" type="password" id="password" name="password" placeholder="Min. 6 karakter" oninput="checkPw(this)" required minlength="6">
              <span class="pw-toggle" onclick="togglePw('password',this)">👁</span>
            </div>
            <div class="pw-strength" id="pw-strength">
              <div class="pw-bars"><div class="pw-bar" id="pb1"></div><div class="pw-bar" id="pb2"></div><div class="pw-bar" id="pb3"></div><div class="pw-bar" id="pb4"></div></div>
              <div class="pw-str-lbl" id="pw-str-lbl"></div>
            </div>
          </div>
          <div>
            <label class="flabel" for="password_confirmation">Konfirmasi Password <sup>*</sup></label>
            <div class="pw-wrap">
              <input class="finput" type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" oninput="checkMatch(this)" required>
              <span class="pw-toggle" onclick="togglePw('password_confirmation',this)">👁</span>
            </div>
            <div class="fhint" id="match-hint" style="display:none"></div>
          </div>
        </div>

        <button type="submit" class="btn-reg">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Buat Akun Gratis
        </button>
      </form>

      <div class="switch-p">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini →</a></div>
    </div>
  </main>
</div>

<script>
function togglePw(id,btn){const i=document.getElementById(id);const s=i.type==='text';i.type=s?'password':'text';btn.textContent=s?'👁':'🙈'}
function checkPw(inp){
  const v=inp.value,wrap=document.getElementById('pw-strength');
  const lbl=document.getElementById('pw-str-lbl');
  const bars=['pb1','pb2','pb3','pb4'].map(id=>document.getElementById(id));
  wrap.style.display=v?'block':'none';
  if(!v)return;
  let s=0;
  if(v.length>=6)s++;if(v.length>=10)s++;
  if(/[A-Z]/.test(v)||/[0-9]/.test(v))s++;if(/[^A-Za-z0-9]/.test(v))s++;
  const cls=['','weak','medium','medium','strong'],lb=['','Lemah','Sedang','Kuat','Sangat Kuat'];
  bars.forEach((b,i)=>{b.className='pw-bar'+(i<s?' '+cls[s]:'')});
  lbl.textContent=lb[s]||'Lemah';
  lbl.style.color=s<=1?'#E74C3C':s<=2?'#F39C12':'var(--green)';
}
function checkMatch(inp){
  const pw=document.getElementById('password').value,hint=document.getElementById('match-hint');
  hint.style.display=inp.value?'block':'none';
  if(inp.value===pw){hint.textContent='✓ Password cocok';hint.style.color='var(--green)'}
  else{hint.textContent='Password tidak cocok';hint.style.color='#C0392B'}
}
</script>
</body>
</html>
