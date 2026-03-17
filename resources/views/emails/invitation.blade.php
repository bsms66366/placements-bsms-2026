@component('mail::message')
# Invitation

Let's join with us **{{$name}}**,  {{-- break line --}}
{{$email_content}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
