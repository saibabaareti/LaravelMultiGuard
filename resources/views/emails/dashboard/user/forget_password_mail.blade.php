




@component('mail::message')
Hello {{ $user_name }}
@component('mail::button', ['url' => $reset_code])
Click here to reset your password
@endcomponent
<p>Or copy & paste the following link to your Secure Browser</p>
<p><a href="{{ route('user.getResetPassword',$reset_code) }}">
{{ route('user.getResetPassword',$reset_code) }}
</a></p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
