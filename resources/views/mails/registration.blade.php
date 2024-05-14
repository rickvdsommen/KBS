<x-mail::message>
# Hallo,
Via de knop hieronder kun je je registreren met de mail waarop je deze mail hebt ontvangen.
<x-mail::button :url="$url" color="success">
Registreren
</x-mail::button>
Thanks,
Team {{ config('app.name') }}
</x-mail::message>
