@extends('template.fullwidth')
@section('title', 'Subscription Successful | Ana Werner Ministries')

@section('content')
<div class="grid-x grid-margin-x">
  <div class="cell large-2 small-1"></div>
  <div class="cell large-8 small-10">
    <section class="content-wrapper" style="text-align: center; padding: 60px 20px;">
      <div style="max-width: 600px; margin: 0 auto;">
        
        <div style="margin-bottom: 30px;">
          <div style="background: #28a745; color: white; border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 40px;">
            ✓
          </div>
          <h1 style="color: #333; margin-bottom: 10px; font-size: 2.5rem;">Welcome to the Mentorship!</h1>
          <p style="color: #666; font-size: 1.2rem; margin: 0;">Your subscription has been successfully activated</p>
        </div>

        @if(isset($subscriptionDetails))
        <div style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 30px; margin-bottom: 30px; text-align: left;">
          <h3 style="color: #333; margin-bottom: 20px; text-align: center;">Subscription Summary</h3>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
            <div>
              <strong style="color: #555;">Subscriber:</strong><br>
              <span style="color: #777;">{{ $subscriptionDetails['customer_name'] }}</span><br>
              <span style="color: #777;">{{ $subscriptionDetails['customer_email'] }}</span>
            </div>
            <div>
              <strong style="color: #555;">Start Date:</strong><br>
              <span style="color: #777;">{{ $subscriptionDetails['subscription_date'] }}</span>
            </div>
            <div>
              <strong style="color: #555;">Subscription:</strong><br>
              <span style="color: #777;">{{ $subscriptionDetails['subscription_name'] }}</span>
            </div>
            <div>
              <strong style="color: #555;">Amount:</strong><br>
              <span style="color: #28a745; font-weight: bold;">${{ number_format($subscriptionDetails['amount_paid'], 2) }} {{ $subscriptionDetails['currency'] }}</span><br>
              <small style="color: #6c757d;">per {{ $subscriptionDetails['billing_cycle'] }}</small>
            </div>
          </div>
          <div style="border-top: 1px solid #dee2e6; padding-top: 15px;">
            <small style="color: #6c757d;">
              <strong>Subscription ID:</strong> {{ $subscriptionDetails['subscription_id'] }}<br>
            </small>
          </div>
        </div>
        @endif

        <div style="background: #e7f3ff; border: 1px solid #bee5eb; border-radius: 8px; padding: 30px; margin-bottom: 30px; text-align: left;">
          <h3 style="color: #0c5460; margin-bottom: 15px;">🎉 You now have access to:</h3>
          <ul style="color: #0c5460; line-height: 1.8; list-style: none; padding-left: 0;">
            <li style="margin-bottom: 10px;">✓ <strong>All mentorship content</strong> - Access exclusive training materials</li>
            <li style="margin-bottom: 10px;">✓ <strong>Monthly live sessions</strong> - Join interactive mentorship calls</li>
            <li style="margin-bottom: 10px;">✓ <strong>Community access</strong> - Connect with other members</li>
            <li style="margin-bottom: 10px;">✓ <strong>Bonus resources</strong> - Additional materials and tools</li>
          </ul>
        </div>

        <div style="background: #f9f9f9; border-radius: 8px; padding: 30px; margin-bottom: 30px; text-align: left;">
          <h3 style="color: #333; margin-bottom: 15px;">What happens next?</h3>
          <ul style="color: #666; line-height: 1.6;">
            <li>You will receive a welcome email with your first steps within the next few minutes</li>
            <li>Your subscription will automatically renew each {{ $subscriptionDetails['billing_cycle'] ?? 'month' }}</li>
            <li>You can manage your subscription anytime from your account page</li>
            <li>For any questions, please contact our support team at info@anawerner.org</li>
          </ul>
        </div>

        <div style="margin-top: 40px;">
          <a href="{{ route('page.training') }}" class="button" style="background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin-right: 15px; font-weight: bold;">
            Start Your Journey
          </a>
          <a href="{{ route('account') }}" class="button hollow" style="border: 2px solid #28a745; color: #28a745; padding: 13px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
            Manage Subscription
          </a>
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6;">
          <p style="color: #6c757d; font-size: 0.9rem; margin: 0;">
            Need help getting started? 
            <a href="mailto:info@anawerner.org" style="color: #28a745; text-decoration: none;">Contact our support team</a>
          </p>
        </div>
      </div>
    </section>
  </div>
  <div class="cell large-2 small-1"></div>
</div>
@endsection