<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Form Peminjaman — {{ $book->title }} — DigiLib</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
<style>

/* ─── TOKENS ─── */
:root{
  --green:      #1c6b46;
  --green-2:    #145235;
  --green-3:    #0b3021;
  --green-pale: #eaf3ee;
  --green-pale-2:#c4dfce;
  --green-mid:  rgba(28,107,70,.1);
  --white:      #ffffff;
  --off:        #f9f8f5;
  --surface:    #f2f0eb;
  --border:     #e4e2da;
  --border-2:   #c9c5ba;
  --ink:        #16140f;
  --ink-2:      #2d2a22;
  --muted:      #6a655b;
  --muted-2:    #a09a90;
  --accent:     #d04e1a;
  --teal:       #5db98a;
  --error:      #c0392b;
  --error-bg:   #fdf3f2;
}

*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{height:100%;-webkit-font-smoothing:antialiased;scroll-behavior:smooth}
body{
  min-height:100%;
  font-family:'DM Sans',system-ui,sans-serif;
  background:var(--off);
  color:var(--ink);
  -webkit-font-smoothing:antialiased;
}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none;background:none}
input,select,textarea{font-family:inherit}

/* ─── SHELL ─── */
.shell{
  display:grid;
  grid-template-columns:420px 1fr;
  min-height:100vh;
}

/* ═══════════════════════════════════════
   LEFT PANEL
═══════════════════════════════════════ */
.panel-left{
  background:var(--green-3);
  position:relative;
  overflow:hidden;
  display:flex;
  flex-direction:column;
  padding:44px 40px;
  gap:0;
}

/* grain */
.panel-left::before{
  content:'';position:absolute;inset:0;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='.04'/%3E%3C/svg%3E");
  pointer-events:none;z-index:0;opacity:.5;
}

/* orbs */
.orb{position:absolute;border-radius:50%;filter:blur(80px);pointer-events:none;z-index:0;animation:orbDrift 12s ease-in-out infinite}
.orb-1{width:380px;height:380px;background:rgba(26,102,72,.35);top:-120px;right:-100px;animation-delay:0s}
.orb-2{width:260px;height:260px;background:rgba(20,82,54,.4);bottom:-60px;left:-60px;animation-delay:-5s}
.orb-3{width:180px;height:180px;background:rgba(212,98,42,.1);top:45%;left:10%;animation-delay:-9s}
@keyframes orbDrift{
  0%,100%{transform:translate(0,0) scale(1)}
  33%{transform:translate(16px,-24px) scale(1.05)}
  66%{transform:translate(-12px,18px) scale(.95)}
}

.lc{position:relative;z-index:1;display:flex;flex-direction:column;height:100%}

/* brand */
.brand{display:flex;align-items:center;gap:10px;margin-bottom:44px}
.brand-mark{
  width:34px;height:34px;background:rgba(255,255,255,.1);
  border-radius:8px;display:flex;align-items:center;justify-content:center;
  border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(8px);
}
.brand-name{
  font-family:'Instrument Serif',serif;font-size:1.25rem;font-weight:400;
  color:rgba(255,255,255,.92);letter-spacing:-.015em;
}

/* book card */
.book-card{
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);
  border-radius:14px;
  padding:20px;
  display:flex;gap:16px;
  margin-bottom:28px;
  transition:background .2s;
}
.book-card:hover{background:rgba(255,255,255,.09)}
.book-cover{
  width:74px;height:108px;border-radius:7px;flex-shrink:0;
  background:linear-gradient(145deg,#1a6648 0%,#0a2a1a 100%);
  display:flex;flex-direction:column;justify-content:flex-end;padding:8px;
  box-shadow:4px 4px 18px rgba(0,0,0,.45),inset -2px 0 4px rgba(0,0,0,.2);
  position:relative;overflow:hidden;
}
.book-cover::after{
  content:'';position:absolute;right:0;top:0;bottom:0;width:3px;
  background:linear-gradient(to right,rgba(0,0,0,.18),rgba(255,255,255,.04));
}
.book-cover-lines{display:flex;flex-direction:column;gap:3px}
.book-cover-line{height:2px;border-radius:1px;background:rgba(255,255,255,.22)}
.book-cover-line:nth-child(1){width:80%}
.book-cover-line:nth-child(2){width:60%}
.book-cover-line:nth-child(3){width:70%;margin-top:4px;height:1px;background:rgba(255,255,255,.12)}

.book-info{flex:1;min-width:0}
.book-genre-tag{
  display:inline-flex;align-items:center;
  font-family:'Syne',sans-serif;font-size:.55rem;font-weight:700;
  letter-spacing:.08em;text-transform:uppercase;
  color:var(--teal);background:rgba(93,185,138,.12);
  border:1px solid rgba(93,185,138,.2);
  padding:3px 8px;border-radius:4px;
  margin-bottom:8px;
}
.book-title{
  font-family:'Instrument Serif',serif;font-size:1.05rem;font-weight:400;
  color:rgba(255,255,255,.92);line-height:1.25;margin-bottom:4px;
}
.book-author{font-size:.76rem;color:rgba(255,255,255,.42);margin-bottom:10px}
.book-meta-row{display:flex;gap:6px;flex-wrap:wrap}
.book-badge{
  font-family:'Syne',sans-serif;font-size:.55rem;font-weight:600;
  letter-spacing:.06em;text-transform:uppercase;
  padding:3px 8px;border-radius:4px;
  border:1px solid rgba(255,255,255,.1);
  color:rgba(255,255,255,.38);
}
.book-badge.avail{color:var(--teal);border-color:rgba(93,185,138,.22);background:rgba(93,185,138,.08)}

/* divider */
.ldivider{
  height:1px;background:rgba(255,255,255,.08);
  margin:0 0 24px;
}

/* rules */
.rules-title{
  font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;
  color:rgba(255,255,255,.28);margin-bottom:16px;
}
.rule-item{
  display:flex;gap:10px;align-items:flex-start;
  margin-bottom:13px;
}
.rule-icon{
  width:26px;height:26px;border-radius:7px;
  background:rgba(255,255,255,.07);
  border:1px solid rgba(255,255,255,.08);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;margin-top:1px;
  color:var(--teal);
}
.rule-text{flex:1}
.rule-label{font-size:.78rem;color:rgba(255,255,255,.72);font-weight:500;line-height:1.3}
.rule-sub{font-size:.7rem;color:rgba(255,255,255,.32);margin-top:2px;line-height:1.4}

/* bottom quote */
.left-quote{margin-top:auto;padding-top:28px}
.quote-mark{
  font-family:'Instrument Serif',serif;font-style:italic;
  font-size:4rem;color:rgba(255,255,255,.07);line-height:.7;
  display:block;margin-bottom:-14px;user-select:none;
}
.quote-text{
  font-family:'Instrument Serif',serif;font-style:italic;
  font-size:1.02rem;color:rgba(255,255,255,.55);
  line-height:1.6;letter-spacing:-.01em;
}

/* ═══════════════════════════════════════
   RIGHT PANEL
═══════════════════════════════════════ */
.panel-right{
  display:flex;flex-direction:column;
  padding:44px 52px;
  overflow-y:auto;
}

/* step nav top */
.step-nav{
  display:flex;align-items:center;gap:0;
  margin-bottom:44px;
}
.step-item{display:flex;align-items:center;gap:9px}
.step-dot{
  width:28px;height:28px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;
  transition:all .3s;flex-shrink:0;
}
.step-dot.done{background:var(--green);color:#fff}
.step-dot.active{background:var(--ink);color:#fff}
.step-dot.pending{background:var(--surface);color:var(--muted-2);border:1.5px solid var(--border)}
.step-label{
  font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;
  color:var(--muted-2);transition:color .3s;
  white-space:nowrap;
}
.step-item.active .step-label{color:var(--ink)}
.step-item.done .step-label{color:var(--green)}
.step-connector{
  height:1px;width:36px;background:var(--border);
  margin:0 6px;flex-shrink:0;
}
.step-connector.done{background:var(--green)}

/* back link */
.back-link{
  display:inline-flex;align-items:center;gap:6px;
  font-family:'Syne',sans-serif;font-size:.68rem;font-weight:600;
  letter-spacing:.04em;text-transform:uppercase;
  color:var(--muted);cursor:pointer;
  transition:color .15s;margin-left:auto;
}
.back-link:hover{color:var(--green)}

/* heading */
.form-heading{
  font-family:'Instrument Serif',serif;font-size:2.1rem;font-weight:400;
  color:var(--ink);letter-spacing:-.025em;line-height:1.1;
  margin-bottom:6px;
}
.form-heading em{font-style:italic;color:var(--muted-2)}
.form-sub{font-size:.84rem;color:var(--muted);line-height:1.6;margin-bottom:32px}

/* ─── FORM STEPS ─── */
.form-step{display:none}
.form-step.active{display:block}

/* field group */
.fgroup{margin-bottom:20px}
.flabel{
  display:block;
  font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;
  letter-spacing:.09em;text-transform:uppercase;
  color:var(--ink-2);margin-bottom:8px;
}
.flabel span{color:var(--muted-2);font-weight:400;text-transform:none;letter-spacing:0;font-size:.7rem}
.finput,.fselect,.ftextarea{
  width:100%;padding:12px 14px;
  background:var(--white);
  border:1.5px solid var(--border);
  border-radius:9px;
  font-size:.88rem;color:var(--ink);
  transition:border-color .15s,box-shadow .15s;
  outline:none;
  -webkit-appearance:none;appearance:none;
}
.finput:focus,.fselect:focus,.ftextarea:focus{
  border-color:var(--green);
  box-shadow:0 0 0 3px rgba(28,107,70,.1);
}
.finput.error,.fselect.error{
  border-color:var(--error);
  box-shadow:0 0 0 3px rgba(192,57,43,.08);
}
.finput.success,.fselect.success{
  border-color:var(--teal);
  box-shadow:0 0 0 3px rgba(93,185,138,.1);
}
.finput[readonly]{
  background:var(--surface);color:var(--muted);cursor:not-allowed;
}
.ftextarea{resize:none;height:88px;line-height:1.55}
.fselect{
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236a655b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  background-repeat:no-repeat;
  background-position:right 14px center;
  padding-right:38px;cursor:pointer;
}
.field-hint{font-size:.72rem;color:var(--muted);margin-top:5px;line-height:1.4}
.field-hint.err{color:var(--error)}

/* two col grid */
.fgrid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px}

/* date select row */
.date-row{display:flex;align-items:center;gap:12px}
.date-arrow{color:var(--muted-2);flex-shrink:0}

/* durasi presets */
.durasi-opts{display:flex;gap:8px;flex-wrap:wrap;margin-top:2px}
.dur-opt{
  padding:7px 16px;border-radius:7px;
  border:1.5px solid var(--border);
  font-family:'Syne',sans-serif;font-size:.68rem;font-weight:700;
  letter-spacing:.04em;text-transform:uppercase;
  color:var(--muted);cursor:pointer;
  transition:all .15s;
  user-select:none;
}
.dur-opt:hover{border-color:var(--green);color:var(--green);background:var(--green-pale)}
.dur-opt.active{border-color:var(--green);background:var(--green);color:#fff}

/* metode radio */
.method-opts{display:flex;flex-direction:column;gap:10px;margin-top:2px}
.method-opt{
  display:flex;align-items:center;gap:13px;
  padding:14px 16px;border-radius:10px;
  border:1.5px solid var(--border);
  cursor:pointer;transition:all .15s;
  user-select:none;
}
.method-opt:hover{border-color:var(--green-pale-2);background:var(--green-pale)}
.method-opt.active{border-color:var(--green);background:var(--green-pale)}
.method-radio{
  width:18px;height:18px;border-radius:50%;
  border:2px solid var(--border-2);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;transition:border-color .15s;
}
.method-opt.active .method-radio{border-color:var(--green)}
.method-radio-dot{
  width:8px;height:8px;border-radius:50%;background:var(--green);
  transform:scale(0);transition:transform .15s;
}
.method-opt.active .method-radio-dot{transform:scale(1)}
.method-icon{
  width:36px;height:36px;border-radius:8px;
  background:var(--surface);display:flex;align-items:center;justify-content:center;
  flex-shrink:0;color:var(--muted);transition:background .15s,color .15s;
}
.method-opt.active .method-icon{background:rgba(28,107,70,.12);color:var(--green)}
.method-text{flex:1}
.method-name{font-size:.84rem;font-weight:600;color:var(--ink-2);line-height:1.2}
.method-desc{font-size:.72rem;color:var(--muted);margin-top:2px}
.method-badge{
  font-family:'Syne',sans-serif;font-size:.55rem;font-weight:700;
  letter-spacing:.07em;text-transform:uppercase;
  padding:3px 8px;border-radius:4px;
  background:var(--green-pale);color:var(--green);
  border:1px solid var(--green-pale-2);
  flex-shrink:0;
}

/* section sub-heading */
.fsub{
  font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;
  letter-spacing:.1em;text-transform:uppercase;
  color:var(--muted-2);margin-bottom:14px;
  display:flex;align-items:center;gap:8px;
}
.fsub::after{content:'';flex:1;height:1px;background:var(--border)}

/* divider */
.fdivider{height:1px;background:var(--border);margin:24px 0}

/* btn primary */
.btn-primary{
  width:100%;padding:14px;border-radius:9px;
  background:var(--green);color:#fff;
  font-family:'Syne',sans-serif;font-size:.8rem;font-weight:700;
  letter-spacing:.05em;text-transform:uppercase;
  transition:all .18s;position:relative;overflow:hidden;
  display:flex;align-items:center;justify-content:center;gap:8px;
  margin-top:8px;
}
.btn-primary:hover{background:var(--green-2);transform:translateY(-1px);box-shadow:0 6px 20px rgba(28,107,70,.28)}
.btn-primary:active{transform:translateY(0)}
.btn-primary.loading{pointer-events:none;opacity:.7}
.btn-primary.loading::after{
  content:'';width:16px;height:16px;border-radius:50%;
  border:2px solid rgba(255,255,255,.35);border-top-color:#fff;
  animation:spin .7s linear infinite;position:absolute;
}
@keyframes spin{to{transform:rotate(360deg)}}

/* btn ghost */
.btn-ghost{
  width:100%;padding:12px;border-radius:9px;
  background:transparent;color:var(--muted);
  font-family:'Syne',sans-serif;font-size:.75rem;font-weight:600;
  letter-spacing:.04em;text-transform:uppercase;
  border:1.5px solid var(--border);
  transition:all .15s;
  display:flex;align-items:center;justify-content:center;gap:7px;
  margin-top:8px;
}
.btn-ghost:hover{border-color:var(--ink-2);color:var(--ink-2)}

/* ═══════════════════════════════════════
   STEP 2 — KONFIRMASI
═══════════════════════════════════════ */
.confirm-card{
  background:var(--surface);border:1.5px solid var(--border);
  border-radius:12px;overflow:hidden;margin-bottom:20px;
}
.confirm-header{
  padding:16px 20px;
  border-bottom:1px solid var(--border);
  background:var(--white);
  display:flex;align-items:center;justify-content:space-between;
}
.confirm-header-title{
  font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;
  letter-spacing:.1em;text-transform:uppercase;color:var(--muted-2);
}
.confirm-edit{
  font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--green);
  cursor:pointer;transition:color .15s;
}
.confirm-edit:hover{color:var(--green-2)}
.confirm-body{padding:18px 20px;display:flex;flex-direction:column;gap:12px}
.confirm-row{display:flex;align-items:flex-start;justify-content:space-between;gap:10px}
.confirm-key{
  font-size:.76rem;color:var(--muted);min-width:120px;padding-top:1px;
}
.confirm-val{
  font-size:.82rem;color:var(--ink-2);font-weight:500;text-align:right;flex:1;line-height:1.4;
}
.confirm-val.highlight{color:var(--green);font-weight:600}

/* denda info */
.denda-box{
  display:flex;gap:12px;align-items:flex-start;
  background:rgba(208,78,26,.05);border:1px solid rgba(208,78,26,.14);
  border-radius:9px;padding:13px 15px;margin-bottom:20px;
}
.denda-icon{color:var(--accent);flex-shrink:0;margin-top:2px}
.denda-text p:first-child{font-size:.78rem;font-weight:600;color:var(--accent);margin-bottom:3px}
.denda-text p:last-child{font-size:.72rem;color:var(--muted);line-height:1.5}

/* tos checkbox */
.tos-wrap{display:flex;align-items:flex-start;gap:11px;margin-bottom:4px}
.tos-check{
  width:18px;height:18px;border-radius:5px;
  border:1.5px solid var(--border-2);
  background:var(--white);flex-shrink:0;
  cursor:pointer;display:flex;align-items:center;justify-content:center;
  transition:all .15s;margin-top:1px;
}
.tos-check.checked{background:var(--green);border-color:var(--green)}
.tos-label{font-size:.78rem;color:var(--muted);line-height:1.55;cursor:pointer}
.tos-label a{color:var(--green);font-weight:500}
.tos-label a:hover{text-decoration:underline}

/* ═══════════════════════════════════════
   STEP 3 — SUCCESS
═══════════════════════════════════════ */
.success-wrap{
  display:flex;flex-direction:column;align-items:center;
  text-align:center;padding:32px 0;
}
.success-icon{
  width:80px;height:80px;border-radius:50%;
  background:var(--green-pale);border:2px solid var(--green-pale-2);
  display:flex;align-items:center;justify-content:center;
  color:var(--green);margin-bottom:24px;
  animation:popIn .5s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes popIn{from{transform:scale(0);opacity:0}to{transform:scale(1);opacity:1}}

.success-title{
  font-family:'Instrument Serif',serif;font-size:2rem;font-weight:400;
  color:var(--ink);letter-spacing:-.02em;margin-bottom:8px;
}
.success-sub{font-size:.84rem;color:var(--muted);line-height:1.65;max-width:380px;margin-bottom:32px}

.success-code-wrap{
  background:var(--surface);border:1.5px solid var(--border);
  border-radius:10px;padding:18px 24px;margin-bottom:28px;width:100%;max-width:360px;
}
.success-code-label{
  font-family:'Syne',sans-serif;font-size:.58rem;font-weight:700;
  letter-spacing:.1em;text-transform:uppercase;color:var(--muted-2);margin-bottom:8px;
}
.success-code{
  font-family:'Instrument Serif',serif;font-size:2rem;
  color:var(--ink);letter-spacing:.05em;line-height:1;
}

.success-steps{
  display:flex;flex-direction:column;gap:10px;
  width:100%;max-width:360px;margin-bottom:32px;
  text-align:left;
}
.sstep{display:flex;gap:12px;align-items:flex-start}
.sstep-num{
  width:24px;height:24px;border-radius:50%;
  background:var(--green);color:#fff;
  font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
  margin-top:1px;
}
.sstep-text{font-size:.8rem;color:var(--muted);line-height:1.5}
.sstep-text strong{color:var(--ink-2)}

.btn-home{
  padding:13px 28px;border-radius:9px;
  background:var(--green);color:#fff;
  font-family:'Syne',sans-serif;font-size:.78rem;font-weight:700;
  letter-spacing:.05em;text-transform:uppercase;
  transition:all .18s;display:inline-flex;align-items:center;gap:8px;
}
.btn-home:hover{background:var(--green-2);transform:translateY(-1px);box-shadow:0 6px 20px rgba(28,107,70,.28)}

/* ─── TOAST ─── */
.toast{
  position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(20px);
  background:var(--ink);color:#f4f1ea;
  font-size:.8rem;font-weight:500;
  padding:11px 18px;border-radius:8px;
  display:flex;align-items:center;gap:8px;
  z-index:9999;opacity:0;
  transition:opacity .25s,transform .25s;
  pointer-events:none;white-space:nowrap;
  box-shadow:0 4px 20px rgba(0,0,0,.18);
}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.toast.success-toast{background:var(--green)}
.toast.err-toast{background:var(--error)}

/* ─── RESPONSIVE ─── */
@media(max-width:900px){
  .shell{grid-template-columns:1fr}
  .panel-left{display:none}
  .panel-right{padding:32px 24px}
  .step-connector{width:22px}
  .fgrid-2{grid-template-columns:1fr}
}
@media(max-width:480px){
  .panel-right{padding:24px 16px}
  .form-heading{font-size:1.7rem}
  .method-badge{display:none}
}

/* entrance animations */
.fade-in{animation:fadeUp .45s ease both}
@keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:none}}
.fade-in-d1{animation-delay:.08s}
.fade-in-d2{animation-delay:.16s}
.fade-in-d3{animation-delay:.24s}
.fade-in-d4{animation-delay:.32s}
.fade-in-d5{animation-delay:.40s}
</style>
</head>
<body>

<!-- ─── TOAST ─── -->
<div class="toast" id="toast"></div>

{{-- Hidden form untuk submit ke server --}}
<form id="borrowForm" method="POST" action="{{ route('user.borrow.store') }}" style="display:none">
  @csrf
  <input type="hidden" name="book_id"      value="{{ $book->id }}">
  <input type="hidden" name="borrow_date"  id="hidden-ambil">
  <input type="hidden" name="return_date"  id="hidden-kembali">
  <input type="hidden" name="condition"    value="normal">
</form>

<div class="shell">

  <!-- ═══════════════════════════════════════
       LEFT PANEL
  ═══════════════════════════════════════ -->
  <aside class="panel-left">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="lc">

      <!-- brand -->
      <div class="brand">
        <div class="brand-mark">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.85)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
        </div>
        <span class="brand-name">DigiLib</span>
      </div>

      <!-- book card — data dari $book -->
      <div class="book-card">
        <div class="book-cover">
          <div class="book-cover-lines">
            <div class="book-cover-line"></div>
            <div class="book-cover-line"></div>
            <div class="book-cover-line"></div>
          </div>
        </div>
        <div class="book-info">
          <div class="book-genre-tag">{{ $book->category->name ?? 'Umum' }}</div>
          <div class="book-title">{{ $book->title }}</div>
          <div class="book-author">{{ $book->author }}</div>
          <div class="book-meta-row">
            <div class="book-badge avail">Tersedia</div>
            @if($book->publish_date)
              <div class="book-badge">{{ $book->publish_date->format('Y') }}</div>
            @endif
            @if($book->pages)
              <div class="book-badge">{{ $book->pages }} hal</div>
            @endif
          </div>
        </div>
      </div>

      <div class="ldivider"></div>

      <!-- rules -->
      <div class="rules-title">Peraturan Peminjaman</div>

      <div class="rule-item">
        <div class="rule-icon">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div class="rule-text">
          <div class="rule-label">Durasi Pinjam</div>
          <div class="rule-sub">Maksimal 14 hari per peminjaman</div>
        </div>
      </div>

      <div class="rule-item">
        <div class="rule-icon">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div class="rule-text">
          <div class="rule-label">Batas Ambil</div>
          <div class="rule-sub">Buku harus diambil dalam 3 hari setelah pemesanan</div>
        </div>
      </div>

      <div class="rule-item">
        <div class="rule-icon">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <div class="rule-text">
          <div class="rule-label">Denda Keterlambatan</div>
          <div class="rule-sub">Rp 2.000 per hari setelah jatuh tempo</div>
        </div>
      </div>

      <div class="rule-item">
        <div class="rule-icon">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div class="rule-text">
          <div class="rule-label">Batas Pinjaman Aktif</div>
          <div class="rule-sub">Maks. 3 buku dipinjam secara bersamaan</div>
        </div>
      </div>

      <div class="rule-item">
        <div class="rule-icon">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div class="rule-text">
          <div class="rule-label">Perpanjangan</div>
          <div class="rule-sub">1x perpanjangan maks. 7 hari (via aplikasi)</div>
        </div>
      </div>

      <!-- quote -->
      <div class="left-quote">
        <span class="quote-mark">"</span>
        <p class="quote-text">Membaca adalah berdialog dengan jiwa para penulis dari seluruh masa.</p>
      </div>

    </div><!-- /lc -->
  </aside>

  <!-- ═══════════════════════════════════════
       RIGHT PANEL
  ═══════════════════════════════════════ -->
  <main class="panel-right" id="panelRight">

    <!-- step nav -->
    <div class="step-nav fade-in">
      <div class="step-item active" id="sitem-1">
        <div class="step-dot active" id="sdot-1">1</div>
        <span class="step-label">Detail</span>
      </div>
      <div class="step-connector" id="sconn-1"></div>
      <div class="step-item" id="sitem-2">
        <div class="step-dot pending" id="sdot-2">2</div>
        <span class="step-label">Konfirmasi</span>
      </div>
      <div class="step-connector" id="sconn-2"></div>
      <div class="step-item" id="sitem-3">
        <div class="step-dot pending" id="sdot-3">3</div>
        <span class="step-label">Selesai</span>
      </div>
      <a class="back-link" href="{{ route('user.books.show', $book) }}">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
      </a>
    </div>

    <!-- ─── STEP 1: DETAIL PEMINJAMAN ─── -->
    <div class="form-step active" id="step-1">
      <h1 class="form-heading fade-in fade-in-d1">Form <em>Peminjaman</em></h1>
      <p class="form-sub fade-in fade-in-d2">Lengkapi detail peminjaman di bawah. Buku akan siap diambil sesuai tanggal yang kamu pilih.</p>

      <!-- Informasi Buku -->
      <div class="fsub fade-in fade-in-d2">Buku yang Dipinjam</div>

      <div class="fgroup fade-in fade-in-d2">
        <label class="flabel">Judul Buku</label>
        <input class="finput" id="inp-judul" type="text" value="{{ $book->title }}" readonly/>
      </div>

      <!-- Informasi Peminjam -->
      <div class="fsub fade-in fade-in-d3">Informasi Peminjam</div>

      <div class="fgroup fade-in fade-in-d3">
        <label class="flabel">Nama Lengkap</label>
        <input class="finput" id="inp-nama" type="text" value="{{ auth()->user()->name }}" readonly/>
      </div>

      <!-- Tanggal -->
      <div class="fsub fade-in fade-in-d3">Tanggal Peminjaman</div>

      <div class="fgrid-2 fade-in fade-in-d3">
        <div class="fgroup">
          <label class="flabel">Tanggal Ambil</label>
          <input class="finput" id="inp-ambil" type="date"/>
          <p class="field-hint" id="hint-ambil">Pilih tanggal dalam 5 hari ke depan</p>
        </div>
        <div class="fgroup">
          <label class="flabel">Tanggal Kembali</label>
          <input class="finput" id="inp-kembali" type="date" readonly/>
          <p class="field-hint">Dihitung otomatis dari durasi</p>
        </div>
      </div>

      <div class="fgroup fade-in fade-in-d3">
        <label class="flabel">Durasi Pinjam</label>
        <div class="durasi-opts" id="durasiOpts">
          <div class="dur-opt" data-val="7">7 Hari</div>
          <div class="dur-opt active" data-val="14">14 Hari</div>
        </div>
        <p class="field-hint" id="hint-durasi">Durasi maksimal 14 hari</p>
      </div>

      <!-- Catatan -->
      <div class="fsub fade-in fade-in-d4">Catatan <span style="font-weight:400;text-transform:none;letter-spacing:0;font-size:.7rem;color:var(--muted-2)">(opsional)</span></div>

      <div class="fgroup fade-in fade-in-d4">
        <label class="flabel">Catatan untuk Petugas <span>(opsional)</span></label>
        <textarea class="ftextarea" id="inp-catatan" placeholder="Contoh: Mohon hubungi saya sehari sebelum buku siap diambil…"></textarea>
      </div>

      <button class="btn-primary fade-in fade-in-d5" onclick="goStep2()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        Lanjut ke Konfirmasi
      </button>
    </div>

    <!-- ─── STEP 2: KONFIRMASI ─── -->
    <div class="form-step" id="step-2">
      <h1 class="form-heading">Konfirmasi <em>Peminjaman</em></h1>
      <p class="form-sub">Pastikan semua detail sudah benar sebelum mengajukan peminjaman.</p>

      <!-- ringkasan -->
      <div class="confirm-card">
        <div class="confirm-header">
          <span class="confirm-header-title">Ringkasan Peminjaman</span>
          <span class="confirm-edit" onclick="goStep1()">Ubah Detail</span>
        </div>
        <div class="confirm-body">
          <div class="confirm-row">
            <span class="confirm-key">Buku</span>
            <span class="confirm-val" id="cv-judul">—</span>
          </div>
          <div class="confirm-row">
            <span class="confirm-key">Peminjam</span>
            <span class="confirm-val" id="cv-nama">—</span>
          </div>
          <div class="confirm-row">
            <span class="confirm-key">Tanggal Ambil</span>
            <span class="confirm-val highlight" id="cv-ambil">—</span>
          </div>
          <div class="confirm-row">
            <span class="confirm-key">Tanggal Kembali</span>
            <span class="confirm-val highlight" id="cv-kembali">—</span>
          </div>
          <div class="confirm-row">
            <span class="confirm-key">Durasi</span>
            <span class="confirm-val" id="cv-durasi">—</span>
          </div>
          <div class="confirm-row" id="cv-catatan-row" style="display:none">
            <span class="confirm-key">Catatan</span>
            <span class="confirm-val" id="cv-catatan">—</span>
          </div>
        </div>
      </div>

      <!-- denda warning -->
      <div class="denda-box">
        <div class="denda-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="denda-text">
          <p>Perhatian: Denda Keterlambatan</p>
          <p>Terlambat mengembalikan buku akan dikenakan denda <strong>Rp 2.000 per hari</strong>. Kamu akan mendapat notifikasi email H-3 dan H-1 sebelum jatuh tempo.</p>
        </div>
      </div>

      <!-- tos -->
      <div class="tos-wrap" id="tosWrap">
        <div class="tos-check" id="tosCheck" onclick="toggleTos()"></div>
        <p class="tos-label" onclick="toggleTos()">Saya menyatakan telah membaca dan menyetujui <a href="#">Syarat & Ketentuan Peminjaman</a> DigiLib, serta bersedia menerima konsekuensi denda apabila terlambat mengembalikan buku.</p>
      </div>

      <button class="btn-primary" id="btnSubmit" onclick="handleSubmit()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        Ajukan Peminjaman
      </button>
      <button class="btn-ghost" onclick="goStep1()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali & Ubah
      </button>
    </div>

    <!-- ─── STEP 3: SUCCESS ─── -->
    <div class="form-step" id="step-3">
      <div class="success-wrap">
        <div class="success-icon">
          <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h1 class="success-title">Peminjaman Diajukan!</h1>
        <p class="success-sub">Permintaanmu sudah kami terima. Konfirmasi akan dikirim ke email kamu dalam beberapa menit.</p>

        <div class="success-code-wrap">
          <div class="success-code-label">Kode Peminjaman</div>
          <div class="success-code" id="successCode">
            {{-- Kode dari server jika tersedia, fallback ke placeholder --}}
            {{ session('kode_peminjaman', 'DGL-' . date('Y') . '-XXXX') }}
          </div>
        </div>

        <div class="success-steps">
          <div class="sstep">
            <div class="sstep-num">1</div>
            <p class="sstep-text"><strong>Cek email</strong> — Konfirmasi dan detail peminjaman sudah dikirim ke emailmu.</p>
          </div>
          <div class="sstep">
            <div class="sstep-num">2</div>
            <p class="sstep-text"><strong>Siapkan KTP / kartu pelajar</strong> saat mengambil buku di perpustakaan.</p>
          </div>
          <div class="sstep">
            <div class="sstep-num">3</div>
            <p class="sstep-text"><strong>Kembalikan tepat waktu</strong> — Kamu akan mendapat notifikasi H-3 sebelum jatuh tempo.</p>
          </div>
        </div>

        <a href="{{ route('user.books.index') }}" class="btn-home">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Kembali ke Beranda
        </a>
      </div>
    </div>

  </main>
</div>

<script>
/* ─── STATE ─── */
let currentStep = 1;
let selectedDurasi = 14;
let tosChecked = false;

/* ─── TOAST ─── */
function showToast(msg, type='') {
  const t = document.getElementById('toast');
  t.innerHTML = msg;
  t.className = 'toast' + (type ? ' '+type : '');
  requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add('show')));
  setTimeout(() => t.classList.remove('show'), 3200);
}

/* ─── DATE HELPERS ─── */
function formatDateID(dateStr) {
  if(!dateStr) return '—';
  const d = new Date(dateStr);
  const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
  const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  return `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

function addDays(dateStr, days) {
  const d = new Date(dateStr);
  d.setDate(d.getDate() + days);
  return d.toISOString().split('T')[0];
}

function toInputDate(d) {
  return d.toISOString().split('T')[0];
}

/* ─── INIT DATES ─── */
(function initDates(){
  const today = new Date();
  const maxAmbil = new Date(today);
  maxAmbil.setDate(today.getDate() + 5);

  const inp = document.getElementById('inp-ambil');
  inp.min = toInputDate(today);
  inp.max = toInputDate(maxAmbil);
  inp.value = toInputDate(today);

  updateReturnDate();
})();

function updateReturnDate() {
  const ambil = document.getElementById('inp-ambil').value;
  if(!ambil) return;
  const kembali = addDays(ambil, selectedDurasi);
  document.getElementById('inp-kembali').value = kembali;
}

document.getElementById('inp-ambil').addEventListener('change', updateReturnDate);

/* ─── DURASI ─── */
document.querySelectorAll('.dur-opt').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.dur-opt').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    selectedDurasi = parseInt(btn.dataset.val);
    updateReturnDate();
  });
});

/* ─── TOS ─── */
function toggleTos() {
  tosChecked = !tosChecked;
  const el = document.getElementById('tosCheck');
  if(tosChecked) {
    el.classList.add('checked');
    el.innerHTML = `<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>`;
  } else {
    el.classList.remove('checked');
    el.innerHTML = '';
  }
}

/* ─── STEP NAVIGATION ─── */
function setStep(n) {
  for(let i=1;i<=3;i++){
    const step = document.getElementById('step-'+i);
    const dot  = document.getElementById('sdot-'+i);
    const item = document.getElementById('sitem-'+i);
    step.classList.toggle('active', i===n);
    dot.classList.remove('active','done','pending');
    item.classList.remove('active','done');
    if(i < n){ dot.classList.add('done'); item.classList.add('done'); }
    else if(i === n){ dot.classList.add('active'); item.classList.add('active'); }
    else { dot.classList.add('pending'); }
  }
  for(let i=1;i<=2;i++){
    const conn = document.getElementById('sconn-'+i);
    conn.classList.toggle('done', i < n);
  }
  currentStep = n;
  document.getElementById('panelRight').scrollTo({top:0, behavior:'smooth'});
}

function goStep1(){ setStep(1); }

function goStep2() {
  const ambil = document.getElementById('inp-ambil').value;
  if(!ambil){ showToast('⚠ Pilih tanggal pengambilan buku','err-toast'); return; }

  document.getElementById('cv-judul').textContent   = document.getElementById('inp-judul').value;
  document.getElementById('cv-nama').textContent    = document.getElementById('inp-nama').value;
  document.getElementById('cv-ambil').textContent   = formatDateID(ambil);
  document.getElementById('cv-kembali').textContent = formatDateID(document.getElementById('inp-kembali').value);
  document.getElementById('cv-durasi').textContent  = selectedDurasi + ' hari';

  const catatan = document.getElementById('inp-catatan').value.trim();
  const catatanRow = document.getElementById('cv-catatan-row');
  if(catatan){ catatanRow.style.display=''; document.getElementById('cv-catatan').textContent=catatan; }
  else { catatanRow.style.display='none'; }

  setStep(2);
}

function handleSubmit() {
  if(!tosChecked){
    showToast('⚠ Centang persetujuan syarat & ketentuan dahulu','err-toast');
    return;
  }

  /* Isi hidden fields lalu submit form ke server */
  document.getElementById('hidden-ambil').value     = document.getElementById('inp-ambil').value;
  document.getElementById('hidden-kembali').value   = document.getElementById('inp-kembali').value;

  const btn = document.getElementById('btnSubmit');
  btn.classList.add('loading');
  btn.textContent = '';

  document.getElementById('borrowForm').submit();
}

/* ─── Tampilkan step 3 jika server redirect dengan session success ─── */
@if(session('success'))
  document.addEventListener('DOMContentLoaded', () => {
    setStep(3);
    showToast('✓ Peminjaman berhasil diajukan!', 'success-toast');
  });
@endif

@if(session('error'))
  document.addEventListener('DOMContentLoaded', () => {
    showToast('⚠ {{ addslashes(session('error')) }}', 'err-toast');
  });
@endif
</script>
</body>
</html>
