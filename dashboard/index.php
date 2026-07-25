<?php include_once('../_header.php'); ?>

<?php
// Sapaan otomatis berdasarkan jam saat ini
$jam = (int) date('H');
if ($jam >= 4 && $jam < 11) {
    $sapaan = 'Selamat Pagi';
} elseif ($jam >= 11 && $jam < 15) {
    $sapaan = 'Selamat Siang';
} elseif ($jam >= 15 && $jam < 18) {
    $sapaan = 'Selamat Sore';
} else {
    $sapaan = 'Selamat Malam';
}

// Tanggal lengkap berbahasa Indonesia (manual, tidak bergantung setlocale)
$nama_hari  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$nama_bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$tanggal_hari_ini = $nama_hari[(int) date('w')] . ', ' . (int) date('j') . ' ' . $nama_bulan[(int) date('n')] . ' ' . date('Y');
?>

<style>
    .rs-dash, .rs-dash *{ box-sizing:border-box; }
    .rs-dash{
        --ink:#1E2A44;
        --muted:#5B6472;
        --paper:#F5F6F8;
        --line:#E3E6EA;
        font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
        margin-top:6px;
    }

    /* ---------- Hero / sapaan ---------- */
    .rs-hero{
        background:var(--paper);
        border:1px solid var(--line);
        border-radius:10px;
        padding:30px 32px;
        margin-bottom:22px;
    }
    .rs-eyebrow{
        display:inline-block;
        font-size:12px;
        font-weight:700;
        letter-spacing:.08em;
        text-transform:uppercase;
        color:var(--muted);
        margin-bottom:10px;
    }
    .rs-greeting{
        font-family:Georgia,"Iowan Old Style","Palatino Linotype","Book Antiqua",serif;
        font-size:2rem;
        font-weight:600;
        color:var(--ink);
        margin:0 0 10px 0;
        line-height:1.25;
    }
    .rs-dash mark{
        background:rgba(30,42,68,.08);
        color:var(--ink);
        padding:1px 8px;
        border-radius:4px;
        font-weight:700;
    }
    .rs-sub{
        color:var(--muted);
        font-size:15px;
        line-height:1.6;
        max-width:560px;
        margin:0 0 20px 0;
    }
    .rs-toggle-btn{
        display:inline-flex;
        align-items:center;
        gap:8px;
        border-radius:6px;
        border:1px solid var(--line) !important;
        background:#fff;
        color:var(--ink);
        font-weight:600;
        padding:9px 16px;
        transition:background .15s ease, transform .1s ease, border-color .15s ease;
    }
    .rs-toggle-btn:hover, .rs-toggle-btn:focus{
        background:#fff;
        border-color:var(--ink) !important;
        color:var(--ink);
    }
    .rs-toggle-btn:active{ transform:translateY(1px); }
    .rs-toggle-btn:focus-visible{ outline:2px solid var(--ink); outline-offset:2px; }
    .rs-toggle-icon{ font-size:15px; opacity:.75; line-height:1; }

    /* ---------- Kartu pintasan (bertema map arsip rekam medis) ---------- */
    .rs-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(210px, 1fr));
        gap:16px;
    }
    .rs-card{
        position:relative;
        display:flex;
        align-items:flex-start;
        gap:14px;
        background:#fff;
        border:1px solid var(--line);
        border-radius:8px;
        padding:18px 18px 18px 22px;
        text-decoration:none;
        overflow:hidden;
        transition:transform .15s ease, box-shadow .15s ease, border-color .15s ease;
    }
    .rs-card::before{
        content:"";
        position:absolute;
        left:0; top:0; bottom:0;
        width:4px;
        background:var(--tab);
    }
    .rs-card:hover{
        transform:translateY(-2px);
        box-shadow:0 8px 18px rgba(20,30,50,.08);
        border-color:var(--tab);
        text-decoration:none;
    }
    .rs-card:focus-visible{ outline:2px solid var(--tab); outline-offset:2px; }
    .rs-card-icon{
        flex:0 0 auto;
        width:38px; height:38px;
        border-radius:8px;
        display:flex; align-items:center; justify-content:center;
        background:var(--tint);
        color:var(--tab);
    }
    .rs-card-icon svg{ width:20px; height:20px; }
    .rs-card-text strong{
        display:block;
        color:var(--ink);
        font-size:15px;
        margin-bottom:3px;
    }
    .rs-card-text small{
        display:block;
        color:var(--muted);
        font-size:12.5px;
        line-height:1.4;
    }

    .rs-card--pasien{ --tab:#2F8F8B; --tint:#E4F3F2; }
    .rs-card--dokter{ --tab:#4C5FD5; --tint:#E7E9FB; }
    .rs-card--poli{ --tab:#C97F2A; --tint:#FBF0E2; }
    .rs-card--obat{ --tab:#3E8E5A; --tint:#E5F4EA; }
    .rs-card--rekam{ --tab:#8B3A42; --tint:#F5E7E9; }

    @media (max-width:576px){
        .rs-hero{ padding:22px 20px; }
        .rs-greeting{ font-size:1.5rem; }
    }
    @media (prefers-reduced-motion:reduce){
        .rs-card, .rs-toggle-btn{ transition:none; }
    }
</style>

<div class="row">
    <div class="col-lg-12">

        <div class="rs-dash">

            <div class="rs-hero">
                <span class="rs-eyebrow">Dashboard &middot; <?= $tanggal_hari_ini; ?></span>
                <h1 class="rs-greeting"><?= $sapaan; ?>, <mark><?= $_SESSION['user']; ?></mark></h1>
                <p class="rs-sub">Semua data pasien, dokter, dan rekam medis ada dalam satu tempat. Gunakan menu di samping atau pintasan di bawah untuk mulai bekerja.</p>

                <a href="#menu-toggle" class="btn btn-default rs-toggle-btn" id="menu-toggle">
                    <span class="rs-toggle-icon">&#9776;</span> Toggle Menu
                </a>
            </div>

            <div class="rs-grid">

                <a href="../pasien/data.php" class="rs-card rs-card--pasien">
                    <span class="rs-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="3.4"/>
                            <path d="M5 20c0-3.9 3.1-6 7-6s7 2.1 7 6"/>
                        </svg>
                    </span>
                    <span class="rs-card-text">
                        <strong>Data Pasien</strong>
                        <small>Lihat dan kelola data pasien</small>
                    </span>
                </a>

                <a href="../dokter/data.php" class="rs-card rs-card--dokter">
                    <span class="rs-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 3v5a3 3 0 0 0 6 0V3"/>
                            <path d="M9 11v2a5 5 0 0 0 10 0v-1.5"/>
                            <circle cx="19" cy="9.5" r="1.6"/>
                        </svg>
                    </span>
                    <span class="rs-card-text">
                        <strong>Data Dokter</strong>
                        <small>Kelola jadwal dan profil dokter</small>
                    </span>
                </a>

                <a href="../poliklinik/data.php" class="rs-card rs-card--poli">
                    <span class="rs-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 21V9l8-5 8 5v12"/>
                            <path d="M9 21v-6h6v6"/>
                            <path d="M12 9v4M10 11h4"/>
                        </svg>
                    </span>
                    <span class="rs-card-text">
                        <strong>Data Poliklinik</strong>
                        <small>Atur daftar poliklinik rumah sakit</small>
                    </span>
                </a>

                <a href="../obat/data.php" class="rs-card rs-card--obat">
                    <span class="rs-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="9" width="18" height="6" rx="3" transform="rotate(-30 12 12)"/>
                            <path d="M12 8.5l3 7" transform="rotate(-30 12 12)"/>
                        </svg>
                    </span>
                    <span class="rs-card-text">
                        <strong>Data Obat</strong>
                        <small>Pantau stok dan data obat</small>
                    </span>
                </a>

                <a href="../rekam_medis/data.php" class="rs-card rs-card--rekam">
                    <span class="rs-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 7a1 1 0 0 1 1-1h5l2 2h9a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7z"/>
                            <path d="M8 13h8M8 16h5"/>
                        </svg>
                    </span>
                    <span class="rs-card-text">
                        <strong>Rekam Medis</strong>
                        <small>Buka riwayat rekam medis pasien</small>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>