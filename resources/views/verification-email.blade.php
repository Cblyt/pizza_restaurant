@component('mail::message')
Thank you for registering with the pizza restaurant who serves the best pizzas in town!

@component('mail::button', ['url' => 'http://localhost:8000/verify?email='.$email.'&hash='.$hash])
Verify your email
@endcomponent

Thanks,<br>
Pizza Restaruant
@endcomponent
