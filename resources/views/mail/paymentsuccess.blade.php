@component('mail::message')
Hello {{$name}},
Thank you for booking storage in Gudangpedia!

Total Price : {{$total_price}} <br>
Total Unit : {{$total_unit}} <br>
Unit Size : {{$size}} <br>
Type : {{$type}} <br>
Storage Name : {{$storage_name}} <br>
Storage Address : {{$storage_address}} <br>


Sincerely,
Gudangpedia team.
@endcomponent