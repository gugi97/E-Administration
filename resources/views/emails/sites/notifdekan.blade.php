@component('mail::message')
# Persetujuan Surat Keputusan

Ada Permintaan Persetujuan Surat Keputusan Baru

@component('mail::button', ['url' => 'http://127.0.0.1:8000/dekan'])
Klik Disini
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
