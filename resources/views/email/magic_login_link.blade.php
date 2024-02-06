<x-mail::message>
# Your magic login link

Login to your account by clicking the button below.

<x-mail::button :url="$url">
    Login
</x-mail::button>

This magic link will expire in 30 minutes. If you did not request a login, no further action is required.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
