@extends('template.fullwidth')


@section('content')
<style>
        #card-element {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 400px;
            margin-bottom:20px;
        }
        #card-errors {
            color: red;
            margin-top: 10px;
        }
    </style>
        <script src="https://js.stripe.com/v3/"></script>


<div class="grid-x grid-margin-x">
  <div class="cell large-4 small-1"></div>
  <div class="cell large-4 small-10">
        <h2>Complete Your Payment</h2>
        <h4>{{$course->title}}</h4>
        <br/>
        <label>Enter Your Name
            <input id="card-holder-name" type="text" required placeholder="Full Name ...">
        </label> 
        <label>Enter Your Email Address
            <input id="card-holder-email" type="text" required placeholder="Email Address ...">
        </label>      
    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

        <button id="card-button" class="button">
            Process Payment
        </button>

        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

  </div>
  <div class="cell large-4 small-1"></div>
</div>



        <script>
            const stripe = Stripe("{{env('STRIPE_KEY')}}");
        
            const elements = stripe.elements();
            const cardElement = elements.create('card');
        
            cardElement.mount('#card-element');
            const cardHolderName = document.getElementById('card-holder-name');
            const cardHolderEmail = document.getElementById('card-holder-email');
            const cardButton = document.getElementById('card-button');
            
            cardButton.addEventListener('click', async (e) => 
                {
                    const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: { email: cardHolderEmail.value }
                    }
                );
            
                if (error) 
                {
                    console.log(error);
                } 
                else 
                {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('singlePurchase')}}",
                        dataType: "json",
                        data: { pm: paymentMethod,
                                _token: '{{csrf_token()}}',
                                email: cardHolderEmail.value,
                                name: cardHolderName.value,
                                id: {{$course->id}},
                        },
                        success: function(res){
                            
                            console.log(res);
                            
                        }
                    });

                }
            });
        </script>

   
    @endsection

