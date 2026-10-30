<?php

use App\Mail\PictureMail;
use Illuminate\Support\Facades\Mail;

function postcardData(array $overrides = []): array
{
    return array_replace([
        'name' => 'Dina',
        'email' => 'friend@example.com',
        'note' => "Semoga harimu seru!\nSalam dari kampus.",
        'picture' => 'night',
    ], $overrides);
}

test('each selected picture is sent with the entered name and message', function ($picture) {
    config(['mail.default' => 'smtp']);
    Mail::fake();
    $this->from('/')->post(route('picture.send'), postcardData(['picture' => $picture]))
        ->assertRedirect('/')->assertSessionHasNoErrors()
        ->assertSessionHas('picture_status', 'Kartu berhasil dikirim ke friend@example.com. Periksa kotak masuk atau folder spam.');
    Mail::assertSent(PictureMail::class, fn ($mail) => $mail->hasTo('friend@example.com')
        && $mail->senderName === 'Dina'
        && $mail->note === "Semoga harimu seru!\nSalam dari kampus."
        && $mail->picture === $picture);
    Mail::assertSentCount(1);
})->with(['night', 'forest', 'shark']);

test('invalid input cannot send mail', function ($field, $value) {
    Mail::fake();
    $this->from('/')->post(route('picture.send'), postcardData([$field => $value]))
        ->assertRedirect('/')->assertSessionHasErrors($field)->assertSessionMissing('picture_status');
    Mail::assertNothingSent();
})->with([
    ['name', ''], ['name', str_repeat('a', 81)], ['name', "Dina\nBcc: other@example.com"],
    ['email', ''], ['email', 'not-an-email'], ['email', str_repeat('a', 255).'@example.com'],
    ['note', ''], ['note', str_repeat('a', 1001)],
    ['picture', ''], ['picture', '../../.env'],
]);

test('missing mail configuration preserves the input and shows an error', function () {
    config(['mail.default' => 'log']);
    Mail::fake();
    $this->from('/')->post(route('picture.send'), postcardData())
        ->assertSessionHasErrors('email')->assertSessionMissing('picture_status')
        ->assertSessionHasInput('note', postcardData()['note']);
    Mail::assertNothingSent();
});

test('smtp failure shows a safe message and preserves the selection', function () {
    config(['mail.default' => 'smtp']);
    Mail::shouldReceive('to')->once()->with('friend@example.com')->andReturnSelf();
    Mail::shouldReceive('send')->once()->andThrow(new RuntimeException('Private SMTP details'));
    $this->from('/')->post(route('picture.send'), postcardData(['picture' => 'forest']))
        ->assertSessionHasErrors(['email' => 'Kartu belum berhasil dikirim. Periksa alamat email atau coba lagi nanti.'])
        ->assertSessionHasInput('picture', 'forest')->assertSessionMissing('picture_status');
});

test('more than three submissions per minute are blocked', function () {
    config(['mail.default' => 'smtp']);
    Mail::fake();
    for ($attempt = 0; $attempt < 3; $attempt++) {
        $this->post(route('picture.send'), postcardData())->assertRedirect();
    }
    $this->post(route('picture.send'), postcardData())->assertStatus(429);
    Mail::assertSentCount(3);
});

test('each email embeds the selected image and escapes user content', function ($picture) {
    $sent = Mail::mailer('array')->to('friend@example.com')->send(
        new PictureMail('Dina <b>Test</b>', "<script>alert(1)</script>\nBaris kedua", $picture),
    );
    $message = $sent->getOriginalMessage();
    $inline = array_values(array_filter($message->getAttachments(), fn ($part) => $part->getDisposition() === 'inline'));
    expect($inline)->toHaveCount(1);
    expect($message->getHtmlBody())
        ->toContain('cid:'.$inline[0]->getContentId())
        ->toContain('Dina &lt;b&gt;Test&lt;/b&gt;')
        ->toContain('&lt;script&gt;alert(1)&lt;/script&gt;')
        ->toContain("<br />\nBaris kedua")
        ->not->toContain('<script>');
    expect($inline[0]->getBody())->toBe(file_get_contents(public_path('images/'.config('postcards.'.$picture.'.file'))));
    expect($message->getAttachments())->toHaveCount(2);
    expect($message->getTextBody())->toContain(config('postcards.'.$picture.'.name'));
})->with(['night', 'forest', 'shark']);
