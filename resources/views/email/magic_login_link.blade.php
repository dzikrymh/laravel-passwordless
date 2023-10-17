<x-mail::message>
# Your magic login link

Login to your account by clicking the button below.

<x-mail::button :url="$url">
    Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>