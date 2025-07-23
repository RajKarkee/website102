   <header class="header">
       <div class="header-content">
           <div class="d-flex align-items-center">
               <button class="menu-toggle" id="menuToggle">
                   <i class="fas fa-bars"></i>
               </button>
               <a href="#" class="logo">
                   <i class="fas fa-tachometer-alt"></i>
                   AdminPanel
               </a>
           </div>
           <div class="header-right">
               {{-- <div class="user-menu">
                    <button class="user-btn" id="userBtn">
                        <i class="fas fa-user-circle"></i>
                        <span>Admin User</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="#"><i class="fas fa-user"></i> Profile</a>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div> --}}

               <div class="user-menu">
                   <button class="user-btn" id="userBtn">
                       @php
                           use Illuminate\Support\Facades\Auth;
                           use App\Models\Userpic;

                           $userpic = Userpic::where('user_id', Auth::id())->first();
                       @endphp
                       <img src="{{asset('storage/' . $imagepath) : asset('default-user.png') }}"
                           alt="User Image" class="user-img" />

                       <span class="user-name">{{ Auth::user()->name }}</span>
                       <i class="fas fa-chevron-down"></i>
                   </button>

                   <div class="user-dropdown" id="userDropdown">
                       <a href="#" id="openProfile"><i class="fas fa-user"></i> Profile</a>
                       <a href="#"><i class="fas fa-cog"></i> Settings</a>
                       <a href="{{ route('admin.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i> Logout
                       </a>
                       <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                           style="display: none;">
                           @csrf
                       </form>
                   </div>
               </div>

               <style>
                   .user-menu {
                       position: relative;
                       display: inline-block;
                   }

                   .user-img {
                       width: 36px;
                       height: 36px;
                       border-radius: 50%;
                       margin-right: 10px;
                       object-fit: cover;
                   }

                   .user-name {
                       font-weight: 500;
                       margin-right: 8px;
                       color: #bbb;
                   }

                   .user-dropdown {
                       display: none;
                       position: absolute;
                       top: 50px;
                       right: 0;
                       background-color: white;
                       box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                       border-radius: 8px;
                       overflow: hidden;
                       z-index: 999;
                       width: 180px;
                   }

                   .user-dropdown a {
                       display: block;
                       padding: 12px 16px;
                       text-decoration: none;
                       color: #333;
                       transition: background-color 0.3s;
                       font-size: 14px;
                   }

                   .user-dropdown a:hover {
                       background-color: #f9f9f9;
                   }

                   /* Modal styles */
                   .modal {
                       position: fixed;
                       z-index: 1000;
                       left: 0;
                       top: 0;
                       width: 100%;
                       height: 100%;
                       background-color: rgba(0, 0, 0, 0.4);
                       display: flex;
                       align-items: center;
                       justify-content: center;
                   }

                   .modal-content {
                       background-color: #fff;
                       padding: 30px;
                       border-radius: 12px;
                       width: 100%;
                       max-width: 450px;
                       box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
                       position: relative;
                   }

                   .modal-content h2 {
                       margin-top: 0;
                       margin-bottom: 20px;
                       font-size: 20px;
                   }

                   .modal-content label {
                       display: block;
                       margin-bottom: 6px;
                       font-weight: 600;
                       color: #333;
                   }

                   .modal-content input[type="text"],
                   .modal-content input[type="email"],
                   .modal-content input[type="password"],
                   .modal-content input[type="file"] {
                       width: 100%;
                       padding: 10px;
                       margin-bottom: 15px;
                       border: 1px solid #ccc;
                       border-radius: 6px;
                       font-size: 14px;
                   }

                   .modal-content button[type="submit"] {
                       width: 100%;
                       background-color: #007BFF;
                       color: white;
                       border: none;
                       padding: 12px;
                       border-radius: 6px;
                       font-size: 15px;
                       cursor: pointer;
                       transition: background-color 0.3s;
                   }

                   .modal-content button[type="submit"]:hover {
                       background-color: #0056b3;
                   }

                   .close {
                       position: absolute;
                       top: 10px;
                       right: 20px;
                       font-size: 26px;
                       color: #666;
                       cursor: pointer;
                   }
               </style>

               <div id="profileModal" class="modal" style="display: none;">
                   <div class="modal-content">
                       <span class="close" id="closeProfileModal">&times;</span>
                       <h2>Edit Profile</h2>
                       <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')

                           <label>Name:</label>
                           <input type="text" name="name" value="{{ Auth::user()->name }}" required>

                           <label>Email:</label>
                           <input type="email" name="email" value="{{ Auth::user()->email }}" required>

                           <label>Password (leave blank to keep current):</label>
                           <input type="password" name="password">

                           <label>Profile Image:</label>
                           <input type="file" name="image">

                           <button type="submit">Save Changes</button>
                       </form>
                   </div>
               </div>

           </div>
       </div>
   </header>


   <script>
       const userBtn = document.getElementById('userBtn');
       const dropdown = document.getElementById('userDropdown');
       const modal = document.getElementById('profileModal');
       const openProfile = document.getElementById('openProfile');
       const closeModal = document.getElementById('closeProfileModal');

       userBtn.addEventListener('click', () => {
           dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
       });

       openProfile.addEventListener('click', (e) => {
           e.preventDefault();
           dropdown.style.display = 'none';
           modal.style.display = 'flex';
       });

       closeModal.addEventListener('click', () => {
           modal.style.display = 'none';
       });

       window.addEventListener('click', (event) => {
           if (event.target === modal) {
               modal.style.display = 'none';
           }
       });
   </script>
