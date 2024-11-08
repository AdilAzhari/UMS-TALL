<x-mail::message>
    # Course Registration Confirmation

    Dear {{ $user }},

    Thank you for registering for {{ $courseName }}**. We're excited to have you join us!

    {{-- <x-mail::panel> --}}
    <strong>Course Details</strong>
    • Course Name: {{ $courseName }}
    • Proctor Status: {{ ucfirst($status) }}
    • Proctor Required: {{ $requiresProctor ? 'Yes' : 'No' }}

    @if ($requiresProctor)
        <strong>Important:</strong> Please assign a proctor for this course as soon as possible.
    @endif
    {{-- </x-mail::panel> --}}

    @if ($requiresProctor)
        {{-- <x-mail::button :url="route('proctor.assign', ['course' => $courseId])">
        Assign Proctor
    </x-mail::button> --}}
    @endif

    <x-mail::subcopy>
        If you have any questions, our support team is here to help at:
        support@{{ config('app.url') }}
    </x-mail::subcopy>

    Thanks,<br>
    {{ config('app.name') }} Team
</x-mail::message>
