<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cuipapersum</title>
    @vite('resources/css/app.css')

    <link rel="icon" href="{{ asset('assets/Browser_logo_cuipapersum.svg') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <script src="https://kit.fontawesome.com/e28e3997b3.js" crossorigin="anonymous"></script>

</head>
<body class="min-h-screen" >
    <header class="shadow-2xl">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{route('landing')}}">
                <img class="ml-3 mt-1 mb-2 h-6 md:h-8 " src="{{ asset('assets/Logo_cuipapersum.svg') }}" alt="Logo">
            </a>
          

            </div>
            <div class="flex items-center space-x-4 mr-4">
                @if (Auth::check())
                    <a href="{{ route('logout') }}">Logout</a>
                    <a href="{{ route('pastpapers.createpaper') }}">Add New Paper</a>
                @else
                    {{-- <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a> --}}
                    <a class="hover:bg-[#007FFF] ml-6 md:ml-0 text-xs hover:text-white md:text-base hover:rounded hover:p-1 text-[#007FFF]" target="_blank" href="mailto:talha0750@gmail.com">Contribute a Paper</a>

                    @endif
                @include('layouts.navigation')
            </div>
        </div>
    </header>
    
    


@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@yield('content')

<!--Footer container-->
<footer class="flex flex-col bottom-0 mt-auto  text-surface bg-neutral-900 text-white flex-shrink-0">
  <div class="flex flex-row">
    <div>
      <img class="ml-4" src="{{ asset('assets/Logo_cuipapersum_white.svg') }}" alt="Logo">
      <h6 class="text-xs ml-4 ">
          Helping Juniors - Unlocking Knowledge with Every Past Paper
      </h6>
    </div>
  
    <div class="flex flex-row mt-2 ml-auto mr-4">
      <div class="flex flex-col">
      <h6 class="text-xs" >Developed & Maintained by</h6>
      <h6 class="text- hidden md:block">
          Muhammad Talha 
      </h6>
    </div>
      <img class="ml-2  hidden md:block h-8" src="{{ asset('assets/developer_image.png') }}" alt="Logo">
    </div>
  </div>
  
  <div class="container  px-1 pt-1">
    <!-- Social media icons container -->
    <div class=" flex justify-center space-x-2">
     
        <a target="_blank"
        href="https://mtalha.me"
        type="button"
        class="flex items-center justify-center rounded-full bg-[#dd4b39] md:h-8 md:w-8 h-6 w-6 leading-normal text-white shadow-dark-3 shadow-black/30 transition duration-150 ease-in-out hover:shadow-dark-1 focus:shadow-dark-1 focus:outline-none focus:ring-0 active:shadow-1 dark:text-white"
        data-twe-ripple-init
        data-twe-ripple-color="light">
        <span class="flex items-center justify-center [&>svg]:h-3 [&>svg]:w-3">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 488 512">
            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
            <path
              d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
          </svg>
        </span>
     </a>
     
     

     <!-- Instagram Button -->
<a target="_blank"
href="https://www.instagram.com/_talha.xd/"
type="button"
class="flex items-center justify-center rounded-full bg-[#ac2bac] md:h-8 md:w-8 h-6 w-6 text-white shadow-dark-3 shadow-black/30 transition duration-150 ease-in-out hover:shadow-dark-1 focus:shadow-dark-1 focus:outline-none focus:ring-0 active:shadow-1 dark:text-white"
data-twe-ripple-init
data-twe-ripple-color="light">
<span class="flex items-center justify-center [&>svg]:h-4 [&>svg]:w-4">
  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512">
    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
  </svg>
</span>
</a>

<!-- LinkedIn Button -->
<a target="_blank"
href="https://www.linkedin.com/in/muhammad-talha-offofc/"
type="button"
class="flex items-center justify-center rounded-full bg-[#0082ca] md:h-8 md:w-8 h-6 w-6 text-white shadow-dark-3 shadow-black/30 transition duration-150 ease-in-out hover:shadow-dark-1 focus:shadow-dark-1 focus:outline-none focus:ring-0 active:shadow-1 dark:text-white"
data-twe-ripple-init
data-twe-ripple-color="light">
<span class="flex items-center justify-center [&>svg]:h-4 [&>svg]:w-4">
  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512">
    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
    <path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z" />
  </svg>
</span>
</a>

<!-- GitHub Button -->
<a target="_blank"
href="https://github.com/MTalhaofc"
type="button"
class="flex items-center justify-center rounded-full bg-[#333333] md:h-8 md:w-8 h-6 w-6 text-white shadow-dark-3 shadow-black/30 transition duration-150 ease-in-out hover:shadow-dark-1 focus:shadow-dark-1 focus:outline-none focus:ring-0 active:shadow-1 dark:text-white"
data-twe-ripple-init
data-twe-ripple-color="light">
<span class="flex items-center justify-center [&>svg]:h-4 [&>svg]:w-4">
  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 496 512">
    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
    <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.7-36.7 0 0-22.9-15.7 1.6-15.5 0 0 24.8 2 37.9 25.9 21.9 37.9 58.5 27.1 72.9 20.5 2.3-16 9-27.3 16.5-33.6-60-6.7-123-30.1-123-133.9 0-29.5 10.5-53.6 27.6-72.6-3-6.9-12.1-34.9 2.9-72.6 21.9-6.9 72.6 29.5 72.6 29.5 20.8-5.6 43-8.9 65.1-8.9 22.1 0 44.3 3 65.1 8.9 0 0 50.5-36.7 72.6-29.5 15.3 37.7 5.6 65.7 2.9 72.6 17.1 19 27.6 43.1 27.6 72.6 0 103.9-63 127.1-123 133.9 9.2 7.9 17.4 23.6 17.4 47.5 0 34.6-.3 77.9-.3 86.5 0 6.5 4.6 14.4 17.3 12.1 99.7-33.4 169.5-128.3 169.5-239.2C496 113.3 385.5 8 244.8 8z" />
  </svg>
</span>
</a>

    </div>
  </div>

  <!--Copyright section-->
  <div class="w-full bg-black/5 p-1 text-center text-xs md:text-base">
    ©2024 All Rights Reserved : XDev 
    
  </div>


  
</footer>
</body>
</html>