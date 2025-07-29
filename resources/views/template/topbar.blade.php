@auth

<div class="grid-container" style="margin-top:95px;">
  <div class="clearfix">
    <a href="/logout" class="btn button float-right" style="background:#133639;margin-left:10px;" >Logout</a> 
        <a href="{{ route('account') }}" class="btn button float-right" style="background:#133639;margin-left:10px;" >Account</a>


  </div>
</div>

@endauth
@guest
<div class="grid-container" style="margin-top:95px;">
  <div class="clearfix">
    <button class="btn button float-right" style="background:#30c0d2;" onclick="openLoginModal()">Login</button>
  </div>
</div>

<!-- Login Modal -->
<div id="loginModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div class="modal-content" style="background: white; border-radius: 10px; padding: 40px; max-width: 500px; width: 90%; max-height: 90%; overflow-y: auto; position: relative;">
        <button type="button" class="close-modal" onclick="closeLoginModal()" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
        @include('snippets.loginform')
    </div>
</div>

<script>
    function openLoginModal() {
        document.getElementById('loginModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeLoginModal() {
        document.getElementById('loginModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    // Close modal when clicking outside
    document.getElementById('loginModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLoginModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('loginModal').style.display === 'flex') {
            closeLoginModal();
        }
    });
</script>


@endguest