@extends('template.fullwidth')
@section('title', 'Payment Successful | Ana Werner Ministries')

@section('content')
<div class="grid-x grid-margin-x">
  <div class="cell large-2 small-1"></div>
  <div class="cell large-8 small-10">
    <section class="content-wrapper" style="text-align: center; padding: 60px 20px;">
      <div style="max-width: 600px; margin: 0 auto;">


        @if(isset($purchaseDetails))
        <div style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 30px; margin-bottom: 30px; text-align: left;">
          <h3 style="color: #333; margin-bottom: 20px; text-align: center;">Purchase Summary</h3>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
            <div>
              <strong style="color: #555;">Customer:</strong><br>
              <span style="color: #777;">{{ $purchaseDetails['customer_name'] }}</span><br>
              <span style="color: #777;">{{ $purchaseDetails['customer_email'] }}</span>
            </div>
            <div>
              <strong style="color: #555;">Purchase Date:</strong><br>
              <span style="color: #777;">{{ $purchaseDetails['purchase_date'] }}</span>
            </div>
            <div>
              <strong style="color: #555;">Course:</strong><br>
              <span style="color: #777;">{{ $purchaseDetails['course_title'] }}</span>
            </div>
            <div>
              <strong style="color: #555;">Amount Paid:</strong><br>
              <span style="color: #28a745; font-weight: bold;">${{ number_format($purchaseDetails['amount_paid'], 2) }} {{ $purchaseDetails['currency'] }}</span>
            </div>
          </div>
          <div style="border-top: 1px solid #dee2e6; padding-top: 15px;">
            <small style="color: #6c757d;">
              <strong>Transaction ID:</strong> {{ $purchaseDetails['charge_id'] }}<br>
            </small>
          </div>
        </div>
        @endif

        <div style="background: #f9f9f9; border-radius: 8px; padding: 30px; margin-bottom: 30px; text-align: left;">
          <h3 style="color: #333; margin-bottom: 15px;">What happens next?</h3>
          <ul style="color: #666; line-height: 1.6;">
            <li>You will receive a confirmation email shortly with your next steps</li>
            <li>For any questions, please contact our support team at info@anawerner.org</li>
          </ul>
        </div>

        <div style="margin-top: 40px;">
          <a href="{{ route('page.home') }}" class="button" style="background: #2196f3; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin-right: 15px;">
            Return to Home
          </a>
          <a href="{{ route('page.training') }}" class="button hollow" style="border: 2px solid #2196f3; color: #2196f3; padding: 13px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
            View Training
          </a>
        </div>
      </div>
    </section>
  </div>
  <div class="cell large-2 small-1"></div>
</div>
@endsection