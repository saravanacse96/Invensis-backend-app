@extends('layouts.payment')
<style>
    /* Style the form */
    #payment-form {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #f9f9f9;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #card-element {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #fff;
    }

    .btn-primary {
        padding: 10px 20px;
        background-color: #007bff;
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Error messages */
    #card-errors {
        color: #fa755a;
        margin-top: 10px;
    }

    /* new styles */
    .card-element {
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 10px;
}

/* Styles for the focused CardElement */
.card-element-focus {
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
  outline: none;
}

/* Styles for the invalid CardElement */
.card-element-invalid {
  border-color: #fa755a;
}

</style>

@section('content')
<div class="container">
<h1>Checkout</h1>
    <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
        @csrf
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{$page->description}}" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount (USD)</label>
            <input type="text" class="form-control" id="amount" name="amount" value="{{$page->price}}" required>
        </div>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <div id="card-errors" role="alert"></div>
        <input type="hidden" name="page_id" value="{{$page->id}}">
        <button type="submit" class="btn btn-primary">Pay with Stripe</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    });
</script>
@endsection
