<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <h2>Stripe Payment Form</h2>
    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="/stripe-payment/{{$total_cost}}" method="POST" id="payment-form">
        @csrf
        <lable for="email">#ID{{ $reservation_id }}</lable>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <div id="card-element"></div>
        <button type="submit" id="submit">
            <span id="button-text">Pay {{ number_format((float) $total_cost, 2, ',', ' ') }} MAD</span>
        </button>
    </form>

    @if(session('error2'))
    <script>
        alert("{{ session('error2') }}");
    </script>
    @endif
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {token, error} = await stripe.createToken(card);
            if (error) {
                alert(error.message);
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                HTMLFormElement.prototype.submit.call(form);
            }
        });
    </script>
</body>
</html>
