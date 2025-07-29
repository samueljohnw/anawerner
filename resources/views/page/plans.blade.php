@extends('template.fullwidth')
@section('title', 'Subscription Plans | Ana Werner Ministries')

@section('content')
<section style="padding: 60px 20px; max-width: 900px; margin: 0 auto; font-family: sans-serif; color: #2c3e50;">

  <!-- Hero -->
  <h1 style="font-size: 2.8rem; text-align: center; margin-bottom: 30px;color:#444; ">
    Welcome to The Eagle’s Spot
  </h1>
  <p style="font-size: 1.2rem; line-height: 1.6; margin-bottom: 20px;">
    What if there was one trusted place where you could learn about deliverance, inner healing, miracles, and so much more?
  </p>
  <p style="font-size: 1.1rem; color: #555; line-height: 1.6; margin-bottom: 50px;">
    Welcome to <strong>The Eagle’s Spot</strong>—a prophetic hub designed to equip, empower, and activate you. Inside this exclusive community, you’ll receive powerful teachings and interviews on topics like healing, deliverance, the prophetic, spiritual warfare, and the supernatural. Trusted leaders from around the world will pour into you, so you not only receive impartation—you’ll learn to walk in it.
  </p>

  <!-- Q&A Section -->
  <div style="background: #f9f9f9; border-radius: 12px; padding: 40px; margin-bottom: 50px;">
    <h2 style="color: #2e7d32; font-size: 2rem; margin-bottom: 20px;">Want real answers to real questions?</h2>
    <p style="font-size: 1.1rem; color: #444; line-height: 1.6;">
      If you've ever longed for a mentor—someone who will answer your raw, real questions with honesty and spiritual clarity—our <strong>Seers Soaring Plan</strong> is for you.
    </p>
    <br/>
    <p style="font-size: 1.1rem; color: #444; line-height: 1.6;">
      Each month, you'll be invited to submit your questions and join a live Q&A session, where Ana personally responds, offers insight, and ministers. These gatherings are powerful moments of connection and prophetic flow within our community.
    </p>
  </div>

  <!-- Plan Options -->
  <h2 style="font-size: 2rem; text-align: center; margin-bottom: 30px;">Choose the Plan That Fits You</h2>

  <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; margin-bottom: 40px;">
    <!-- Basic Plan -->
    <div style="flex: 1; min-width: 280px; max-width: 400px; border: 1px solid #ddd; border-radius: 10px; padding: 30px;">
      <h3 style="text-align: center; font-size: 1.5rem; margin-bottom: 10px;color:#3498db">✅ Basic Plan ($19)</h3>
      <ul style="list-style: none; padding: 0; font-size: 1rem; color: #444; margin-bottom: 20px;">
        <li>• Monthly prophetic teachings and insights</li>
        <li>• Full access to every teaching</li>
        <li>• All video content on demand</li>
        <li>• Watch anywhere, anytime</li>
      </ul>
      <div style="text-align: center;">
        @auth
          <a href="/subscribe/EAGLES_SPOT" style="background: #3498db; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">Join the Basic Plan</a>
        @else
          <button onclick="showLoginForm()" style="background: #3498db; color: white; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; font-size: 1rem;">Join the Basic Plan</button>
        @endauth
      </div>
    </div>

    <!-- Seers Soaring Plan -->
    <div style="flex: 1; min-width: 280px; max-width: 400px; border: 2px solid #f1c40f; background: #fffbe6; border-radius: 10px; padding: 30px; position: relative;">
      <div style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #e74c3c; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">
        MOST POPULAR
      </div>
      <h3 style="text-align: center; font-size: 1.5rem; margin-bottom: 10px;color:#3498db">✅ Seers Soaring Plan ($59)</h3>
      <ul style="list-style: none; padding: 0; font-size: 1rem; color: #444; margin-bottom: 20px;">
        <li>• Everything in the Basic Plan</li>
        <li>• Submit questions to Ana</li>
        <li>• Monthly live Q&A sessions with Ana</li>
        <li>• Submit your questions and receive ministry</li>
      </ul>
      <div style="text-align: center;">
        @auth
          <a href="/subscribe/SEERS_SOARING" style="background: #e67e22; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">Join the Seers Soaring Plan</a>
        @else
          <button onclick="showLoginForm()" style="background: #e67e22; color: white; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; font-size: 1rem;">Join the Seers Soaring Plan</button>
        @endauth
      </div>
    </div>
  </div>

  <!-- Guarantee -->
  <div style="text-align: center; margin-bottom: 40px;">
    <p style="font-size: 1.1rem; color: #333; font-weight: bold;">
      No contract. Cancel anytime.
    </p>
    <p style="font-size: 1rem; color: #666;">
      Watch on any device, anywhere in the world.
    </p>
  </div>

  <!-- Closing -->
  <div style="text-align: center;">
    <h3 style="color: #2e7d32; font-size: 1.8rem;">You don’t have to grow alone.</h3>
    <p style="font-size: 1.2rem; color: #444; font-weight: bold;">
      Let’s go deeper—together.
    </p>
  </div>

</section>

@guest
<!-- Login Modal Overlay -->
<div id="loginModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 1000; justify-content: center; align-items: center;">
  <div style="background: white; padding: 2rem; border-radius: 10px; max-width: 400px; width: 90%; position: relative;">
    <button onclick="hideLoginForm()" style="position: absolute; top: 10px; right: 15px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">&times;</button>
    
    <div style="text-align: center; margin-bottom: 1.5rem;">
      <h3 style="margin-bottom: 0.5rem;">Please Login First</h3>
      <p style="color: #666; margin: 0;">You need to be logged in to subscribe to a plan</p>
    </div>
    
    @include('snippets.loginform')
  </div>
</div>

<script>
function showLoginForm() {
  document.getElementById('loginModal').style.display = 'flex';
}

function hideLoginForm() {
  document.getElementById('loginModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('loginModal').addEventListener('click', function(e) {
  if (e.target === this) {
    hideLoginForm();
  }
});
</script>
@endguest

@endsection
