<div class="callout" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div style="text-align: left; margin-bottom: 1.5rem;">
        <!-- <h5 style="color: #495057; margin-bottom: 0.5rem; font-weight: 600;">Welcome Back</h5> -->
        <p style="color: #6c757d; margin: 0; font-size: 0.9rem;">Enter your email address to receive a link to login.</p>
    </div>
   
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="medium-12 cell">
                @error('email')
                    <div style="background: #f8d7da; color: #721c24; padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; border-left: 4px solid #dc3545; font-size: 0.9rem;">
                        {{ $message }}
                    </div>
                @enderror
                
                <form method="POST" action="{{ route('attempt') }}" style="margin: 0;">
                    @csrf
                    <div style="margin-bottom: 1.5rem;">
                        <label style="color: #495057; font-weight: 500; margin-bottom: 0.5rem; display: block;">Email Address</label>
                        <input name="email" 
                               type="email" 
                               placeholder="Enter your email address" 
                               class="expanded"
                               style="padding: 0.75rem 1rem; border: 2px solid #e9ecef; border-radius: 6px; font-size: 1rem; transition: border-color 0.15s ease-in-out; background: white;"
                               onfocus="this.style.borderColor='#007bff'; this.style.boxShadow='0 0 0 0.2rem rgba(0,123,255,0.25)'"
                               onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                        <div style="display:none"><input type="text" name="weetard"></div>
                    </div>
                    
                    <button type="submit" 
                            class="btn expanded"
                            style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); 
                                   color: white; 
                                   border: none; 
                                   padding: 0.875rem 2rem; 
                                   border-radius: 6px; 
                                   font-weight: 600; 
                                   font-size: 1rem; 
                                   cursor: pointer; 
                                   transition: all 0.15s ease-in-out;
                                   text-transform: none;"
                            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(0,123,255,0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        Send Login Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>