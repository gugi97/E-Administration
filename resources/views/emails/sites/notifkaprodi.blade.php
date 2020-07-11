@component('mail::message')
# Verifikasi Surat Keputusan

Ada Permintaan Verifikasi Surat Keputusan Baru

@component('mail::button', ['url' => 'http://127.0.0.1:8000/kaprodi'])
Verifikasi
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
