<x-mail::message>
    Dear {{ $user }},

    We are writing to inform you that there has been a change in your proctor status for the course
    {{ $courseName }}. Below are the updated details:

    ## Course Details
    • Course Name: {{ $courseName }}
    • Proctor Status: {{ ucfirst($status) }}
    • Proctor Required: {{ $requiresProctor ? 'Yes' : 'No' }}

    @if ($requiresProctor && $status == 'pending')
        <strong>Important:</strong> Please assign a proctor for this course at your earliest convenience.
    @elseif ($status == 'approved')
        Your assigned proctor has been approved. No further action is needed at this time.
    @elseif ($status == 'rejected')
        Unfortunately, your assigned proctor was not approved. Please assign a different proctor by logging into your
        student portal.
    @endif

    To review these changes and manage your proctor status, please log in to your
    {{-- [student portal](https://studentportal.uopeople.edu). --}}

    If you have any questions, you may contact Student Services at
    {{-- [student.services@uopeople.edu](mailto:student.services@uopeople.edu). --}}

    Best Regards,
    Student Services
    Nova Horizon University

</x-mail::message>
