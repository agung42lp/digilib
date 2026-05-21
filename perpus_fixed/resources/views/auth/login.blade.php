<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>DigiLib — Masuk & Daftar</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
<style>
:root{
  --green:     #1c6b46;
  --green-2:   #145235;
  --green-3:   #0b3021;
  --green-pale:#eaf3ee;
  --green-pale-2:#c4dfce;
  --green-mid: rgba(28,107,70,.1);
  --white:     #ffffff;
  --off:       #f9f8f5;
  --surface:   #f2f0eb;
  --border:    #e4e2da;
  --border-2:  #c9c5ba;
  --ink:       #16140f;
  --ink-2:     #2d2a22;
  --muted:     #6a655b;
  --muted-2:   #a09a90;
  --accent:    #d04e1a;
  --error:     #C0392B;
  --error-bg:  #FDF3F2;
  --success:   #1c6b46;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{height:100%;-webkit-font-smoothing:antialiased}
body{
  height:100%;
  font-family:'DM Sans',system-ui,sans-serif;
  background:var(--off);
  color:var(--ink);
  overflow:hidden;
}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none;background:none}
input,textarea{font-family:inherit}
.shell{display:grid;grid-template-columns:1fr 1fr;height:100vh;overflow:hidden}
.panel-left{
  background:var(--green-3);position:relative;overflow:hidden;
  display:flex;flex-direction:column;justify-content:space-between;
  padding:48px;transition:background .8s ease;
}
.panel-left::before{
  content:'';position:absolute;inset:0;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='.04'/%3E%3C/svg%3E");
  pointer-events:none;z-index:0;opacity:.5;
}
.orb{position:absolute;border-radius:50%;filter:blur(80px);pointer-events:none;z-index:0;animation:orbDrift 12s ease-in-out infinite}
.orb-1{width:400px;height:400px;background:rgba(26,102,72,.35);top:-100px;right:-100px;animation-delay:0s}
.orb-2{width:300px;height:300px;background:rgba(20,82,54,.4);bottom:-80px;left:-60px;animation-delay:-4s}
.orb-3{width:200px;height:200px;background:rgba(212,98,42,.12);top:40%;left:20%;animation-delay:-8s}
@keyframes orbDrift{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(20px,-30px) scale(1.05)}66%{transform:translate(-15px,20px) scale(.95)}}
.panel-left-content{position:relative;z-index:1}
.brand{display:flex;align-items:center;gap:10px}
.brand-mark{width:36px;height:36px;background:rgba(255,255,255,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(8px)}
.brand-name{font-family:'Instrument Serif',serif;font-size:1.3rem;font-weight:400;color:rgba(255,255,255,.92);letter-spacing:-.015em}
.book-stack{display:flex;gap:6px;align-items:flex-end;margin:48px 0 40px}
.bs{border-radius:5px;position:relative;transition:transform .4s cubic-bezier(.34,1.56,.64,1);cursor:pointer;flex-shrink:0;box-shadow:3px 0 0 rgba(0,0,0,.25),5px 2px 8px rgba(0,0,0,.3),inset -3px 0 6px rgba(0,0,0,.15)}
.bs:hover{transform:translateY(-12px) !important}
.bs-inner{width:100%;height:100%;border-radius:5px;display:flex;align-items:flex-end;padding:10px 6px;position:relative;overflow:hidden}
.bs::after{content:'';position:absolute;right:0;top:0;bottom:0;width:4px;background:linear-gradient(to right,rgba(0,0,0,.15),rgba(255,255,255,.04));border-radius:0 5px 5px 0}
.bs-title{font-family:'Instrument Serif',serif;font-size:.52rem;font-weight:400;color:rgba(255,255,255,.85);line-height:1.2;writing-mode:vertical-rl;text-orientation:mixed;transform:rotate(180deg);letter-spacing:.04em;text-shadow:0 1px 3px rgba(0,0,0,.3)}
.quote-block{position:relative;z-index:1}
.quote-mark{font-family:'Instrument Serif',serif;font-style:italic;font-size:5rem;font-weight:400;color:rgba(255,255,255,.08);line-height:.8;margin-bottom:-20px;user-select:none;display:block}
.quote-text{font-family:'Instrument Serif',serif;font-style:italic;font-size:1.3rem;font-weight:400;color:rgba(255,255,255,.85);line-height:1.55;letter-spacing:-.01em;margin-bottom:14px;transition:opacity .6s,transform .6s}
.quote-author{font-size:.75rem;font-weight:500;color:rgba(255,255,255,.4);letter-spacing:.04em;text-transform:uppercase;font-family:'Syne',sans-serif}
.left-stats{display:flex;gap:32px;position:relative;z-index:1;padding-top:32px;border-top:1px solid rgba(255,255,255,.08)}
.lstat-n{font-family:'Instrument Serif',serif;font-size:1.6rem;font-weight:400;color:rgba(255,255,255,.9);letter-spacing:-.02em;line-height:1}
.lstat-l{font-size:.68rem;font-weight:500;color:rgba(255,255,255,.38);margin-top:3px;letter-spacing:.02em}
.panel-right{background:var(--white);display:flex;flex-direction:column;align-items:center;padding:72px 56px 56px;position:relative;overflow-y:auto}
.back-link{position:absolute;top:28px;left:28px;display:flex;align-items:center;gap:6px;font-size:.78rem;font-weight:500;color:var(--muted);transition:color .15s}
.back-link:hover{color:var(--ink)}
.back-arrow{width:28px;height:28px;border-radius:7px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:.7rem;transition:all .15s}
.back-link:hover .back-arrow{border-color:var(--border-2);background:var(--surface)}
.form-container{width:100%;max-width:380px;margin-block:auto}
.tab-bar{display:flex;background:var(--surface);border-radius:12px;padding:4px;margin-bottom:36px}
.tab{flex:1;text-align:center;padding:9px 0;border-radius:9px;font-size:.83rem;font-weight:600;color:var(--muted);cursor:pointer;transition:all .25s cubic-bezier(.4,0,.2,1);letter-spacing:-.01em;user-select:none}
.tab.active{background:var(--white);color:var(--ink);box-shadow:0 1px 4px rgba(0,0,0,.08),0 2px 12px rgba(0,0,0,.05)}
.form-panel{display:none;animation:panelIn .3s ease both}
.form-panel.active{display:block}
@keyframes panelIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.form-header{margin-bottom:28px}
.form-title{font-family:'Instrument Serif',serif;font-size:2rem;font-weight:400;color:var(--ink);letter-spacing:-.02em;line-height:1.1;margin-bottom:7px}
.form-title em{font-style:italic;font-weight:400;color:var(--green)}
.form-subtitle{font-size:.87rem;font-weight:400;color:var(--muted);line-height:1.5;letter-spacing:-.01em}
.fields{display:flex;flex-direction:column;gap:14px;margin-bottom:20px}
.field-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.field{position:relative}
.field-label{display:block;font-family:'Syne',sans-serif;font-size:.68rem;font-weight:600;color:var(--muted);margin-bottom:6px;letter-spacing:.04em;text-transform:uppercase}
.field-input{width:100%;height:46px;padding:0 14px;border-radius:10px;border:1.5px solid var(--border);background:var(--white);font-size:.9rem;font-weight:400;color:var(--ink);outline:none;transition:border-color .2s,box-shadow .2s;letter-spacing:-.01em;-webkit-appearance:none}
.field-input::placeholder{color:var(--muted-2)}
.field-input:focus{border-color:var(--green);box-shadow:0 0 0 3px var(--green-mid)}
.field-input.error{border-color:var(--error);box-shadow:0 0 0 3px rgba(192,57,43,.08)}
.field-input.success{border-color:var(--success)}
.field-textarea{width:100%;padding:12px 14px;border-radius:10px;border:1.5px solid var(--border);background:var(--white);font-family:'DM Sans',sans-serif;font-size:.9rem;color:var(--ink);outline:none;resize:none;transition:border-color .2s,box-shadow .2s;-webkit-appearance:none}
.field-textarea::placeholder{color:var(--muted-2)}
.field-textarea:focus{border-color:var(--green);box-shadow:0 0 0 3px var(--green-mid)}
.field-pw{position:relative}
.field-pw .field-input{padding-right:44px}
.pw-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);color:var(--muted-2);font-size:.85rem;cursor:pointer;transition:color .15s;user-select:none;padding:4px}
.pw-toggle:hover{color:var(--muted)}
.field-hint{font-size:.68rem;font-weight:500;color:var(--muted-2);margin-top:5px;letter-spacing:-.01em}
.field-hint.err{color:var(--error)}
.pw-strength{margin-top:7px}
.pw-strength-bars{display:flex;gap:3px;margin-bottom:4px}
.pw-bar{flex:1;height:3px;border-radius:99px;background:var(--border);transition:background .3s}
.pw-bar.weak{background:#E74C3C}
.pw-bar.medium{background:#F39C12}
.pw-bar.strong{background:#1A6648}
.pw-strength-label{font-size:.65rem;font-weight:600;color:var(--muted-2);letter-spacing:.02em;text-transform:uppercase}
.check-row{display:flex;align-items:flex-start;gap:9px;margin-bottom:6px}
.check-row input[type=checkbox]{width:16px;height:16px;accent-color:var(--green);flex-shrink:0;margin-top:1px;cursor:pointer}
.check-label{font-size:.78rem;font-weight:400;color:var(--muted);line-height:1.4;letter-spacing:-.01em}
.check-label a{color:var(--green);font-weight:500;border-bottom:1px solid var(--green-pale)}
.check-label a:hover{border-color:var(--green)}
.btn-submit{width:100%;height:48px;background:var(--green);color:var(--white);border-radius:12px;font-size:.9rem;font-weight:600;letter-spacing:-.01em;transition:all .2s;position:relative;overflow:hidden;box-shadow:0 1px 3px rgba(26,102,72,.25),0 4px 14px rgba(26,102,72,.2);margin-bottom:20px}
.btn-submit:hover{background:var(--green-2);transform:translateY(-1px);box-shadow:0 2px 8px rgba(26,102,72,.3),0 8px 20px rgba(26,102,72,.25)}
.btn-submit:active{transform:translateY(0)}
.btn-submit::after{content:'';position:absolute;top:-50%;left:-75%;width:50%;height:200%;background:linear-gradient(100deg,transparent,rgba(255,255,255,.12),transparent);transform:skewX(-25deg);transition:left .5s ease}
.btn-submit:hover::after{left:125%}
.btn-submit.loading{pointer-events:none;opacity:.8}
.btn-submit.loading::before{content:'';width:16px;height:16px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;display:inline-block;animation:spin .7s linear infinite;margin-right:8px;vertical-align:middle}
@keyframes spin{to{transform:rotate(360deg)}}
.forgot-row{display:flex;justify-content:flex-end;margin-top:-8px;margin-bottom:16px}
.forgot-link{font-size:.75rem;font-weight:500;color:var(--green);letter-spacing:-.01em;transition:opacity .15s}
.forgot-link:hover{opacity:.75}
.switch-prompt{text-align:center;font-size:.78rem;color:var(--muted);letter-spacing:-.01em}
.switch-prompt a{color:var(--green);font-weight:600;margin-left:4px;border-bottom:1px solid var(--green-pale);transition:border-color .15s}
.switch-prompt a:hover{border-color:var(--green)}
.toast{position:fixed;bottom:32px;left:50%;transform:translateX(-50%) translateY(20px);background:var(--ink);color:#fff;font-size:.8rem;font-weight:500;padding:12px 24px;border-radius:99px;white-space:nowrap;box-shadow:0 8px 24px rgba(0,0,0,.25);z-index:1000;opacity:0;transition:all .35s cubic-bezier(.34,1.56,.64,1);letter-spacing:-.01em;pointer-events:none}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.toast.success-toast{background:var(--green)}
.steps-bar{display:flex;gap:4px;margin-bottom:28px}
.step-dot{height:3px;flex:1;background:var(--border);border-radius:99px;transition:background .3s}
.step-dot.done{background:var(--green)}
.step-dot.active{background:var(--green);opacity:.5}

/* Error alert box */
.alert-error{
  background:var(--error-bg);
  border:1px solid rgba(192,57,43,.2);
  border-radius:10px;
  padding:12px 14px;
  margin-bottom:16px;
  font-size:.8rem;
  color:var(--error);
  line-height:1.5;
}

@media(max-width:820px){
  .shell{grid-template-columns:1fr}
  .panel-left{display:none}
  body{overflow-y:auto}
  .panel-right{min-height:100vh;overflow-y:auto}
}
</style>
</head>
<body>

<div class="shell">

  <!-- LEFT PANEL -->
  <div class="panel-left" id="panelLeft">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="panel-left-content">
      <a href="{{ url('/') }}" class="brand">
        <div class="brand-mark"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
        <span class="brand-name">DigiLib</span>
      </a>
    </div>

    <div class="panel-left-content">
      <div class="book-stack" id="bookStack">
        <div class="bs" style="width:44px;height:152px"><div class="bs-inner" style="background:linear-gradient(170deg,#2D7A56,#1A4A30)"><span class="bs-title">Bumi Manusia</span></div></div>
        <div class="bs" style="width:40px;height:130px"><div class="bs-inner" style="background:linear-gradient(170deg,#8B4A1A,#5A2A08)"><span class="bs-title">Laskar Pelangi</span></div></div>
        <div class="bs" style="width:46px;height:168px"><div class="bs-inner" style="background:linear-gradient(170deg,#1B3A6B,#0A1F3C)"><span class="bs-title">Sapiens</span></div></div>
        <div class="bs" style="width:38px;height:140px"><div class="bs-inner" style="background:linear-gradient(170deg,#6B2D6B,#3A0A3A)"><span class="bs-title">Filosofi Teras</span></div></div>
        <div class="bs" style="width:44px;height:158px"><div class="bs-inner" style="background:linear-gradient(170deg,#B8520A,#7A3000)"><span class="bs-title">Atomic Habits</span></div></div>
        <div class="bs" style="width:40px;height:136px"><div class="bs-inner" style="background:linear-gradient(170deg,#2A5C6B,#0A2A38)"><span class="bs-title">Perahu Kertas</span></div></div>
        <div class="bs" style="width:42px;height:148px"><div class="bs-inner" style="background:linear-gradient(170deg,#4A6B1A,#263A08)"><span class="bs-title">Pulang</span></div></div>
        <div class="bs" style="width:38px;height:124px"><div class="bs-inner" style="background:linear-gradient(170deg,#6B4A1A,#3A2008)"><span class="bs-title">Negeri 5 Menara</span></div></div>
      </div>
      <div class="quote-block">
        <span class="quote-mark">"</span>
        <p class="quote-text" id="quoteText">Sebuah buku yang bagus adalah teman terbaik yang diam saat kamu sibuk, dan berbicara saat kamu butuh.</p>
        <span class="quote-author" id="quoteAuthor">— Pramoedya Ananta Toer</span>
      </div>
    </div>

    <div class="left-stats panel-left-content">
      <div><div class="lstat-n">2.4K+</div><div class="lstat-l">Koleksi Buku</div></div>
      <div><div class="lstat-n">1.2K</div><div class="lstat-l">Anggota Aktif</div></div>
      <div><div class="lstat-n">Gratis</div><div class="lstat-l">Selamanya</div></div>
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="panel-right">
    <a href="{{ url('/') }}" class="back-link">
      <div class="back-arrow">←</div>
      Kembali
    </a>

    <div class="form-container">

      <div class="tab-bar" role="tablist">
        <div class="tab active" id="tab-login" onclick="switchTab('login')" role="tab">Masuk</div>
        <div class="tab" id="tab-register" onclick="switchTab('register')" role="tab">Daftar</div>
      </div>

      <!-- ══ LOGIN FORM ══ -->
      <div class="form-panel active" id="panel-login">
        <div class="form-header">
          <h1 class="form-title">Selamat <em>datang</em> kembali.</h1>
          <p class="form-subtitle">Masuk untuk melanjutkan koleksi bacaanmu.</p>
        </div>

        {{-- Error dari Laravel --}}
        @if ($errors->hasAny(['email', 'password']) && old('_form') !== 'register')
          <div class="alert-error">
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif

        <form id="form-login" action="{{ route('login') }}" method="POST">
          @csrf
          {{-- Penanda form ini yang submit, untuk bisa bedain error login vs register --}}
          <input type="hidden" name="_form" value="login">

          <div class="fields">
            <div class="field">
              <label class="field-label" for="login-email">Email</label>
              <input class="field-input @error('email') error @enderror"
                     type="email" id="login-email" name="email"
                     value="{{ old('email') }}"
                     placeholder="nama@email.com" autocomplete="email"/>
            </div>
            <div class="field field-pw">
              <label class="field-label" for="login-pw">Password</label>
              <input class="field-input" type="password" id="login-pw" name="password"
                     placeholder="••••••••" autocomplete="current-password"/>
              <span class="pw-toggle" onclick="togglePw('login-pw',this)">👁</span>
            </div>
          </div>

          <div class="forgot-row">
            <a href="#" class="forgot-link">Lupa password?</a>
          </div>

          <button type="submit" class="btn-submit" id="btn-login">
            Masuk ke DigiLib
          </button>
        </form>

        <div class="switch-prompt">
          Belum punya akun?
          <a href="#" onclick="switchTab('register');return false">Daftar gratis <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        </div>
      </div>

      <!-- ══ REGISTER FORM ══ -->
      <div class="form-panel" id="panel-register">
        <div class="form-header">
          <h1 class="form-title">Mulai <em>perjalanan</em> membacamu.</h1>
          <p class="form-subtitle">Gratis selamanya. Tidak perlu kartu kredit.</p>
        </div>

        <div class="steps-bar">
          <div class="step-dot active" id="sdot-1"></div>
          <div class="step-dot" id="sdot-2"></div>
          <div class="step-dot" id="sdot-3"></div>
        </div>

        {{-- Error dari Laravel (register gagal) --}}
        @if ($errors->any() && old('_form') === 'register')
          <div class="alert-error" id="reg-error-box">
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif

        <form id="form-register" action="{{ route('register') }}" method="POST">
          @csrf
          <input type="hidden" name="_form" value="register">
          {{-- Field name digabung dari fn+ln via JS sebelum submit --}}
          <input type="hidden" id="reg-name-hidden" name="name" value="{{ old('name') }}">

          <!-- Step 1: Data Diri -->
          <div id="reg-step-1">
            <div class="fields">
              <div class="field-row">
                <div class="field">
                  <label class="field-label" for="reg-fn">Nama Depan</label>
                  <input class="field-input" type="text" id="reg-fn" placeholder="Aufa"
                         value="{{ old('_fn') }}"/>
                  <input type="hidden" name="_fn" id="reg-fn-hidden" value="{{ old('_fn') }}">
                </div>
                <div class="field">
                  <label class="field-label" for="reg-ln">Nama Belakang</label>
                  <input class="field-input" type="text" id="reg-ln" placeholder="Santoso"
                         value="{{ old('_ln') }}"/>
                  <input type="hidden" name="_ln" id="reg-ln-hidden" value="{{ old('_ln') }}">
                </div>
              </div>
              <div class="field">
                <label class="field-label" for="reg-email">Email</label>
                <input class="field-input @error('email') error @enderror"
                       type="email" id="reg-email" name="email"
                       placeholder="nama@email.com" autocomplete="email"
                       value="{{ old('email') }}"/>
              </div>
              <div class="field">
                <label class="field-label" for="reg-username">Username</label>
                <input class="field-input @error('username') error @enderror"
                       type="text" id="reg-username" name="username"
                       placeholder="aufasantoso" autocomplete="username"
                       value="{{ old('username') }}"
                       oninput="checkUsername(this)"/>
                <span class="field-hint" id="username-hint">Minimal 4 karakter, hanya huruf dan angka</span>
              </div>
              <div class="field">
                <label class="field-label" for="reg-city">Kota / Alamat</label>
                <textarea class="field-textarea" id="reg-city" name="city" rows="2"
                  placeholder="Jakarta, Bogor, Depok, Tangerang, Bekasi...">{{ old('city') }}</textarea>
                <span class="field-hint">Layanan tersedia di Jabodetabek, Bandung, Surabaya, Yogyakarta</span>
              </div>
            </div>
            <button type="button" class="btn-submit" onclick="regNext(1)">
              Lanjut <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>

          <!-- Step 2: Password -->
          <div id="reg-step-2" style="display:none">
            <div class="fields">
              <div class="field field-pw">
                <label class="field-label" for="reg-pw">Buat Password</label>
                <input class="field-input @error('password') error @enderror"
                       type="password" id="reg-pw" name="password"
                       placeholder="Minimal 8 karakter"
                       oninput="checkPwStrength(this)"/>
                <span class="pw-toggle" onclick="togglePw('reg-pw',this)">👁</span>
                <div class="pw-strength" id="pw-strength-wrap" style="display:none">
                  <div class="pw-strength-bars">
                    <div class="pw-bar" id="sb1"></div>
                    <div class="pw-bar" id="sb2"></div>
                    <div class="pw-bar" id="sb3"></div>
                    <div class="pw-bar" id="sb4"></div>
                  </div>
                  <span class="pw-strength-label" id="pw-strength-label">Lemah</span>
                </div>
              </div>
              <div class="field field-pw">
                <label class="field-label" for="reg-pw2">Konfirmasi Password</label>
                <input class="field-input" type="password" id="reg-pw2"
                       name="password_confirmation"
                       placeholder="Ulangi password" oninput="checkPwMatch(this)"/>
                <span class="pw-toggle" onclick="togglePw('reg-pw2',this)">👁</span>
                <span class="field-hint" id="pw-match-hint"></span>
              </div>
            </div>
            <div style="display:flex;gap:8px">
              <button type="button" class="btn-submit" style="background:var(--surface);color:var(--ink-2);box-shadow:none;flex:0 0 48px" onclick="regBack(2)">←</button>
              <button type="button" class="btn-submit" style="flex:1" onclick="regNext(2)">
                Lanjut <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </button>
            </div>
          </div>

          <!-- Step 3: Konfirmasi -->
          <div id="reg-step-3" style="display:none">
            <div class="check-row" style="margin-bottom:20px">
              <input type="checkbox" id="tos"/>
              <label class="check-label" for="tos">
                Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta
                <a href="#">Kebijakan Privasi</a> DigiLib
              </label>
            </div>
            <div style="display:flex;gap:8px">
              <button type="button" class="btn-submit" style="background:var(--surface);color:var(--ink-2);box-shadow:none;flex:0 0 48px" onclick="regBack(3)">←</button>
              <button type="button" class="btn-submit" style="flex:1" id="btn-register" onclick="handleRegister()">
                Buat Akun Gratis
              </button>
            </div>
          </div>

        </form>

        <div class="switch-prompt" style="margin-top:20px">
          Sudah punya akun?
          <a href="#" onclick="switchTab('login');return false">Masuk <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
/* ── Auto-switch ke register tab jika ada error register ── */
document.addEventListener('DOMContentLoaded', function() {
  @if (old('_form') === 'register')
    switchTab('register');
    // Kalau ada error, langsung tampilkan step yang punya masalah
    @if ($errors->has('password') || $errors->has('password_confirmation'))
      showRegStep(2);
    @else
      showRegStep(1);
    @endif
  @endif
});

/* ── Quotes Rotator ── */
const quotes = [
  { text: "Sebuah buku yang bagus adalah teman terbaik yang diam saat kamu sibuk, dan berbicara saat kamu butuh.", author: "— Pramoedya Ananta Toer" },
  { text: "Tidak ada teman yang setia selain buku, tidak ada guru yang sabar selain buku.", author: "— Ernest Hemingway" },
  { text: "Membaca memberi kita tempat untuk pergi saat kita harus tinggal di mana kita berada.", author: "— Mason Cooley" },
  { text: "Buku adalah jendela dunia, membaca adalah kuncinya.", author: "— Peribahasa" },
];
let qi = 0;
setInterval(() => {
  qi = (qi + 1) % quotes.length;
  const el = document.getElementById('quoteText');
  const au = document.getElementById('quoteAuthor');
  el.style.opacity = '0'; el.style.transform = 'translateY(8px)';
  au.style.opacity = '0';
  setTimeout(() => {
    el.textContent = quotes[qi].text;
    au.textContent = quotes[qi].author;
    el.style.transition = 'opacity .6s ease, transform .6s ease';
    el.style.opacity = '1'; el.style.transform = 'none';
    au.style.transition = 'opacity .6s .1s ease';
    au.style.opacity = '1';
  }, 400);
}, 6000);

/* ── Tab Switcher ── */
function switchTab(tab) {
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.form-panel').forEach(p => p.classList.remove('active'));
  document.getElementById('tab-' + tab).classList.add('active');
  document.getElementById('panel-' + tab).classList.add('active');
  if (tab === 'register') showRegStep(1);
}

/* ── Toast ── */
function showToast(msg, type = '') {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'toast' + (type ? ' ' + type : '');
  requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add('show')));
  setTimeout(() => t.classList.remove('show'), 3200);
}

/* ── Password Toggle ── */
function togglePw(id, btn) {
  const inp = document.getElementById(id);
  const showing = inp.type === 'text';
  inp.type = showing ? 'password' : 'text';
  btn.textContent = showing ? '👁' : '🙈';
}

/* ── Password Strength ── */
function checkPwStrength(inp) {
  const v = inp.value;
  const wrap = document.getElementById('pw-strength-wrap');
  const label = document.getElementById('pw-strength-label');
  const bars = ['sb1','sb2','sb3','sb4'].map(id => document.getElementById(id));
  if (!v) { wrap.style.display = 'none'; return; }
  wrap.style.display = 'block';
  let score = 0;
  if (v.length >= 8) score++;
  if (/[A-Z]/.test(v)) score++;
  if (/[0-9]/.test(v)) score++;
  if (/[^A-Za-z0-9]/.test(v)) score++;
  const cls = ['','weak','medium','medium','strong'];
  const labels = ['','Lemah','Sedang','Kuat','Sangat Kuat'];
  bars.forEach((b, i) => { b.className = 'pw-bar' + (i < score ? ' ' + cls[score] : ''); });
  label.textContent = labels[score] || 'Lemah';
  label.style.color = score <= 1 ? '#E74C3C' : score <= 2 ? '#F39C12' : '#1A6648';
}

/* ── Password Match ── */
function checkPwMatch(inp) {
  const pw = document.getElementById('reg-pw').value;
  const hint = document.getElementById('pw-match-hint');
  if (!inp.value) { hint.textContent = ''; inp.classList.remove('error','success'); return; }
  if (inp.value === pw) {
    hint.textContent = '✓ Password cocok'; hint.style.color = '#1A6648';
    inp.classList.add('success'); inp.classList.remove('error');
  } else {
    hint.textContent = 'Password tidak cocok'; hint.className = 'field-hint err';
    inp.classList.add('error'); inp.classList.remove('success');
  }
}

/* ── Username Check ── */
function checkUsername(inp) {
  const v = inp.value;
  const hint = document.getElementById('username-hint');
  const ok = /^[a-zA-Z0-9]{4,}$/.test(v);
  if (!v) {
    hint.textContent = 'Minimal 4 karakter, hanya huruf dan angka';
    hint.className = 'field-hint'; inp.classList.remove('error','success'); return;
  }
  if (ok) {
    hint.textContent = '✓ Format username valid'; hint.style.color = '#1A6648';
    inp.classList.add('success'); inp.classList.remove('error');
  } else {
    hint.textContent = 'Hanya huruf & angka, min. 4 karakter';
    hint.className = 'field-hint err'; inp.classList.add('error'); inp.classList.remove('success');
  }
}

/* ── Register Steps ── */
function showRegStep(n) {
  for (let i = 1; i <= 3; i++) {
    const el = document.getElementById('reg-step-' + i);
    if (el) el.style.display = i === n ? 'block' : 'none';
    const dot = document.getElementById('sdot-' + i);
    if (dot) dot.className = 'step-dot' + (i < n ? ' done' : '') + (i === n ? ' active' : '');
  }
}

function regNext(step) {
  if (step === 1) {
    const fn = document.getElementById('reg-fn').value.trim();
    const email = document.getElementById('reg-email').value.trim();
    const un = document.getElementById('reg-username').value.trim();
    const city = document.getElementById('reg-city').value.trim();
    if (!fn || !email || !un || !city) { showToast('⚠️ Lengkapi semua field'); return; }
    if (!email.includes('@')) { showToast('⚠️ Email tidak valid'); return; }
    if (!/^[a-zA-Z0-9]{4,}$/.test(un)) { showToast('⚠️ Username tidak valid'); return; }
    showRegStep(2);
  } else if (step === 2) {
    const pw = document.getElementById('reg-pw').value;
    const pw2 = document.getElementById('reg-pw2').value;
    if (pw.length < 8) { showToast('⚠️ Password minimal 8 karakter'); return; }
    if (pw !== pw2) { showToast('⚠️ Password tidak cocok'); return; }
    showRegStep(3);
  }
}

function regBack(step) { showRegStep(step - 1); }

/* ── Submit Register: gabungkan nama, lalu submit form sungguhan ── */
function handleRegister() {
  if (!document.getElementById('tos').checked) {
    showToast('⚠️ Setujui syarat & ketentuan terlebih dahulu');
    return;
  }
  const fn = document.getElementById('reg-fn').value.trim();
  const ln = document.getElementById('reg-ln').value.trim();
  const fullName = ln ? fn + ' ' + ln : fn;
  document.getElementById('reg-name-hidden').value = fullName;
  document.getElementById('reg-fn-hidden').value = fn;
  document.getElementById('reg-ln-hidden').value = document.getElementById('reg-ln').value.trim();

  const btn = document.getElementById('btn-register');
  btn.classList.add('loading');
  document.getElementById('form-register').submit();
}

/* ── Stagger book entrance ── */
document.querySelectorAll('.bs').forEach((b, i) => {
  b.style.opacity = '0';
  b.style.transform = 'translateY(30px)';
  b.style.transition = `opacity .5s ${.08*i+.3}s ease, transform .5s ${.08*i+.3}s ease`;
  requestAnimationFrame(() => requestAnimationFrame(() => {
    b.style.opacity = '1';
    b.style.transform = 'translateY(0)';
  }));
});
</script>
</body>
</html>
