<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pilih karakter favorit, tulis pesan pribadi, dan kirim kartu gambar langsung ke email.">
    <title>Kirimin | Satu gambar, satu senyum.</title>
    <link rel="stylesheet" href="{{ asset('postcards.css') }}">
    <script src="{{ asset('postcards.js') }}" defer></script>
</head>
<body>
    <header class="site-header">
        <a href="{{ route('home') }}" class="wordmark" aria-label="Kirimin, beranda">kirimin<span>✳</span></a>
        <span class="header-note">Kartu kecil. Cerita besar.</span>
        <a class="header-link" href="#kirim">Buat kartu <span aria-hidden="true">↗</span></a>
    </header>
    <main>
        <section class="intro">
            <div>
                <p class="eyebrow">DARI KAMU, UNTUK SIAPA PUN.</p>
                <h1>Kirim sedikit<br><em>keanehan.</em></h1>
            </div>
            <div class="intro-copy">
                <span class="intro-mark" aria-hidden="true">✳</span>
                <p>Karakter unik, pesan personal.<br>Satu kartu kecil untuk bikin hari<br>seseorang lebih seru.</p>
            </div>
        </section>

        @if (session('picture_status'))
            <div class="notice success" role="status">{{ session('picture_status') }}</div>
        @endif
        @if ($errors->any())
            <div class="notice error" role="alert"><strong>Kartu belum terkirim.</strong> Periksa isian yang ditandai di bawah.</div>
        @endif

        <form id="postcard-form" action="{{ route('picture.send') }}" method="POST">
            @csrf
            <fieldset class="gallery">
                <legend><span class="step">01</span> Pilih teman kirimmu <span class="legend-note">Satu kartu, satu karakter.</span></legend>
                <div class="picture-grid">
                    @foreach ($pictures as $key => $picture)
                        <label class="picture-option">
                            <input type="radio" name="picture" value="{{ $key }}" required @checked(old('picture', 'night') === $key) data-image="{{ asset('images/'.$picture['file']) }}" data-title="{{ $picture['name'] }}" aria-describedby="picture-error">
                            <span class="picture-card">
                                <span class="picture-art art-{{ $key }}">
                                    <img src="{{ asset('images/'.$picture['file']) }}" alt="{{ $picture['name'] }}" width="{{ $key === 'night' ? 335 : ($key === 'forest' ? 337 : 225) }}" height="{{ $key === 'night' ? 597 : ($key === 'forest' ? 449 : 225) }}">
                                    <span class="selection-mark" aria-hidden="true">✓</span>
                                    <span class="picture-index">0{{ $loop->iteration }} / KOLEKSI</span>
                                </span>
                                <span class="picture-description"><strong>{{ $picture['name'] }}</strong><span>{{ $picture['caption'] }}</span></span>
                            </span>
                        </label>
                    @endforeach
                </div>
                <p class="field-error" id="picture-error">@error('picture'){{ $message }}@enderror</p>
            </fieldset>

            <section class="compose" id="kirim">
                <div class="form-panel">
                    <h2><span class="step">02</span> Bikin lebih personal.</h2>
                    <p class="section-copy">Isi detailnya. Biar kartunya terasa benar-benar dari kamu.</p>
                    <div class="field-row">
                        <div class="field">
                            <label for="name">Nama pengirim <span>*</span></label>
                            <input id="name" name="name" autocomplete="name" maxlength="80" required placeholder="Nama kamu" value="{{ old('name') }}" aria-describedby="name-error" @if($errors->has('name')) aria-invalid="true" @endif>
                            <p id="name-error" class="field-error">@error('name'){{ $message }}@enderror</p>
                        </div>
                        <div class="field">
                            <label for="email">Email tujuan <span>*</span></label>
                            <input id="email" name="email" type="email" autocomplete="email" maxlength="254" required placeholder="teman@email.com" value="{{ old('email') }}" aria-describedby="email-error" @if($errors->has('email')) aria-invalid="true" @endif>
                            <p id="email-error" class="field-error">@error('email'){{ $message }}@enderror</p>
                        </div>
                    </div>
                    <div class="field">
                        <label for="note">Pesanmu <span>*</span></label>
                        <textarea id="note" name="note" rows="4" maxlength="1000" required placeholder="Lihat gambar ini, langsung ingat kamu. Semoga harimu seru!" aria-describedby="note-error note-count" @if($errors->has('note')) aria-invalid="true" @endif>{{ old('note') }}</textarea>
                        <div class="field-bottom"><p id="note-error" class="field-error">@error('note'){{ $message }}@enderror</p><span id="note-count">0 / 1000</span></div>
                    </div>
                    <button type="submit" id="send-button"><span>Kirim kartu sekarang</span><span aria-hidden="true">↗</span></button>
                    <p class="send-note">Gambar tampil di dalam email, lengkap dengan salinan JPG.<br>Pastikan penerima bersedia menerima pesanmu.</p>
                    <p id="sending-status" role="status"></p>
                </div>
                <aside class="preview-panel" aria-label="Pratinjau kartu">
                    <div class="preview-heading"><span>PRATINJAU KARTUMU</span><span aria-hidden="true">↙</span></div>
                    <div class="postcard">
                        <div class="postcard-top"><span>kirimin✳</span><span class="stamp">UNTUK<br>KAMU</span></div>
                        <img id="preview-image" src="{{ asset('images/night.jpg') }}" alt="Si Penjaga Malam" width="335" height="597">
                        <div class="postcard-body">
                            <p class="card-kicker" id="preview-title">Si Penjaga Malam</p>
                            <p id="preview-note">Sedikit kejutan untuk bikin harimu lebih seru.</p>
                            <p class="signature">Salam dari, <strong id="preview-name">kamu</strong></p>
                        </div>
                    </div>
                    <p class="preview-caption">Sebuah pesan sederhana bisa jadi kejutan favoritnya.</p>
                </aside>
            </section>
        </form>
    </main>
    <footer><a href="{{ route('home') }}" class="wordmark">kirimin<span>✳</span></a><p>Satu gambar, satu senyum.</p><span>Dibuat untuk dibagikan.</span></footer>
</body>
</html>
