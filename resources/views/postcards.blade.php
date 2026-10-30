<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kirim kartu gambar dan pesan pribadi melalui email.">
    <title>Kirimin | Form Pengiriman Gambar</title>
    <link rel="stylesheet" href="{{ asset('postcards.css') }}">
    <script src="{{ asset('postcards.js') }}" defer></script>
</head>
<body>
    <main class="form-card">
        <header class="card-header">
            <h1>Kirimin</h1>
            <p>Form Pengiriman Gambar</p>
        </header>
        <form id="postcard-form" action="{{ route('picture.send') }}" method="POST">
            @csrf
            @if (session('picture_status'))
                <div class="notice success" role="status">{{ session('picture_status') }}</div>
            @endif
            @if ($errors->any())
                <div class="notice error" role="alert">Kartu belum terkirim. Periksa isian yang ditandai di bawah.</div>
            @endif
            <div class="field">
                <label for="name">Nama Pengirim</label>
                <input id="name" name="name" autocomplete="name" maxlength="80" required placeholder="Masukkan nama lengkap kamu" value="{{ old('name') }}" aria-describedby="name-error" @if($errors->has('name')) aria-invalid="true" @endif>
                <p id="name-error" class="field-error">@error('name'){{ $message }}@enderror</p>
            </div>
            <div class="field">
                <label for="email">Email Tujuan</label>
                <input id="email" name="email" type="email" autocomplete="email" maxlength="254" required placeholder="Masukkan email penerima" value="{{ old('email') }}" aria-describedby="email-error" @if($errors->has('email')) aria-invalid="true" @endif>
                <p id="email-error" class="field-error">@error('email'){{ $message }}@enderror</p>
            </div>
            <div class="field">
                <label for="note">Pesan</label>
                <textarea id="note" name="note" rows="3" maxlength="1000" required placeholder="Tulis pesan untuk penerima" aria-describedby="note-error note-count" @if($errors->has('note')) aria-invalid="true" @endif>{{ old('note') }}</textarea>
                <div class="field-bottom">
                    <p id="note-error" class="field-error">@error('note'){{ $message }}@enderror</p>
                    <span id="note-count">0 / 1000</span>
                </div>
            </div>
            <fieldset>
                <legend>Pilih Gambar</legend>
                <div class="picture-grid">
                    @foreach ($pictures as $key => $picture)
                        <label class="picture-option">
                            <input type="radio" name="picture" value="{{ $key }}" required @checked(old('picture', 'night') === $key) data-image="{{ asset('images/'.$picture['file']) }}" data-title="{{ $picture['name'] }}" aria-describedby="picture-error">
                            <span class="picture-card">
                                <img src="{{ asset('images/'.$picture['file']) }}" alt="" width="{{ $key === 'night' ? 335 : ($key === 'forest' ? 337 : 225) }}" height="{{ $key === 'night' ? 597 : ($key === 'forest' ? 449 : 225) }}">
                                <span>{{ $picture['name'] }}</span>
                                <span class="selection-mark" aria-hidden="true">✓</span>
                            </span>
                        </label>
                    @endforeach
                </div>
                <p class="field-error" id="picture-error">@error('picture'){{ $message }}@enderror</p>
            </fieldset>
            <details class="preview">
                <summary>Lihat pratinjau kartu</summary>
                <div class="postcard">
                    <img id="preview-image" src="{{ asset('images/night.jpg') }}" alt="Si Penjaga Malam" width="335" height="597">
                    <p id="preview-title">Si Penjaga Malam</p>
                    <p id="preview-note">Sedikit kejutan untuk bikin harimu lebih seru.</p>
                    <p class="signature">Salam dari, <strong id="preview-name">kamu</strong></p>
                </div>
            </details>
            <button type="submit" id="send-button"><span>Kirim kartu sekarang</span></button>
            <p id="sending-status" role="status"></p>
            <p class="send-note">Gambar dan pesan akan dikirim ke email tujuan.<br>Salinan JPG ikut terlampir.</p>
        </form>
    </main>
</body>
</html>
