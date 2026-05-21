<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="description" content="DigiLib — Perpustakaan Kota Bogor. 2.400+ koleksi buku fisik pilihan. Pinjam online, ambil langsung di perpustakaan. Daftar gratis, denda berlaku untuk keterlambatan."/>
<title>DigiLib — Perpustakaan Digital Indonesia</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
<style>
:root{
  --ink:#16140f;--ink-2:#2d2a22;--muted:#6a655b;--muted-2:#a09a90;
  --bg:#f9f8f5;--surface:#f2f0eb;--border:#e4e2da;--border-2:#c9c5ba;
  --white:#ffffff;
  --green:#1c6b46;--green-dark:#145235;--green-3:#0b3021;
  --green-pale:#eaf3ee;--green-pale-2:#c4dfce;
  --accent:#d04e1a;--accent-2:#a83e14;
  --teal:#5db98a;
  --nav-h:62px;
  --nav-bg-top:rgba(8,30,18,.22);
  --nav-bg-scroll:rgba(249,248,245,.96);
  --nav-text-top:rgba(244,241,234,.78);
  --nav-text-scroll:var(--muted);
  --nav-logo-top:rgba(244,241,234,.97);
  --nav-logo-scroll:var(--ink);
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{
  background:var(--bg);color:var(--ink);
  font-family:'DM Sans',system-ui,sans-serif;
  overflow-x:hidden;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  text-rendering:optimizeLegibility;
}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none;background:none}
img{max-width:100%;display:block}

/* ── NAV ──── */
.nav{
  position:fixed;top:0;left:0;right:0;z-index:900;
  background:var(--nav-bg-top);
  border-bottom:1px solid rgba(255,255,255,.06);
  -webkit-backdrop-filter:blur(0px) saturate(1);
  backdrop-filter:blur(0px) saturate(1);
  transition:background .35s ease,border-color .35s ease,
             -webkit-backdrop-filter .35s ease,backdrop-filter .35s ease,
             box-shadow .35s ease;
}
.nav.scrolled{
  background:var(--nav-bg-scroll);
  border-bottom-color:rgba(0,0,0,.07);
  -webkit-backdrop-filter:blur(20px) saturate(1.6);
  backdrop-filter:blur(20px) saturate(1.6);
  box-shadow:0 1px 0 rgba(0,0,0,.05),0 4px 24px rgba(0,0,0,.04);
}
.nav-inner{
  display:flex;align-items:center;
  height:var(--nav-h);
  padding:0 28px;gap:0;
  max-width:1340px;margin:0 auto;
}
.nav-logo{
  display:flex;align-items:center;gap:9px;
  font-family:'Instrument Serif',serif;font-size:1.2rem;
  color:var(--nav-logo-top);
  white-space:nowrap;flex-shrink:0;
  margin-right:28px;
  transition:color .35s;
}
.nav.scrolled .nav-logo{color:var(--nav-logo-scroll)}
.nav-logo-icon{
  width:28px;height:28px;border-radius:7px;
  background:var(--green);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}
.nav-links{
  display:flex;align-items:center;gap:2px;
  position:relative;flex-shrink:0;
}
.nl-pill{
  position:absolute;top:50%;transform:translateY(-50%);
  height:30px;border-radius:7px;
  background:rgba(255,255,255,.13);
  transition:left .22s cubic-bezier(.4,0,.2,1),width .22s cubic-bezier(.4,0,.2,1),background .35s;
  pointer-events:none;z-index:0;
}
.nav.scrolled .nl-pill{background:rgba(28,107,70,.09)}
.nl{
  position:relative;z-index:1;
  font-family:'DM Sans',sans-serif;font-size:.82rem;font-weight:500;
  color:var(--nav-text-top);
  padding:6px 13px;border-radius:7px;
  white-space:nowrap;cursor:pointer;
  transition:color .2s;
  letter-spacing:-.01em;
  user-select:none;
}
.nav.scrolled .nl{color:var(--nav-text-scroll)}
.nl:hover,.nl.active{color:rgba(244,241,234,.97)}
.nav.scrolled .nl:hover,.nav.scrolled .nl.active{color:var(--green)}
.nav-div{
  width:1px;height:18px;background:rgba(255,255,255,.14);
  margin:0 18px;flex-shrink:0;transition:background .35s;
}
.nav.scrolled .nav-div{background:var(--border)}
.nav-search-wrap{flex:1;max-width:340px;margin:0 14px;position:relative}
.nav-search{
  display:flex;align-items:center;
  background:rgba(255,255,255,.1);
  border:1px solid rgba(255,255,255,.15);
  border-radius:8px;height:35px;
  transition:background .35s,border-color .35s,box-shadow .15s;
}
.nav.scrolled .nav-search{background:var(--surface);border-color:var(--border)}
.nav-search:focus-within{
  border-color:var(--green)!important;
  box-shadow:0 0 0 3px rgba(28,107,70,.12);
  background:var(--white)!important;
}
.nav-search-icon{
  padding:0 10px;display:flex;align-items:center;
  color:rgba(255,255,255,.45);flex-shrink:0;
  transition:color .35s;
}
.nav.scrolled .nav-search-icon{color:var(--muted-2)}
.nav-search:focus-within .nav-search-icon{color:var(--green)}
.nav-search input{
  flex:1;height:100%;padding:0 10px 0 0;
  background:transparent;border:none;outline:none;
  font-family:'DM Sans',sans-serif;font-size:.82rem;
  color:#f4f1ea;min-width:0;
  transition:color .35s;
}
.nav.scrolled .nav-search input{color:var(--ink)}
.nav-search input::placeholder{color:rgba(255,255,255,.35);transition:color .35s}
.nav.scrolled .nav-search input::placeholder{color:var(--muted-2)}
.nav-search-btn{
  height:100%;padding:0 11px;
  display:flex;align-items:center;
  color:rgba(255,255,255,.35);cursor:pointer;
  border-left:1px solid rgba(255,255,255,.12);
  border-radius:0 7px 7px 0;
  transition:color .15s,background .15s,border-color .35s;
  flex-shrink:0;
}
.nav.scrolled .nav-search-btn{color:var(--muted-2);border-left-color:var(--border)}
.nav-search-btn:hover{color:rgba(255,255,255,.85)!important;background:rgba(255,255,255,.08)!important}
.nav.scrolled .nav-search-btn:hover{color:var(--green)!important;background:var(--green-pale)!important}
.search-dropdown{
  position:absolute;top:calc(100% + 8px);left:0;right:0;
  background:var(--white);border:1px solid var(--border);
  border-radius:10px;box-shadow:0 8px 32px rgba(0,0,0,.12);
  z-index:9999;overflow:hidden;display:none;min-width:320px;
}
.search-dropdown.open{display:block}
.sd-item{display:flex;align-items:center;gap:10px;padding:9px 14px;cursor:pointer;transition:background .1s}
.sd-item:hover,.sd-item.kbactive{background:var(--surface)}
.sd-icon{color:var(--muted-2);flex-shrink:0}
.sd-text{flex:1;min-width:0}
.sd-title{font-size:.82rem;font-weight:500;color:var(--ink);line-height:1.3}
.sd-author{font-size:.71rem;color:var(--muted);margin-top:1px}
.sd-genre{font-family:'Syne',sans-serif;font-size:.55rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--green);background:var(--green-pale);padding:2px 7px;border-radius:4px;flex-shrink:0;white-space:nowrap}
.nav-right{display:flex;align-items:center;gap:7px;flex-shrink:0;margin-left:auto}
.nav-btn{
  font-family:'DM Sans',sans-serif;font-size:.8rem;font-weight:600;
  padding:7px 15px;border-radius:7px;
  cursor:pointer;transition:all .15s;
  display:block;white-space:nowrap;
  letter-spacing:-.01em;
}
.nav-btn-ghost{
  color:rgba(244,241,234,.7);
  border:1px solid rgba(255,255,255,.18);
  transition:all .35s;
}
.nav-btn-ghost:hover{color:rgba(244,241,234,.97)!important;border-color:rgba(255,255,255,.38)!important;background:rgba(255,255,255,.07)!important}
.nav.scrolled .nav-btn-ghost{color:var(--ink-2);border-color:var(--border)}
.nav.scrolled .nav-btn-ghost:hover{color:var(--green)!important;border-color:var(--green)!important;background:var(--green-pale)!important}
.nav-btn-primary{background:var(--green);color:#fff;border:1px solid var(--green)}
.nav-btn-primary:hover{background:var(--green-dark);border-color:var(--green-dark)}

/* hamburger */
.nav-hamburger{
  display:none;flex-direction:column;gap:4.5px;cursor:pointer;
  padding:6px;border-radius:6px;transition:background .15s;
  margin-left:auto;flex-shrink:0;
}
.nav-hamburger:hover{background:rgba(255,255,255,.08)}
.nav.scrolled .nav-hamburger:hover{background:var(--surface)}
.nav-hamburger span{
  display:block;width:20px;height:2px;border-radius:2px;
  background:rgba(244,241,234,.7);
  transition:background .35s,transform .25s,opacity .25s;
}
.nav.scrolled .nav-hamburger span{background:var(--ink-2)}
.nav-hamburger.open span:nth-child(1){transform:translateY(6.5px) rotate(45deg)}
.nav-hamburger.open span:nth-child(2){opacity:0}
.nav-hamburger.open span:nth-child(3){transform:translateY(-6.5px) rotate(-45deg)}

/* mobile menu */
.mobile-menu{
  display:none;position:fixed;top:var(--nav-h);left:0;right:0;
  background:var(--white);border-bottom:1px solid var(--border);
  z-index:899;padding:16px 20px 20px;
  box-shadow:0 8px 32px rgba(0,0,0,.1);
  transform:translateY(-8px);opacity:0;
  transition:transform .22s ease,opacity .22s ease;
  pointer-events:none;
}
.mobile-menu.open{display:block;transform:translateY(0);opacity:1;pointer-events:auto;}
.mm-links{display:flex;flex-direction:column;gap:2px;margin-bottom:14px}
.mm-link{
  font-family:'DM Sans',sans-serif;font-size:.95rem;font-weight:500;
  color:var(--ink-2);padding:10px 12px;border-radius:7px;
  cursor:pointer;transition:background .12s,color .12s;
}
.mm-link:hover,.mm-link.active{background:var(--green-pale);color:var(--green)}
.mm-divider{height:1px;background:var(--border);margin:6px 0}
.mm-btns{display:flex;gap:8px}
.mm-btn{
  flex:1;text-align:center;font-family:'DM Sans',sans-serif;
  font-size:.85rem;font-weight:600;padding:10px;border-radius:7px;
  cursor:pointer;transition:all .15s;
}
.mm-btn-ghost{color:var(--ink-2);border:1px solid var(--border)}
.mm-btn-ghost:hover{border-color:var(--green);color:var(--green)}
.mm-btn-primary{background:var(--green);color:#fff;border:1px solid var(--green)}
.mm-btn-primary:hover{background:var(--green-dark)}

.nav-spacer{height:var(--nav-h)}

/* ── HERO ── */
.hero{position:relative;min-height:580px;overflow:hidden;background:var(--green-3)}
.hero-bg{position:absolute;inset:0;background:linear-gradient(135deg,#061a0f 0%,#123d28 55%,#061a0f 100%)}
.hero-grain{position:absolute;inset:0;z-index:1;pointer-events:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='250' height='250'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='250' height='250' filter='url(%23n)' opacity='.028'/%3E%3C/svg%3E");background-size:250px}
.hero-vignette{position:absolute;inset:0;z-index:2;background:linear-gradient(to right,rgba(6,26,15,.96) 0%,rgba(6,26,15,.68) 42%,rgba(6,26,15,.02) 70%,transparent 100%)}
.hero-inner{position:relative;z-index:3;min-height:580px;display:flex;align-items:center;padding:60px 48px;max-width:1280px}
.hero-badge{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(200,225,210,.65);margin-bottom:18px}
.hero-badge-dot{width:5px;height:5px;border-radius:50%;background:var(--teal);animation:pulse 2.2s ease-in-out infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
.hero-title{font-family:'Instrument Serif',serif;font-size:clamp(2rem,4.8vw,4.8rem);font-weight:400;line-height:.93;letter-spacing:-.03em;color:#f4f1ea;margin-bottom:14px;max-width:500px}
.hero-title em{font-style:italic;color:rgba(244,241,234,.42)}
.hero-meta{display:flex;align-items:center;gap:9px;margin-bottom:20px;flex-wrap:wrap}
.hero-rating{display:flex;align-items:center;gap:5px;background:rgba(93,185,138,.12);border:1px solid rgba(93,185,138,.24);padding:4px 10px;border-radius:5px}
.hero-rating-star{color:var(--teal);font-size:.82rem}
.hero-rating-n{font-family:'Syne',sans-serif;font-size:.78rem;font-weight:700;color:var(--teal)}
.hero-rating-ct{font-size:.7rem;color:rgba(244,241,234,.38);margin-left:2px}
.hero-tag{font-family:'Syne',sans-serif;font-size:.62rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:rgba(244,241,234,.4);padding:4px 10px;border-radius:5px;border:1px solid rgba(255,255,255,.1)}
.hero-desc{font-size:.88rem;color:rgba(244,241,234,.56);line-height:1.78;max-width:420px;margin-bottom:28px}
.hero-actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.hero-btn-main{display:inline-flex;align-items:center;gap:8px;font-family:'Syne',sans-serif;font-size:.76rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--green);color:#fff;padding:12px 24px;border-radius:7px;transition:all .2s}
.hero-btn-main:hover{background:#24855a;transform:translateY(-1px);box-shadow:0 6px 20px rgba(28,107,70,.35)}
.hero-btn-sec{display:inline-flex;align-items:center;gap:8px;font-family:'Syne',sans-serif;font-size:.76rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;color:rgba(244,241,234,.52);border:1px solid rgba(255,255,255,.14);padding:11px 20px;border-radius:7px;transition:all .2s}
.hero-btn-sec:hover{color:#f4f1ea;border-color:rgba(255,255,255,.34)}
.hero-covers{position:absolute;right:60px;top:50%;transform:translateY(-50%);z-index:3;display:flex;gap:24px;align-items:flex-end}
.hero-cover-main{width:150px;height:216px;border-radius:7px;overflow:hidden;flex-shrink:0;box-shadow:-14px 10px 40px rgba(0,0,0,.7),4px 0 0 rgba(255,255,255,.04)}
.hero-cover-main-inner{width:100%;height:100%;background:linear-gradient(160deg,#1a6648,#030e07);display:flex;flex-direction:column;justify-content:flex-end;padding:14px;position:relative;}
.hero-cover-main-inner img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;display:block;border-radius:0;}
.hero-cover-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.72) 0%,transparent 60%);border-radius:0;z-index:1}
.hero-cover-t{font-family:'Instrument Serif',serif;font-size:.8rem;color:rgba(255,255,255,.92);line-height:1.2;position:relative;z-index:2}
.hero-cover-a{font-size:.6rem;color:rgba(255,255,255,.46);margin-top:3px;position:relative;z-index:2}
.hero-side-stack{display:flex;flex-direction:column;gap:9px;padding-bottom:8px}
.hero-side-cover{width:64px;height:92px;border-radius:5px;overflow:hidden;opacity:.42;box-shadow:-4px 4px 16px rgba(0,0,0,.5);position:relative}
.hero-side-cover-inner{width:100%;height:100%}
.hero-side-cover img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block;}

/* ── PAGE ── */
.page{max-width:1280px;margin:0 auto;padding:0 32px}

/* ── SECTION HEADER ── */
.sh{display:flex;align-items:baseline;justify-content:space-between;padding-top:52px;margin-bottom:22px}
.sh-left{display:flex;align-items:baseline;gap:12px}
.sh-title{font-family:'Instrument Serif',serif;font-size:1.5rem;font-weight:400;color:var(--ink);letter-spacing:-.02em}
.sh-title em{font-style:italic;color:var(--muted)}
.sh-badge{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--green);display:flex;align-items:center;gap:6px}
.sh-badge::before{content:'';width:12px;height:2px;background:var(--green);flex-shrink:0}

/* ── CAROUSEL ── */
.car-wrap{position:relative;margin:0 -32px}
.car-fade{position:absolute;right:0;top:0;bottom:0;width:80px;background:linear-gradient(to left,var(--bg),transparent);pointer-events:none;z-index:2}
.car{display:flex;gap:14px;overflow-x:auto;scrollbar-width:none;padding:4px 32px 20px;-webkit-overflow-scrolling:touch;cursor:grab}
.car::-webkit-scrollbar{display:none}
.car:active{cursor:grabbing}

/* ── BOOK CARD ── */
.bk{width:128px;flex-shrink:0}
.bk-link{display:block;color:inherit}
.bk-cov{width:128px;height:186px;border-radius:7px;margin-bottom:10px;overflow:hidden;position:relative;box-shadow:0 2px 0 rgba(0,0,0,.07),0 4px 16px rgba(0,0,0,.09);transition:transform .3s cubic-bezier(.34,1.56,.64,1),box-shadow .3s}
.bk:hover .bk-cov{transform:translateY(-6px) scale(1.02);box-shadow:0 14px 28px rgba(0,0,0,.16)}
.bk-cov-art{width:100%;height:100%;display:flex;flex-direction:column;justify-content:flex-end;padding:10px 9px}
.bk-cov::before{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.52) 0%,transparent 45%);z-index:1}
.bk-cov::after{content:'';position:absolute;left:0;top:0;bottom:0;width:7px;background:linear-gradient(to right,rgba(0,0,0,.2),transparent);z-index:1}
.bk-cov-txt{position:relative;z-index:2}
.bk-cov-t{font-family:'Instrument Serif',serif;font-size:.54rem;color:rgba(255,255,255,.92);line-height:1.2}
.bk-cov-a{font-size:.46rem;color:rgba(255,255,255,.5);margin-top:2px}
.bk-badge{position:absolute;top:8px;left:8px;z-index:3;font-family:'Syne',sans-serif;font-size:.5rem;font-weight:700;letter-spacing:.04em;padding:3px 7px;border-radius:4px}
.bb-hot{background:var(--accent);color:#fff}
.bb-new{background:var(--green);color:#fff}
.bb-top{background:rgba(0,0,0,.58);color:rgba(255,255,255,.85);backdrop-filter:blur(4px)}
.bk-title{font-size:.78rem;font-weight:500;color:var(--ink);line-height:1.25;margin-bottom:3px}
.bk-author{font-size:.68rem;color:var(--muted);margin-bottom:4px}
.bk-rat{display:flex;align-items:center;gap:4px}
.bk-star{color:#e6a817;font-size:.7rem}
.bk-score{font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;color:var(--ink-2)}
.bk-votes{font-size:.63rem;color:var(--muted-2)}

/* ── DUAL LAYOUT ── */
.dual{display:grid;grid-template-columns:1fr 310px;gap:44px;align-items:start}

/* ── TOP CHART ── */
.chart{background:var(--white);border:1px solid var(--border);border-radius:10px;overflow:hidden;position:sticky;top:92px}
.chart-head{background:var(--green);padding:16px 20px;display:flex;align-items:center;justify-content:space-between}
.chart-head-t{font-family:'Instrument Serif',serif;font-size:1.1rem;color:#f4f1ea}
.chart-head-s{font-family:'Syne',sans-serif;font-size:.57rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:rgba(244,241,234,.48);margin-top:2px}
.ch-item{display:flex;align-items:center;gap:12px;padding:11px 16px;border-bottom:1px solid var(--border);transition:background .15s;cursor:pointer}
.ch-item:last-child{border-bottom:none}
.ch-item:hover{background:var(--surface)}
.ch-rank{font-family:'Instrument Serif',serif;font-size:1.3rem;color:var(--border-2);width:24px;text-align:center;flex-shrink:0;line-height:1}
.ch-rank.hi{color:var(--accent)}
.ch-cov{width:38px;height:54px;border-radius:4px;overflow:hidden;flex-shrink:0;box-shadow:1px 2px 8px rgba(0,0,0,.12)}
.ch-info{flex:1;min-width:0}
.ch-t{font-size:.78rem;font-weight:500;color:var(--ink);line-height:1.2;margin-bottom:2px}
.ch-a{font-size:.67rem;color:var(--muted)}
.ch-r{display:flex;align-items:center;gap:3px;margin-top:4px}
.ch-star{color:#e6a817;font-size:.66rem}
.ch-sc{font-family:'Syne',sans-serif;font-size:.66rem;font-weight:700;color:var(--ink-2)}
.ch-badge{font-family:'Syne',sans-serif;font-size:.5rem;font-weight:700;letter-spacing:.04em;padding:2px 6px;border-radius:4px;flex-shrink:0}
.cb-up{background:var(--green-pale);color:var(--green)}
.cb-fire{background:rgba(208,78,26,.1);color:var(--accent)}

/* ── GENRE TABS ── */
.gtabs{display:flex;border-bottom:1.5px solid var(--border);overflow-x:auto;scrollbar-width:none;margin-bottom:20px}
.gtabs::-webkit-scrollbar{display:none}
.gtab{font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--muted-2);padding:10px 16px;border-bottom:2px solid transparent;margin-bottom:-1.5px;white-space:nowrap;cursor:pointer;transition:color .15s,border-color .15s}
.gtab:hover{color:var(--ink)}
.gtab.active{color:var(--green);border-bottom-color:var(--green)}

/* ── GENRE GRID ── */
.ggrid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px}
.gtile{background:var(--white);border:1.5px solid var(--border);border-radius:10px;padding:16px 14px;cursor:pointer;transition:all .2s;display:flex;flex-direction:column;gap:7px;position:relative;overflow:hidden}
.gtile:hover{border-color:var(--green);transform:translateY(-2px);box-shadow:0 8px 20px rgba(28,107,70,.08)}
.gtile-icon{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center}
.gtile-name{font-family:'Syne',sans-serif;font-size:.73rem;font-weight:700;color:var(--ink)}
.gtile-count{font-size:.67rem;color:var(--muted)}
.gtile-n{font-family:'Instrument Serif',serif;font-size:3rem;font-style:italic;color:var(--border);position:absolute;right:-3px;bottom:-8px;line-height:1;pointer-events:none;letter-spacing:-.04em;transition:color .2s}
.gtile:hover .gtile-n{color:var(--border-2)}

/* ── STATS ── */
.statsbar{display:grid;grid-template-columns:repeat(4,1fr);margin-top:56px;background:var(--white);border:1px solid var(--border);border-radius:10px;overflow:hidden}
.stat{padding:26px 28px;border-right:1px solid var(--border);display:flex;flex-direction:column;gap:4px}
.stat:last-child{border-right:none}
.stat-n{font-family:'Instrument Serif',serif;font-size:2.2rem;color:var(--green);letter-spacing:-.05em;line-height:1}
.stat-lbl{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted)}
.stat-sub{font-size:.7rem;color:var(--muted-2);margin-top:2px}

/* ── HOW IT WORKS ── */
.how{margin-top:56px}
.how-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:24px}
.how-card{background:var(--white);border:1.5px solid var(--border);border-radius:12px;padding:28px 24px;position:relative;overflow:hidden;transition:border-color .2s,box-shadow .2s}
.how-card:hover{border-color:var(--green-pale-2);box-shadow:0 8px 24px rgba(28,107,70,.07)}
.how-num{font-family:'Instrument Serif',serif;font-size:5rem;font-style:italic;color:var(--border);position:absolute;right:10px;top:-10px;line-height:1;pointer-events:none;transition:color .2s}
.how-card:hover .how-num{color:var(--green-pale-2)}
.how-icon{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;position:relative;z-index:1}
.how-title{font-family:'Syne',sans-serif;font-size:.8rem;font-weight:700;color:var(--ink);margin-bottom:8px;position:relative;z-index:1}
.how-desc{font-size:.8rem;color:var(--muted);line-height:1.68;position:relative;z-index:1}

/* ── REVIEWS — dual marquee ── */
.rv-section{margin-top:4px;overflow:hidden;position:relative}
.rv-section::before,.rv-section::after{content:'';position:absolute;top:0;bottom:0;width:120px;z-index:2;pointer-events:none;}
.rv-section::before{left:0;background:linear-gradient(to right,var(--bg),transparent)}
.rv-section::after{right:0;background:linear-gradient(to left,var(--bg),transparent)}
.rv-row{display:flex;gap:16px;width:max-content;margin-bottom:14px}
.rv-row:last-child{margin-bottom:0}
.rv-row-1{animation:rv-scroll-l 40s linear infinite}
.rv-row-2{animation:rv-scroll-r 46s linear infinite}
.rv-row:hover{animation-play-state:paused}
@keyframes rv-scroll-l{from{transform:translateX(0)}to{transform:translateX(-50%)}}
@keyframes rv-scroll-r{from{transform:translateX(-50%)}to{transform:translateX(0)}}
.rv{background:var(--white);border:1.5px solid var(--border);border-radius:12px;padding:22px 24px;flex-shrink:0;width:320px;position:relative;overflow:hidden;transition:border-color .2s,box-shadow .2s,transform .2s;cursor:default;}
.rv:hover{border-color:var(--green-pale-2);box-shadow:0 6px 24px rgba(28,107,70,.08);transform:translateY(-2px)}
.rv-deco{position:absolute;top:-6px;right:14px;font-family:'Instrument Serif',serif;font-size:5.5rem;line-height:1;color:var(--border);pointer-events:none;user-select:none;transition:color .2s;}
.rv:hover .rv-deco{color:var(--green-pale-2)}
.rv-stars{font-size:.75rem;letter-spacing:1px;margin-bottom:12px}
.rv-stars-full{color:#e6a817}
.rv-stars-empty{color:var(--border-2)}
.rv-text{font-family:'Instrument Serif',serif;font-style:italic;font-size:.93rem;color:var(--ink-2);line-height:1.72;position:relative;z-index:1;margin-bottom:16px;}
.rv-bottom{display:flex;align-items:center;gap:12px;padding-top:14px;border-top:1px solid var(--border)}
.rv-av{width:34px;height:34px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;}
.rv-info{flex:1;min-width:0}
.rv-name{font-size:.8rem;font-weight:600;color:var(--ink);line-height:1.2}
.rv-ct{font-family:'Syne',sans-serif;font-size:.6rem;color:var(--muted);margin-top:1px}
.rv-bk-cov{width:22px;height:32px;border-radius:2px;overflow:hidden;flex-shrink:0;box-shadow:1px 1px 4px rgba(0,0,0,.12)}

/* ── TICKER ── */
.ticker{background:var(--green);height:36px;overflow:hidden;display:flex;align-items:center;margin-top:56px}
.ticker-inner{display:flex;gap:44px;animation:tkr 30s linear infinite;white-space:nowrap}
@keyframes tkr{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.ticker-item{font-family:'Syne',sans-serif;font-size:.59rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(244,241,234,.45);display:flex;align-items:center;gap:14px;flex-shrink:0}
.ticker-item span{color:rgba(244,241,234,.2)}

/* ── FAQ ── */
.faq{margin-top:56px}
.faq-list{margin-top:24px;display:flex;flex-direction:column;gap:8px}
.faq-item{background:var(--white);border:1.5px solid var(--border);border-radius:10px;overflow:hidden;transition:border-color .2s}
.faq-item.open{border-color:var(--green-pale-2)}
.faq-q{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:18px 20px;cursor:pointer;user-select:none}
.faq-q-text{font-family:'DM Sans',sans-serif;font-size:.88rem;font-weight:600;color:var(--ink)}
.faq-icon{width:20px;height:20px;border-radius:50%;border:1.5px solid var(--border-2);display:flex;align-items:center;justify-content:center;color:var(--muted);flex-shrink:0;transition:all .2s}
.faq-item.open .faq-icon{background:var(--green);border-color:var(--green);color:#fff;transform:rotate(45deg)}
.faq-a{display:none;padding:0 20px 18px;font-size:.84rem;color:var(--muted);line-height:1.72}
.faq-item.open .faq-a{display:block}

/* ── CTA ── */
.cta{background:var(--green-3);border-radius:14px;margin-top:56px;padding:60px 52px;display:flex;align-items:center;justify-content:space-between;gap:44px;position:relative;overflow:hidden}
.cta::before{content:'';position:absolute;width:480px;height:480px;border-radius:50%;background:radial-gradient(circle,rgba(28,107,70,.28) 0%,transparent 65%);right:-160px;top:-160px;pointer-events:none}
.cta-l{position:relative;z-index:1}
.cta-eyebrow{font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--teal);margin-bottom:18px;display:flex;align-items:center;gap:8px}
.cta-eyebrow::before{content:'';width:16px;height:1px;background:var(--teal)}
.cta-title{font-family:'Instrument Serif',serif;font-size:clamp(1.9rem,3.6vw,3.6rem);color:#f4f1ea;letter-spacing:-.03em;line-height:.95;margin-bottom:14px}
.cta-title em{font-style:italic;color:rgba(244,241,234,.38)}
.cta-desc{font-size:.87rem;color:rgba(244,241,234,.5);max-width:380px;line-height:1.72}
.cta-r{display:flex;flex-direction:column;gap:9px;min-width:260px;position:relative;z-index:1;flex-shrink:0}
.cta-main{background:var(--accent);color:#fff;font-family:'Syne',sans-serif;font-size:.8rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:15px 28px;border-radius:8px;text-align:center;display:block;transition:all .2s}
.cta-main:hover{background:var(--accent-2);transform:translateY(-2px);box-shadow:0 8px 24px rgba(208,78,26,.28)}
.cta-ghost{color:rgba(244,241,234,.42);font-family:'Syne',sans-serif;font-size:.73rem;font-weight:500;text-align:center;padding:9px;display:block;border:1px solid rgba(255,255,255,.1);border-radius:7px;transition:all .15s}
.cta-ghost:hover{color:#f4f1ea;border-color:rgba(255,255,255,.22)}
.cta-facts{display:grid;grid-template-columns:1fr 1fr;gap:7px;margin-top:3px}
.cta-fact{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.07);border-radius:8px;padding:11px 13px}
.cta-fact-n{font-family:'Instrument Serif',serif;font-size:1.5rem;color:var(--teal);letter-spacing:-.04em;line-height:1}
.cta-fact-l{font-family:'Syne',sans-serif;font-size:.56rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:rgba(244,241,234,.28);margin-top:3px}

/* ── FOOTER ── */
footer{background:var(--ink);margin-top:60px}
.footer-inner{max-width:1280px;margin:0 auto;padding:52px 32px 0}
.footer-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr 1fr;gap:40px;padding-bottom:40px;border-bottom:1px solid rgba(255,255,255,.07)}
.footer-logo{display:flex;align-items:center;gap:9px;font-family:'Instrument Serif',serif;font-size:1.2rem;color:#f4f1ea;margin-bottom:14px}
.footer-logo-icon{width:28px;height:28px;border-radius:6px;background:var(--green);display:flex;align-items:center;justify-content:center}
.footer-desc{font-size:.78rem;color:rgba(244,241,234,.33);line-height:1.7;max-width:200px;margin-bottom:20px}
.footer-social{display:flex;gap:7px}
.footer-soc-btn{width:30px;height:30px;border-radius:6px;border:1px solid rgba(255,255,255,.09);display:flex;align-items:center;justify-content:center;color:rgba(244,241,234,.28);transition:all .15s;cursor:pointer}
.footer-soc-btn:hover{border-color:rgba(255,255,255,.22);color:#f4f1ea}
.fcol-title{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(244,241,234,.24);margin-bottom:14px}
.fcol-links{display:flex;flex-direction:column;gap:10px}
.fcol-links a{font-size:.78rem;color:rgba(244,241,234,.42);transition:color .15s}
.fcol-links a:hover{color:#f4f1ea}
.footer-bottom{display:flex;align-items:center;justify-content:space-between;padding:18px 32px;max-width:1280px;margin:0 auto;flex-wrap:wrap;gap:10px}
.footer-copy{font-family:'Syne',sans-serif;font-size:.6rem;letter-spacing:.06em;text-transform:uppercase;color:rgba(244,241,234,.15)}
.footer-bl{display:flex;gap:18px;flex-wrap:wrap}
.footer-bl a{font-family:'Syne',sans-serif;font-size:.6rem;letter-spacing:.04em;text-transform:uppercase;color:rgba(244,241,234,.15);transition:color .15s}
.footer-bl a:hover{color:rgba(244,241,234,.4)}

/* ── SCROLL REVEAL ── */
.sr{opacity:0;transform:translateY(20px);transition:opacity .6s ease,transform .6s ease}
.sr.in{opacity:1;transform:none}

/* ── RESPONSIVE ── */
@media(max-width:1100px){
  .dual{grid-template-columns:1fr}.chart{position:static}
  .ggrid{grid-template-columns:repeat(3,1fr)}
  .footer-top{grid-template-columns:1fr 1fr}
  .statsbar{grid-template-columns:repeat(2,1fr)}
  .stat:nth-child(2){border-right:none}
  .stat:nth-child(3){border-top:1px solid var(--border)}
  .stat:nth-child(4){border-top:1px solid var(--border);border-right:none}
  .cta{flex-direction:column;padding:44px 28px}
  .hero-covers{display:none}
  .page{padding:0 20px}.car-wrap{margin:0 -20px}.car{padding:4px 20px 20px}
  .nav-inner{padding:0 20px;gap:0}
  .nav-search-wrap{max-width:240px;margin:0 10px}
  .nav-div{margin:0 12px}
  .how-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:820px){
  .nav-links,.nav-div,.nav-right{display:none}
  .nav-hamburger{display:flex}
  .nav-search-wrap{max-width:none;flex:1;margin:0 10px}
  .ggrid{grid-template-columns:repeat(2,1fr)}
  .footer-top{grid-template-columns:1fr}
  .hero{min-height:auto}
  .hero-inner{min-height:auto;padding:80px 24px 52px}
  .rv{width:280px}
  .how-grid{grid-template-columns:1fr}
  .faq-q-text{font-size:.84rem}
}
@media(max-width:560px){
  .ggrid{grid-template-columns:1fr 1fr}
  .statsbar{grid-template-columns:1fr 1fr}
  .stat:nth-child(2){border-right:none}
  .stat:nth-child(3){border-top:1px solid var(--border);border-right:1px solid var(--border)}
  .stat:nth-child(4){border-top:1px solid var(--border);border-right:none}
  .hero-title{font-size:clamp(1.8rem,7vw,2.8rem)}
  .hero-actions{flex-direction:column;align-items:flex-start}
  .hero-btn-main,.hero-btn-sec{width:100%;justify-content:center}
  .cta{padding:32px 20px}
  .cta-facts{grid-template-columns:1fr 1fr}
  .footer-inner{padding:40px 20px 0}
  .footer-bottom{padding:16px 20px}
  .page{padding:0 16px}
  .car-wrap{margin:0 -16px}.car{padding:4px 16px 20px}
  .srbox{padding:32px 24px}
}
</style>
</head>
<body>

@php
$coverGradients = [
  'linear-gradient(155deg,#1A6648,#030E07)',
  'linear-gradient(155deg,#4A1F5A,#0D0514)',
  'linear-gradient(155deg,#3A551A,#0A1403)',
  'linear-gradient(155deg,#7A3A0E,#2E1200)',
  'linear-gradient(155deg,#162C55,#030710)',
  'linear-gradient(155deg,#6A1530,#1A030B)',
  'linear-gradient(155deg,#1E4A55,#030F14)',
  'linear-gradient(155deg,#5A3A08,#1C0E00)',
  'linear-gradient(155deg,#2A1A50,#080312)',
  'linear-gradient(155deg,#6B501A,#1E1000)',
];
@endphp

<!-- ── NAV ── -->
<nav class="nav" id="mainNav" role="navigation" aria-label="Navigasi utama">
  <div class="nav-inner">
    <a href="#beranda" class="nav-logo" id="navLogo" aria-label="DigiLib — Kembali ke beranda">
      <div class="nav-logo-icon" aria-hidden="true">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
      </div>
      DigiLib
    </a>

    <div class="nav-links" id="navLinks" role="menubar">
      <div class="nl-pill" id="nlPill" aria-hidden="true"></div>
      <div class="nl active" data-href="#beranda" role="menuitem" tabindex="0">Beranda</div>
      <div class="nl" data-href="#trending" role="menuitem" tabindex="0">Koleksi</div>
      <div class="nl" data-href="#genre" role="menuitem" tabindex="0">Genre</div>
      <div class="nl" data-href="#ulasan" role="menuitem" tabindex="0">Ulasan</div>
      <div class="nl" data-href="#cara-kerja" role="menuitem" tabindex="0">Cara Kerja</div>
    </div>

    <div class="nav-div" aria-hidden="true"></div>

    <div class="nav-search-wrap" role="search">
      <div class="nav-search">
        <div class="nav-search-icon" aria-hidden="true">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <input type="search" id="searchInput" placeholder="Cari judul, penulis, topik..." autocomplete="off" aria-label="Cari buku"/>
        <button class="nav-search-btn" id="searchBtn" aria-label="Mulai pencarian">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
      </div>
      <div class="search-dropdown" id="searchDropdown" role="listbox" aria-label="Saran pencarian"></div>
    </div>

    <div class="nav-right">
      @auth
        <a href="{{ route('user.profile') }}" class="nav-btn nav-btn-ghost">{{ auth()->user()->name }}</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
          @csrf
          <button type="submit" class="nav-btn nav-btn-ghost">Keluar</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="nav-btn nav-btn-ghost">Masuk</a>
        <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Daftar Gratis</a>
      @endauth
    </div>

    <button class="nav-hamburger" id="navHamburger" aria-label="Buka menu" aria-expanded="false" aria-controls="mobileMenu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- ── MOBILE MENU ── -->
<div class="mobile-menu" id="mobileMenu" role="dialog" aria-label="Menu navigasi mobile">
  <nav class="mm-links" aria-label="Menu utama">
    <div class="mm-link active" data-href="#beranda" tabindex="0">Beranda</div>
    <div class="mm-link" data-href="#trending" tabindex="0">Koleksi</div>
    <div class="mm-link" data-href="#genre" tabindex="0">Genre</div>
    <div class="mm-link" data-href="#ulasan" tabindex="0">Ulasan</div>
    <div class="mm-link" data-href="#cara-kerja" tabindex="0">Cara Kerja</div>
    <div class="mm-link" data-href="#daftar" tabindex="0">Bergabung</div>
  </nav>
  <div class="mm-divider" aria-hidden="true"></div>
  <div class="mm-btns">
    @auth
      <a href="{{ route('user.profile') }}" class="mm-btn mm-btn-ghost">Dashboard</a>
      <form method="POST" action="{{ route('logout') }}" style="flex:1">
        @csrf
        <button type="submit" class="mm-btn mm-btn-primary" style="width:100%">Keluar</button>
      </form>
    @else
      <a href="{{ route('login') }}" class="mm-btn mm-btn-ghost">Masuk</a>
      <a href="{{ route('register') }}" class="mm-btn mm-btn-primary">Daftar Gratis</a>
    @endauth
  </div>
</div>

<div class="nav-spacer" aria-hidden="true"></div>

<!-- ── HERO ── -->
<section class="hero" id="beranda" aria-label="Hero DigiLib">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="hero-grain" aria-hidden="true"></div>
  <div class="hero-vignette" aria-hidden="true"></div>
  <div class="hero-inner">
    <div style="max-width:500px">
      <div class="hero-badge" aria-label="Pilihan editor minggu ini">
        <span class="hero-badge-dot" aria-hidden="true"></span>Pilihan Editor Minggu Ini
      </div>
      <h1 class="hero-title">Pinjam buku fisik,<em> mudah & online.</em></h1>
      <div class="hero-meta">
        <div class="hero-rating" aria-label="Rating 4.9 dari 1.247 ulasan">
          <span class="hero-rating-star" aria-hidden="true">★</span>
          <span class="hero-rating-n">4.9</span>
          <span class="hero-rating-ct">(1.247 ulasan)</span>
        </div>
        <span class="hero-tag">2.400+ Koleksi</span>
        <span class="hero-tag">Bogor Tengah</span>
      </div>
      <p class="hero-desc">Perpustakaan Kota Bogor. Pinjam buku fisik pilihanmu — sastra, sejarah, sains, self-help — lalu ambil di Jl. Kapten Muslihat No. 21, Bogor Tengah.</p>
      <div class="hero-actions">
        @auth
          <a href="{{ route('user.books.index') }}" class="hero-btn-main">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Jelajahi Koleksi
          </a>
        @else
          <a href="{{ route('register') }}" class="hero-btn-main">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            Daftar & Pinjam Buku
          </a>
        @endauth
        <a href="#trending" class="hero-btn-sec">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          Jelajahi Koleksi
        </a>
      </div>
    </div>
  </div>
  <div class="hero-covers" aria-hidden="true">
    <div class="hero-side-stack">
      <div class="hero-side-cover">
        <div class="hero-side-cover-inner" style="background:linear-gradient(155deg,#7A3A0E,#2E1200)">
          <img src="{{ asset('covers/atomic-habits.png') }}" alt="Sampul Atomic Habits" onerror="this.style.display='none'">
        </div>
      </div>
      <div class="hero-side-cover">
        <div class="hero-side-cover-inner" style="background:linear-gradient(155deg,#162C55,#050A18)">
          <img src="{{ asset('covers/sapiens.png') }}" alt="Sampul Sapiens" onerror="this.style.display='none'">
        </div>
      </div>
      <div class="hero-side-cover">
        <div class="hero-side-cover-inner" style="background:linear-gradient(155deg,#4A1F5A,#130518)">
          <img src="{{ asset('covers/filosofi-teras.png') }}" alt="Sampul Filosofi Teras" onerror="this.style.display='none'">
        </div>
      </div>
    </div>
    <div class="hero-cover-main">
      <div class="hero-cover-main-inner">
        <img src="{{ asset('covers/bumi-manusia.png') }}" alt="Sampul Bumi Manusia" onerror="this.style.display='none'">
        <div class="hero-cover-overlay"></div>
        <div class="hero-cover-t">Bumi Manusia</div>
        <div class="hero-cover-a">Pramoedya Ananta Toer</div>
      </div>
    </div>
  </div>
</section>

<main class="page">

  <!-- ── TRENDING ── -->
  <section id="trending" aria-label="Buku trending">
    <div class="sh sr">
      <div class="sh-left">
        <h2 class="sh-title">Trending <em>Sekarang</em></h2>
        <div class="sh-badge" aria-label="Minggu ini">Minggu Ini</div>
      </div>
      <a href="{{ route('user.books.index') }}" style="font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;color:var(--green)">
        Lihat Semua →
      </a>
    </div>
    <div class="car-wrap sr">
      <div class="car-fade" aria-hidden="true"></div>
      <div class="car" id="car1" role="list" aria-label="Daftar buku trending">
        @forelse($trendingBooks as $i => $book)
          <article class="bk" role="listitem">
            <a href="{{ route('user.books.show', $book) }}" class="bk-link">
              <div class="bk-cov" aria-label="Sampul {{ $book->title }}">
                <div class="bk-cov-art" style="background:{{ $coverGradients[$i % count($coverGradients)] }}">
                  <div class="bk-cov-txt">
                    <div class="bk-cov-t">{{ Str::limit($book->title, 20) }}</div>
                    <div class="bk-cov-a">{{ Str::limit($book->author, 16) }}</div>
                  </div>
                </div>
                @if($i === 0)
                  <span class="bk-badge bb-top" aria-label="Peringkat 1">#1</span>
                @elseif($book->borrowings_count > 50)
                  <span class="bk-badge bb-hot">Populer</span>
                @endif
              </div>
              <div class="bk-title">{{ Str::limit($book->title, 22) }}</div>
              <div class="bk-author">{{ Str::limit($book->author, 20) }}</div>
              <div class="bk-rat" aria-label="Rating {{ number_format($book->reviews_avg_rating ?? 0, 1) }}">
                <span class="bk-star" aria-hidden="true">★</span>
                <span class="bk-score">{{ number_format($book->reviews_avg_rating ?? 0, 1) }}</span>
                <span class="bk-votes">({{ $book->reviews_count ?? 0 }})</span>
              </div>
            </a>
          </article>
        @empty
          {{-- Fallback static jika controller tidak mengirim data --}}
          <article class="bk" role="listitem">
            <div class="bk-cov"><div class="bk-cov-art" style="background:linear-gradient(155deg,#1A6648,#030E07)"><div class="bk-cov-txt"><div class="bk-cov-t">Bumi Manusia</div><div class="bk-cov-a">Pramoedya</div></div></div><span class="bk-badge bb-top">#1</span></div>
            <div class="bk-title">Bumi Manusia</div><div class="bk-author">Pramoedya A. Toer</div>
            <div class="bk-rat"><span class="bk-star">★</span><span class="bk-score">4.9</span><span class="bk-votes">(1.2rb)</span></div>
          </article>
        @endforelse
      </div>
    </div>
  </section>

  <div class="dual sr" style="margin-top:8px">
    <div>

      <!-- ── BUKU BARU ── -->
      <section aria-label="Buku baru ditambahkan">
        <div class="sh" style="padding-top:44px">
          <div class="sh-left">
            <h2 class="sh-title">Baru <em>Ditambahkan</em></h2>
            <div class="sh-badge">Bulan Ini</div>
          </div>
        </div>
        <div class="car-wrap">
          <div class="car-fade" aria-hidden="true"></div>
          <div class="car" id="car2" role="list" aria-label="Buku baru">
            @forelse($newBooks as $i => $book)
              <article class="bk" role="listitem">
                <a href="{{ route('user.books.show', $book) }}" class="bk-link">
                  <div class="bk-cov" aria-label="Sampul {{ $book->title }}">
                    <div class="bk-cov-art" style="background:{{ $coverGradients[$i % count($coverGradients)] }}">
                      <div class="bk-cov-txt">
                        <div class="bk-cov-t">{{ Str::limit($book->title, 20) }}</div>
                        <div class="bk-cov-a">{{ Str::limit($book->author, 16) }}</div>
                      </div>
                    </div>
                    <span class="bk-badge bb-new">Baru</span>
                  </div>
                  <div class="bk-title">{{ Str::limit($book->title, 22) }}</div>
                  <div class="bk-author">{{ Str::limit($book->author, 20) }}</div>
                  <div class="bk-rat">
                    <span class="bk-star">★</span>
                    <span class="bk-score">{{ number_format($book->reviews_avg_rating ?? 0, 1) }}</span>
                    <span class="bk-votes">({{ $book->reviews_count ?? 0 }})</span>
                  </div>
                </a>
              </article>
            @empty
              <p style="color:var(--muted);font-size:.84rem;padding:8px 0">Belum ada buku baru.</p>
            @endforelse
          </div>
        </div>
      </section>

      <!-- ── GENRE ── -->
      <section id="genre" aria-label="Jelajahi genre" style="padding-top:44px">
        <div class="sh" style="padding-top:0;margin-bottom:20px">
          <div class="sh-left"><h2 class="sh-title">Jelajahi <em>Genre</em></h2></div>
        </div>
        <div class="gtabs" role="tablist" aria-label="Filter genre">
          <div class="gtab active" data-filter="all" role="tab" aria-selected="true" tabindex="0">Semua</div>
          <div class="gtab" data-filter="sastra" role="tab" aria-selected="false" tabindex="-1">Sastra</div>
          <div class="gtab" data-filter="selfhelp" role="tab" aria-selected="false" tabindex="-1">Self-Help</div>
          <div class="gtab" data-filter="sejarah" role="tab" aria-selected="false" tabindex="-1">Sejarah</div>
          <div class="gtab" data-filter="sains" role="tab" aria-selected="false" tabindex="-1">Sains</div>
          <div class="gtab" data-filter="filsafat" role="tab" aria-selected="false" tabindex="-1">Filsafat</div>
          <div class="gtab" data-filter="fiksi" role="tab" aria-selected="false" tabindex="-1">Fiksi Ilmiah</div>
          <div class="gtab" data-filter="agama" role="tab" aria-selected="false" tabindex="-1">Agama</div>
        </div>
        <div class="ggrid" role="tabpanel">
          <a href="{{ route('user.books.index', ['category' => 'sastra-indonesia']) }}" class="gtile" data-g="sastra" tabindex="0"><div class="gtile-icon" style="background:rgba(28,107,70,.1)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div><div class="gtile-name">Sastra Indonesia</div><div class="gtile-count">{{ $categories->firstWhere('slug','sastra-indonesia')?->books_count ?? 0 }} buku</div><div class="gtile-n">Sas</div></a>
          <a href="{{ route('user.books.index', ['category' => 'sejarah']) }}" class="gtile" data-g="sejarah" tabindex="0"><div class="gtile-icon" style="background:rgba(208,78,26,.1)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10z"/></svg></div><div class="gtile-name">Sejarah & Budaya</div><div class="gtile-count">{{ $categories->firstWhere('slug','sejarah')?->books_count ?? 0 }} buku</div><div class="gtile-n">Sej</div></a>
          <a href="{{ route('user.books.index', ['category' => 'sains']) }}" class="gtile" data-g="sains" tabindex="0"><div class="gtile-icon" style="background:rgba(60,100,200,.08)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4060B0" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/></svg></div><div class="gtile-name">Sains & Teknologi</div><div class="gtile-count">{{ $categories->firstWhere('slug','sains')?->books_count ?? 0 }} buku</div><div class="gtile-n">Tek</div></a>
          <a href="{{ route('user.books.index', ['category' => 'self-help']) }}" class="gtile" data-g="selfhelp" tabindex="0"><div class="gtile-icon" style="background:rgba(230,168,23,.1)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c89a14" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4z"/></svg></div><div class="gtile-name">Pengembangan Diri</div><div class="gtile-count">{{ $categories->firstWhere('slug','self-help')?->books_count ?? 0 }} buku</div><div class="gtile-n">Dev</div></a>
          <a href="{{ route('user.books.index', ['category' => 'fiksi-ilmiah']) }}" class="gtile" data-g="fiksi" tabindex="0"><div class="gtile-icon" style="background:rgba(130,60,200,.08)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#7040B0" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div><div class="gtile-name">Fiksi Ilmiah</div><div class="gtile-count">{{ $categories->firstWhere('slug','fiksi-ilmiah')?->books_count ?? 0 }} buku</div><div class="gtile-n">Fk</div></a>
          <a href="{{ route('user.books.index', ['category' => 'filsafat']) }}" class="gtile" data-g="filsafat" tabindex="0"><div class="gtile-icon" style="background:rgba(208,78,26,.08)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M20.3 17.3a2 2 0 0 0 .7-1.5v-7.6a2 2 0 0 0-.7-1.5L16 3.3a2 2 0 0 0-1.5-.3h-5A2 2 0 0 0 8 3.3L3.7 6.7a2 2 0 0 0-.7 1.5v7.6a2 2 0 0 0 .7 1.5L8 20.7a2 2 0 0 0 1.5.3h5a2 2 0 0 0 1.5-.3z"/></svg></div><div class="gtile-name">Filsafat</div><div class="gtile-count">{{ $categories->firstWhere('slug','filsafat')?->books_count ?? 0 }} buku</div><div class="gtile-n">Fil</div></a>
          <a href="{{ route('user.books.index', ['category' => 'agama']) }}" class="gtile" data-g="agama" tabindex="0"><div class="gtile-icon" style="background:rgba(28,107,70,.08)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div><div class="gtile-name">Agama & Spiritual</div><div class="gtile-count">{{ $categories->firstWhere('slug','agama')?->books_count ?? 0 }} buku</div><div class="gtile-n">Aga</div></a>
          <a href="{{ route('user.books.index', ['category' => 'hukum']) }}" class="gtile" data-g="sains" tabindex="0"><div class="gtile-icon" style="background:rgba(60,100,200,.08)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4060B0" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="gtile-name">Hukum & Politik</div><div class="gtile-count">{{ $categories->firstWhere('slug','hukum')?->books_count ?? 0 }} buku</div><div class="gtile-n">Hkm</div></a>
        </div>
      </section>
    </div>

    <!-- ── TOP 10 ── -->
    <div style="padding-top:52px">
      <div class="sh" style="padding-top:0;margin-bottom:14px">
        <div class="sh-left"><h2 class="sh-title">Top 10 <em>DigiLib</em></h2></div>
      </div>
      <div class="chart" role="list" aria-label="Top 10 buku terbaik DigiLib">
        <div class="chart-head" aria-hidden="true">
          <div><div class="chart-head-t">Peringkat Terbaik</div><div class="chart-head-s">Berdasarkan Rating Pembaca</div></div>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(244,241,234,.3)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        </div>
        @forelse($topBooks as $i => $book)
          <a href="{{ route('user.books.show', $book) }}" class="ch-item" role="listitem" tabindex="0">
            <div class="ch-rank {{ $i < 3 ? 'hi' : '' }}">{{ $i + 1 }}</div>
            <div class="ch-cov"><div style="width:100%;height:100%;background:{{ $coverGradients[$i % count($coverGradients)] }}"></div></div>
            <div class="ch-info">
              <div class="ch-t">{{ Str::limit($book->title, 22) }}</div>
              <div class="ch-a">{{ Str::limit($book->author, 18) }}</div>
              <div class="ch-r"><span class="ch-star">★</span><span class="ch-sc">{{ number_format($book->reviews_avg_rating ?? 0, 1) }}</span></div>
            </div>
            @if($i === 0)<span class="ch-badge cb-fire">🔥</span>@endif
          </a>
        @empty
          <div style="padding:20px;color:var(--muted);font-size:.84rem">Belum ada data.</div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- ── STATS ── -->
  <div class="statsbar sr" role="list" aria-label="Statistik DigiLib">
    <div class="stat" role="listitem"><div class="stat-n">2.4K</div><div class="stat-lbl">Koleksi Buku</div><div class="stat-sub">Terus bertambah tiap minggu</div></div>
    <div class="stat" role="listitem"><div class="stat-n">12K+</div><div class="stat-lbl">Anggota Aktif</div><div class="stat-sub">Bergabung tahun ini</div></div>
    <div class="stat" role="listitem"><div class="stat-n">Bogor</div><div class="stat-lbl">Lokasi Perpustakaan</div><div class="stat-sub">Jl. Kapten Muslihat No. 21</div></div>
    <div class="stat" role="listitem"><div class="stat-n">14 hr</div><div class="stat-lbl">Masa Pinjam</div><div class="stat-sub">Tidak dapat diperpanjang</div></div>
  </div>

  <!-- ── CARA KERJA ── -->
  <section id="cara-kerja" class="how sr" aria-label="Cara kerja DigiLib">
    <div class="sh" style="padding-top:0;margin-bottom:0">
      <div class="sh-left">
        <h2 class="sh-title">Cara <em>Kerja</em></h2>
        <div class="sh-badge">3 Langkah</div>
      </div>
    </div>
    <div class="how-grid">
      <div class="how-card">
        <div class="how-num" aria-hidden="true">1</div>
        <div class="how-icon" style="background:var(--green-pale)">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="how-title">Daftar Akun</div>
        <div class="how-desc">Buat akun DigiLib gratis dalam 30 detik. Tidak perlu kartu kredit. Cukup email dan password, langsung bisa mulai.</div>
      </div>
      <div class="how-card">
        <div class="how-num" aria-hidden="true">2</div>
        <div class="how-icon" style="background:rgba(208,78,26,.08)">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
        </div>
        <div class="how-title">Pilih & Pinjam Online</div>
        <div class="how-desc">Temukan buku dari 2.400+ koleksi, cek ketersediaan secara real-time, lalu ajukan peminjaman langsung dari website.</div>
      </div>
      <div class="how-card">
        <div class="how-num" aria-hidden="true">3</div>
        <div class="how-icon" style="background:rgba(93,185,138,.1)">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <div class="how-title">Ambil di Perpustakaan</div>
        <div class="how-desc">Datang ke Jl. Kapten Muslihat No. 21, Bogor Tengah. Tunjukkan kode peminjaman, bawa buku pulang. Kembalikan dalam 14 hari.</div>
      </div>
    </div>
  </section>

  <!-- ── ULASAN ── -->
  <section id="ulasan" aria-label="Ulasan pembaca" style="margin-top:56px">
    <div class="sh sr" style="padding-top:0;margin-bottom:22px">
      <div class="sh-left">
        <h2 class="sh-title">Kata <em>Pembaca</em></h2>
        <div class="sh-badge">Ulasan Nyata</div>
      </div>
    </div>
    <div class="rv-section sr">
      <div class="rv-row rv-row-1" aria-label="Ulasan pembaca baris pertama">
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Akhirnya ada perpustakaan yang sistemnya praktis. Pinjam online, tinggal ambil di perpus. Nggak perlu antri panjang atau bingung buku masih ada atau nggak.</div><div class="rv-bottom"><div class="rv-av" style="background:var(--green-pale);color:var(--green)">RA</div><div class="rv-info"><div class="rv-name">Rizky Aditya</div><div class="rv-ct">42 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#1A6648,#030E07)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★</span><span class="rv-stars-empty">★</span></div><div class="rv-text">Koleksi sastra Indonesia-nya lengkap banget. Hampir semua yang mau aku baca ada. Surga buat pencinta sastra lokal — buku lawas pun tersedia.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(208,78,26,.1);color:var(--accent)">DS</div><div class="rv-info"><div class="rv-name">Dinda Saraswati</div><div class="rv-ct">67 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#3A551A,#0A1403)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Interface-nya bersih banget. Gak ada iklan, gak ada pop-up ganggu. Beda banget sama aplikasi lain yang penuh distraksi. Fokus baca, itu doang.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(80,160,220,.1);color:#3a80c0">BA</div><div class="rv-info"><div class="rv-name">Budi Ardiansyah</div><div class="rv-ct">18 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#162C55,#030710)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★</span><span class="rv-stars-empty">★</span></div><div class="rv-text">Suka banget sama fitur rekomendasi-nya. Setiap selesai baca satu buku, langsung ada saran judul lain yang nyambung. Bacaan gue makin luas.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(130,60,200,.09);color:#7040B0">NP</div><div class="rv-info"><div class="rv-name">Nadia Pramesti</div><div class="rv-ct">53 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#4A1F5A,#0D0514)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Koleksinya lengkap dan daftarnya mudah. Proses peminjaman online-nya jelas dari awal sampai pengambilan. Pastiin kembaliin tepat waktu ya, ada dendanya!</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(208,78,26,.1);color:var(--accent)">MH</div><div class="rv-info"><div class="rv-name">Muhammad Haris</div><div class="rv-ct">31 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#7A3A0E,#2E1200)"></div></div></div></div>
        {{-- Duplikat untuk efek marquee tanpa putus --}}
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Akhirnya ada perpustakaan yang sistemnya praktis. Pinjam online, tinggal ambil di perpus. Nggak perlu antri panjang atau bingung buku masih ada atau nggak.</div><div class="rv-bottom"><div class="rv-av" style="background:var(--green-pale);color:var(--green)">RA</div><div class="rv-info"><div class="rv-name">Rizky Aditya</div><div class="rv-ct">42 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#1A6648,#030E07)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★</span><span class="rv-stars-empty">★</span></div><div class="rv-text">Koleksi sastra Indonesia-nya lengkap banget. Hampir semua yang mau aku baca ada. Surga buat pencinta sastra lokal — buku lawas pun tersedia.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(208,78,26,.1);color:var(--accent)">DS</div><div class="rv-info"><div class="rv-name">Dinda Saraswati</div><div class="rv-ct">67 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#3A551A,#0A1403)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Interface-nya bersih banget. Gak ada iklan, gak ada pop-up ganggu. Beda banget sama aplikasi lain yang penuh distraksi. Fokus baca, itu doang.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(80,160,220,.1);color:#3a80c0">BA</div><div class="rv-info"><div class="rv-name">Budi Ardiansyah</div><div class="rv-ct">18 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#162C55,#030710)"></div></div></div></div>
      </div>
      <div class="rv-row rv-row-2" aria-hidden="true">
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Sistem pinjam online ini jauh lebih efisien. Cek ketersediaan, pinjam, lalu langsung ke Jl. Kapten Muslihat No. 21 buat ambil bukunya. Gak perlu telepon dulu.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(80,120,200,.1);color:#5080C0">FN</div><div class="rv-info"><div class="rv-name">Fajar Nugroho</div><div class="rv-ct">28 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#4A1F5A,#0D0514)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★</span><span class="rv-stars-empty">★</span></div><div class="rv-text">Buku-buku sejarah dan budaya Indonesia di sini lumayan lengkap. Referensi skripsi gue banyak ketemu di sini. Mahasiswa bisa coba ini dulu sebelum beli.</div><div class="rv-bottom"><div class="rv-av" style="background:var(--green-pale);color:var(--green)">SR</div><div class="rv-info"><div class="rv-name">Siti Rahayu</div><div class="rv-ct">89 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#5A3A08,#1C0E00)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Desain aplikasinya enak banget di mata. Gue yang biasanya males baca jadi rajin gara-gara tampilannya nyaman. Serius, UI-nya beda kelas.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(208,78,26,.1);color:var(--accent)">AW</div><div class="rv-info"><div class="rv-name">Arya Wicaksono</div><div class="rv-ct">14 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#1E4A55,#030F14)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★</span><span class="rv-stars-empty">★</span></div><div class="rv-text">Koleksi self-help-nya up-to-date. Buku yang baru rilis pun udah ada dalam hitungan minggu. Hemat banget, nggak perlu beli langsung.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(130,60,200,.09);color:#7040B0">LK</div><div class="rv-info"><div class="rv-name">Lisa Kurniawan</div><div class="rv-ct">44 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#6B501A,#1E1000)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Gue rekomendasiin ke seluruh keluarga. Orang tua gue yang jarang baca sekarang aktif pinjam buku masak sama sejarah. DigiLib beneran buat semua umur.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(80,160,220,.1);color:#3a80c0">DP</div><div class="rv-info"><div class="rv-name">Dewi Puspaningrum</div><div class="rv-ct">37 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#2A1A50,#080312)"></div></div></div></div>
        {{-- Duplikat --}}
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Sistem pinjam online ini jauh lebih efisien. Cek ketersediaan, pinjam, lalu langsung ke Jl. Kapten Muslihat No. 21 buat ambil bukunya. Gak perlu telepon dulu.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(80,120,200,.1);color:#5080C0">FN</div><div class="rv-info"><div class="rv-name">Fajar Nugroho</div><div class="rv-ct">28 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#4A1F5A,#0D0514)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★</span><span class="rv-stars-empty">★</span></div><div class="rv-text">Buku-buku sejarah dan budaya Indonesia di sini lumayan lengkap. Referensi skripsi gue banyak ketemu di sini. Mahasiswa bisa coba ini dulu sebelum beli.</div><div class="rv-bottom"><div class="rv-av" style="background:var(--green-pale);color:var(--green)">SR</div><div class="rv-info"><div class="rv-name">Siti Rahayu</div><div class="rv-ct">89 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#5A3A08,#1C0E00)"></div></div></div></div>
        <div class="rv"><div class="rv-deco">"</div><div class="rv-stars"><span class="rv-stars-full">★★★★★</span></div><div class="rv-text">Desain aplikasinya enak banget di mata. Gue yang biasanya males baca jadi rajin gara-gara tampilannya nyaman. Serius, UI-nya beda kelas.</div><div class="rv-bottom"><div class="rv-av" style="background:rgba(208,78,26,.1);color:var(--accent)">AW</div><div class="rv-info"><div class="rv-name">Arya Wicaksono</div><div class="rv-ct">14 buku dipinjam</div></div><div class="rv-bk-cov"><div style="width:100%;height:100%;background:linear-gradient(155deg,#1E4A55,#030F14)"></div></div></div></div>
      </div>
    </div>
  </section>

  <!-- ── TICKER ── -->
  <div class="ticker sr" aria-hidden="true">
    <div class="ticker-inner">
      <div class="ticker-item"><span>✦</span> 2.400 Koleksi</div><div class="ticker-item"><span>✦</span> Daftar Gratis</div><div class="ticker-item"><span>✦</span> Pinjam Online</div><div class="ticker-item"><span>✦</span> Ambil di Bogor</div><div class="ticker-item"><span>✦</span> Sastra Indonesia</div><div class="ticker-item"><span>✦</span> Fiksi Ilmiah</div><div class="ticker-item"><span>✦</span> Denda Berlaku</div><div class="ticker-item"><span>✦</span> Sejarah & Budaya</div>
      <div class="ticker-item"><span>✦</span> 2.400 Koleksi</div><div class="ticker-item"><span>✦</span> Daftar Gratis</div><div class="ticker-item"><span>✦</span> Pinjam Online</div><div class="ticker-item"><span>✦</span> Ambil di Bogor</div><div class="ticker-item"><span>✦</span> Sastra Indonesia</div><div class="ticker-item"><span>✦</span> Fiksi Ilmiah</div><div class="ticker-item"><span>✦</span> Denda Berlaku</div><div class="ticker-item"><span>✦</span> Sejarah & Budaya</div>
    </div>
  </div>

  <!-- ── FAQ ── -->
  <section class="faq sr" aria-label="Pertanyaan yang sering ditanyakan">
    <div class="sh" style="padding-top:0;margin-bottom:0">
      <div class="sh-left">
        <h2 class="sh-title">Pertanyaan <em>Umum</em></h2>
        <div class="sh-badge">FAQ</div>
      </div>
    </div>
    <div class="faq-list">
      <div class="faq-item" role="listitem">
        <div class="faq-q" tabindex="0" aria-expanded="false" role="button">
          <span class="faq-q-text">Apakah pendaftaran DigiLib gratis?</span>
          <div class="faq-icon" aria-hidden="true"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-a">Ya, pendaftaran anggota DigiLib sepenuhnya gratis. Tidak ada biaya pendaftaran atau biaya bulanan. Namun, denda keterlambatan berlaku jika buku dikembalikan melewati batas waktu pinjam.</div>
      </div>
      <div class="faq-item" role="listitem">
        <div class="faq-q" tabindex="0" aria-expanded="false" role="button">
          <span class="faq-q-text">Bagaimana sistem peminjaman buku bekerja?</span>
          <div class="faq-icon" aria-hidden="true"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-a">Pilih buku yang ingin dipinjam, klik "Pinjam", lalu datang ke perpustakaan kami di Bogor untuk mengambil buku fisiknya. Masa pinjam 14 hari. Jika terlambat dikembalikan, denda harian akan dikenakan.</div>
      </div>
      <div class="faq-item" role="listitem">
        <div class="faq-q" tabindex="0" aria-expanded="false" role="button">
          <span class="faq-q-text">Di mana lokasi perpustakaan DigiLib?</span>
          <div class="faq-icon" aria-hidden="true"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-a">Perpustakaan DigiLib berlokasi di Jl. Kapten Muslihat No. 21, Bogor Tengah. Jam layanan Senin–Jumat pukul 08.00–16.00 WIB.</div>
      </div>
      <div class="faq-item" role="listitem">
        <div class="faq-q" tabindex="0" aria-expanded="false" role="button">
          <span class="faq-q-text">Berapa banyak buku yang bisa dipinjam sekaligus?</span>
          <div class="faq-icon" aria-hidden="true"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-a">Anggota dapat meminjam hingga 3 buku secara bersamaan. Buku harus dikembalikan sebelum dapat meminjam judul baru. Koleksi terus diperbarui setiap minggu dengan judul-judul baru.</div>
      </div>
      <div class="faq-item" role="listitem">
        <div class="faq-q" tabindex="0" aria-expanded="false" role="button">
          <span class="faq-q-text">Bagaimana sistem denda keterlambatan bekerja?</span>
          <div class="faq-icon" aria-hidden="true"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        </div>
        <div class="faq-a">Denda dihitung per hari sejak tanggal jatuh tempo. Pembayaran denda dilakukan saat pengembalian buku di perpustakaan. Anggota dengan denda yang belum dibayar tidak dapat melakukan peminjaman baru sampai denda dilunasi.</div>
      </div>
    </div>
  </section>

  <!-- ── CTA ── -->
  <section id="daftar" class="cta sr" aria-label="Ajakan bergabung DigiLib">
    <div class="cta-l">
      <div class="cta-eyebrow">Siap Pinjam Buku?</div>
      <div class="cta-title">Bergabung dengan<br>12.000+ anggota.<br><em>Daftar gratis.</em></div>
      <p class="cta-desc">Tidak perlu kartu kredit. Daftar dalam 30 detik dan langsung pinjam buku pilihanmu. Ambil di Jl. Kapten Muslihat No. 21, Bogor Tengah.</p>
    </div>
    <div class="cta-r">
      @auth
        <a href="{{ route('user.books.index') }}" class="cta-main">Mulai Pinjam Buku →</a>
        <a href="{{ route('user.dashboard') }}" class="cta-ghost">Lihat Dashboard Kamu</a>
      @else
        <a href="{{ route('register') }}" class="cta-main">Daftar Sekarang — Gratis</a>
        <a href="{{ route('login') }}" class="cta-ghost">Sudah punya akun? Masuk</a>
      @endauth
      <div class="cta-facts" role="list" aria-label="Keunggulan DigiLib">
        <div class="cta-fact" role="listitem"><div class="cta-fact-n">2.4K</div><div class="cta-fact-l">Koleksi Buku</div></div>
        <div class="cta-fact" role="listitem"><div class="cta-fact-n">Rp 0</div><div class="cta-fact-l">Biaya Daftar</div></div>
        <div class="cta-fact" role="listitem"><div class="cta-fact-n">14hr</div><div class="cta-fact-l">Masa Pinjam</div></div>
        <div class="cta-fact" role="listitem"><div class="cta-fact-n">Bogor</div><div class="cta-fact-l">Kap. Muslihat 21</div></div>
      </div>
    </div>
  </section>

</main>

<!-- ── FOOTER ── -->
<footer role="contentinfo">
  <div class="footer-inner">
    <div class="footer-top">
      <div>
        <div class="footer-logo">
          <div class="footer-logo-icon" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
          DigiLib
        </div>
        <div class="footer-desc">Perpustakaan Kota Bogor. Pinjam buku fisik online, ambil di Jl. Kapten Muslihat No. 21, Bogor Tengah.</div>
        <div class="footer-social" aria-label="Media sosial DigiLib">
          <a href="#" class="footer-soc-btn" aria-label="Twitter DigiLib"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83z"/></svg></a>
          <a href="#" class="footer-soc-btn" aria-label="Facebook DigiLib"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="#" class="footer-soc-btn" aria-label="Instagram DigiLib"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
        </div>
      </div>
      <div><div class="fcol-title">Koleksi</div><div class="fcol-links"><a href="{{ route('user.books.index') }}">Trending Sekarang</a><a href="{{ route('user.books.index', ['sort' => 'latest']) }}">Buku Baru</a><a href="{{ route('user.books.index', ['sort' => 'rating']) }}">Top 10 DigiLib</a><a href="{{ route('user.books.index') }}">Berdasarkan Genre</a></div></div>
      <div><div class="fcol-title">Komunitas</div><div class="fcol-links"><a href="#">Ulasan Pembaca</a><a href="#">Daftar Bacaan</a><a href="#">Forum Diskusi</a><a href="#">Tantangan Membaca</a></div></div>
      <div><div class="fcol-title">Perusahaan</div><div class="fcol-links"><a href="#">Tentang Kami</a><a href="#">Blog</a><a href="#">Karir</a><a href="#">Kontak</a></div></div>
      <div><div class="fcol-title">Bantuan</div><div class="fcol-links"><a href="#">Pusat Bantuan</a><a href="#">FAQ</a><a href="#">Privasi</a><a href="#">Syarat & Ketentuan</a></div></div>
    </div>
  </div>
  <div style="padding:0 32px 40px;max-width:1280px;margin:0 auto">
    <div style="font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.24);margin-bottom:10px">Lokasi Perpustakaan</div>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.0!2d106.7985!3d-6.5956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5d6a2a12345%3A0x0!2sPerpustakaan+dan+Galeri+Kota+Bogor%2C+Jl.+Kapten+Muslihat+No.21%2C+Bogor!5e0!3m2!1sid!2sid!4v1"
      width="100%" height="200"
      style="border:0;border-radius:8px;opacity:.75;filter:grayscale(30%)"
      allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
      title="Lokasi Perpustakaan dan Galeri Kota Bogor">
    </iframe>
  </div>
  <div class="footer-bottom">
    <div class="footer-copy">© {{ date('Y') }} DigiLib — Perpustakaan Kota Bogor</div>
    <div class="footer-bl"><a href="#">Privasi</a><a href="#">Syarat</a><a href="#">Cookies</a><a href="#">Aksesibilitas</a></div>
  </div>
</footer>

<script>
/* ── NAV SCROLL ── */
const nav = document.getElementById('mainNav');
function setNavScroll() {
  if (window.scrollY > 10) nav.classList.add('scrolled');
  else nav.classList.remove('scrolled');
}
window.addEventListener('scroll', setNavScroll, { passive: true });
setNavScroll();

/* ── NAV PILL ── */
const pill = document.getElementById('nlPill');
const nlWrap = document.getElementById('navLinks');
const nls = document.querySelectorAll('.nl');
function movePill(el) {
  const wRect = nlWrap.getBoundingClientRect();
  const eRect = el.getBoundingClientRect();
  pill.style.left = (eRect.left - wRect.left) + 'px';
  pill.style.width = eRect.width + 'px';
}
function setActiveNl(el) {
  nls.forEach(n => n.classList.remove('active'));
  el.classList.add('active');
  movePill(el);
}
const firstActive = document.querySelector('.nl.active');
if (firstActive) { requestAnimationFrame(() => movePill(firstActive)); }
nls.forEach(nl => {
  nl.addEventListener('click', () => {
    setActiveNl(nl);
    const href = nl.dataset.href;
    if (href) {
      const t = document.getElementById(href.slice(1));
      if (t) {
        const top = t.getBoundingClientRect().top + window.scrollY - nav.offsetHeight - 8;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    }
  });
  nl.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') nl.click(); });
  nl.addEventListener('mouseenter', () => movePill(nl));
  nl.addEventListener('mouseleave', () => { const a = document.querySelector('.nl.active'); if (a) movePill(a); });
});
window.addEventListener('resize', () => { const a = document.querySelector('.nl.active'); if (a) movePill(a); });

/* ── SECTION OBSERVER ── */
const sections = [
  { id: 'beranda', nl: nls[0] },
  { id: 'trending', nl: nls[1] },
  { id: 'genre', nl: nls[2] },
  { id: 'ulasan', nl: nls[3] },
  { id: 'cara-kerja', nl: nls[4] },
];
const sObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (!e.isIntersecting) return;
    const match = sections.find(s => s.id === e.target.id);
    if (match) setActiveNl(match.nl);
  });
}, { threshold: .3, rootMargin: '-62px 0px 0px 0px' });
sections.forEach(s => { const el = document.getElementById(s.id); if (el) sObs.observe(el); });

document.getElementById('navLogo').addEventListener('click', e => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: 'smooth' });
  setActiveNl(nls[0]);
});

/* ── HAMBURGER ── */
const hamburger = document.getElementById('navHamburger');
const mobileMenu = document.getElementById('mobileMenu');
hamburger.addEventListener('click', () => {
  const isOpen = mobileMenu.classList.toggle('open');
  hamburger.classList.toggle('open', isOpen);
  hamburger.setAttribute('aria-expanded', isOpen);
  hamburger.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
});
document.querySelectorAll('.mm-link').forEach(link => {
  link.addEventListener('click', () => {
    const href = link.dataset.href;
    mobileMenu.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    hamburger.setAttribute('aria-label', 'Buka menu');
    if (href) {
      const t = document.getElementById(href.slice(1));
      if (t) {
        const top = t.getBoundingClientRect().top + window.scrollY - nav.offsetHeight - 8;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    }
  });
});
document.addEventListener('click', e => {
  if (!e.target.closest('#navHamburger') && !e.target.closest('#mobileMenu')) {
    mobileMenu.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    hamburger.setAttribute('aria-label', 'Buka menu');
  }
});

/* ── SEARCH — redirect ke halaman buku ── */
const searchUrl = "{{ route('user.books.index') }}";
const inp = document.getElementById('searchInput');
const dd = document.getElementById('searchDropdown');
let kbIdx = -1;

function runSearch() {
  const q = inp.value.trim();
  if (!q) return;
  window.location.href = searchUrl + '?search=' + encodeURIComponent(q);
}

inp.addEventListener('keydown', e => {
  const items = dd.querySelectorAll('.sd-item');
  if (e.key === 'ArrowDown') { e.preventDefault(); kbIdx = Math.min(kbIdx + 1, items.length - 1); items.forEach((el, i) => el.classList.toggle('kbactive', i === kbIdx)); }
  else if (e.key === 'ArrowUp') { e.preventDefault(); kbIdx = Math.max(kbIdx - 1, -1); items.forEach((el, i) => el.classList.toggle('kbactive', i === kbIdx)); }
  else if (e.key === 'Enter') { e.preventDefault(); if (kbIdx >= 0 && items[kbIdx]) items[kbIdx].click(); else runSearch(); }
  else if (e.key === 'Escape') { dd.classList.remove('open'); inp.blur(); }
});
document.getElementById('searchBtn').addEventListener('click', runSearch);
document.addEventListener('click', e => { if (!e.target.closest('.nav-search-wrap')) dd.classList.remove('open'); });

/* ── SCROLL REVEAL ── */
const srObs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (!e.isIntersecting) return; e.target.classList.add('in'); srObs.unobserve(e.target); });
}, { threshold: .07 });
document.querySelectorAll('.sr').forEach(el => srObs.observe(el));

/* ── CAROUSEL DRAG ── */
function makeDrag(id) {
  const el = document.getElementById(id);
  if (!el) return;
  let d = false, sx, sl;
  el.addEventListener('mousedown', e => { d = true; sx = e.pageX - el.offsetLeft; sl = el.scrollLeft; el.style.userSelect = 'none'; });
  document.addEventListener('mouseup', () => { d = false; const el2 = document.getElementById(id); if (el2) el2.style.userSelect = ''; });
  document.addEventListener('mousemove', e => { if (!d) return; e.preventDefault(); el.scrollLeft = sl - (e.pageX - el.offsetLeft - sx) * 1.2; });
}
makeDrag('car1');
makeDrag('car2');

/* ── GENRE TABS ── */
document.querySelectorAll('.gtab').forEach(t => {
  t.addEventListener('click', () => {
    document.querySelectorAll('.gtab').forEach(x => { x.classList.remove('active'); x.setAttribute('aria-selected', 'false'); x.setAttribute('tabindex', '-1'); });
    t.classList.add('active');
    t.setAttribute('aria-selected', 'true');
    t.setAttribute('tabindex', '0');
    const f = t.dataset.filter;
    document.querySelectorAll('.gtile').forEach(tile => {
      tile.style.display = (f === 'all' || tile.dataset.g === f) ? '' : 'none';
    });
  });
  t.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') t.click(); });
});

/* ── FAQ ── */
document.querySelectorAll('.faq-q').forEach(q => {
  q.addEventListener('click', () => {
    const item = q.closest('.faq-item');
    const isOpen = item.classList.toggle('open');
    q.setAttribute('aria-expanded', isOpen);
  });
  q.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); q.click(); } });
});
</script>
</body>
</html>
