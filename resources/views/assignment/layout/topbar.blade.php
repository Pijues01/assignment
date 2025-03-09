  <!-- CONTENT -->
  <section id="content">
      <!-- NAVBAR -->
      <nav>
          <i class='bx bx-menu bx-sm'></i>
          {{-- <a href="#" class="nav-link">Categories</a> --}}
          <form action="#" class="hide-item">
              <div class="form-input">
                  <input type="search" placeholder="Search...">
                  <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
              </div>
          </form>
          <input class="hide-item" type="checkbox" class="checkbox" id="switch-mode" hidden />
          <label  class="swith-lm hide-item" for="switch-mode">
              <i class="bx bxs-moon"></i>
              <i class="bx bx-sun"></i>
              <div class="ball"></div>
          </label>



          <!-- Profile Menu -->

          @if (auth()->user()->profileimg)
          <a href="#" class="profile" id="profileIcon">
              <img src="{{ asset('storage/' . auth()->user()->profileimg) }}"
                  alt="Profile Picture">
                </a>
          @else
          <a href="#" class="profile" id="profileIcon">
            <img src="images/profile_picture.jpg" alt="Profile">
        </a>
          @endif
          <div class="profile-menu" id="profileMenu">
              <ul>
                  <li><a href="#">My Profile</a></li>
                  <li><a href="#">Settings</a></li>
                  <li><a href="#">Log Out</a></li>
              </ul>
          </div>
      </nav>
      <!-- NAVBAR -->
      <main>
