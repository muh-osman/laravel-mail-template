<x-mail::message>
# Introduction

The body of your message.

{{ $name }}

{{ $email }}

<x-mail::button :url="'https://www.google.com/'">
Button
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
