@extends('layouts.app')
@section('title', 'Profil Saya')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
<style>
:root{
  --ink:#16140f;--ink-2:#2d2a22;--muted:#6a655b;--muted-2:#a09a90;
  --bg:#f9f8f5;--surface:#f2f0eb;--border:#e4e2da;--border-2:#c9c5ba;
  --white:#ffffff;--green:#1c6b46;--green-dark:#145235;
  --green-pale:#eaf3ee;--green-pale-2:#c4dfce;--green-mid:rgba(28,107,70,.1);
  --accent:#d04e1a;--accent-pale:rgba(208,78,26,.09);
  --yellow:#e6a817;--red:#c0392b;--red-pale:rgba(192,57,43,.08);
  --amber:#a07010;--amber-pale:rgba(230,168,23,.1);--amber-border:rgba(230,168,23,.25);
  --blue:#1565c0;--blue-pale:#e3f2fd;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
body{background:var(--bg);color:var(--ink);font-family:'DM Sans',system-ui,sans-serif;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none;background:none}
.page{max-width:1240px;margin:0 auto;padding:0 28px 80px}

/* ── HERO ── */
.profile-hero{margin:28px 0 24px;border-radius:16px;overflow:hidden}
.hero-cover{height:160px;background:linear-gradient(135deg,#061a0f 0%,#123d28 55%,#0a2d1e 100%);position:relative;overflow:hidden}
.hero-cover::before{content:'';position:absolute;inset:0;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='250' height='250'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='250' height='250' filter='url(%23n)' opacity='.04'/%3E%3C/svg%3E");background-size:250px;pointer-events:none}
.orb{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;animation:orbDrift 12s ease-in-out infinite}
.orb-1{width:280px;height:280px;background:rgba(28,107,70,.3);top:-80px;right:8%}
.orb-2{width:180px;height:180px;background:rgba(208,78,26,.12);top:10%;left:12%;animation-delay:-5s}
@keyframes orbDrift{0%,100%{transform:translate(0,0)}33%{transform:translate(18px,-18px)}66%{transform:translate(-10px,14px)}}
.cover-wm{position:absolute;inset:0;display:flex;align-items:center;justify-content:flex-end;padding-right:32px;opacity:.04;font-family:'Instrument Serif',serif;font-style:italic;font-size:90px;color:#fff;pointer-events:none}
.identity-bar{background:var(--white);border:1px solid var(--border);padding:0 28px 22px;display:flex;align-items:flex-end;gap:20px}
.av-wrap{position:relative;margin-top:-44px;flex-shrink:0;z-index:2}
.profile-av{width:88px;height:88px;border-radius:50%;background:linear-gradient(140deg,var(--green),var(--green-dark));border:4px solid var(--white);box-shadow:0 4px 16px rgba(28,107,70,.25);display:flex;align-items:center;justify-content:center;overflow:hidden;object-fit:cover}
.av-init{font-family:'Instrument Serif',serif;font-size:2rem;font-style:italic;color:rgba(255,255,255,.92)}
.av-cam{position:absolute;bottom:2px;right:2px;width:24px;height:24px;border-radius:50%;background:var(--white);border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--muted);transition:all .15s}
.av-cam:hover{border-color:var(--green);color:var(--green)}
.profile-info{flex:1;min-width:0;padding-top:14px}
.profile-name{font-family:'Instrument Serif',serif;font-size:1.65rem;color:var(--ink);letter-spacing:-.03em;line-height:1.1;margin-bottom:6px}
.profile-tags{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.ptag{display:inline-flex;align-items:center;gap:4px;font-family:'Syne',sans-serif;font-size:.57rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:3px 9px;border-radius:5px}
.ptag-role{background:var(--green-pale);color:var(--green)}
.ptag-since{font-size:.73rem;color:var(--muted-2);display:flex;align-items:center;gap:4px}
.profile-actions{display:flex;align-items:flex-end;gap:8px;padding-top:14px;flex-shrink:0}
.btn-primary{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--green);color:#fff;padding:9px 18px;border-radius:8px;cursor:pointer;transition:all .2s;box-shadow:0 1px 3px rgba(28,107,70,.25),0 4px 12px rgba(28,107,70,.18);border:none}
.btn-primary:hover{background:var(--green-dark);transform:translateY(-1px)}
.stat-bar{background:var(--white);border:1px solid var(--border);border-top:none;display:grid;grid-template-columns:repeat(4,1fr);border-radius:0 0 16px 16px;overflow:hidden}
.sbar{padding:16px 18px;border-right:1px solid var(--border);display:flex;flex-direction:column;gap:2px;transition:background .12s;cursor:default}
.sbar:last-child{border-right:none}
.sbar:hover{background:var(--surface)}
.sbar-n{font-family:'Instrument Serif',serif;font-size:1.5rem;color:var(--green);letter-spacing:-.04em;line-height:1}
.sbar-n.warn{color:var(--accent)}
.sbar-n.muted{color:var(--muted-2)}
.sbar-label{font-family:'Syne',sans-serif;font-size:.55rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--muted)}
.sbar-sub{font-size:.67rem;color:var(--muted-2);margin-top:1px}

/* ── MAIN GRID ── */
.main-grid{display:grid;grid-template-columns:210px 1fr;gap:22px;align-items:start}
.sidebar{display:flex;flex-direction:column;gap:14px;position:sticky;top:80px}
.scard{background:var(--white);border:1px solid var(--border);border-radius:12px;overflow:hidden}
.scard-head{padding:13px 16px 11px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.scard-title{font-family:'Syne',sans-serif;font-size:.63rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--muted)}
.status-card{padding:12px 0}
.sc-row{display:flex;align-items:center;justify-content:space-between;padding:8px 16px;border-bottom:1px solid var(--border)}
.sc-row:last-child{border-bottom:none}
.sc-label{font-size:.78rem;color:var(--muted);display:flex;align-items:center;gap:7px}
.sc-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}
.dot-dipinjam{background:var(--green)}
.dot-menunggu{background:var(--yellow)}
.dot-kembali{background:var(--muted-2)}
.sc-count{font-family:'Instrument Serif',serif;font-size:1.1rem;color:var(--ink);letter-spacing:-.03em}
.info-list{padding:4px 0}
.info-item{display:flex;align-items:center;gap:12px;padding:10px 16px;border-bottom:1px solid var(--border);transition:background .12s}
.info-item:last-child{border-bottom:none}
.info-item:hover{background:var(--surface)}
.info-icon{width:28px;height:28px;border-radius:6px;background:var(--surface);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);flex-shrink:0}
.info-content{flex:1;min-width:0}
.info-lbl{font-family:'Syne',sans-serif;font-size:.56rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--muted-2)}
.info-val{font-size:.79rem;font-weight:500;color:var(--ink);margin-top:1px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}

/* ── TABS ── */
.tab-nav{display:flex;align-items:center;background:var(--white);border:1px solid var(--border);border-radius:12px 12px 0 0;border-bottom:none;padding:6px 6px 0;overflow-x:auto;scrollbar-width:none}
.tab-nav::-webkit-scrollbar{display:none}
.titem{font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:var(--muted-2);padding:9px 14px;border-radius:8px 8px 0 0;cursor:pointer;white-space:nowrap;border-bottom:2.5px solid transparent;transition:color .15s,background .15s;display:flex;align-items:center;gap:6px}
.titem:hover{color:var(--ink);background:var(--surface)}
.titem.active{color:var(--green);border-bottom-color:var(--green);background:var(--green-pale)}
.tbadge{font-family:'Syne',sans-serif;font-size:.5rem;font-weight:700;padding:2px 6px;border-radius:4px;background:var(--surface);color:var(--muted-2)}
.titem.active .tbadge{background:rgba(28,107,70,.15);color:var(--green)}
.tbadge.warn{background:rgba(208,78,26,.1);color:var(--accent)}
.tab-panels{background:var(--white);border:1px solid var(--border);border-radius:0 0 12px 12px;min-height:380px}
.panel{display:none;animation:fadeUp .3s ease both}
.panel.active{display:block}
@keyframes fadeUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

/* ── LOAN ITEMS ── */
.loan-list{padding:2px 0}
.loan-item{display:flex;gap:16px;padding:18px 22px;border-bottom:1px solid var(--border);transition:background .12s}
.loan-item:last-child{border-bottom:none}
.loan-item:hover{background:var(--surface)}
.book-cover{width:50px;height:70px;border-radius:6px;flex-shrink:0;overflow:hidden;box-shadow:2px 3px 10px rgba(0,0,0,.12)}
.book-cover img{width:100%;height:100%;object-fit:cover}
.loan-body{flex:1;min-width:0}
.loan-top{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:3px}
.loan-title{font-size:.88rem;font-weight:600;color:var(--ink);line-height:1.25}
.loan-author{font-size:.73rem;color:var(--muted);margin-bottom:10px}
.sbadge{font-family:'Syne',sans-serif;font-size:.54rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:4px 9px;border-radius:5px;flex-shrink:0;white-space:nowrap;display:inline-flex;align-items:center;gap:4px}
.s-menunggu{background:var(--amber-pale);color:var(--amber);border:1px solid var(--amber-border)}
.s-dipinjam{background:var(--green-pale);color:var(--green);border:1px solid var(--green-pale-2)}
.s-kembali{background:var(--surface);color:var(--muted);border:1px solid var(--border)}
.s-returning{background:var(--accent-pale);color:var(--accent);border:1px solid rgba(208,78,26,.2)}
.loan-meta{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:10px}
.lmeta{font-size:.71rem;color:var(--muted-2);display:flex;align-items:center;gap:4px}
.lmeta.warn{color:var(--accent);font-weight:500}
.prog-wrap{margin-bottom:10px}
.prog-header{display:flex;justify-content:space-between;margin-bottom:4px}
.prog-label{font-family:'Syne',sans-serif;font-size:.57rem;font-weight:700;letter-spacing:.03em;text-transform:uppercase;color:var(--muted-2)}
.prog-track{height:5px;background:var(--border);border-radius:99px;overflow:hidden}
.prog-fill{height:100%;border-radius:99px;transition:width 1s cubic-bezier(.4,0,.2,1)}
.fill-ok{background:var(--green)}
.fill-warn{background:var(--accent)}
.loan-actions{display:flex;gap:8px;flex-wrap:wrap}
.abtn{display:inline-flex;align-items:center;gap:5px;font-family:'Syne',sans-serif;font-size:.61rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:7px 12px;border-radius:7px;cursor:pointer;transition:all .15s;border:none}
.abtn-green{background:var(--green);color:#fff}
.abtn-green:hover{background:var(--green-dark)}
.abtn-outline{color:var(--ink-2);border:1.5px solid var(--border);background:transparent}
.abtn-outline:hover{border-color:var(--border-2);background:var(--surface)}
.abtn-disabled{background:var(--surface);color:var(--muted-2);border:1.5px solid var(--border);cursor:not-allowed}
.pending-notice{display:flex;align-items:flex-start;gap:8px;padding:8px 12px;border-radius:8px;background:var(--amber-pale);border:1px solid var(--amber-border);font-size:.74rem;color:var(--amber);margin-bottom:10px}

/* ── EMPTY SLOTS ── */
.empty-slot{display:flex;gap:16px;padding:16px 22px;background:var(--surface);border-bottom:1px solid var(--border);align-items:center;opacity:.6}
.empty-slot:last-child{border-bottom:none}
.slot-box{width:50px;height:70px;border-radius:6px;border:1.5px dashed var(--border-2);display:flex;align-items:center;justify-content:center;color:var(--muted-2);flex-shrink:0}
.slot-text{font-size:.8rem;color:var(--muted)}
.slot-sub{font-size:.7rem;color:var(--muted-2);margin-top:2px}
.empty-panel{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:64px 20px;gap:10px;color:var(--muted-2)}
.empty-panel-icon{width:48px;height:48px;border-radius:12px;background:var(--surface);border:1.5px dashed var(--border-2);display:flex;align-items:center;justify-content:center;color:var(--border-2)}
.empty-panel p{font-size:.82rem}

/* ── RIWAYAT ── */
.hist-item{display:flex;gap:14px;align-items:flex-start;padding:15px 22px;border-bottom:1px solid var(--border);transition:background .12s}
.hist-item:last-child{border-bottom:none}
.hist-item:hover{background:var(--surface)}
.hist-idx{font-family:'Instrument Serif',serif;font-style:italic;font-size:1rem;color:var(--border-2);width:18px;text-align:center;flex-shrink:0;margin-top:2px}
.hist-cover{width:38px;height:54px;border-radius:5px;flex-shrink:0;box-shadow:1px 2px 8px rgba(0,0,0,.1);overflow:hidden;object-fit:cover}
.hist-info{flex:1;min-width:0}
.hist-title-row{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:2px}
.hist-title{font-size:.84rem;font-weight:500;color:var(--ink);line-height:1.2}
.hist-author{font-size:.71rem;color:var(--muted);margin-bottom:6px}
.hist-date{font-size:.68rem;color:var(--muted-2);display:flex;align-items:center;gap:3px}
.hist-right{display:flex;flex-direction:column;align-items:flex-end;gap:6px;flex-shrink:0}
.stars{display:flex;gap:2px}
.star-f{color:var(--yellow);font-size:.7rem}
.star-e{color:var(--border-2);font-size:.7rem}
.btn-ulasan{font-family:'Syne',sans-serif;font-size:.59rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:5px 10px;border-radius:5px;cursor:pointer;transition:all .15s;color:var(--green);border:1px solid var(--green-pale-2);background:var(--green-pale);white-space:nowrap;display:inline-flex;align-items:center;gap:4px}
.btn-ulasan:hover{background:#daeee4}
.btn-bukti{font-family:'Syne',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:5px 10px;border-radius:5px;cursor:pointer;transition:all .15s;color:var(--muted);border:1px solid var(--border);background:transparent;white-space:nowrap;display:inline-flex;align-items:center;gap:4px}
.btn-bukti:hover{border-color:var(--border-2);background:var(--surface);color:var(--ink)}

/* ── KOLEKSI PRIBADI ── */
.koleksi-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:14px;padding:22px}
.kbook{display:flex;flex-direction:column;gap:7px;cursor:pointer;transition:transform .15s}
.kbook:hover{transform:translateY(-2px)}
.kbook-cover{width:100%;aspect-ratio:2/3;border-radius:8px;overflow:hidden;box-shadow:2px 4px 12px rgba(0,0,0,.12)}
.kbook-cover img{width:100%;height:100%;object-fit:cover}
.kbook-title{font-size:.75rem;font-weight:600;color:var(--ink);line-height:1.3;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
.kbook-author{font-size:.67rem;color:var(--muted)}
.kbook-actions{display:flex;gap:6px}
.kbook-btn{font-family:'Syne',sans-serif;font-size:.55rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:4px 8px;border-radius:5px;cursor:pointer;transition:all .15s}
.kbook-borrow{color:#fff;background:var(--green);border:none}
.kbook-borrow:hover{background:var(--green-dark)}
.kbook-remove{color:var(--accent);background:var(--accent-pale);border:1px solid rgba(208,78,26,.2)}
.kbook-remove:hover{background:rgba(208,78,26,.15)}

/* ── ULASAN ── */
.ulasan-item{padding:18px 22px;border-bottom:1px solid var(--border);transition:background .12s}
.ulasan-item:last-child{border-bottom:none}
.ulasan-item:hover{background:var(--surface)}
.ul-book-row{display:flex;gap:12px;align-items:center;margin-bottom:11px}
.ul-cover{width:36px;height:52px;border-radius:5px;flex-shrink:0;box-shadow:1px 2px 8px rgba(0,0,0,.1);overflow:hidden;object-fit:cover}
.ul-title{font-size:.84rem;font-weight:600;color:var(--ink);margin-bottom:2px}
.ul-author{font-size:.71rem;color:var(--muted)}
.ul-stars{display:flex;align-items:center;gap:2px;margin-top:4px}
.ul-text{font-family:'Instrument Serif',serif;font-style:italic;font-size:.88rem;color:var(--ink-2);line-height:1.7;padding:11px 15px;background:var(--surface);border-radius:8px;border-left:3px solid var(--green-pale-2);margin-bottom:11px}
.ul-footer{display:flex;align-items:center;justify-content:space-between}
.ul-date{font-size:.68rem;color:var(--muted-2);display:flex;align-items:center;gap:4px}
.ul-del{font-family:'Syne',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:5px 9px;border-radius:5px;cursor:pointer;color:var(--accent);border:1px solid rgba(208,78,26,.2);background:var(--accent-pale);transition:all .15s}
.ul-del:hover{background:rgba(208,78,26,.15)}

/* ── EDIT PROFIL ── */
.edit-wrap{padding:26px 22px}
.edit-section{margin-bottom:26px}
.edit-section:last-child{margin-bottom:0}
.edit-section-title{font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);margin-bottom:14px;padding-bottom:10px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:8px}
.fields{display:grid;grid-template-columns:1fr 1fr;gap:13px}
.field{position:relative}
.f-full{grid-column:1/-1}
.field-lbl{display:block;font-family:'Syne',sans-serif;font-size:.61rem;font-weight:700;color:var(--muted);margin-bottom:6px;letter-spacing:.04em;text-transform:uppercase}
.field-in{width:100%;height:44px;padding:0 12px;border-radius:9px;border:1.5px solid var(--border);background:var(--white);font-size:.88rem;color:var(--ink);outline:none;transition:border-color .2s,box-shadow .2s;font-family:inherit}
.field-in::placeholder{color:var(--muted-2)}
.field-in:focus{border-color:var(--green);box-shadow:0 0 0 3px var(--green-mid)}
.field-in[readonly]{background:var(--surface);color:var(--muted);cursor:not-allowed}
.field-ta{width:100%;padding:10px 12px;min-height:80px;border-radius:9px;border:1.5px solid var(--border);background:var(--white);font-family:'DM Sans',sans-serif;font-size:.88rem;color:var(--ink);outline:none;resize:none;transition:border-color .2s,box-shadow .2s}
.field-ta:focus{border-color:var(--green);box-shadow:0 0 0 3px var(--green-mid)}
.field-ta::placeholder{color:var(--muted-2)}
.field-hint{font-size:.65rem;color:var(--muted-2);margin-top:3px}
.pw-box{background:var(--surface);border:1.5px solid var(--border);border-radius:11px;padding:16px}
.pw-fields{display:grid;gap:11px}
.pw-bars{display:flex;gap:3px;margin-top:6px}
.pw-bar{flex:1;height:3px;border-radius:99px;background:var(--border);transition:background .3s}
.pw-bar.weak{background:#E74C3C}
.pw-bar.medium{background:#F39C12}
.pw-bar.strong{background:var(--green)}
.pw-str{font-size:.62rem;font-weight:600;color:var(--muted-2);margin-top:4px;text-transform:uppercase;letter-spacing:.03em}
.edit-footer{display:flex;gap:9px;padding:16px 22px;border-top:1px solid var(--border);background:var(--surface);border-radius:0 0 12px 12px}
.btn-save{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.72rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--green);color:#fff;padding:10px 22px;border-radius:9px;cursor:pointer;border:none;transition:all .2s;box-shadow:0 1px 3px rgba(28,107,70,.25),0 4px 12px rgba(28,107,70,.18)}
.btn-save:hover{background:var(--green-dark);transform:translateY(-1px)}
.btn-cancel{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.72rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:var(--ink-2);border:1.5px solid var(--border);background:var(--white);padding:10px 18px;border-radius:9px;cursor:pointer;transition:all .15s}
.btn-cancel:hover{border-color:var(--border-2);background:var(--surface)}

/* ── MODAL ── */
.modal-bg{
  position:fixed;inset:0;z-index:1060;
  background:rgba(22,20,15,.55);
  backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);
  display:flex;align-items:flex-start;justify-content:center;
  overflow-y:auto;overscroll-behavior:contain;
  padding:32px 20px 48px;
  opacity:0;visibility:hidden;pointer-events:none;
  transition:opacity .25s ease,visibility .25s ease;
}
.modal-bg.open{opacity:1;visibility:visible;pointer-events:auto;}
.dl-modal{background:var(--white);border-radius:16px;width:100%;max-width:520px;box-shadow:0 24px 60px rgba(0,0,0,.2);transform:translateY(20px) scale(.97);opacity:0;transition:transform .35s cubic-bezier(0.16,1,0.3,1),opacity .2s ease-out;overflow:hidden}
.modal-bg.open .dl-modal{transform:translateY(0) scale(1);opacity:1}
.modal-header{padding:18px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.modal-title{font-family:'Instrument Serif',serif;font-size:1.1rem;color:var(--ink)}
.modal-close{width:28px;height:28px;border-radius:6px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--muted);border:1px solid var(--border);transition:all .15s}
.modal-close:hover{border-color:var(--border-2);background:var(--surface);color:var(--ink)}
.modal-body{padding:20px 24px}
.modal-book-row{display:flex;gap:14px;padding:12px;background:var(--surface);border:1px solid var(--border);border-radius:10px;margin-bottom:16px}
.mb-cover{width:46px;height:66px;border-radius:6px;flex-shrink:0;box-shadow:2px 3px 10px rgba(0,0,0,.12);overflow:hidden;object-fit:cover}
.mb-title{font-size:.88rem;font-weight:600;color:var(--ink);margin-bottom:2px}
.mb-author{font-size:.74rem;color:var(--muted);margin-bottom:7px}
.mb-row{font-size:.71rem;color:var(--muted-2);display:flex;gap:6px}
.mb-row strong{color:var(--muted)}
.mb-row.warn{color:var(--accent);font-weight:500}
.modal-fields{display:grid;gap:11px}
.return-notice{display:flex;align-items:flex-start;gap:9px;padding:11px 14px;background:var(--amber-pale);border:1px solid var(--amber-border);border-radius:8px;margin-top:14px;font-size:.77rem;color:var(--amber);line-height:1.5}
.modal-footer{display:flex;gap:8px;padding:14px 24px;border-top:1px solid var(--border);background:var(--surface)}
.star-picker{display:flex;gap:6px}
.sp-star{font-size:1.5rem;cursor:pointer;color:var(--border-2);transition:color .12s,transform .1s;user-select:none}
.sp-star:hover{transform:scale(1.15)}
.sp-star.on{color:var(--yellow)}
.review-required-banner{
  background:linear-gradient(135deg,#0f4d2e,#1c6b46);
  color:#fff;padding:14px 22px;
  display:flex;align-items:center;gap:12px;
  font-size:.82rem;border-radius:0;
}
.review-required-banner strong{font-weight:700}
.review-required-banner a{color:#a8d5bb;text-decoration:underline;cursor:pointer}

/* ── TOAST ── */
.toast{position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(20px);background:var(--ink);color:#fff;font-size:.8rem;font-weight:500;padding:11px 24px;border-radius:99px;white-space:nowrap;box-shadow:0 8px 24px rgba(0,0,0,.25);z-index:1100;opacity:0;transition:all .35s cubic-bezier(.34,1.56,.64,1);pointer-events:none}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.toast.success{background:var(--green)}
.toast.error{background:var(--accent)}

.scroll-up{position:fixed;bottom:28px;right:28px;z-index:800;width:38px;height:38px;border-radius:10px;background:var(--white);border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);cursor:pointer;box-shadow:0 4px 16px rgba(0,0,0,.1);transition:all .2s;opacity:0;pointer-events:none}
.scroll-up.visible{opacity:1;pointer-events:auto}
.scroll-up:hover{border-color:var(--green);color:var(--green);background:var(--green-pale)}
.sr{opacity:0;transform:translateY(16px);transition:opacity .5s ease,transform .5s ease}
.sr.in{opacity:1;transform:translateY(0)}

@media(max-width:880px){.main-grid{grid-template-columns:1fr}.sidebar{position:static}.stat-bar{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.page{padding:0 16px 60px}.identity-bar{padding:0 16px 18px}.fields{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
@php
  $activeBorrowings   = $borrowings->whereIn('status', ['pending','approved','returning']);
  $historyBorrowings  = $borrowings->where('status', 'returned');
  $rejectedBorrowings = $borrowings->where('status', 'rejected');
  $activeCount        = $borrowings->where('status', 'approved')->count();
  $pendingCount       = $borrowings->where('status', 'pending')->count();
  $returningCount     = $borrowings->where('status', 'returning')->count();
  $avgRating          = $reviews->count() ? number_format($reviews->avg('rating'), 1) : '—';
  $initials           = strtoupper(substr($user->name, 0, 2));
  $hasPendingReviews  = $pendingReviews->count() > 0;
  $firstPendingReview = $pendingReviews->first();
@endphp

<div class="page">

  {{-- ═══ MANDATORY REVIEW BANNER ═══ --}}
  @if($hasPendingReviews)
  <div class="review-required-banner sr">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>
    <div>
      <strong>Anda punya {{ $pendingReviews->count() }} buku yang belum diulas!</strong>
      Bantu sesama pembaca dengan memberi ulasan.
      <a onclick="switchTab('riwayat'); openModal('modal-ulasan-{{ $firstPendingReview->id }}')">Tulis sekarang →</a>
    </div>
  </div>
  @endif

  {{-- ═══ HERO ═══ --}}
  <div class="profile-hero sr" style="transition-delay:.04s">
    <div class="hero-cover">
      <div class="orb orb-1"></div><div class="orb orb-2"></div>
      <div class="cover-wm">DigiLib</div>
    </div>
    <div class="identity-bar">
      <div class="av-wrap">
        @if($user->avatar)
          <img src="{{ asset('storage/'.$user->avatar) }}" class="profile-av" alt="{{ $user->name }}">
        @else
          <div class="profile-av"><span class="av-init">{{ $initials }}</span></div>
        @endif
        <button class="av-cam" onclick="document.getElementById('avatar-file').click()" title="Ganti foto profil">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        </button>
      </div>
      <div class="profile-info">
        <div class="profile-name">{{ $user->name }}</div>
        <div class="profile-tags">
          <span class="ptag ptag-role">
            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            {{ ucfirst($user->role) }}
          </span>
          <span class="ptag ptag-since">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Bergabung {{ $user->created_at->translatedFormat('F Y') }}
          </span>
        </div>
      </div>
      <div class="profile-actions">
        <button class="btn-primary" onclick="switchTab('edit')">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          Edit Profil
        </button>
      </div>
    </div>
    <div class="stat-bar">
      <div class="sbar"><div class="sbar-n">{{ $borrowings->count() }}</div><div class="sbar-label">Total Dipinjam</div><div class="sbar-sub">Sepanjang waktu</div></div>
      <div class="sbar"><div class="sbar-n">{{ $activeCount }}</div><div class="sbar-label">Sedang Dipinjam</div><div class="sbar-sub">Buku aktif</div></div>
      <div class="sbar"><div class="sbar-n {{ $pendingCount > 0 ? 'warn' : 'muted' }}">{{ $pendingCount }}</div><div class="sbar-label">Menunggu Konfirmasi</div><div class="sbar-sub">Pending admin</div></div>
      <div class="sbar"><div class="sbar-n">{{ $reviews->count() }}</div><div class="sbar-label">Ulasan Ditulis</div><div class="sbar-sub">Rata-rata ★{{ $avgRating }}</div></div>
    </div>
  </div>

  {{-- ═══ MAIN GRID ═══ --}}
  <div class="main-grid">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
      <div class="scard sr" style="transition-delay:.05s">
        <div class="scard-head"><span class="scard-title">Status Pinjaman</span></div>
        <div class="status-card">
          <div class="sc-row"><span class="sc-label"><span class="sc-dot dot-dipinjam"></span>Sedang Dipinjam</span><span class="sc-count">{{ $activeCount }}</span></div>
          <div class="sc-row"><span class="sc-label"><span class="sc-dot dot-menunggu"></span>Menunggu Konfirmasi</span><span class="sc-count">{{ $pendingCount }}</span></div>
          <div class="sc-row"><span class="sc-label"><span class="sc-dot dot-kembali"></span>Proses Pengembalian</span><span class="sc-count">{{ $returningCount }}</span></div>
        </div>
      </div>
      <div class="scard sr" style="transition-delay:.09s">
        <div class="scard-head">
          <span class="scard-title">Info Akun</span>
          <span style="font-size:.72rem;font-weight:500;color:var(--green);cursor:pointer" onclick="switchTab('edit')">Edit</span>
        </div>
        <div class="info-list">
          <div class="info-item">
            <div class="info-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
            <div class="info-content"><div class="info-lbl">Username</div><div class="info-val">{{ $user->username }}</div></div>
          </div>
          <div class="info-item">
            <div class="info-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div class="info-content"><div class="info-lbl">Email</div><div class="info-val">{{ $user->email }}</div></div>
          </div>
          <div class="info-item">
            <div class="info-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.9a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16z"/></svg></div>
            <div class="info-content"><div class="info-lbl">Telepon</div><div class="info-val">{{ $user->phone ?? '-' }}</div></div>
          </div>
          <div class="info-item">
            <div class="info-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div class="info-content"><div class="info-lbl">Kota</div><div class="info-val">{{ $user->city ?? '-' }}</div></div>
          </div>
        </div>
      </div>
    </aside>

    {{-- CONTENT --}}
    <div class="sr" style="transition-delay:.07s">

      <div class="tab-nav">
        <div class="titem active" data-tab="aktif" onclick="switchTab('aktif')">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          Aktif
          @if($activeBorrowings->count() > 0)<span class="tbadge warn">{{ $activeBorrowings->count() }}</span>@endif
        </div>
        <div class="titem" data-tab="riwayat" onclick="switchTab('riwayat')">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Riwayat<span class="tbadge">{{ $historyBorrowings->count() }}</span>
          @if($hasPendingReviews)<span class="tbadge warn" title="Menunggu ulasan">★{{ $pendingReviews->count() }}</span>@endif
        </div>
        <div class="titem" data-tab="koleksi" onclick="switchTab('koleksi')">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
          Koleksi<span class="tbadge">{{ $collections->count() }}</span>
        </div>
        <div class="titem" data-tab="ulasan" onclick="switchTab('ulasan')">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          Ulasan<span class="tbadge">{{ $reviews->count() }}</span>
        </div>
        <div class="titem" data-tab="edit" onclick="switchTab('edit')">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          Edit Profil
        </div>
      </div>

      <div class="tab-panels">

        {{-- ── TAB: PINJAMAN AKTIF ── --}}
        <div class="panel active" id="panel-aktif">
          <div class="loan-list">
            @forelse($activeBorrowings as $b)

              @if($b->status === 'pending')
              <div class="loan-item">
                <div class="book-cover"><img src="{{ $b->book->cover_url }}" alt="{{ $b->book->title }}"></div>
                <div class="loan-body">
                  <div class="loan-top">
                    <span class="loan-title">{{ $b->book->title }}</span>
                    <span class="sbadge s-menunggu">⏳ Menunggu Konfirmasi</span>
                  </div>
                  <div class="loan-author">{{ $b->book->author }}</div>
                  <div class="pending-notice">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Pengajuan sedang ditinjau oleh petugas perpustakaan.
                  </div>
                  @if($b->admin_note)
                  <div class="pending-notice" style="background:var(--accent-pale);border-color:rgba(208,78,26,.25);color:var(--accent)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="flex-shrink:0"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span><strong>Catatan petugas:</strong> {{ $b->admin_note }}</span>
                  </div>
                  @endif
                  <div class="loan-meta">
                    <span class="lmeta">📅 Diajukan: {{ $b->borrow_date->format('d M Y') }}</span>
                    <span class="lmeta">📅 Rencana kembali: {{ $b->return_date->format('d M Y') }}</span>
                  </div>
                  <div class="loan-actions">
                    <span class="abtn abtn-disabled">Menunggu Konfirmasi Admin</span>
                  </div>
                </div>
              </div>

              @elseif($b->status === 'approved')
              @php
                $totalDays = max(1, $b->borrow_date->diffInDays($b->return_date));
                $usedDays  = $b->borrow_date->diffInDays(now());
                $pct       = min(100, round($usedDays / $totalDays * 100));
                $daysLeft  = (int) now()->diffInDays($b->return_date, false);
                $isLate    = $b->isLate();
              @endphp
              <div class="loan-item">
                <div class="book-cover"><img src="{{ $b->book->cover_url }}" alt="{{ $b->book->title }}"></div>
                <div class="loan-body">
                  <div class="loan-top">
                    <span class="loan-title">{{ $b->book->title }}</span>
                    <span class="sbadge s-dipinjam">✓ Dipinjam</span>
                  </div>
                  <div class="loan-author">{{ $b->book->author }}</div>
                  <div class="prog-wrap">
                    <div class="prog-header">
                      <span class="prog-label">Sisa waktu</span>
                      @if($isLate)<span class="prog-label" style="color:var(--accent)">⚠ Terlambat {{ $b->lateDays() }} hari!</span>
                      @elseif($daysLeft <= 3)<span class="prog-label" style="color:var(--accent)">{{ $daysLeft }} hari lagi!</span>
                      @else<span class="prog-label" style="color:var(--green)">{{ $daysLeft }} hari lagi</span>@endif
                    </div>
                    <div class="prog-track"><div class="prog-fill {{ ($isLate || $daysLeft <= 3) ? 'fill-warn' : 'fill-ok' }}" style="width:{{ $pct }}%"></div></div>
                  </div>
                  <div class="loan-meta">
                    <span class="lmeta">📅 {{ $b->borrow_date->format('d M Y') }}</span>
                    <span class="lmeta {{ ($isLate || $daysLeft <= 3) ? 'warn' : '' }}">⏰ Jatuh tempo: {{ $b->return_date->format('d M Y') }}</span>
                    @if($isLate)<span class="lmeta warn">💰 Denda: Rp {{ number_format($b->calculateFine(), 0, ',', '.') }}</span>@endif
                  </div>
                  <div class="loan-actions">
                    <button class="abtn abtn-green" onclick="openModal('modal-return-{{ $b->id }}')">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/></svg>
                      Ajukan Pengembalian
                    </button>
                    <a href="{{ route('user.borrow.receipt', $b) }}" target="_blank" class="abtn abtn-outline">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                      Bukti Pinjam
                    </a>
                  </div>
                </div>
              </div>

              {{-- Modal pengembalian — inline di dalam loop --}}
              <div class="modal-bg" id="modal-return-{{ $b->id }}" onclick="closeBg(event,'modal-return-{{ $b->id }}')">
                <div class="dl-modal">
                  <div class="modal-header">
                    <span class="modal-title">Ajukan Pengembalian</span>
                    <button class="modal-close" onclick="closeModal('modal-return-{{ $b->id }}')">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('user.borrow.return', $b) }}">
                    @csrf
                    <div class="modal-body">
                      <div class="modal-book-row">
                        <img src="{{ $b->book->cover_url }}" class="mb-cover" alt="{{ $b->book->title }}">
                        <div>
                          <div class="mb-title">{{ $b->book->title }}</div>
                          <div class="mb-author">{{ $b->book->author }}</div>
                          <div><div class="mb-row"><strong>Pinjam:</strong> {{ $b->borrow_date->format('d M Y') }}</div>
                          <div class="mb-row {{ $daysLeft <= 0 ? 'warn' : '' }}"><strong>Jatuh Tempo:</strong> {{ $b->return_date->format('d M Y') }}</div></div>
                        </div>
                      </div>
                      <div class="modal-fields">
                        <div class="field">
                          <label class="field-lbl">Catatan (opsional)</label>
                          <textarea name="notes" class="field-ta" placeholder="Kondisi buku, catatan khusus..." rows="2"></textarea>
                        </div>
                      </div>
                      <div class="return-notice">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Setelah diajukan, petugas akan memverifikasi pengembalian buku Anda. Setelah disetujui, Anda akan diminta memberikan <strong>ulasan buku</strong>.
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="abtn abtn-outline" style="flex:1;justify-content:center" onclick="closeModal('modal-return-{{ $b->id }}')">Batal</button>
                      <button type="submit" class="abtn abtn-green" style="flex:1;justify-content:center">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/></svg>
                        Ajukan Pengembalian
                      </button>
                    </div>
                  </form>
                </div>
              </div>

              @elseif($b->status === 'returning')
              <div class="loan-item">
                <div class="book-cover"><img src="{{ $b->book->cover_url }}" alt="{{ $b->book->title }}"></div>
                <div class="loan-body">
                  <div class="loan-top">
                    <span class="loan-title">{{ $b->book->title }}</span>
                    <span class="sbadge s-returning">🔄 Proses Pengembalian</span>
                  </div>
                  <div class="loan-author">{{ $b->book->author }}</div>
                  <div class="pending-notice" style="background:var(--accent-pale);border-color:rgba(208,78,26,.2);color:var(--accent)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Pengembalian sedang diverifikasi oleh petugas.
                  </div>
                  @if($b->admin_note)
                  <div class="pending-notice" style="background:var(--accent-pale);border-color:rgba(208,78,26,.25);color:var(--accent)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="flex-shrink:0"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span><strong>Catatan petugas:</strong> {{ $b->admin_note }}</span>
                  </div>
                  @endif
                  <div class="loan-meta"><span class="lmeta">📅 Dipinjam: {{ $b->borrow_date->format('d M Y') }}</span></div>
                  <div class="loan-actions">
                    <a href="{{ route('user.borrow.receipt', $b) }}" target="_blank" class="abtn abtn-outline">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                      Bukti Pinjam
                    </a>
                  </div>
                </div>
              </div>
              @endif

            @empty
              <div class="empty-panel">
                <div class="empty-panel-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
                <p>Tidak ada pinjaman aktif</p>
              </div>
            @endforelse

            {{-- Slot kosong --}}
            @php $maxBorrow = 3; $slotsLeft = max(0, $maxBorrow - $activeBorrowings->count()); @endphp
            @for($i = 0; $i < $slotsLeft; $i++)
              <div class="empty-slot">
                <div class="slot-box"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
                <div><div class="slot-text">Slot pinjaman tersedia</div><div class="slot-sub"><a href="{{ route('user.books.index') }}" style="color:var(--green)">Kunjungi koleksi buku →</a></div></div>
              </div>
            @endfor

            @if($rejectedBorrowings->count() > 0)
              <div style="font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--muted-2);padding:14px 22px 8px;border-top:1px solid var(--border)">Pengajuan Ditolak</div>
              @foreach($rejectedBorrowings as $b)
              <div class="loan-item" style="opacity:.75">
                <div class="book-cover"><img src="{{ $b->book->cover_url }}" alt="{{ $b->book->title }}"></div>
                <div class="loan-body">
                  <div class="loan-top">
                    <span class="loan-title">{{ $b->book->title }}</span>
                    <span class="sbadge" style="background:var(--red-pale);color:var(--red)">✗ Ditolak</span>
                  </div>
                  <div class="loan-author">{{ $b->book->author }}</div>
                  <div class="pending-notice" style="background:var(--red-pale);border-color:rgba(192,57,43,.2);color:var(--red)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    @if($b->admin_note)<span><strong>Alasan:</strong> {{ $b->admin_note }}</span>@else Pengajuan ditolak petugas.@endif
                  </div>
                  <div class="loan-meta"><span class="lmeta">Diajukan: {{ $b->borrow_date->format('d M Y') }}</span></div>
                </div>
              </div>
              @endforeach
            @endif
          </div>
        </div>

        {{-- ── TAB: RIWAYAT ── --}}
        <div class="panel" id="panel-riwayat">
          @if($hasPendingReviews)
          <div style="padding:12px 22px;background:var(--green-pale);border-bottom:1px solid var(--green-pale-2);display:flex;align-items:center;gap:10px;font-size:.8rem;color:var(--green)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.122 2.122 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>
            <strong>{{ $pendingReviews->count() }} buku</strong> menunggu ulasan Anda. Klik "Tulis Ulasan" untuk berbagi pendapat.
          </div>
          @endif
          <div class="loan-list">
            @forelse($historyBorrowings as $index => $b)
              <div class="hist-item">
                <span class="hist-idx">{{ $index + 1 }}</span>
                <img src="{{ $b->book->cover_url }}" class="hist-cover" alt="{{ $b->book->title }}">
                <div class="hist-info">
                  <div class="hist-title-row">
                    <span class="hist-title">{{ $b->book->title }}</span>
                    <span class="sbadge s-kembali" style="font-size:.52rem">✓ Dikembalikan</span>
                  </div>
                  <div class="hist-author">{{ $b->book->author }} · {{ $b->book->publisher }}</div>
                  <div class="hist-date">📅 Kembali {{ $b->return_date->format('d M Y') }}
                    @if($b->fine_amount > 0) · <span style="color:var(--accent)">Denda: Rp {{ number_format($b->fine_amount,0,',','.') }}</span>@endif
                  </div>
                </div>
                <div class="hist-right">
                  @if($b->review)
                    <div class="stars">@for($i=1;$i<=5;$i++)<span class="{{ $i<=$b->review->rating ? 'star-f':'star-e' }}">★</span>@endfor</div>
                  @else
                    <button class="btn-ulasan" onclick="openModal('modal-ulasan-{{ $b->id }}')">
                      <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      Tulis Ulasan
                    </button>
                  @endif
                  <a href="{{ route('user.borrow.return-receipt', $b) }}" target="_blank" class="btn-bukti">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    Bukti Kembali
                  </a>
                </div>
              </div>
              {{-- Modal ulasan inline --}}
              @if(!$b->review)
              <div class="modal-bg" id="modal-ulasan-{{ $b->id }}" onclick="closeBg(event,'modal-ulasan-{{ $b->id }}')">
                <div class="dl-modal">
                  <div class="modal-header">
                    <span class="modal-title">⭐ Tulis Ulasan Buku</span>
                    <button class="modal-close" onclick="closeModal('modal-ulasan-{{ $b->id }}')">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('user.borrow.review', $b) }}">
                    @csrf
                    <div class="modal-body">
                      <div class="modal-book-row">
                        <img src="{{ $b->book->cover_url }}" class="mb-cover" alt="{{ $b->book->title }}">
                        <div>
                          <div class="mb-title">{{ $b->book->title }}</div>
                          <div class="mb-author">{{ $b->book->author }}</div>
                          <div class="mb-row" style="color:var(--muted-2);margin-top:6px">Dikembalikan {{ $b->return_date->format('d M Y') }}</div>
                        </div>
                      </div>
                      <div class="modal-fields">
                        <div class="field">
                          <label class="field-lbl">Penilaian <span style="color:var(--accent)">*</span></label>
                          <div class="star-picker" id="starPicker-{{ $b->id }}">
                            @for($i=1;$i<=5;$i++)
                              <span class="sp-star" data-v="{{ $i }}" data-input="rating-{{ $b->id }}" data-hint="hint-{{ $b->id }}">★</span>
                            @endfor
                          </div>
                          <input type="hidden" name="rating" id="rating-{{ $b->id }}" required>
                          <div class="field-hint" id="hint-{{ $b->id }}" style="margin-top:5px;font-weight:500">Klik bintang untuk memberi nilai</div>
                        </div>
                        <div class="field">
                          <label class="field-lbl">Tulis Ulasan</label>
                          <textarea name="comment" class="field-ta" placeholder="Ceritakan pengalamanmu membaca buku ini..." rows="4" maxlength="500"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="abtn abtn-outline" style="flex:1;justify-content:center" onclick="closeModal('modal-ulasan-{{ $b->id }}')">Nanti</button>
                      <button type="submit" class="abtn abtn-green" style="flex:1;justify-content:center">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Kirim Ulasan
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              @endif
            @empty
              <div class="empty-panel">
                <div class="empty-panel-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                <p>Belum ada riwayat peminjaman</p>
              </div>
            @endforelse
          </div>
        </div>

        {{-- ── TAB: KOLEKSI PRIBADI ── --}}
        <div class="panel" id="panel-koleksi">
          @if($collections->isEmpty())
            <div class="empty-panel">
              <div class="empty-panel-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg></div>
              <p>Belum ada buku di koleksi</p>
              <a href="{{ route('user.books.index') }}" class="abtn abtn-green" style="margin-top:8px">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Jelajahi Buku
              </a>
            </div>
          @else
          <div class="koleksi-grid">
            @foreach($collections as $c)
            <div class="kbook">
              <a href="{{ route('user.books.show', $c->book) }}">
                <div class="kbook-cover"><img src="{{ $c->book->cover_url }}" alt="{{ $c->book->title }}"></div>
              </a>
              <div class="kbook-title">{{ $c->book->title }}</div>
              <div class="kbook-author">{{ $c->book->author }}</div>
              <div class="kbook-actions">
                @if($c->book->isAvailable())
                <a href="{{ route('user.borrow.create', ['book_id' => $c->book->id]) }}" class="kbook-btn kbook-borrow">Pinjam</a>
                @else
                <span class="kbook-btn" style="background:var(--surface);color:var(--muted-2);border:1px solid var(--border);cursor:not-allowed">Tidak Tersedia</span>
                @endif
                <form method="POST" action="{{ route('user.books.collect', $c->book) }}" style="display:inline">
                  @csrf
                  <button type="submit" class="kbook-btn kbook-remove" title="Hapus dari koleksi">✕</button>
                </form>
              </div>
            </div>
            @endforeach
          </div>
          @endif
        </div>

        {{-- ── TAB: ULASAN SAYA ── --}}
        <div class="panel" id="panel-ulasan">
          @forelse($reviews as $r)
            <div class="ulasan-item">
              <div class="ul-book-row">
                <img src="{{ $r->book->cover_url }}" class="ul-cover" alt="{{ $r->book->title }}">
                <div>
                  <div class="ul-title">{{ $r->book->title }}</div>
                  <div class="ul-author">{{ $r->book->author }}</div>
                  <div class="ul-stars">@for($i=1;$i<=5;$i++)<span class="{{ $i<=$r->rating?'star-f':'star-e' }}">★</span>@endfor</div>
                </div>
              </div>
              @if($r->comment)<div class="ul-text">{{ $r->comment }}</div>@endif
              <div class="ul-footer">
                <span class="ul-date">📅 {{ $r->created_at->translatedFormat('d M Y') }}</span>
                <form method="POST" action="{{ route('user.review.destroy', $r) }}" onsubmit="return confirm('Hapus ulasan ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="ul-del">Hapus</button>
                </form>
              </div>
            </div>
          @empty
            <div class="empty-panel">
              <div class="empty-panel-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
              <p>Belum ada ulasan</p>
            </div>
          @endforelse
        </div>

        {{-- ── TAB: EDIT PROFIL ── --}}
        <div class="panel" id="panel-edit">
          <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="avatar" id="avatar-file" accept="image/*" style="display:none" onchange="this.form.submit()">
            <div class="edit-wrap">
              <div class="edit-section">
                <div class="edit-section-title">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                  Informasi Pribadi
                </div>
                <div class="fields">
                  <div class="field"><label class="field-lbl">Nama Lengkap</label><input type="text" name="name" class="field-in {{ $errors->has('name') ? 'border-red-400' : '' }}" value="{{ old('name', $user->name) }}" required></div>
                  <div class="field"><label class="field-lbl">Username</label><input type="text" class="field-in" value="{{ $user->username }}" readonly><div class="field-hint">Username tidak dapat diubah</div></div>
                  <div class="field"><label class="field-lbl">Email</label><input type="email" class="field-in" value="{{ $user->email }}" readonly><div class="field-hint">Hubungi admin untuk ubah email</div></div>
                  <div class="field"><label class="field-lbl">Nomor Telepon</label><input type="tel" name="phone" class="field-in" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890"></div>
                  <div class="field f-full"><label class="field-lbl">Kota</label><input type="text" name="city" class="field-in" value="{{ old('city', $user->city) }}" placeholder="Kota tempat tinggal"></div>
                </div>
                @if($errors->has('name'))<div style="margin-top:8px;font-size:.78rem;color:var(--accent)">{{ $errors->first('name') }}</div>@endif
              </div>
            </div>
            <div class="edit-footer" style="border-radius:0">
              <button type="submit" class="btn-save">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Simpan Perubahan
              </button>
              <button type="button" class="btn-cancel" onclick="switchTab('aktif')">Batal</button>
            </div>
          </form>

          <form method="POST" action="{{ route('user.profile.password') }}">
            @csrf
            <div class="edit-wrap" style="padding-top:0">
              <div class="edit-section" style="margin-bottom:0">
                <div class="edit-section-title">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                  Ganti Password
                </div>
                <div class="pw-box">
                  <div class="pw-fields">
                    <div class="field"><label class="field-lbl">Password Saat Ini</label><input type="password" name="current_password" class="field-in" placeholder="••••••••" required></div>
                    <div class="field">
                      <label class="field-lbl">Password Baru</label>
                      <input type="password" name="password" class="field-in" id="new-pw" placeholder="Min. 6 karakter" oninput="checkStrength(this)" required minlength="6">
                      <div id="pw-str-wrap" style="display:none;margin-top:6px">
                        <div class="pw-bars"><div class="pw-bar" id="bar1"></div><div class="pw-bar" id="bar2"></div><div class="pw-bar" id="bar3"></div><div class="pw-bar" id="bar4"></div></div>
                        <div class="pw-str" id="pw-str-label"></div>
                      </div>
                    </div>
                    <div class="field"><label class="field-lbl">Konfirmasi Password Baru</label><input type="password" name="password_confirmation" class="field-in" id="confirm-pw" placeholder="Ulangi password baru" oninput="checkMatch(this)" required><div class="field-hint" id="match-hint"></div></div>
                  </div>
                </div>
                @if($errors->has('current_password') || $errors->has('password'))
                <div style="margin-top:12px;padding:10px 14px;background:var(--accent-pale);border:1px solid rgba(208,78,26,.25);border-radius:8px;font-size:.8rem;color:var(--accent)">{{ $errors->first() }}</div>
                @endif
              </div>
            </div>
            <div class="edit-footer">
              <button type="submit" class="btn-save">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Ubah Password
              </button>
            </div>
          </form>
        </div>

      </div>{{-- /tab-panels --}}
    </div>{{-- /content --}}

  </div>{{-- /main-grid --}}
</div>{{-- /page --}}

<button class="scroll-up" id="scrollUp" onclick="window.scrollTo({top:0,behavior:'smooth'})">
  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"/></svg>
</button>
<div class="toast" id="toastEl"></div>

@endsection

@push('scripts')
<script>
function switchTab(t){
  document.querySelectorAll('.titem').forEach(x=>x.classList.remove('active'));
  document.querySelectorAll('.panel').forEach(x=>x.classList.remove('active'));
  const tab = document.querySelector(`.titem[data-tab="${t}"]`);
  const panel = document.getElementById(`panel-${t}`);
  if(tab) tab.classList.add('active');
  if(panel) panel.classList.add('active');
}

function openModal(id){
  const el = document.getElementById(id);
  if(!el) return;
  // Teleport to body to escape any transform stacking context
  if(el.parentElement !== document.body) document.body.appendChild(el);
  el.classList.add('open');
  el.scrollTop = 0;
  document.body.style.overflow = 'hidden';
  setTimeout(()=>{ const f = el.querySelector('input:not([type=hidden]),textarea'); if(f) f.focus(); }, 80);
}
function closeModal(id){
  const el = document.getElementById(id);
  if(el) el.classList.remove('open');
  // Restore scroll only if no other modal open
  if(!document.querySelector('.modal-bg.open')) document.body.style.overflow = '';
}
function closeBg(e, id){ if(e.target.id === id) closeModal(id); }
document.addEventListener('keydown', e=>{
  if(e.key === 'Escape'){
    const o = document.querySelector('.modal-bg.open');
    if(o) closeModal(o.id);
  }
});

// ─── STAR PICKER ───
document.querySelectorAll('.star-picker').forEach(picker=>{
  const stars = [...picker.querySelectorAll('.sp-star')];
  let selected = 0;
  const labels = ['','Sangat Buruk 😞','Kurang Bagus 😐','Cukup Bagus 😊','Bagus Sekali 😄','Luar Biasa! 🤩'];
  stars.forEach(s=>{
    s.addEventListener('mouseenter',()=>{ const v=+s.dataset.v; stars.forEach((x,i)=>x.classList.toggle('on',i<v)); });
    s.addEventListener('mouseleave',()=>{ stars.forEach((x,i)=>x.classList.toggle('on',i<selected)); });
    s.addEventListener('click',()=>{
      selected = +s.dataset.v;
      const inp = document.getElementById(s.dataset.input);
      const hint = document.getElementById(s.dataset.hint);
      if(inp) inp.value = selected;
      if(hint){ hint.textContent = labels[selected]; hint.style.color = 'var(--green)'; hint.style.fontWeight = '600'; }
    });
  });
});

// ─── PASSWORD STRENGTH ───
function checkStrength(inp){
  const v=inp.value, w=document.getElementById('pw-str-wrap'), lbl=document.getElementById('pw-str-label');
  const bars=['bar1','bar2','bar3','bar4'].map(id=>document.getElementById(id));
  if(!v){ w.style.display='none'; return; }
  w.style.display='block';
  let s=0;
  if(v.length>=8)s++; if(/[A-Z]/.test(v))s++; if(/[0-9]/.test(v))s++; if(/[^A-Za-z0-9]/.test(v))s++;
  const cls=['','weak','medium','medium','strong'], lb=['','Lemah','Sedang','Kuat','Sangat Kuat'];
  bars.forEach((b,i)=>{ b.className='pw-bar'+(i<s?' '+cls[s]:''); });
  lbl.textContent = lb[s]||''; lbl.style.color = s<=1?'#E74C3C':s<=2?'#F39C12':'var(--green)';
}
function checkMatch(inp){
  const pw=document.getElementById('new-pw').value, h=document.getElementById('match-hint');
  if(!inp.value){ h.textContent=''; return; }
  h.textContent = inp.value===pw ? '✓ Password cocok' : 'Password tidak cocok';
  h.style.color = inp.value===pw ? 'var(--green)' : '#C0392B';
}

// ─── TOAST ───
function toast(msg,type){
  const t=document.getElementById('toastEl');
  t.textContent=msg; t.className='toast'+(type?' '+type:'');
  requestAnimationFrame(()=>requestAnimationFrame(()=>t.classList.add('show')));
  setTimeout(()=>t.classList.remove('show'),3200);
}

// ─── AUTO-OPEN REVIEW MODAL ───
// If user has pending reviews, auto-open the first one after a short delay
@if($hasPendingReviews)
document.addEventListener('DOMContentLoaded', ()=>{
  setTimeout(()=>{
    switchTab('riwayat');
    setTimeout(()=>openModal('modal-ulasan-{{ $firstPendingReview->id }}'), 400);
  }, 800);
});
@endif

// ─── REDIRECT ON ERRORS ───
@if($errors->any() && !$errors->has('current_password'))
  document.addEventListener('DOMContentLoaded',()=>switchTab('edit'));
@endif

// ─── SESSION TOASTS ───
document.addEventListener('DOMContentLoaded',()=>{
  @if(session('success')) toast(@json(session('success')),'success'); @endif
  @if(session('error'))   toast(@json(session('error')),'error');     @endif
  @if(session('info'))    toast(@json(session('info')));               @endif
});

// ─── SCROLL REVEAL ───
const srObs = new IntersectionObserver(entries=>{
  entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); srObs.unobserve(e.target); }});
},{threshold:.06});
document.querySelectorAll('.sr').forEach(el=>srObs.observe(el));
window.addEventListener('scroll',()=>{
  document.getElementById('scrollUp').classList.toggle('visible', scrollY>300);
});
</script>
@endpush
