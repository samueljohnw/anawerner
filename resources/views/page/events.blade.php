@extends('template.fullwidth')

@section('title', 'Events | Ana Werner Ministries')

@section('content')


    <section class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="row align-middle grid-x">
            <div class="column small-12 medium-12">
              <h2>Upcoming Events</h2>
              <p>
                Won't you join me for some of these events I'll be at? I would love to see you there.
</p>
              <br/>
              <button type="button" class="button" onclick="openSpeakingModal()">Invite Me to Speak at Your Event</button>
            </div>
          </div>
          <hr/>
        <div class="grid-x grid-padding-x">
            @foreach($events as $event)
                   <a style="color:#333;" href="/event/{{$event->id}}">
                    <div class="cell small-4"><img style="max-width=350px;" src="/storage/{{ $event->featured_image }}">
                   
                    </a>
                
                    <h3 >
                      <a style="color:#333;" href="/event/{{$event->id}}">{{$event->title}}</a>
                    </h3>
                    <b>
                    {{ date("F j, Y", strtotime($event->start_day)) }} - {{ date("F j, Y", strtotime($event->end_day)) }}
                    </b>
                    <p>
                    {{$event->location}}
                    </p>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    </section>

    <!-- Speaking Invitation Modal -->
    <div id="speakingModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
        <div class="modal-content" style="background: white; border-radius: 10px; padding: 40px; max-width: 800px; width: 90%; max-height: 90%; overflow-y: auto; position: relative;">
            <button type="button" class="close-modal" onclick="closeSpeakingModal()" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
            
            <h2 style="color: #333; margin-bottom: 20px; text-align: center;">Speaking Invitation Request</h2>
            <p style="color: #666; margin-bottom: 30px; text-align: center;">Thank you for your interest in having Ana speak at your event. Please fill out the form below and we'll get back to you soon.</p>
            
            <form id="speakingForm" action="#" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                @csrf
                
                <div>
                    <label for="contact_name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Name *</label>
                    <input type="text" id="contact_name" name="contact_name" required style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px;" placeholder="Your full name">
                </div>
                
                <div>
                    <label for="contact_email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Email *</label>
                    <input type="email" id="contact_email" name="contact_email" required style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px;" placeholder="your@email.com">
                </div>
                
                <div>
                    <label for="event_address" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Event Address *</label>
                    <textarea id="event_address" name="event_address" required style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px; resize: vertical; min-height: 80px;" placeholder="Full address where the event will be held"></textarea>
                </div>
                
                <div>
                    <label for="event_date" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Date of Event *</label>
                    <input type="date" id="event_date" name="event_date" required style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px;">
                </div>
                
                <div>
                    <label for="estimated_attendance" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Estimated Attendance *</label>
                    <select id="estimated_attendance" name="estimated_attendance" required style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px;">
                        <option value="">Select attendance range</option>
                        <option value="1-50">1-50 people</option>
                        <option value="51-100">51-100 people</option>
                        <option value="101-250">101-250 people</option>
                        <option value="251-500">251-500 people</option>
                        <option value="501-1000">501-1000 people</option>
                        <option value="1000+">1000+ people</option>
                    </select>
                </div>
                
                <div>
                    <label for="additional_info" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Additional Information</label>
                    <textarea id="additional_info" name="additional_info" style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px; resize: vertical; min-height: 100px;" placeholder="Tell us more about your event, theme, audience, or any special requirements..."></textarea>
                </div>
                
                <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;">
                    <button type="button" onclick="closeSpeakingModal()" style="background: #6c757d; color: white; border: none; padding: 12px 24px; border-radius: 5px; cursor: pointer; font-size: 16px;">Cancel</button>
                    <button type="submit" style="background: #2196f3; color: white; border: none; padding: 12px 24px; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;">Send Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openSpeakingModal() {
            document.getElementById('speakingModal').style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }
        
        function closeSpeakingModal() {
            document.getElementById('speakingModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Re-enable background scrolling
            document.getElementById('speakingForm').reset(); // Clear form
        }
        
        // Close modal when clicking outside the modal content
        document.getElementById('speakingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSpeakingModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('speakingModal').style.display === 'flex') {
                closeSpeakingModal();
            }
        });
        
        // Handle form submission
        document.getElementById('speakingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // You can add AJAX submission here or process the form data
            alert('Thank you for your speaking request! We will get back to you soon.');
            closeSpeakingModal();
        });
    </script>
   
@endsection