<?php

namespace App\Http\Controllers;

use App\Mail\PictureMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Throwable;

class PictureEmailController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'not_regex:/[\r\n]/'],
            'email' => ['required', 'string', 'email', 'max:254'],
            'note' => ['required', 'string', 'max:1000'],
            'picture' => ['required', 'string', Rule::in(array_keys(config('postcards')))],
        ], [
            'required' => ':attribute wajib diisi.',
            'email' => 'Masukkan alamat email yang valid.',
            'max' => ':attribute maksimal :max karakter.',
            'in' => 'Pilih salah satu dari tiga gambar yang tersedia.',
            'not_regex' => 'Nama harus ditulis dalam satu baris.',
        ], ['name' => 'Nama pengirim', 'email' => 'Email tujuan', 'note' => 'Pesan', 'picture' => 'Gambar']);

        if (in_array(config('mail.default'), ['log', 'array'], true)) {
            return back()->withInput()->withErrors(['email' => 'Pengiriman email belum dikonfigurasi. Silakan coba lagi nanti.']);
        }

        try {
            Mail::to($data['email'])->send(new PictureMail($data['name'], $data['note'], $data['picture']));
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->withErrors(['email' => 'Kartu belum berhasil dikirim. Periksa alamat email atau coba lagi nanti.']);
        }

        return redirect()->route('home')->with('picture_status', 'Kartu berhasil dikirim ke '.$data['email'].'. Periksa kotak masuk atau folder spam.');
    }
}
