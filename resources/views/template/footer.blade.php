<!-- Footer Starts Here -->
<footer class="footer">
      <div class="container">
        <div class="grid-container footer-container">
          <div class="grid-x grid-padding-x align-top footer-block">
            <!-- Logo Section -->
            <div class="medium-4 small-12 text-center footer-logo-wrap">
              <div class="footer-logo">
                <img src="/assets/images/logo.png"
                  alt="Ana Werner Logo">
              </div>
            </div>

            <!-- Navigation Links Section 1 -->
            <div class="medium-2 small-12">
              <ul class="vertical menu footer-menu">
                <li><a href="{{route('page.about')}}">About</a></li>
                <li><a href="/events/">Events</a></li>
                <li><a href="/books/">Books</a></li>
              </ul>
            </div>

            <!-- Navigation Links Section 2 -->
            <div class="medium-2 small-12">
              <ul class="vertical menu footer-menu footer-menu-new">
                <li><a href="/training/">Trainings</a></li>
                <li><a href="/eagles-network/">Eagles Network</a></li>
                @auth
                  <li><a href="/logout">Logout</a></li>
                @endauth
              </ul>
            </div>

            <!-- Social Icons Section -->
            <div class="medium-2 small-12 text-center footer-copyright-field">
              <ul class="menu footer-icons">
                <li>
                  <a target="_blank" href="https://www.facebook.com/anawernerministries/"><i class="icon icon-facebook"></i></a>
                </li>
                <li>
                  <a target="_blank" href="https://x.com/anawernermin"><i class="icon icon-twitter"></i></a>
                </li>
                <li>
                  <a target="_blank" href="https://www.youtube.com/c/AnaWernerMinistries"><i class="icon icon-youtube"></i></a>
                </li>
                <li>
                  <a target="_blank" href="https://www.instagram.com/anawernerministries/"><i class="icon icon-instagram"></i></a>
                </li>
              </ul>
              <div class="small-12 text-center copy-right-field">
                <p>Copyright © <?=date('Y')?> Ana Werner. All Rights Reserved.</p>
              </div>
            </div>

            <!-- Footer Section -->
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Ends Here -->