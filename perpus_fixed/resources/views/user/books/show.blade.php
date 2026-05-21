<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="description" content="{{ $book->title }} — {{ $book->author }}. Pinjam gratis di DigiLib, perpustakaan digital Indonesia."/>
<title>{{ $book->title }} — DigiLib</title>
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
  --nav-bg-scroll:rgba(249,248,245,.96);
  --nav-text-scroll:var(--muted);
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

/* NAV */
.nav{
  position:fixed;top:0;left:0;right:0;z-index:900;
  background:var(--nav-bg-scroll);
  border-bottom:1px solid rgba(0,0,0,.07);
  -webkit-backdrop-filter:blur(20px) saturate(1.6);
  backdrop-filter:blur(20px) saturate(1.6);
  box-shadow:0 1px 0 rgba(0,0,0,.05),0 4px 24px rgba(0,0,0,.04);
}
.nav-inner{
  display:flex;align-items:center;
  height:var(--nav-h);padding:0 28px;gap:0;
  max-width:1340px;margin:0 auto;
}
.nav-logo{
  display:flex;align-items:center;gap:9px;
  font-family:'Instrument Serif',serif;font-size:1.2rem;
  color:var(--ink);white-space:nowrap;flex-shrink:0;margin-right:28px;
}
.nav-logo-icon{
  width:28px;height:28px;border-radius:7px;background:var(--green);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.nav-search-wrap{flex:1;max-width:340px;margin:0 14px;position:relative}
.nav-search{
  display:flex;align-items:center;background:var(--surface);
  border:1px solid var(--border);border-radius:8px;height:35px;
  transition:border-color .15s,box-shadow .15s;
}
.nav-search:focus-within{border-color:var(--green)!important;box-shadow:0 0 0 3px rgba(28,107,70,.12);background:var(--white)!important}
.nav-search-icon{padding:0 10px;display:flex;align-items:center;color:var(--muted-2);flex-shrink:0}
.nav-search:focus-within .nav-search-icon{color:var(--green)}
.nav-search input{
  flex:1;height:100%;padding:0 10px 0 0;
  background:transparent;border:none;outline:none;
  font-family:'DM Sans',sans-serif;font-size:.82rem;color:var(--ink);min-width:0;
}
.nav-search input::placeholder{color:var(--muted-2)}
.nav-search-btn{
  height:100%;padding:0 11px;display:flex;align-items:center;
  color:var(--muted-2);cursor:pointer;
  border-left:1px solid var(--border);border-radius:0 7px 7px 0;
  transition:color .15s,background .15s,border-color .35s;flex-shrink:0;
}
.nav-search-btn:hover{color:var(--green)!important;background:var(--green-pale)!important}
.nav-right{display:flex;align-items:center;gap:7px;flex-shrink:0;margin-left:auto}
.nav-btn{font-family:'DM Sans',sans-serif;font-size:.8rem;font-weight:600;padding:7px 15px;border-radius:7px;cursor:pointer;transition:all .15s;display:block;white-space:nowrap;letter-spacing:-.01em}
.nav-btn-ghost{color:var(--ink-2);border:1px solid var(--border)}
.nav-btn-ghost:hover{color:var(--green)!important;border-color:var(--green)!important;background:var(--green-pale)!important}
.nav-btn-primary{background:var(--green);color:#fff;border:1px solid var(--green)}
.nav-btn-primary:hover{background:var(--green-dark);border-color:var(--green-dark)}
.nav-hamburger{display:none;flex-direction:column;gap:4.5px;cursor:pointer;padding:6px;border-radius:6px;transition:background .15s;margin-left:auto;flex-shrink:0}
.nav-hamburger:hover{background:var(--surface)}
.nav-hamburger span{display:block;width:20px;height:2px;border-radius:2px;background:var(--ink-2);transition:transform .25s,opacity .25s}
.nav-hamburger.open span:nth-child(1){transform:translateY(6.5px) rotate(45deg)}
.nav-hamburger.open span:nth-child(2){opacity:0}
.nav-hamburger.open span:nth-child(3){transform:translateY(-6.5px) rotate(-45deg)}
.mobile-menu{display:none;position:fixed;top:var(--nav-h);left:0;right:0;background:var(--white);border-bottom:1px solid var(--border);z-index:899;padding:16px 20px 20px;box-shadow:0 8px 32px rgba(0,0,0,.1);transform:translateY(-8px);opacity:0;transition:transform .22s ease,opacity .22s ease;pointer-events:none}
.mobile-menu.open{display:block;transform:translateY(0);opacity:1;pointer-events:auto}
.mm-links{display:flex;flex-direction:column;gap:2px;margin-bottom:14px}
.mm-link{font-size:.95rem;font-weight:500;color:var(--ink-2);padding:10px 12px;border-radius:7px;cursor:pointer;transition:background .12s,color .12s}
.mm-link:hover{background:var(--green-pale);color:var(--green)}
.mm-divider{height:1px;background:var(--border);margin:6px 0}
.mm-btns{display:flex;gap:8px}
.mm-btn{flex:1;text-align:center;font-family:'DM Sans',sans-serif;font-size:.85rem;font-weight:600;padding:10px;border-radius:7px;cursor:pointer;transition:all .15s}
.mm-btn-ghost{color:var(--ink-2);border:1px solid var(--border)}
.mm-btn-ghost:hover{border-color:var(--green);color:var(--green)}
.mm-btn-primary{background:var(--green);color:#fff;border:1px solid var(--green)}
.mm-btn-primary:hover{background:var(--green-dark)}
.nav-spacer{height:var(--nav-h)}

/* BOOK HERO */
.book-hero{background:var(--green-3);position:relative;overflow:hidden;}
.bh-grain{position:absolute;inset:0;z-index:1;pointer-events:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='250' height='250'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='250' height='250' filter='url(%23n)' opacity='.032'/%3E%3C/svg%3E");background-size:250px;}
.bh-vignette{position:absolute;inset:0;z-index:2;background:linear-gradient(120deg,rgba(6,26,15,.98) 0%,rgba(6,26,15,.72) 48%,rgba(6,26,15,.12) 80%,transparent 100%);}
.bh-deco-circle{position:absolute;right:-120px;top:-120px;width:480px;height:480px;border-radius:50%;background:radial-gradient(circle,rgba(93,185,138,.07) 0%,transparent 65%);z-index:2;pointer-events:none;}
.bh-inner{position:relative;z-index:3;max-width:1280px;margin:0 auto;padding:52px 32px 56px;display:grid;grid-template-columns:1fr auto;gap:60px;align-items:center;}
.bh-eyebrow{display:flex;align-items:center;gap:8px;margin-bottom:22px;}
.bh-back{display:inline-flex;align-items:center;gap:6px;font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(200,225,210,.5);border:1px solid rgba(255,255,255,.1);padding:5px 12px;border-radius:5px;transition:all .15s;cursor:pointer;}
.bh-back:hover{color:rgba(244,241,234,.9);border-color:rgba(255,255,255,.24)}
.bh-back svg{transition:transform .15s}
.bh-back:hover svg{transform:translateX(-2px)}
.bh-cat{font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--teal);}
.bh-title{font-family:'Instrument Serif',serif;font-size:clamp(2rem,5.2vw,4.2rem);font-weight:400;line-height:.92;letter-spacing:-.035em;color:#f4f1ea;margin-bottom:10px;max-width:560px;}
.bh-title em{font-style:italic;color:rgba(244,241,234,.38)}
.bh-author{font-family:'DM Sans',sans-serif;font-size:1rem;font-weight:400;color:rgba(244,241,234,.48);margin-bottom:20px;letter-spacing:-.01em;}
.bh-author strong{color:rgba(244,241,234,.76);font-weight:500}
.bh-meta{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:24px}
.bh-rating{display:flex;align-items:center;gap:5px;background:rgba(93,185,138,.12);border:1px solid rgba(93,185,138,.24);padding:5px 11px;border-radius:5px;}
.bh-stars{color:var(--teal);font-size:.82rem;letter-spacing:1px}
.bh-score{font-family:'Syne',sans-serif;font-size:.8rem;font-weight:700;color:var(--teal)}
.bh-votes{font-size:.7rem;color:rgba(244,241,234,.32);margin-left:2px}
.bh-tag{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:rgba(244,241,234,.38);padding:5px 11px;border-radius:5px;border:1px solid rgba(255,255,255,.1);}
.bh-tag.genre{color:rgba(93,185,138,.7);border-color:rgba(93,185,138,.2)}
.bh-synopsis{font-size:.9rem;color:rgba(244,241,234,.54);line-height:1.82;max-width:500px;margin-bottom:32px;}
.bh-actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.bh-btn-main{display:inline-flex;align-items:center;gap:9px;font-family:'Syne',sans-serif;font-size:.76rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--green);color:#fff;padding:13px 26px;border-radius:8px;transition:all .2s;cursor:pointer;}
.bh-btn-main:hover{background:#24855a;transform:translateY(-2px);box-shadow:0 8px 24px rgba(28,107,70,.4)}
.bh-btn-wish{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.76rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;color:rgba(244,241,234,.5);border:1px solid rgba(255,255,255,.14);padding:12px 20px;border-radius:8px;transition:all .2s;cursor:pointer;}
.bh-btn-wish:hover{color:#f4f1ea;border-color:rgba(255,255,255,.34);background:rgba(255,255,255,.04)}
.bh-btn-wish.active{color:var(--accent);border-color:rgba(208,78,26,.32)}
.bh-avail{display:inline-flex;align-items:center;gap:7px;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--teal);}
.bh-avail-dot{width:6px;height:6px;border-radius:50%;background:var(--teal);animation:pulse 2.2s ease-in-out infinite;flex-shrink:0}
.bh-avail-na{color:rgba(244,241,234,.3)}
.bh-avail-dot-na{background:rgba(244,241,234,.2);animation:none}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}

/* BOOK COVER */
.bh-cover-wrap{position:relative;flex-shrink:0}
.bh-cover{width:180px;height:260px;border-radius:9px;overflow:hidden;box-shadow:-16px 12px 48px rgba(0,0,0,.75),4px 0 0 rgba(255,255,255,.04);position:relative;flex-shrink:0;}
.bh-cover-img{width:100%;height:100%;object-fit:cover;display:block}
.bh-cover-art{width:100%;height:100%;background:linear-gradient(155deg,#1c6b46 0%,#0b3021 60%,#040e08 100%);display:flex;flex-direction:column;justify-content:flex-end;padding:18px 16px;position:relative;overflow:hidden;}
.bh-cover-deco{position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:radial-gradient(circle,rgba(93,185,138,.14) 0%,transparent 70%);}
.bh-cover-lines{position:absolute;top:16px;left:0;right:0;display:flex;flex-direction:column;gap:6px;padding:0 14px;}
.bh-cover-line{height:1px;background:rgba(255,255,255,.06);border-radius:2px}
.bh-cover-line:nth-child(2){width:70%}
.bh-cover-line:nth-child(3){width:45%}
.bh-cover-numeral{position:absolute;top:18px;right:14px;font-family:'Instrument Serif',serif;font-style:italic;font-size:4.5rem;line-height:1;color:rgba(255,255,255,.05);letter-spacing:-.04em;user-select:none;}
.bh-cover-t{font-family:'Instrument Serif',serif;font-size:.9rem;color:rgba(255,255,255,.92);line-height:1.2;position:relative;z-index:1;}
.bh-cover-a{font-size:.56rem;color:rgba(255,255,255,.44);margin-top:4px;position:relative;z-index:1}
.bh-cover::after{content:'';position:absolute;left:0;top:0;bottom:0;width:9px;background:linear-gradient(to right,rgba(0,0,0,.32),transparent);z-index:2}
.bh-cover-badge{position:absolute;top:-10px;right:-10px;width:52px;height:52px;border-radius:50%;background:var(--accent);display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(208,78,26,.4);}
.bh-cover-badge-n{font-family:'Instrument Serif',serif;font-size:1rem;color:#fff;line-height:1}
.bh-cover-badge-l{font-family:'Syne',sans-serif;font-size:.38rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:rgba(255,255,255,.7)}
.bh-cover-shadow{position:absolute;bottom:-10px;left:10px;right:-10px;height:30px;background:rgba(0,0,0,.35);border-radius:0 0 9px 9px;filter:blur(12px);z-index:-1;}

/* PAGE LAYOUT */
.page{max-width:1280px;margin:0 auto;padding:0 32px}
.detail-body{display:grid;grid-template-columns:1fr 320px;gap:44px;align-items:start;padding-top:44px;padding-bottom:80px;}

/* TABS */
.tabs{display:flex;border-bottom:1.5px solid var(--border);margin-bottom:32px}
.tab{font-family:'Syne',sans-serif;font-size:.68rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted-2);padding:11px 18px;border-bottom:2px solid transparent;margin-bottom:-1.5px;cursor:pointer;transition:color .15s,border-color .15s;white-space:nowrap;}
.tab:hover{color:var(--ink)}
.tab.active{color:var(--green);border-bottom-color:var(--green)}
.tab-panel{display:none}.tab-panel.active{display:block}

/* SYNOPSIS */
.synopsis-text{font-family:'DM Sans',sans-serif;font-size:.9rem;color:var(--ink-2);line-height:1.88;margin-bottom:22px;}

/* INFO TABLE */
.info-section{padding-top:36px}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;border:1.5px solid var(--border);border-radius:10px;overflow:hidden;background:var(--white);}
.info-row{display:flex;flex-direction:column;padding:16px 20px;border-bottom:1px solid var(--border);border-right:1px solid var(--border);}
.info-row:nth-child(even){border-right:none}
.info-row:nth-last-child(-n+2){border-bottom:none}
.info-label{font-family:'Syne',sans-serif;font-size:.57rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted-2);margin-bottom:5px;}
.info-value{font-size:.84rem;font-weight:500;color:var(--ink)}

/* REVIEWS */
.reviews-section{padding-top:36px}
.reviews-header{display:flex;align-items:baseline;justify-content:space-between;margin-bottom:24px;}
.rh-left{display:flex;align-items:baseline;gap:12px}
.rh-title{font-family:'Instrument Serif',serif;font-size:1.3rem;color:var(--ink);letter-spacing:-.02em;}
.rh-count{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted-2);}
.rating-summary{background:var(--white);border:1.5px solid var(--border);border-radius:10px;padding:20px 22px;margin-bottom:20px;display:flex;align-items:center;gap:28px;}
.rs-big{text-align:center;flex-shrink:0}
.rs-num{font-family:'Instrument Serif',serif;font-size:3.2rem;color:var(--green);letter-spacing:-.05em;line-height:1;}
.rs-stars{font-size:.9rem;color:#e6a817;letter-spacing:2px;margin-top:4px}
.rs-count{font-family:'Syne',sans-serif;font-size:.58rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--muted-2);margin-top:4px}
.rs-bars{flex:1}
.rs-bar-row{display:flex;align-items:center;gap:10px;margin-bottom:7px}
.rs-bar-row:last-child{margin-bottom:0}
.rs-bar-lbl{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;color:var(--muted);width:10px;text-align:right;flex-shrink:0}
.rs-bar-track{flex:1;height:5px;background:var(--surface);border-radius:3px;overflow:hidden}
.rs-bar-fill{height:100%;border-radius:3px;background:var(--green);transition:width .6s ease}
.rs-bar-pct{font-family:'Syne',sans-serif;font-size:.58rem;color:var(--muted-2);width:26px;text-align:right;flex-shrink:0}
.review-card{background:var(--white);border:1.5px solid var(--border);border-radius:12px;padding:22px 24px;margin-bottom:12px;position:relative;overflow:hidden;transition:border-color .2s,box-shadow .2s;}
.review-card:hover{border-color:var(--green-pale-2);box-shadow:0 6px 20px rgba(28,107,70,.07)}
.rc-deco{position:absolute;top:-8px;right:16px;font-family:'Instrument Serif',serif;font-size:6rem;line-height:1;color:var(--border);pointer-events:none;user-select:none;transition:color .2s;}
.review-card:hover .rc-deco{color:var(--green-pale-2)}
.rc-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;gap:12px}
.rc-user{display:flex;align-items:center;gap:10px}
.rc-av{width:36px;height:36px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;}
.rc-name{font-size:.84rem;font-weight:600;color:var(--ink)}
.rc-date{font-family:'Syne',sans-serif;font-size:.58rem;letter-spacing:.04em;color:var(--muted-2);margin-top:2px}
.rc-stars{color:#e6a817;font-size:.78rem;letter-spacing:1px;flex-shrink:0}
.rc-text{font-family:'Instrument Serif',serif;font-style:italic;font-size:.92rem;color:var(--ink-2);line-height:1.74;position:relative;z-index:1;margin-bottom:12px;}

/* SIDEBAR */
.sidebar-sticky{position:sticky;top:calc(var(--nav-h) + 18px);display:flex;flex-direction:column;gap:16px}
.borrow-card{background:var(--white);border:1.5px solid var(--border);border-radius:12px;overflow:hidden;}
.borrow-card-head{background:var(--green-3);padding:18px 20px;position:relative;overflow:hidden;}
.borrow-card-head::before{content:'';position:absolute;right:-30px;top:-30px;width:120px;height:120px;border-radius:50%;background:radial-gradient(circle,rgba(93,185,138,.1) 0%,transparent 70%);}
.bc-head-title{font-family:'Instrument Serif',serif;font-size:1.1rem;color:#f4f1ea;position:relative;z-index:1}
.bc-head-sub{font-size:.72rem;color:rgba(244,241,234,.38);margin-top:3px;position:relative;z-index:1}
.borrow-card-body{padding:18px 20px}
.avail-status{display:flex;align-items:center;gap:8px;padding:10px 14px;border-radius:7px;background:rgba(93,185,138,.08);border:1px solid rgba(93,185,138,.18);margin-bottom:16px;}
.avail-status-na{background:rgba(200,0,0,.05);border-color:rgba(200,0,0,.15)}
.avail-dot{width:7px;height:7px;border-radius:50%;background:var(--teal);flex-shrink:0;animation:pulse 2.2s ease-in-out infinite}
.avail-dot-na{background:#c0392b;animation:none}
.avail-txt{flex:1}
.avail-main{font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;color:var(--teal);letter-spacing:.04em}
.avail-main-na{color:#c0392b}
.avail-sub{font-size:.65rem;color:var(--muted);margin-top:1px}
.avail-count{font-family:'Instrument Serif',serif;font-size:1.2rem;color:var(--teal);line-height:1}
.loan-info{display:flex;flex-direction:column;gap:10px;margin-bottom:18px}
.loan-row{display:flex;align-items:center;justify-content:space-between;gap:8px}
.loan-lbl{font-family:'Syne',sans-serif;font-size:.62rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;color:var(--muted-2)}
.loan-val{font-size:.78rem;font-weight:500;color:var(--ink)}
.loan-div{height:1px;background:var(--border)}
.sidebar-btn-main{display:block;width:100%;text-align:center;font-family:'Syne',sans-serif;font-size:.76rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--green);color:#fff;padding:13px;border-radius:8px;transition:all .2s;cursor:pointer;margin-bottom:8px;border:none;}
.sidebar-btn-main:hover{background:var(--green-dark);transform:translateY(-1px);box-shadow:0 6px 20px rgba(28,107,70,.3)}
.sidebar-btn-main:disabled{background:var(--muted-2);cursor:not-allowed;transform:none;box-shadow:none}
.sidebar-btn-ghost{display:flex;width:100%;align-items:center;justify-content:center;gap:7px;font-family:'Syne',sans-serif;font-size:.72rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;color:var(--muted);border:1.5px solid var(--border);padding:10px;border-radius:8px;cursor:pointer;transition:all .15s;}
.sidebar-btn-ghost:hover{border-color:var(--accent);color:var(--accent)}
.sidebar-btn-ghost.active{border-color:var(--accent);color:var(--accent);background:rgba(208,78,26,.04)}
.author-card{background:var(--white);border:1.5px solid var(--border);border-radius:12px;padding:18px 20px;}
.author-card-head{display:flex;align-items:center;gap:12px;margin-bottom:14px;padding-bottom:14px;border-bottom:1px solid var(--border);}
.author-av{width:44px;height:44px;border-radius:50%;flex-shrink:0;background:linear-gradient(135deg,#1c6b46,#0b3021);display:flex;align-items:center;justify-content:center;font-family:'Instrument Serif',serif;font-size:1.1rem;color:rgba(255,255,255,.8);}
.author-name{font-size:.88rem;font-weight:600;color:var(--ink)}
.author-label{font-family:'Syne',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--green);margin-top:2px}
.author-bio{font-size:.78rem;color:var(--muted);line-height:1.7}

/* RELATED */
.related-section{background:var(--surface);border-top:1px solid var(--border);padding:52px 0 60px;}
.sh{display:flex;align-items:baseline;justify-content:space-between;margin-bottom:22px}
.sh-left{display:flex;align-items:baseline;gap:12px}
.sh-title{font-family:'Instrument Serif',serif;font-size:1.5rem;font-weight:400;color:var(--ink);letter-spacing:-.02em}
.sh-title em{font-style:italic;color:var(--muted)}
.sh-badge{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--green);display:flex;align-items:center;gap:6px}
.sh-badge::before{content:'';width:12px;height:2px;background:var(--green);flex-shrink:0}
.sh-link{font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:var(--green);display:flex;align-items:center;gap:5px;cursor:pointer;transition:gap .15s}
.sh-link:hover{gap:8px}
.car-wrap{position:relative;margin:0 -32px}
.car-fade-r{position:absolute;right:0;top:0;bottom:0;width:80px;background:linear-gradient(to left,var(--surface),transparent);pointer-events:none;z-index:2}
.car-fade-l{position:absolute;left:0;top:0;bottom:0;width:80px;background:linear-gradient(to right,var(--surface),transparent);pointer-events:none;z-index:2}
.car{display:flex;gap:14px;overflow-x:auto;scrollbar-width:none;padding:4px 32px 20px;-webkit-overflow-scrolling:touch;cursor:grab}
.car::-webkit-scrollbar{display:none}
.car:active{cursor:grabbing}
.bk{width:128px;flex-shrink:0}
.bk-cov{width:128px;height:186px;border-radius:7px;margin-bottom:10px;overflow:hidden;position:relative;box-shadow:0 2px 0 rgba(0,0,0,.07),0 4px 16px rgba(0,0,0,.09);transition:transform .3s cubic-bezier(.34,1.56,.64,1),box-shadow .3s}
.bk:hover .bk-cov{transform:translateY(-6px) scale(1.02);box-shadow:0 14px 28px rgba(0,0,0,.16)}
.bk-cov-art{width:100%;height:100%;display:flex;flex-direction:column;justify-content:flex-end;padding:10px 9px}
.bk-cov::before{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.52) 0%,transparent 45%);z-index:1}
.bk-cov::after{content:'';position:absolute;left:0;top:0;bottom:0;width:7px;background:linear-gradient(to right,rgba(0,0,0,.2),transparent);z-index:1}
.bk-cov-txt{position:relative;z-index:2}
.bk-cov-t{font-family:'Instrument Serif',serif;font-size:.54rem;color:rgba(255,255,255,.92);line-height:1.2}
.bk-cov-a{font-size:.46rem;color:rgba(255,255,255,.5);margin-top:2px}
.bk-title{font-size:.78rem;font-weight:500;color:var(--ink);line-height:1.25;margin-bottom:3px}
.bk-author{font-size:.68rem;color:var(--muted);margin-bottom:4px}
.bk-rat{display:flex;align-items:center;gap:4px}
.bk-star{color:#e6a817;font-size:.7rem}
.bk-score{font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;color:var(--ink-2)}

/* FOOTER */
footer{background:var(--ink);margin-top:0}
.footer-bottom{display:flex;align-items:center;justify-content:space-between;padding:18px 32px;max-width:1280px;margin:0 auto;flex-wrap:wrap;gap:10px}
.footer-copy{font-family:'Syne',sans-serif;font-size:.6rem;letter-spacing:.06em;text-transform:uppercase;color:rgba(244,241,234,.15)}
.footer-bl{display:flex;gap:18px;flex-wrap:wrap}
.footer-bl a{font-family:'Syne',sans-serif;font-size:.6rem;letter-spacing:.04em;text-transform:uppercase;color:rgba(244,241,234,.15);transition:color .15s}
.footer-bl a:hover{color:rgba(244,241,234,.4)}

/* SCROLL REVEAL */
.sr{opacity:0;transform:translateY(18px);transition:opacity .55s ease,transform .55s ease}
.sr.in{opacity:1;transform:none}

/* TOAST */
.toast{position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(80px);background:var(--ink);color:#f4f1ea;font-family:'Syne',sans-serif;font-size:.68rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:12px 22px;border-radius:8px;box-shadow:0 8px 28px rgba(0,0,0,.22);z-index:9999;white-space:nowrap;display:flex;align-items:center;gap:8px;opacity:0;transition:transform .3s cubic-bezier(.34,1.56,.64,1),opacity .3s ease;pointer-events:none;}
.toast.show{transform:translateX(-50%) translateY(0);opacity:1}
.toast-dot{width:6px;height:6px;border-radius:50%;background:var(--teal);flex-shrink:0}

/* RESPONSIVE */
@media(max-width:1100px){
  .bh-inner{gap:36px}
  .detail-body{grid-template-columns:1fr 280px;gap:28px}
  .bh-cover{width:150px;height:216px}
}
@media(max-width:820px){
  .nav-right{display:none}
  .nav-hamburger{display:flex}
  .nav-search-wrap{max-width:none;flex:1;margin:0 10px}
  .bh-inner{grid-template-columns:1fr;padding:44px 20px 48px}
  .bh-cover-wrap{display:none}
  .detail-body{grid-template-columns:1fr;gap:24px}
  .sidebar-sticky{position:static}
  .sidebar-col{order:-1}
  .car-wrap{margin:0 -20px}
  .car{padding:4px 20px 20px}
  .page{padding:0 20px}
  .info-grid{grid-template-columns:1fr}
  .info-row{border-right:none!important}
  .info-row:nth-last-child(-n+2){border-bottom:1px solid var(--border)}
  .info-row:last-child{border-bottom:none!important}
  .rating-summary{flex-direction:column;gap:16px;align-items:flex-start}
}
@media(max-width:560px){
  .bh-title{font-size:clamp(1.8rem,7vw,2.8rem)}
  .bh-actions{flex-direction:column;align-items:stretch}
  .bh-btn-main,.bh-btn-wish{justify-content:center}
  .page{padding:0 16px}
  .car-wrap{margin:0 -16px}
  .car{padding:4px 16px 20px}
}
</style>
</head>
<body>

<!-- TOAST -->
<div class="toast" id="toast" role="status" aria-live="polite">
  <div class="toast-dot"></div>
  <span id="toastMsg">Koleksi diperbarui</span>
</div>

<!-- NAV -->
<nav class="nav" id="mainNav" role="navigation" aria-label="Navigasi utama">
  <div class="nav-inner">
    <a href="{{ route('user.books.index') }}" class="nav-logo" aria-label="DigiLib — Kembali ke beranda">
      <div class="nav-logo-icon" aria-hidden="true">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
      </div>
      DigiLib
    </a>
    <div class="nav-search-wrap" role="search">
      <form action="{{ route('user.books.index') }}" method="GET">
        <div class="nav-search">
          <div class="nav-search-icon" aria-hidden="true">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </div>
          <input type="search" name="search" placeholder="Cari judul, penulis..." autocomplete="off" aria-label="Cari buku"/>
          <button type="submit" class="nav-search-btn" aria-label="Mulai pencarian">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </button>
        </div>
      </form>
    </div>
    <div class="nav-right">
      @auth
        <a href="{{ route('user.dashboard') }}" class="nav-btn nav-btn-ghost">{{ auth()->user()->name }}</a>
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

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu" aria-label="Menu mobile">
  <div class="mm-btns">
    @auth
      <a href="{{ route('user.dashboard') }}" class="mm-btn mm-btn-ghost">Dashboard</a>
      <form method="POST" action="{{ route('logout') }}" style="flex:1">
        @csrf
        <button type="submit" class="mm-btn mm-btn-primary" style="width:100%">Keluar</button>
      </form>
    @else
      <a href="{{ route('login') }}" class="mm-btn mm-btn-ghost">Masuk</a>
      <a href="{{ route('register') }}" class="mm-btn mm-btn-primary">Daftar</a>
    @endauth
  </div>
</div>

<div class="nav-spacer"></div>

<!-- HERO -->
@php
  $avg = $book->avgRating();
  $starsFull = str_repeat('★', (int)round($avg));
  $starsEmpty = str_repeat('☆', 5 - (int)round($avg));
@endphp

<section class="book-hero" aria-label="Informasi buku">
  <div class="bh-grain" aria-hidden="true"></div>
  <div class="bh-vignette" aria-hidden="true"></div>
  <div class="bh-deco-circle" aria-hidden="true"></div>
  <div class="bh-inner">
    <div class="bh-content">
      <div class="bh-eyebrow">
        <a href="{{ route('user.books.index') }}" class="bh-back" aria-label="Kembali ke koleksi">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
          Kembali
        </a>
        <span class="bh-cat">{{ $book->category->name }}</span>
      </div>

      <h1 class="bh-title">{{ $book->title }}</h1>
      <p class="bh-author">oleh <strong>{{ $book->author }}</strong></p>

      <div class="bh-meta" role="group" aria-label="Informasi buku">
        <div class="bh-rating" aria-label="Rating {{ number_format($avg,1) }} dari 5, {{ $reviews->count() }} ulasan">
          <span class="bh-stars" aria-hidden="true">{{ $starsFull }}{{ $starsEmpty }}</span>
          <span class="bh-score">{{ number_format($avg, 1) }}</span>
          <span class="bh-votes">{{ $reviews->count() }} ulasan</span>
        </div>
        <span class="bh-tag genre">{{ $book->category->name }}</span>
        @if($book->publish_date)
          <span class="bh-tag">{{ $book->publish_date->format('Y') }}</span>
        @endif
        @if($book->pages)
          <span class="bh-tag">{{ $book->pages }} hal</span>
        @endif
      </div>

      <p class="bh-synopsis">{{ Str::limit($book->synopsis ?? 'Tidak ada sinopsis.', 200) }}</p>

      <div class="bh-actions">
        @auth
          @if($book->isAvailable())
            <a href="{{ route('user.borrow.create', ['book_id' => $book->id]) }}" class="bh-btn-main">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
              Pinjam Buku
            </a>
          @else
            <button class="bh-btn-main" disabled style="opacity:.5;cursor:not-allowed">Stok Habis</button>
          @endif

          <form method="POST" action="{{ route('user.books.collect', $book) }}" style="display:inline">
            @csrf
            <button type="submit" class="bh-btn-wish {{ $userCollection ? 'active' : '' }}" aria-pressed="{{ $userCollection ? 'true' : 'false' }}">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              {{ $userCollection ? 'Tersimpan ♥' : 'Koleksi' }}
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="bh-btn-main">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
            Login untuk Meminjam
          </a>
        @endauth

        <span class="bh-avail {{ !$book->isAvailable() ? 'bh-avail-na' : '' }}" role="status" aria-live="polite">
          <span class="bh-avail-dot {{ !$book->isAvailable() ? 'bh-avail-dot-na' : '' }}" aria-hidden="true"></span>
          @if($book->isAvailable())
            {{ $book->stock }} eksemplar tersedia
          @else
            Stok habis
          @endif
        </span>
      </div>
    </div>

    <!-- COVER -->
    <div class="bh-cover-wrap" aria-hidden="true">
      <div class="bh-cover-shadow"></div>
      <div class="bh-cover">
        @if($book->cover_url && !str_contains($book->cover_url, 'placeholder'))
          <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="bh-cover-img"/>
        @else
          <div class="bh-cover-art">
            <div class="bh-cover-deco"></div>
            <div class="bh-cover-lines">
              <div class="bh-cover-line"></div>
              <div class="bh-cover-line"></div>
              <div class="bh-cover-line"></div>
            </div>
            <div class="bh-cover-numeral">{{ strtoupper(substr($book->title, 0, 1)) }}</div>
            <div class="bh-cover-t">{{ $book->title }}</div>
            <div class="bh-cover-a">{{ $book->author }}</div>
          </div>
        @endif
      </div>
      <div class="bh-cover-badge" aria-label="Rating">
        <div class="bh-cover-badge-n">{{ number_format($avg, 1) }}</div>
        <div class="bh-cover-badge-l">Rating</div>
      </div>
    </div>
  </div>
</section>

<!-- DETAIL BODY -->
<div class="page">
  <div class="detail-body">

    <!-- MAIN COL -->
    <main class="main-col" id="main-content">

      <!-- TABS -->
      <div class="tabs" role="tablist" aria-label="Navigasi konten buku">
        <button class="tab active" role="tab" aria-selected="true" aria-controls="panel-sinopsis" id="tab-sinopsis">Sinopsis</button>
        <button class="tab" role="tab" aria-selected="false" aria-controls="panel-info" id="tab-info" tabindex="-1">Info Buku</button>
        <button class="tab" role="tab" aria-selected="false" aria-controls="panel-ulasan" id="tab-ulasan" tabindex="-1">Ulasan ({{ $reviews->count() }})</button>
      </div>

      <!-- SINOPSIS -->
      <div class="tab-panel active" id="panel-sinopsis" role="tabpanel" aria-labelledby="tab-sinopsis">
        <p class="synopsis-text">{{ $book->synopsis ?? 'Tidak ada sinopsis untuk buku ini.' }}</p>
      </div>

      <!-- INFO BUKU -->
      <div class="tab-panel" id="panel-info" role="tabpanel" aria-labelledby="tab-info">
        <div class="info-section">
          <div class="info-grid" role="table" aria-label="Detail buku">
            <div class="info-row" role="row">
              <span class="info-label">Judul</span>
              <span class="info-value">{{ $book->title }}</span>
            </div>
            <div class="info-row" role="row">
              <span class="info-label">Penulis</span>
              <span class="info-value">{{ $book->author }}</span>
            </div>
            @if($book->publisher)
            <div class="info-row" role="row">
              <span class="info-label">Penerbit</span>
              <span class="info-value">{{ $book->publisher }}</span>
            </div>
            @endif
            @if($book->publish_date)
            <div class="info-row" role="row">
              <span class="info-label">Tahun Terbit</span>
              <span class="info-value">{{ $book->publish_date->format('d M Y') }}</span>
            </div>
            @endif
            @if($book->pages)
            <div class="info-row" role="row">
              <span class="info-label">Jumlah Halaman</span>
              <span class="info-value">{{ $book->pages }} halaman</span>
            </div>
            @endif
            @if($book->language)
            <div class="info-row" role="row">
              <span class="info-label">Bahasa</span>
              <span class="info-value">{{ $book->language }}</span>
            </div>
            @endif
            @if($book->isbn)
            <div class="info-row" role="row">
              <span class="info-label">ISBN</span>
              <span class="info-value">{{ $book->isbn }}</span>
            </div>
            @endif
            <div class="info-row" role="row">
              <span class="info-label">Kategori</span>
              <span class="info-value">{{ $book->category->name }}</span>
            </div>
            @if($book->weight)
            <div class="info-row" role="row">
              <span class="info-label">Berat</span>
              <span class="info-value">{{ $book->weight }} gram</span>
            </div>
            @endif
            <div class="info-row" role="row">
              <span class="info-label">Stok</span>
              <span class="info-value">{{ $book->stock }} eksemplar</span>
            </div>
          </div>
        </div>
      </div>

      <!-- ULASAN -->
      <div class="tab-panel" id="panel-ulasan" role="tabpanel" aria-labelledby="tab-ulasan">
        <div class="reviews-section">
          <div class="reviews-header">
            <div class="rh-left">
              <h2 class="rh-title">Ulasan Pembaca</h2>
              <span class="rh-count">{{ $reviews->count() }} ulasan</span>
            </div>
          </div>

          @if($reviews->count() > 0)
          <div class="rating-summary" role="region" aria-label="Ringkasan rating">
            <div class="rs-big">
              <div class="rs-num" aria-label="Rating {{ number_format($avg,1) }}">{{ number_format($avg, 1) }}</div>
              <div class="rs-stars" aria-hidden="true">{{ $starsFull }}{{ $starsEmpty }}</div>
              <div class="rs-count">{{ $reviews->count() }} ulasan</div>
            </div>
            <div class="rs-bars" role="list" aria-label="Distribusi bintang">
              @php
                $total = $reviews->count();
                $dist = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                foreach ($reviews as $r) { $dist[(int)$r->rating] = ($dist[(int)$r->rating] ?? 0) + 1; }
              @endphp
              @foreach([5,4,3,2,1] as $star)
                @php $pct = $total > 0 ? round(($dist[$star] / $total) * 100) : 0; @endphp
                <div class="rs-bar-row" role="listitem">
                  <span class="rs-bar-lbl" aria-label="{{ $star }} bintang">{{ $star }}</span>
                  <div class="rs-bar-track"><div class="rs-bar-fill" style="width:{{ $pct }}%" role="progressbar" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div></div>
                  <span class="rs-bar-pct">{{ $pct }}%</span>
                </div>
              @endforeach
            </div>
          </div>

          @foreach($reviews as $review)
          @php
            $colors = ['linear-gradient(135deg,#1c6b46,#0b3021)','linear-gradient(135deg,#5db98a,#1c6b46)','linear-gradient(135deg,#d04e1a,#8b2f0d)','linear-gradient(135deg,#1a4a7a,#071525)','linear-gradient(135deg,#3d1a6b,#0d0518)'];
            $colorIdx = $loop->index % count($colors);
            $initials = strtoupper(substr($review->user->name, 0, 1));
            if (strpos($review->user->name, ' ') !== false) {
              $parts = explode(' ', $review->user->name);
              $initials = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
            }
            $reviewStars = str_repeat('★', (int)$review->rating) . str_repeat('☆', 5 - (int)$review->rating);
          @endphp
          <article class="review-card sr" aria-label="Ulasan dari {{ $review->user->name }}">
            <div class="rc-deco" aria-hidden="true">"</div>
            <div class="rc-header">
              <div class="rc-user">
                <div class="rc-av" style="background:{{ $colors[$colorIdx] }}" aria-hidden="true">{{ $initials }}</div>
                <div>
                  <div class="rc-name">{{ $review->user->name }}</div>
                  <div class="rc-date">{{ $review->created_at->diffForHumans() }}</div>
                </div>
              </div>
              <div class="rc-stars" aria-label="Rating {{ $review->rating }} bintang">{{ $reviewStars }}</div>
            </div>
            @if($review->comment)
            <p class="rc-text">{{ $review->comment }}</p>
            @endif
          </article>
          @endforeach

          @else
          <p style="color:var(--muted);font-size:.88rem;padding:24px 0">Belum ada ulasan untuk buku ini.</p>
          @endif
        </div>
      </div>
    </main>

    <!-- SIDEBAR -->
    <aside class="sidebar-col" aria-label="Panel peminjaman">
      <div class="sidebar-sticky">

        <!-- BORROW CARD -->
        <div class="borrow-card">
          <div class="borrow-card-head">
            <div class="bc-head-title">Pinjam Buku</div>
            <div class="bc-head-sub">Gratis · Tanpa denda · Perpanjang kapan saja</div>
          </div>
          <div class="borrow-card-body">
            <div class="avail-status {{ !$book->isAvailable() ? 'avail-status-na' : '' }}" role="status">
              <div class="avail-dot {{ !$book->isAvailable() ? 'avail-dot-na' : '' }}" aria-hidden="true"></div>
              <div class="avail-txt">
                <div class="avail-main {{ !$book->isAvailable() ? 'avail-main-na' : '' }}">
                  {{ $book->isAvailable() ? 'Tersedia' : 'Stok Habis' }}
                </div>
                <div class="avail-sub">{{ $book->stock }} eksemplar</div>
              </div>
              <div class="avail-count">{{ $book->stock }}</div>
            </div>

            <div class="loan-info" role="list">
              <div class="loan-row" role="listitem">
                <span class="loan-lbl">Durasi Pinjam</span>
                <span class="loan-val">14 hari</span>
              </div>
              <div class="loan-div"></div>
              <div class="loan-row" role="listitem">
                <span class="loan-lbl">Format</span>
                <span class="loan-val">Fisik</span>
              </div>
              <div class="loan-div"></div>
              <div class="loan-row" role="listitem">
                <span class="loan-lbl">Kategori</span>
                <span class="loan-val">{{ $book->category->name }}</span>
              </div>
            </div>

            @auth
              @if($book->isAvailable())
                <a href="{{ route('user.borrow.create', ['book_id' => $book->id]) }}" class="sidebar-btn-main" style="display:block;text-align:center">
                  Pinjam Sekarang →
                </a>
              @else
                <button class="sidebar-btn-main" disabled>Stok Habis</button>
              @endif

              <form method="POST" action="{{ route('user.books.collect', $book) }}">
                @csrf
                <button type="submit" class="sidebar-btn-ghost {{ $userCollection ? 'active' : '' }}">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                  {{ $userCollection ? 'Hapus dari Koleksi' : 'Simpan ke Koleksi' }}
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="sidebar-btn-main" style="display:block;text-align:center">
                Login untuk Meminjam
              </a>
            @endauth
          </div>
        </div>

        <!-- AUTHOR CARD -->
        <div class="author-card">
          <div class="author-card-head">
            <div class="author-av" aria-hidden="true">{{ strtoupper(substr($book->author, 0, 1)) }}</div>
            <div>
              <div class="author-name">{{ $book->author }}</div>
              <div class="author-label">Penulis</div>
            </div>
          </div>
          <p class="author-bio">Informasi penulis belum tersedia.</p>
        </div>

      </div>
    </aside>
  </div>
</div>

<!-- RELATED BOOKS -->
@if($relatedBooks->count())
<section class="related-section" aria-label="Buku serupa">
  <div class="page">
    <div class="sh">
      <div class="sh-left">
        <span class="sh-badge">Rekomendasi</span>
        <h2 class="sh-title">Buku <em>Serupa</em></h2>
      </div>
      <a href="{{ route('user.books.index', ['category' => $book->category->slug ?? '']) }}" class="sh-link" aria-label="Lihat semua buku serupa">
        Lihat Semua
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
    </div>
    <div class="car-wrap">
      <div class="car-fade-l" aria-hidden="true"></div>
      <div class="car-fade-r" aria-hidden="true"></div>
      <div class="car" id="relatedCar" role="list" aria-label="Buku serupa">
        @php
          $gradients = [
            'linear-gradient(155deg,#1c6b46,#040e08)',
            'linear-gradient(155deg,#1a4a7a,#071525)',
            'linear-gradient(155deg,#8b1a1a,#1a0505)',
            'linear-gradient(155deg,#3d1a6b,#0d0518)',
            'linear-gradient(155deg,#6b3d1c,#1a0e05)',
            'linear-gradient(155deg,#1a6b5a,#051a12)',
          ];
        @endphp
        @foreach($relatedBooks as $i => $rel)
        <a href="{{ route('user.books.show', $rel) }}" class="bk" role="listitem" aria-label="{{ $rel->title }} oleh {{ $rel->author }}">
          <div class="bk-cov" style="background:{{ $gradients[$i % count($gradients)] }}">
            <div class="bk-cov-art">
              <div class="bk-cov-txt">
                <div class="bk-cov-t">{{ Str::limit($rel->title, 30) }}</div>
                <div class="bk-cov-a">{{ $rel->author }}</div>
              </div>
            </div>
          </div>
          <div class="bk-title">{{ Str::limit($rel->title, 35) }}</div>
          <div class="bk-author">{{ $rel->author }}</div>
          <div class="bk-rat">
            <span class="bk-star">★</span>
            <span class="bk-score">{{ number_format($rel->avgRating(), 1) }}</span>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif

<!-- FOOTER -->
<footer>
  <div class="footer-bottom">
    <span class="footer-copy">© {{ date('Y') }} DigiLib · Perpustakaan Digital Indonesia</span>
    <div class="footer-bl">
      <a href="#">Kebijakan Privasi</a>
      <a href="#">Syarat Layanan</a>
    </div>
  </div>
</footer>

<script>
/* NAV HAMBURGER */
const hamburger = document.getElementById('navHamburger');
const mobileMenu = document.getElementById('mobileMenu');
hamburger.addEventListener('click', () => {
  const isOpen = mobileMenu.classList.toggle('open');
  hamburger.classList.toggle('open', isOpen);
  hamburger.setAttribute('aria-expanded', isOpen);
  hamburger.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
});
document.addEventListener('click', e => {
  if (!e.target.closest('#navHamburger') && !e.target.closest('#mobileMenu')) {
    mobileMenu.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    hamburger.setAttribute('aria-label', 'Buka menu');
  }
});

/* TABS */
const tabs = document.querySelectorAll('.tab');
const panels = document.querySelectorAll('.tab-panel');
tabs.forEach((tab, i) => {
  tab.addEventListener('click', () => {
    tabs.forEach(t => { t.classList.remove('active'); t.setAttribute('aria-selected','false'); t.setAttribute('tabindex','-1'); });
    panels.forEach(p => p.classList.remove('active'));
    tab.classList.add('active');
    tab.setAttribute('aria-selected','true');
    tab.setAttribute('tabindex','0');
    panels[i].classList.add('active');
  });
  tab.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') { tabs[(i+1) % tabs.length].click(); tabs[(i+1) % tabs.length].focus(); }
    if (e.key === 'ArrowLeft') { tabs[(i-1+tabs.length) % tabs.length].click(); tabs[(i-1+tabs.length) % tabs.length].focus(); }
  });
});

/* SCROLL REVEAL */
const srObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in');
    srObs.unobserve(e.target);
  });
}, { threshold: 0.08 });
document.querySelectorAll('.sr').forEach(el => srObs.observe(el));

/* CAROUSEL DRAG */
function makeDrag(id) {
  const el = document.getElementById(id);
  if (!el) return;
  let d = false, sx, sl;
  el.addEventListener('mousedown', e => { d = true; sx = e.pageX - el.offsetLeft; sl = el.scrollLeft; el.style.userSelect = 'none'; });
  document.addEventListener('mouseup', () => { d = false; const el2 = document.getElementById(id); if (el2) el2.style.userSelect = ''; });
  document.addEventListener('mousemove', e => { if (!d) return; e.preventDefault(); el.scrollLeft = sl - (e.pageX - el.offsetLeft - sx) * 1.2; });
}
makeDrag('relatedCar');

/* ANIMATE RATING BARS */
const ratingBars = document.querySelectorAll('.rs-bar-fill');
ratingBars.forEach(bar => {
  const target = bar.style.width;
  bar.style.width = '0%';
  setTimeout(() => { bar.style.width = target; }, 100);
});

/* FLASH TOAST */
function showToast(msg) {
  const toast = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = msg;
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 2800);
}
@if(session('success'))
  showToast("{{ session('success') }}");
@elseif(session('info'))
  showToast("{{ session('info') }}");
@endif
</script>
</body>
</html>
