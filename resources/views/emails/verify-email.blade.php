@component('mail::message')
# Verify Email

Welcome to Mailroom.  Only one more step left.

@component('mail::button', ['url' => url('verify') . '?token=' . $user->verify_token])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
