@component('mail::message')
    # Welcome to {{ config('app.name') }}!

    Thank you for registering for your new course. We're excited to have you on board!

    {{-- Course Information Card --}}
    @component('mail::panel')
        ## Course Registration Details
        **{{ $courseName }}**
        Status: {{ ucfirst($status) }}

        @if ($requiresProctor)
            🔔 **Action Required:** This course needs a proctor
            {{-- @component('mail::button', ['url' => route('proctor.assign', ['course' => $courseId])])
                Assign Proctor Now
            @endcomponent --}}
        @else
            ✅ No proctor required for this course
        @endif
    @endcomponent

    {{-- Next Steps Section --}}
    @component('mail::panel')
        ## Next Steps
        1. Review your course materials
        2. Mark important dates in your calendar
        @if ($requiresProctor)
            3. Assign a proctor as soon as possible
        @endif
    @endcomponent

    @component('mail::subcopy')
        Need help? Our support team is ready to assist you:
        - Email: support@{{ config('app.url') }}
        {{-- - Visit our [Help Center]({{ route('help-center') }}) --}}
    @endcomponent

    Best regards,
    {{ config('app.name') }} Team
@endcomponent
