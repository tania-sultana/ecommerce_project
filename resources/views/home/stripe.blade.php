<!DOCTYPE html>
<html lang="en">


<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ config('app.name', 'VPA Services Payment') }}</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <style>
    .bg-gray-200 {
    --tw-bg-opacity: 1;
    background-color: rgba(229,231,235,var(--tw-bg-opacity));
}

.min-h-screen {
    min-height: 100vh;
}

.shadow {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06) !important;
}
.rounded-md {
    border-radius: 0.375rem;
}

.max-w-xl {
    max-width: 36rem;
}
.w-full {
    width: 100%;
}

.bg-blue-1 {
    --tw-bg-opacity: 1;
    background-color: rgba(39,128,184,var(--tw-bg-opacity)) !important;
}
.font-black{
    font-weight: 900;
}

.StripeElement {
    background-color: white;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid transparent;
    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
}

.StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
    border-color: #fa755a;
}

.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}

.hidden{
    display: none;
}
.opacity-30{
    opacity: 0.3;
}
  </style>
</head>


<body>
   <div class="min-h-screen bg-gray-200 d-flex justify-content-center align-items-center">
       <div class="w-full max-w-xl">
           <div class="pb-4 d-flex justify-content-center text-center">
               <img src="/assets/images/logo.png" alt="Logo">
           </div>
           <div class="shadow bg-white rounded-md p-3">
               <form id="payment-form">
                   @csrf


                   <input type="hidden" name="amount" value="{{ $amount }}">


                   <div class="w-full mb-3">
                       <label>Card Holder Name</label>
                       <input id="card-holder-name" class="form-control" type="text" />
                   </div>
                   <div class="w-full">
                       <input disabled id="card-holder-email" class="form-control" type="text"
                           value="{{ $user->email }}">
                   </div>


                   <div class="mt-3">
                       <div id="card-element" class="form-control"></div>
                   </div>


                   <!-- Used to display form card errors and others messages. -->
                   <div id="card-errors" role="alert" class="text-danger"></div>
                   <div id="card-thank" style="color: green;"></div>
                   <div id="card-message" style="color: green;"></div>
                   <div id="card-success" style="color: green;font-weight:bolder"></div>


                   <div class="stripe-errors"></div>
                   @if (count($errors) > 0)
                       <div class="alert alert-danger">
                           @foreach ($errors->all() as $error)
                               {{ $error }}<br>
                           @endforeach
                       </div>
                   @endif


                   <button id="submit"
                       class="w-full btn py-2 rounded-md bg-blue-1 d-flex justify-content-center text-center text-white font-black mt-2">
                       <div id="loading" class="hidden">
                           Loading...
                           <div class="spinner-border text-white spinner-border-sm">
                               <span class="visually-hidden">Loading...</span>
                           </div>
                       </div>
                       <span class="" id="price">
                           Submit Payment €{{ $amount }}
                       </span>
                   </button>
               </form>
           </div>
       </div>
   </div>






   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://js.stripe.com/v3/"></script>
   <script type="text/javascript">
       $('#card-success').text('');
       $('#card-errors').text('');
       var stripe = Stripe("{{ config('app.stripe_key') }}");
       var elements = stripe.elements();
       $('#submit').prop('disabled', true);
       // Set up Stripe.js and Elements to use in checkout form
       var style = {
           base: {
               color: "#32325d",
           }
       };


       var card = elements.create("card", {
           style: style
       });
       card.mount("#card-element");




       card.addEventListener('change', ({
           error
       }) => {
           const displayError = document.getElementById('card-errors');
           if (error) {
               displayError.textContent = error.message;
               $('#submit').prop('disabled', true);
           } else {
               displayError.textContent = '';
               $('#submit').prop('disabled', false);


           }
       });


       var form = document.getElementById('payment-form');


       form.addEventListener('submit', function(ev) {
           $('.loading').css('display', 'block');


           ev.preventDefault();


           setLoading(true)


           const cardHolderName = document.getElementById('card-holder-name');
           const cardHolderEmail = document.getElementById('card-holder-email');
           //cardnumber,exp-date,cvc
           stripe.confirmCardPayment('{{ $client_secret }}', {
               payment_method: {
                   card: card,
                   billing_details: {
                       name: cardHolderName.value,
                       email: cardHolderEmail.value
                   }
               },
               setup_future_usage: 'off_session'
           }).then(function(result) {
               $('.loading').css('display', 'none');


               if (result.error) {
                   setLoading(false)
                   $('#card-errors').text(result.error.message);


               } else {
                   if (result.paymentIntent.status === 'succeeded') {


                       setLoading(false)
                       $('#card-success').text("payment successfully completed.");
                       setTimeout(
                           function() {
                               window.location.href = "{{ route('stripe.post') }}";
                           }, 2000);
                   }
                   return false;
               }
           });
       });


       function setLoading(isLoading) {
           if (isLoading) {
               document.querySelector("#submit").disabled = true;
               document.querySelector("#submit").classList.add("opacity-30");
               document.querySelector("#submit").classList.add("cursor-not-allowed");
               document.querySelector("#loading").classList.remove("hidden");
               document.querySelector("#price").classList.add("hidden");
           } else {
               document.querySelector("#submit").disabled = false;
               document.querySelector("#submit").classList.remove("opacity-30");
               document.querySelector("#submit").classList.remove("cursor-not-allowed");
               document.querySelector("#loading").classList.add("hidden");
               document.querySelector("#price").classList.remove("hidden");
           }
       }
   </script>
</body>
