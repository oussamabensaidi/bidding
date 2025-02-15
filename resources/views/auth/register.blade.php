<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/regestrationform.js'])
</head>

<div class="main-wrapper">
  <button class="dark-mode-toggle" id="themeToggle">
      🌓
  </button>
    <div class="form-wrapper">
      <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
          <div class="steps">
              <ul>
                  <li class="step-menu1 active">
                      <span>1</span>
                      Personal info
                  </li>
                  <li class="step-menu2">
                      <span>2</span>
                      Additonal information
                  </li>
                  <li class="step-menu3">
                      <span>3</span>
                      Confirmation
                  </li>
              </ul>
          </div>
  
          <div class="form-step-1 active">
            <div class="input-flex">
              <div>
                  <label for="firstname" class="form-label"> Full name </label>
                  <input
                  type="text"
                  name="name"
                  placeholder="Andrio roberto"
                  id="firstname"
                  class="form-input"
                  />
              </div>
              <div>
                <label for="email" class="form-label"> Email Address </label>
                <input
                type="email"
                name="email"
                placeholder="example@mail.com"
                id="email"
                class="form-input"
                />
            </div>
            </div>
    
            <div class="input-flex">
                <div>
                    <label for="dob" class="form-label"> Password </label>
                    <input 
                    type="password" 
                    name="password" 
                    id="dob" 
                    class="form-input"
                    placeholder="password"
                    />
                </div>
                <div>
                    <label for="password_confirmation" class="form-label"> Password confirmation </label>
                    <input
                    type="password"
                    name="password_confirmation"
                    placeholder="type it again"
                    id="lastname"
                    class="form-input"
                    />
                </div>
            </div>
    
            <div>
                <label for="role" class="form-label" > Role </label>
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                  <option value="select" selected disabled>select a role :</option>
                    <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            
            </div>
          </div>
  
          <div class="form-step-2">
              <div>
                        <label for="file" class="form-label">Profile picture</label>
                        <input type="file"  accept="image/*" id="file" class="form-input" name="profile_picture"  >
              </div>
              <div class="input-flex"> 
                  <div>
                        <label for="balance" class="form-label">Enter you balance</label>
                        <input type="number" name="balance"id="balance" class="form-input"/>
                  </div>
                  <div id="client_bid_div">
                      <label for="balance" class="form-label">Maximum Bid $</label>
                      <input  type="number"  id="client_bid" name="maximumbid"  class="form-input"/>
                  </div> 
              </div>
                <p><img id="output" width="200" /></p>
            </div>
















          <div class="form-step-3">
            <div class="form-confirm">
              <p>
                read all the condition <a href="" style="color: rgb(113, 2, 187);text-decoration:underline;">here</a>
              </p>
              <input type="checkbox" id="checkbox"><label for=""> I agree to all the condition in the mentioned link above ✋</label>
            </div>
          </div>
  
          <div class="form-btn-wrapper">
            <a href="{{route('login')}}" id="loginLink"
            style="color: #555; text-decoration: none;"
            onmouseover="this.style.color='#000'; this.style.textDecoration='underline';"
            onmouseout="this.style.color='#555'; this.style.textDecoration='none';">
           already have an account?
         </a>
            <button class="back-btn">
              Back
            </button>
  
            <button class="btn">
                Next Step
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1675_1807)">
                <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_1675_1807">
                <rect width="16" height="16" fill="white"/>
                </clipPath>
                </defs>
                </svg>
            </button>
          </div>
      </form>
      
    </div>
  </div>
