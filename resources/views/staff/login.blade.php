<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Terminal Access - Futsal Mare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=JetBrains+Mono:wght@400;500;700&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --display: 'Anton', sans-serif;
            --body: 'Work Sans', sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }
        body { font-family: var(--body); }
        .f-display { font-family: var(--display); }
        .f-mono { font-family: var(--mono); }

        @keyframes scanline {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(1000%); }
        }
        .scanline-effect::after {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.4), transparent);
            animation: scanline 4s linear infinite;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#070B0E] font-sans antialiased text-slate-200 flex min-h-screen items-center justify-center p-4 relative overflow-hidden">

    <!-- DYNAMIC GRID BACKGROUND & GLOW ACCENTS -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.05] bg-[radial-gradient(#38bdf8_1px,transparent_1px)] bg-[size:28px_28px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-sky-600/10 rounded-full filter blur-[140px] pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-[400px] h-[400px] bg-sky-500/10 rounded-full filter blur-[160px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-[400px] h-[400px] bg-amber-500/10 rounded-full filter blur-[160px] pointer-events-none"></div>

    <main class="w-full max-w-md relative z-10 space-y-6">

        <!-- BRANDING & BADGE HEADER -->
        <div class="flex flex-col items-center text-center space-y-3">
            <div class="inline-flex items-center space-x-3 bg-[#0D151D]/90 border border-slate-800/80 px-4 py-2.5 rounded-2xl backdrop-blur-xl shadow-2xl shadow-sky-950/20">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="f-display text-xl uppercase tracking-wider text-white">FUTSAL<span class="text-sky-400 ml-1">MARE</span></span>
                <span class="text-slate-600 font-light">|</span>
                <span class="f-mono text-[11px] font-bold text-sky-400 tracking-[0.15em] uppercase">GATE TERMINAL</span>
            </div>
            <div>
                <h1 class="text-xl font-extrabold uppercase text-white tracking-wide">Otorisasi Petugas Scanner</h1>
                <p class="text-xs text-slate-400 mt-1">Autentikasi operasional untuk mengaktifkan sistem validasi tiket</p>
            </div>
        </div>

        <!-- MAIN CARD LOGIN -->
        <div class="bg-[#0F1721]/90 backdrop-blur-2xl p-8 rounded-3xl border border-slate-800/80 shadow-[0_20px_50px_rgba(0,0,0,0.7)] relative overflow-hidden space-y-6 scanline-effect">

            <!-- CYAN BORDER TOP HIGHLIGHT -->
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-sky-400 to-transparent"></div>

            <!-- ERROR NOTIFICATION BANNER -->
            @if ($errors->any())
                <div class="p-4 bg-red-950/40 border border-red-500/30 text-red-300 rounded-2xl text-xs font-medium space-y-1.5 shadow-lg backdrop-blur-md">
                    <div class="f-mono text-[10px] uppercase font-bold text-red-400 tracking-wider flex items-center gap-2">
                        <span class="text-sm">⚠️</span> Kredensial Akses Ditolak:
                    </div>
                    <ul class="list-disc list-inside space-y-1 opacity-90 pl-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- LOGIN FORM -->
            <form action="{{ route('staff.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label class="block f-mono text-[10px] font-bold uppercase text-slate-400 tracking-wider">ID Staff / Email Operasional</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-sky-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="staff@futsalmare.com" class="w-full bg-[#070B0E] border border-slate-800/80 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 rounded-xl pl-10 pr-4 py-3.5 text-sm font-semibold text-white placeholder-slate-600 transition-all duration-200 outline-none shadow-inner">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block f-mono text-[10px] font-bold uppercase text-slate-400 tracking-wider">PIN / Kata Sandi Terminal</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-sky-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-[#070B0E] border border-slate-800/80 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 rounded-xl pl-10 pr-4 py-3.5 text-sm font-bold text-white placeholder-slate-600 tracking-widest transition-all duration-200 outline-none shadow-inner">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center cursor-pointer select-none group">
                        <input type="checkbox" name="remember" class="rounded bg-[#070B0E] border-slate-800 text-sky-500 focus:ring-0 cursor-pointer w-4 h-4 transition">
                        <span class="text-xs font-medium text-slate-400 group-hover:text-slate-300 transition ml-2">Tetap Aktif di Sesi Ini</span>
                    </label>
                </div>

                <div class="pt-3">
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-sky-600 to-sky-500 hover:from-sky-500 hover:to-sky-400 text-white font-black text-xs rounded-xl uppercase tracking-[0.2em] shadow-lg shadow-sky-950/50 hover:shadow-sky-500/25 transform hover:-translate-y-0.5 transition active:translate-y-0 duration-200 flex items-center justify-center gap-2.5">
                        <span class="text-sm">📲</span> Buka Terminal Scanner
                    </button>
                </div>
            </form>
        </div>

        <!-- NAVIGATION FOOTER -->
        <div class="text-center">
            <a href="{{ route('landingPage') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-300 uppercase tracking-wider transition-all duration-200 group">
                <span class="transform group-hover:-translate-x-1 transition">&larr;</span> Kembali Ke Beranda Utama
            </a>
        </div>
    </main>

</body>
</html>