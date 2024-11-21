<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <div>
        <h1>Payment Form</h1>

        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div style="color: red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div>
                <label for="student_name">Student Name:</label>
                <input type="text" id="student_name" name="student_name" required>
            </div>

            <div>
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>

            <div>
                <label for="amount">Amount (USD):</label>
                <input type="number" id="amount" name="amount" step="0.01" required>
            </div>

            <div id="card-element"></div>
            <input type="hidden" name="payment_method_id" id="payment-method-id">

            <button type="submit" id="submit-button">Submit Payment</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const stripe = Stripe("{{ config('services.stripe.key') }}");
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const form = document.getElementById('payment-form');
            const paymentMethodInput = document.getElementById('payment-method-id');

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const {
                    paymentMethod,
                    error
                } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                });

                if (error) {
                    alert(error.message);
                } else {
                    paymentMethodInput.value = paymentMethod.id;
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
