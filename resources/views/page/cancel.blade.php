@extends('template.fullwidth')
@section('title', 'Payment Cancelled | Ana Werner Ministries')

@section('content')
<div class="grid-x grid-margin-x">
  <div class="cell large-2 small-1"></div>
  <div class="cell large-8 small-10">
    <section class="content-wrapper" style="text-align: center; padding: 60px 20px;">
      <div style="max-width: 600px; margin: 0 auto;">
        <div style="background: #fff3cd; border: 2px solid #ffc107; border-radius: 10px; padding: 40px; margin-bottom: 30px;">
          <div style="color: #856404; font-size: 64px; margin-bottom: 20px;">⚠</div>
          <h1 style="color: #856404; margin-bottom: 20px; font-size: 2.5rem;">Payment Cancelled</h1>
          <p style="font-size: 1.2rem; color: #555; margin-bottom: 30px;">
            Your payment was cancelled and no charges were made to your account.
          </p>
        </div>

        <div style="background: #f9f9f9; border-radius: 8px; padding: 30px; margin-bottom: 30px; text-align: left;">
          <h3 style="color: #333; margin-bottom: 15px;">What you can do next:</h3>
          <ul style="color: #666; line-height: 1.6;">
            <li>Try the payment process again if you experienced technical difficulties</li>
            <li>Contact our support team if you need assistance</li>
            <li>Browse our other training options and courses</li>
          </ul>
        </div>

        <div style="background: #e7f3ff; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
          <p style="color: #0c5aa6; margin: 0; font-weight: bold;">
            💡 Need help? Our support team is here to assist you with any questions about the payment process.
          </p>
        </div>

        <div style="margin-top: 40px;">
          <a href="{{ route('page.training') }}" class="button" style="background: #2196f3; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin-right: 15px;">
            Try Again
          </a>
          <a href="{{ route('page.home') }}" class="button hollow" style="border: 2px solid #2196f3; color: #2196f3; padding: 13px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
            Return to Home
          </a>
        </div>
      </div>
    </section>
  </div>
  <div class="cell large-2 small-1"></div>
</div>
@endsection