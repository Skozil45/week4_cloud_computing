<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>Kartu untukmu dari {{ $senderName }}</title>
    <style>
        @media only screen and (max-width: 480px) {
            .outer-padding { padding: 20px 10px !important; }
            .card-padding { padding-left: 24px !important; padding-right: 24px !important; }
            .card-title { font-size: 36px !important; line-height: 40px !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#f2efe8;color:#29262e;font-family:Arial,Helvetica,sans-serif;-webkit-text-size-adjust:100%">
    <div style="display:none;font-size:1px;line-height:1px;color:#f2efe8;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all">{{ $senderName }} mengirim {{ config('postcards.'.$picture.'.name') }} dan sebuah pesan khusus untukmu.</div>
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f2efe8">
        <tr><td class="outer-padding" align="center" style="padding:40px 16px">
            <!--[if mso]><table role="presentation" width="560" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:560px">
                <tr><td style="padding:0 4px 22px">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
                        <td style="font-size:27px;font-weight:bold;letter-spacing:-1.5px;color:#5839a8">kirimin<span style="font-weight:normal">&#10035;</span></td>
                        <td align="right" style="font-size:11px;color:#6c6573">Satu gambar, satu senyum.</td>
                    </tr></table>
                </td></tr>
                <tr><td style="height:6px;line-height:6px;font-size:0;background-color:#5839a8;border-radius:12px 12px 0 0">&nbsp;</td></tr>
                <tr><td class="card-padding" bgcolor="#fffdf8" style="padding:34px 40px 28px">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
                        <td style="font-size:10px;font-weight:bold;letter-spacing:1.6px;color:#766b83">SEBUAH KARTU UNTUKMU</td>
                        <td align="right"><span style="display:inline-block;border:1px dashed #a99ab9;padding:9px 11px;color:#5839a8;font-size:9px;line-height:14px;letter-spacing:1px;text-align:center">DARI HATI<br>KE INBOX</span></td>
                    </tr></table>
                    <h1 class="card-title" style="font-family:Georgia,'Times New Roman',serif;font-size:44px;line-height:48px;font-weight:normal;letter-spacing:-1.5px;margin:22px 0 14px">Hal kecil.<br><span style="color:#5839a8">Senyum besar.</span></h1>
                    <p style="font-size:14px;line-height:23px;margin:0;color:#6c6573;word-wrap:break-word;overflow-wrap:anywhere"><strong style="color:#29262e">{{ $senderName }}</strong> memilihkan karakter ini dan menitipkan pesan untukmu.</p>
                </td></tr>
                <tr><td class="card-padding" bgcolor="#fffdf8" style="padding:0 40px">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ede8df" style="border:1px solid #e3ddd2">
                        <tr><td align="center" style="padding:20px 12px 16px">
                            <img src="{{ $message->embed(public_path('images/'.config('postcards.'.$picture.'.file'))) }}" alt="{{ config('postcards.'.$picture.'.name') }}" width="335" border="0" style="display:block;width:100%;max-width:335px;height:auto;color:#29262e;font-size:14px">
                        </td></tr>
                        <tr><td align="center" style="padding:0 16px 20px;font-size:12px;line-height:20px;font-weight:bold;color:#514759">{{ config('postcards.'.$picture.'.name') }}</td></tr>
                    </table>
                </td></tr>
                <tr><td class="card-padding" bgcolor="#fffdf8" style="padding:30px 40px 34px">
                    <p style="margin:0 0 13px;font-size:10px;letter-spacing:1.5px;font-weight:bold;color:#766b83">PESAN KHUSUS BUATMU</p>
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr><td style="border-left:3px solid #9274c6;padding:2px 0 2px 18px;font-family:Georgia,'Times New Roman',serif;font-size:21px;line-height:32px;color:#29262e;word-break:break-word;overflow-wrap:anywhere">{!! nl2br(e($note)) !!}</td></tr>
                    </table>
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:28px;border-top:1px solid #e5ded3">
                        <tr><td style="padding-top:22px;font-size:12px;line-height:22px;color:#6c6573">Salam dari,<br><strong style="font-size:16px;color:#5839a8;word-break:break-word">{{ $senderName }}</strong></td>
                        <td align="right" valign="bottom" style="padding-top:22px;color:#5839a8;font-size:28px">&#10035;</td></tr>
                    </table>
                </td></tr>
                <tr><td align="center" bgcolor="#eae3f3" style="padding:17px 24px;border-radius:0 0 12px 12px;color:#5e4c76;font-size:12px;line-height:19px">Suka gambarnya? Salinan JPG sudah terlampir untuk disimpan.</td></tr>
                <tr><td align="center" style="padding:24px 24px 0;font-size:11px;line-height:18px;color:#766f79">Dikirim melalui Kirimin.<br>Sedikit keanehan, sedikit perhatian.</td></tr>
            </table>
            <!--[if mso]></td></tr></table><![endif]-->
        </td></tr>
    </table>
</body>
</html>
