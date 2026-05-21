<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>DigiLib — @yield('title','Admin')</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
@php $role = auth()->user()->role ?? 'petugas'; $isAdmin = $role === 'admin'; @endphp
<style>
:root{
  --accent:{{ $isAdmin ? '#1c6b46' : '#1a5280' }};
  --accent-dark:{{ $isAdmin ? '#145235' : '#0d3054' }};
  --accent-pale:{{ $isAdmin ? '#eaf3ee' : 'rgba(26,82,128,.07)' }};
  --accent-pale-2:{{ $isAdmin ? '#c4dfce' : 'rgba(26,82,128,.15)' }};
  --accent-mid:{{ $isAdmin ? 'rgba(28,107,70,.25)' : 'rgba(26,82,128,.25)' }};
  --accent-text:{{ $isAdmin ? '#9fc5b2' : '#9fc5e8' }};
  --ink:#16140f;--ink-2:#2d2a22;--muted:#6a655b;--muted-2:#a09a90;
  --bg:#f9f8f5;--surface:#f2f0eb;--border:#e4e2da;--border-2:#c9c5ba;--white:#ffffff;
  --green:#1c6b46;--green-pale:#eaf3ee;--green-pale-2:#c4dfce;
  --red:#c0392b;--red-pale:rgba(192,57,43,.08);
  --amber:#b8760a;--amber-pale:rgba(184,118,10,.08);
  --blue:#1a5280;--blue-pale:rgba(26,82,128,.07);
  --sidebar-w:220px;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html,body{height:100%;background:var(--bg);font-family:'DM Sans',system-ui,sans-serif;color:var(--ink);-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none;background:none}
input,textarea,select{font-family:inherit}

/* ── Layout ── */
.app{display:grid;grid-template-columns:var(--sidebar-w) 1fr;height:100vh;overflow:hidden}
.main-col{display:flex;flex-direction:column;overflow:hidden}

/* ── Sidebar ── */
.sidebar{background:var(--ink);display:flex;flex-direction:column;overflow-y:auto}
.sidebar-logo{display:flex;align-items:center;gap:9px;padding:20px 18px 16px;border-bottom:1px solid rgba(255,255,255,.06)}
.logo-mark{width:30px;height:30px;border-radius:8px;background:var(--accent);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.logo-name{font-family:'Instrument Serif',serif;font-size:1.05rem;color:rgba(255,255,255,.9)}
.logo-badge{font-family:'Syne',sans-serif;font-size:.48rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;background:var(--accent-mid);color:var(--accent-text);padding:2px 7px;border-radius:4px;border:1px solid var(--accent-mid)}
.sidebar-nav{flex:1;padding:12px 10px;display:flex;flex-direction:column;gap:2px}
.nav-section-label{font-family:'Syne',sans-serif;font-size:.52rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.25);padding:10px 8px 5px}
.nav-item{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;font-size:.8rem;color:rgba(255,255,255,.5);transition:background .15s,color .15s}
.nav-item:hover{background:rgba(255,255,255,.06);color:rgba(255,255,255,.7)}
.nav-item.active{background:var(--accent-mid);color:rgba(255,255,255,.92)}
.nav-item-icon{width:18px;flex-shrink:0;display:flex;align-items:center;justify-content:center}
.nav-badge{margin-left:auto;font-family:'Syne',sans-serif;font-size:.5rem;font-weight:700;padding:2px 6px;border-radius:4px;background:rgba(208,78,26,.25);color:#f0886a}
.sidebar-div{height:1px;background:rgba(255,255,255,.06);margin:6px 8px}
.sidebar-footer{padding:14px 12px;border-top:1px solid rgba(255,255,255,.06)}
.user-card{display:flex;align-items:center;gap:9px}
.user-av{width:30px;height:30px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.6rem;font-weight:700;flex-shrink:0}
.user-name{font-size:.78rem;font-weight:600;color:rgba(255,255,255,.85)}
.user-role{font-size:.65rem;color:rgba(255,255,255,.35)}

/* ── Header ── */
.header{background:rgba(249,248,245,.97);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 28px;height:58px;gap:10px;flex-shrink:0}
.header-title{font-family:'Instrument Serif',serif;font-size:1.1rem;color:var(--ink);letter-spacing:-.02em}
.header-sub{font-size:.74rem;color:var(--muted)}
.header-spacer{flex:1}
.icon-btn{width:34px;height:34px;border-radius:8px;background:var(--surface);border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);position:relative;flex-shrink:0;cursor:pointer}
.notif-dot{position:absolute;top:7px;right:7px;width:6px;height:6px;border-radius:50%;background:#e06040;border:1.5px solid var(--bg)}
.btn-back{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:var(--muted);padding:6px 12px;border:1.5px solid var(--border);border-radius:7px;background:var(--surface)}

/* ── Page Body ── */
.page-body{padding:24px 28px;display:flex;flex-direction:column;gap:20px;overflow-y:auto;flex:1}

/* ── Stats ── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
.stats-grid.cols3{grid-template-columns:repeat(3,1fr)}
.stats-grid.cols2{grid-template-columns:repeat(2,1fr)}
.stat-card{background:var(--white);border:1px solid var(--border);border-radius:12px;padding:16px 18px}
.stat-label{font-family:'Syne',sans-serif;font-size:.57rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted-2);margin-bottom:6px;display:flex;align-items:center;gap:6px}
.stat-num{font-family:'Instrument Serif',serif;font-size:2rem;color:var(--ink);letter-spacing:-.04em;line-height:1}
.stat-num.green{color:var(--green)}.stat-num.red{color:var(--red)}.stat-num.amber{color:var(--amber)}
.stat-sub{font-size:.67rem;color:var(--muted-2);margin-top:3px}

/* ── Tabs ── */
.page-tabs{display:flex;align-items:center;gap:2px;background:var(--white);border:1px solid var(--border);border-radius:10px;padding:5px;width:fit-content}
.ptab{font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:7px 14px;border-radius:7px;color:var(--muted-2);display:flex;align-items:center;gap:6px;cursor:pointer;white-space:nowrap;transition:all .15s}
.ptab.active{background:var(--accent);color:#fff}
.ptab-cnt{font-family:'Syne',sans-serif;font-size:.5rem;font-weight:700;padding:2px 5px;border-radius:4px;background:rgba(255,255,255,.25)}
.ptab:not(.active) .ptab-cnt{background:var(--surface);color:var(--muted-2)}
.ptab:not(.active) .ptab-cnt.warn{background:rgba(192,57,43,.1);color:var(--red)}

/* ── Table ── */
.table-wrap{background:var(--white);border:1px solid var(--border);border-radius:12px;overflow:hidden}
.table-head{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid var(--border)}
.table-title{font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
.table-toolbar{display:flex;align-items:center;gap:8px;padding:12px 18px;border-bottom:1px solid var(--border);flex-wrap:wrap}
.tb-search{display:flex;align-items:center;gap:8px;background:var(--surface);border:1.5px solid var(--border);border-radius:7px;padding:0 10px;height:32px;min-width:200px}
.tb-search input{border:none;background:none;font-size:.75rem;color:var(--ink);outline:none;width:100%}
.tb-select{height:32px;padding:0 8px;border:1.5px solid var(--border);border-radius:7px;font-size:.75rem;color:var(--ink);background:var(--surface);outline:none}
.tb-spacer{flex:1}
table{width:100%;border-collapse:collapse}
thead th{font-family:'Syne',sans-serif;font-size:.57rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted-2);padding:10px 14px;text-align:left;border-bottom:1px solid var(--border);background:var(--surface)}
tbody td{font-size:.8rem;padding:11px 14px;border-bottom:1px solid var(--border);color:var(--ink);vertical-align:middle}
tbody tr:last-child td{border-bottom:none}
tbody tr:hover{background:var(--bg)}
.row-actions{display:flex;align-items:center;justify-content:flex-end;gap:5px}
.action-btn{width:28px;height:28px;border-radius:6px;border:1.5px solid var(--border);background:var(--surface);display:flex;align-items:center;justify-content:center;color:var(--muted);cursor:pointer;transition:all .15s;text-decoration:none}
.action-btn:hover{border-color:var(--border-2);color:var(--ink)}
.action-btn.danger{border-color:rgba(192,57,43,.2);background:var(--red-pale);color:var(--red)}
.action-btn.success{border-color:rgba(28,107,70,.2);background:var(--green-pale);color:var(--green)}
.pagination{display:flex;align-items:center;justify-content:space-between;padding:12px 18px;border-top:1px solid var(--border);flex-wrap:wrap;gap:8px}
.pag-info{font-size:.72rem;color:var(--muted-2)}
.pag-btns{display:flex;gap:4px}
.pag-btn{width:28px;height:28px;border-radius:6px;border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:.72rem;color:var(--muted);cursor:pointer;text-decoration:none;transition:all .15s}
.pag-btn:hover{border-color:var(--border-2);color:var(--ink)}
.pag-btn.active{background:var(--accent);color:#fff;font-weight:700;border-color:var(--accent)}
.pag-btn.disabled{opacity:.35;pointer-events:none}

/* ── Badges ── */
.badge{font-family:'Syne',sans-serif;font-size:.52rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:3px 9px;border-radius:5px;display:inline-flex;align-items:center;gap:4px;white-space:nowrap}
.badge-green{background:var(--green-pale);color:var(--green);border:1px solid var(--green-pale-2)}
.badge-red{background:var(--red-pale);color:var(--red);border:1px solid rgba(192,57,43,.2)}
.badge-amber{background:var(--amber-pale);color:var(--amber);border:1px solid rgba(184,118,10,.2)}
.badge-blue{background:var(--blue-pale);color:var(--blue);border:1px solid rgba(26,82,128,.15)}
.badge-muted{background:var(--surface);color:var(--muted-2);border:1px solid var(--border)}

/* ── Buttons ── */
.btn-primary{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--accent);color:#fff;padding:8px 16px;border-radius:8px;cursor:pointer;white-space:nowrap;text-decoration:none;border:none;transition:all .15s}
.btn-primary:hover{background:var(--accent-dark)}
.btn-danger{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--red);color:#fff;padding:8px 16px;border-radius:8px;cursor:pointer;white-space:nowrap;text-decoration:none;border:none}
.btn-secondary{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;border:1.5px solid var(--border);color:var(--ink-2);padding:7px 14px;border-radius:8px;cursor:pointer;white-space:nowrap;text-decoration:none;background:none;transition:all .15s}
.btn-secondary:hover{border-color:var(--border-2)}

/* ── Form ── */
.form-page{max-width:860px}
.form-card{background:var(--white);border:1px solid var(--border);border-radius:12px;overflow:hidden}
.form-card-header{padding:18px 22px;border-bottom:1px solid var(--border)}
.form-card-title{font-family:'Instrument Serif',serif;font-size:1.1rem;color:var(--ink)}
.form-card-sub{font-size:.74rem;color:var(--muted);margin-top:2px}
.form-body{padding:22px;display:flex;flex-direction:column}
.form-row{display:grid;gap:14px;margin-bottom:16px}
.form-row.cols-2{grid-template-columns:1fr 1fr}
.form-row.cols-3{grid-template-columns:2fr 1fr 1fr}
.form-row.cols-1{grid-template-columns:1fr}
.field-label{display:block;font-family:'Syne',sans-serif;font-size:.59rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--muted);margin-bottom:5px}
.field-label span{color:var(--red)}
.form-input{width:100%;height:40px;padding:0 11px;border-radius:8px;border:1.5px solid var(--border);background:var(--white);font-size:.84rem;color:var(--ink);outline:none;transition:border-color .2s}
.form-input:focus{border-color:var(--accent)}
.form-select{width:100%;height:40px;padding:0 11px;border-radius:8px;border:1.5px solid var(--border);background:var(--white);font-size:.84rem;color:var(--ink);outline:none}
.form-textarea{width:100%;padding:10px 11px;border-radius:8px;border:1.5px solid var(--border);background:var(--white);font-size:.84rem;color:var(--ink);outline:none;resize:vertical;font-family:inherit}
.form-textarea:focus{border-color:var(--accent)}
.form-hint{font-size:.65rem;color:var(--muted-2);margin-top:3px}
.form-footer{padding:16px 22px;border-top:1px solid var(--border);background:var(--surface);display:flex;align-items:center;gap:9px}
.cover-preview{width:60px;height:84px;border-radius:8px;background:linear-gradient(150deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:1px 2px 8px rgba(0,0,0,.12)}
.cover-preview-wrap{display:flex;align-items:flex-end;gap:14px;padding:14px;background:var(--surface);border-radius:9px;border:1px solid var(--border);margin-bottom:14px}

/* ── Modals ── */
.modal-overlay{position:fixed;inset:0;background:rgba(22,20,15,.55);display:none;align-items:center;justify-content:center;z-index:100;padding:40px}
.modal-overlay.open{display:flex}
.modal{background:var(--white);border-radius:16px;width:100%;max-width:500px;box-shadow:0 24px 60px rgba(0,0,0,.35);overflow:hidden}
.modal.wide{max-width:560px}
.modal-header{padding:18px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.modal-title{font-family:'Instrument Serif',serif;font-size:1.1rem;color:var(--ink)}
.modal-close{width:28px;height:28px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:var(--muted);border:1px solid var(--border);cursor:pointer}
.modal-body{padding:20px 24px;display:flex;flex-direction:column;gap:13px}
.modal-fields{display:grid;gap:11px}
.m-field-label{display:block;font-family:'Syne',sans-serif;font-size:.59rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--muted);margin-bottom:5px}
.m-input{width:100%;height:40px;padding:0 11px;border-radius:8px;border:1.5px solid var(--border);background:var(--white);font-size:.84rem;color:var(--ink);outline:none;font-family:inherit}
.m-input:focus{border-color:var(--accent)}
.m-select{width:100%;height:40px;padding:0 11px;border-radius:8px;border:1.5px solid var(--border);background:var(--white);font-size:.84rem;color:var(--ink);outline:none}
.m-textarea{width:100%;padding:9px 11px;border-radius:8px;border:1.5px solid var(--border);background:var(--white);font-size:.84rem;color:var(--ink);outline:none;resize:none;font-family:inherit}
.m-textarea:focus{border-color:var(--accent)}
.modal-footer{display:flex;gap:8px;padding:14px 24px;border-top:1px solid var(--border);background:var(--surface)}
.modal-btn-cancel{display:inline-flex;align-items:center;gap:6px;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:9px 18px;border-radius:8px;border:1.5px solid var(--border);color:var(--ink-2);cursor:pointer;background:none}
.modal-btn-ok{display:inline-flex;align-items:center;gap:6px;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:9px 18px;border-radius:8px;background:var(--accent);color:#fff;cursor:pointer;border:none}
.modal-btn-danger{display:inline-flex;align-items:center;gap:6px;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:9px 18px;border-radius:8px;background:var(--red);color:#fff;cursor:pointer;border:none}
.modal-notice{display:flex;align-items:flex-start;gap:9px;padding:11px 14px;border-radius:8px;font-size:.77rem;line-height:1.5}
.notice-amber{background:var(--amber-pale);border:1px solid rgba(184,118,10,.2);color:#7a5000}
.notice-blue{background:var(--blue-pale);border:1px solid rgba(26,82,128,.15);color:var(--blue)}
.notice-red{background:var(--red-pale);border:1px solid rgba(192,57,43,.2);color:var(--red)}
.notice-green{background:var(--green-pale);border:1px solid var(--green-pale-2);color:var(--green)}
.modal-book-row{display:flex;gap:12px;padding:12px;background:var(--surface);border:1px solid var(--border);border-radius:10px}
.mini-cover{width:42px;height:60px;border-radius:6px;flex-shrink:0;box-shadow:1px 2px 8px rgba(0,0,0,.12)}

/* ── Dashboard cards ── */
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.card{background:var(--white);border:1px solid var(--border);border-radius:12px;overflow:hidden}
.card-head{padding:13px 16px;border-bottom:1px solid var(--border);font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--muted);display:flex;align-items:center;justify-content:space-between}
.card-body{padding:0 16px}
.recent-row{display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--border)}
.recent-row:last-child{border-bottom:none}
.recent-av{width:28px;height:28px;border-radius:50%;background:var(--accent-pale);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:.58rem;font-weight:700;flex-shrink:0}
.recent-name{font-size:.78rem;font-weight:500;color:var(--ink)}
.recent-sub{font-size:.67rem;color:var(--muted-2)}
.recent-date{font-size:.68rem;color:var(--muted-2);margin-left:auto;white-space:nowrap}

/* ── Banner ── */
.banner-blue{padding:16px 20px;background:linear-gradient(135deg,rgba(26,82,128,.08),rgba(26,82,128,.04));border:1px solid rgba(26,82,128,.15);border-radius:12px;display:flex;align-items:center;gap:14px}

/* ── Toast ── */
.toast{position:fixed;bottom:24px;right:24px;background:var(--ink);color:#fff;padding:12px 18px;border-radius:10px;font-size:.8rem;font-weight:500;z-index:200;display:none;align-items:center;gap:8px;box-shadow:0 8px 24px rgba(0,0,0,.25)}
.toast.show{display:flex}
.toast.success{background:var(--accent)}
.toast.danger{background:var(--red)}

/* ── Flash ── */
.flash-success{display:flex;align-items:center;gap:10px;background:var(--green-pale);border:1px solid var(--green-pale-2);border-radius:10px;padding:11px 16px;font-size:.78rem;color:var(--green)}
.flash-error{background:var(--red-pale);border:1px solid rgba(192,57,43,.2);border-radius:10px;padding:11px 16px;font-size:.78rem;color:var(--red)}

/* ── Mini avatar ── */
.mini-av{width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.52rem;font-weight:700;flex-shrink:0}

@media(max-width:768px){
  .app{grid-template-columns:1fr}
  .sidebar{display:none}
  .page-body{padding:16px}
  .header{padding:0 16px}
  .stats-grid{grid-template-columns:1fr 1fr}
  .two-col{grid-template-columns:1fr}
}
</style>
@stack('styles')
</head>
<body>
<div class="app">

  <!-- ══ SIDEBAR ══ -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-mark">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.75">
          <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
        </svg>
      </div>
      <span class="logo-name">DigiLib</span>
      <span class="logo-badge">{{ $isAdmin ? 'Admin' : 'Petugas' }}</span>
    </div>

    <nav class="sidebar-nav">
      @if($isAdmin)
        <div class="nav-section-label">Overview</div>
        <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg></div>
          Dashboard
        </a>
        <div class="sidebar-div"></div>
        <div class="nav-section-label">Manajemen</div>
        <a class="nav-item {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
          Manajemen Buku
          @php $pending = \App\Models\BookProposal::pending()->count(); @endphp
          @if($pending > 0)<span class="nav-badge">{{ $pending }}</span>@endif
        </a>
        <a class="nav-item {{ request()->routeIs('admin.borrowings.*') ? 'active' : '' }}" href="{{ route('admin.borrowings.index') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg></div>
          Peminjaman
        </a>
        <a class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
          Manajemen Akun
        </a>
        <div class="sidebar-div"></div>
        <a class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg></div>
          Laporan
        </a>
      @else
        <div class="nav-section-label">Menu</div>
        <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg></div>
          Beranda
        </a>
        <a class="nav-item {{ request()->routeIs('admin.books.proposals.*') ? 'active' : '' }}" href="{{ route('admin.books.proposals.index') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
          Usulan Buku
          @php $myPending = \App\Models\BookProposal::where('user_id', auth()->id())->pending()->count(); @endphp
          @if($myPending > 0)<span class="nav-badge">{{ $myPending }}</span>@endif
        </a>
        <a class="nav-item {{ request()->routeIs('admin.borrowings.*') ? 'active' : '' }}" href="{{ route('admin.borrowings.index') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg></div>
          Peminjaman
        </a>
        <div class="sidebar-div"></div>
        <a class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
          <div class="nav-item-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg></div>
          Laporan
        </a>
      @endif
    </nav>

    <div class="sidebar-footer">
      <div class="user-card">
        <div class="user-av">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
        <div>
          <div class="user-name">{{ auth()->user()->name }}</div>
          <div class="user-role">{{ $isAdmin ? 'Administrator' : 'Petugas Perpustakaan' }}</div>
        </div>
      </div>
      <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit()" style="margin-left:auto;color:rgba(255,255,255,.3);display:flex" title="Keluar">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
    </div>
  </aside>

  <!-- ══ MAIN ══ -->
  <div class="main-col">

    <!-- Header -->
    <header class="header">
      @hasSection('back-url')
        <a href="@yield('back-url')" class="btn-back">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
          Kembali
        </a>
      @endif
      <div>
        <span class="header-title">@yield('page-title','Dashboard')</span>
        @hasSection('page-subtitle')
          <div class="header-sub">@yield('page-subtitle')</div>
        @endif
      </div>
      <div class="header-spacer"></div>
      @yield('header-actions')
      <div class="icon-btn" title="Notifikasi">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      </div>
    </header>

    <!-- Page body -->
    <div class="page-body">
      @if(session('success'))
        <div class="flash-success">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="flash-error">{{ session('error') }}</div>
      @endif

      @yield('content')
    </div>

  </div>
</div>

<!-- Toast -->
<div id="toast" class="toast"></div>

<script>
function openModal(id){ document.getElementById('modal-'+id).classList.add('open') }
function closeModal(id){ document.getElementById('modal-'+id).classList.remove('open') }
function handleOverlayClick(e,id){ if(e.target===e.currentTarget) closeModal(id) }
let _tt;
function showToast(msg,type){
  const t=document.getElementById('toast');
  t.textContent=msg; t.className='toast show '+(type||'');
  clearTimeout(_tt); _tt=setTimeout(()=>t.className='toast',2800);
}
</script>
@stack('scripts')
</body>
</html>
