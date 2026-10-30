<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Kartu untukmu</title></head>
<body style="margin:0;padding:24px 12px;background:#f7f5ee;color:#252522;font-family:Arial,sans-serif">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center">
        <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="width:100%;max-width:560px">
            <tr><td style="padding:16px 24px 24px;color:#5839a8;font-size:28px;font-weight:bold">kirimin✳</td></tr>
            <tr><td style="background:#fffefa;padding:28px">
                <p style="margin:0 0 12px;font-size:11px;letter-spacing:2px;color:#68675f">ADA KARTU UNTUKMU</p>
                <h1 style="font-size:28px;line-height:1.25;margin:0 0 24px">Sedikit kejutan,<br>dari {{ $senderName }}.</h1>
                <img src="{{ $message->embed(public_path('images/'.config('postcards.'.$picture.'.file'))) }}" alt="{{ config('postcards.'.$picture.'.name') }}" width="335" style="display:block;width:100%;max-width:335px;height:auto;margin:0 auto">
                <p style="color:#5839a8;font-size:12px;font-weight:bold;margin:24px 0 12px">{{ config('postcards.'.$picture.'.name') }}</p>
                <p style="font-family:Georgia,serif;font-size:21px;line-height:1.6;white-space:pre-wrap;overflow-wrap:anywhere;margin:0 0 24px">{{ $note }}</p>
                <p style="border-top:1px solid #dedacf;padding-top:20px;font-size:13px;color:#68675f">Salam dari, <strong style="color:#252522">{{ $senderName }}</strong></p>
            </td></tr>
            <tr><td style="padding:24px;text-align:center;font-size:12px;line-height:1.7;color:#68675f">Satu gambar, satu senyum.<br>Salinan JPG juga terlampir untuk disimpan.</td></tr>
        </table>
    </td></tr></table>
</body>
</html>
