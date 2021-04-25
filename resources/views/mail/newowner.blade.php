@component('mail::message')
Hello {{$name}},
Thank you for register as an owner Gudangpedia!

This is your password {{$password}}
Click below to reset your password right now before you login the app
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,
Gudangpedia team.
@endcomponent