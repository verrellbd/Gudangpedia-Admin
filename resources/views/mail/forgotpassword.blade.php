@component('mail::message')
Hello {{$name}},
Thank you for choosing Gudangpedia!

Click below to reset your password right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,
Gudangpedia team.
@endcomponent