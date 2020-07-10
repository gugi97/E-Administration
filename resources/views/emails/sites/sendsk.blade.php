@component('mail::message')
# Surat Keputusan Dosen

Berikut adalah file Surat Keputusan Dosen :

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
