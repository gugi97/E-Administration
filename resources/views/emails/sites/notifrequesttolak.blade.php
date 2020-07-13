@component('mail::message')
# Pemberitahuan Request Surat Keluar

Request Pembuatan Surat Keluar Ditolak.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/dosenrequest'])
Klik Disini
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
