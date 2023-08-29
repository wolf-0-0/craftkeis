<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    {{-- fontawesome icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    {{-- AlpineJS --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- tailwind css --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: "#F4A051",
                        onhover: "#f07c0f",
                        // onhover: "#E5A66C",
                        background: "#D9D9D9",
                        buttons: "#C3C3C3",
                        disabled: "#4f4f4f",
                        bgsec: "#949494",
                        open: "#B1E320",
                        closed: "#E34320"
                    },
                    borderRadius: {
                        'lg': '10px',
                    },
                },
            },
        };
        document.addEventListener('DOMContentLoaded', function() {
            const scrollToTopButton = document.querySelector(".scrollToTopButton");
            // // Show or hide the button based on the scroll position
            window.addEventListener("scroll", () => {
                if (window.pageYOffset > 100) {
                    scrollToTopButton.classList.add("show");
                } else {
                    scrollToTopButton.classList.remove("show");
                }
            });
            // // Scroll to the top of the page when the button is clicked
            scrollToTopButton.addEventListener("click", () => {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        });
    </script>
    <style>
        /* body {
            min-height: fit-content;
        } */

        .active-contact {
            background-color: lightgreen;
        }

        .message-window-page {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 50;
        }

        .message-list {
            -ms-overflow-style: none;
            scrollbar-width: none;
            overflow-y: scroll;
        }

        .message-list::-webkit-scrollbar {
            display: none;
        }

        .message-window-open {
            display: flex;
            /* flex-direction: column; */
        }

        .arrow-up {
            font-size: 3rem;
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 50;
        }

        .scrollToTopButton {
            display: none;
        }

        .show {
            display: block;
        }
    </style>
    <title>Craftkéis - Find Artists</title>
</head>

<body>
    {{-- Creating session variables on every page reload for authenticated users --}}
    @if (auth()->check())
        @php
            //Creat last_conversation session variable if it does not exist
            if (!session()->has('last_conversation')) {
                session(['last_conversation' => 0]);
            }
            
        @endphp
    @endif

    {{-- navbar --}}
    <nav class="w-full mx-auto flex flex-col items-center xl:w-3/4 xl:mx-auto xl:flex xl:flex-col xl:items-center ">
        {{-- top section of navbar --}}
        <section class="w-full dropshadow flex -justify-center h-24 bg-background rounded-b-lg"> 
            <div class="flex space-x-6 items-center grid grid-cols-3 w-11/12 gap-x-52 justify-center mx-auto">
                {{--  Col 1 --}}
                <div class="flex">
                    {{-- Search bar --}}
                    @include('partials._search')
                </div>

                <div class="w-full flex justify-center z-20">
                    <a href="/" class="customLogo">Craftkeis</a>
                </div>

                <div class="w-full flex justify-evenly space-x-2 bg-background">

                    {{-- language select --}}
                    {{-- <a href="" class="text-center text-lg h-8 w-24 text-black rounded-lg bg-buttons hover:text-white hover:bg-onhover"><i class="fas fa-globe"></i></a> --}}

                    {{-- auth directive only shows the elements when logged in --}}
                    @auth
                        <div
                            class="text-center text-lg h-8 w-24 text-black hover:text-white rounded-lg bg-buttons hover:bg-onhover">
                            <a href="/users/{{ auth()->user()->id }}">Account</a>
                        </div>
                        {{-- logout button --}}
                        <form class="inline" action="/logout" method="post">
                            @csrf
                            <button class="text-center text-lg h-8 w-24 text-black rounded-lg bg-buttons hover:bg-onhover">
                                <i class="fa-solid fa-door-closed"></i> Logout
                            </button>
                        </form>
                        {{-- else when not logged in --}}
                    @else
                        <span class="text-center text-lg h-8 w-24 text-text-black rounded-lg bg-buttons hover:bg-onhover">
                            <a href="/login" class="hover:text-white">Login</a>
                        </span>
                        <span class="text-center text-lg h-8 w-24 text-white rounded-lg bg-accent hover:bg-onhover">
                            <a href="/register" class="">Register</a>
                        </span>
                    @endauth
                </div>

            </div>
        </section>

        {{-- categories list --}}
        <section class="flex w-2/3 h-16 xl:h-14 justify-center bg-background rounded-b-lg dropshadowCat">
            <ul class="flex space-x-2 h-14 xl:h-12 w-11/12 justify-center text-sm text-center align-middle">
                <li class="w-1/6"><a href="/services/index"><button
                            class="bg-buttons w-full h-14 xl:h-12 hover:bg-onhover p-1 pt-2 rounded-b-md">All</button></a>
                </li>

                <li class="w-1/6"><a href="/services/index/?category_id=1"><button
                            class="bg-buttons w-full h-14 xl:h-12 hover:bg-onhover p-1 pt-2 rounded-b-md">3D
                            Modelling</button></a></li>
                <li class="w-1/6"><a href="/services/index/?category_id=2"><button
                            class="bg-buttons w-full h-14 xl:h-12 hover:bg-onhover p-1 pt-2 rounded-b-md">2D
                            illustration</button></a></li>
                <li class="w-1/6"><a href="/services/index/?category_id=3"><button
                            class="bg-buttons w-full h-14 xl:h-12 hover:bg-onhover p-1 pt-2 rounded-b-md">Painting</button></a>
                </li>
                <li class="w-1/6"><a href="/services/index/?category_id=4"><button
                            class="bg-buttons w-full h-14 xl:h-12 hover:bg-onhover p-1 pt-2 rounded-b-md">SFX</button></a>
                </li>
                <li class="w-1/6"><a href="/services/index/?category_id=5"><button
                            class="bg-buttons w-full h-14 xl:h-12 hover:bg-onhover p-1 pt-2 rounded-b-md">Wood
                            Sculpt</button></a></li>
                <li class="w-1/6"><a href="/services/index/?category_id=6"><button
                            class="bg-buttons w-full h-14 xl:h-12 hover:bg-onhover p-1 pt-2 rounded-b-md">Logo
                            Design</button></a></li>
            </ul>
        </section>
    </nav>

    <main class="pt-20 w-full">

        {{-- message box --}}
        <x-flash-message />
        {{-- page contents --}}
        {{ $slot }}

    </main>
    @if (auth()->check())
        {{-- <div class="divide-y divide-neutral-200 mx-auto"> --}}
        <x-card-sec class="py-5 message-window-page">
            <details class="group">
                <summary class="flex items-center font-medium cursor-pointer list-none">
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                    <p>MESSAGES</p>
                </summary>
                <div class="message-window-open">
                    <div class="contacts-list">
                        <h2>Contacts</h2>
                        @foreach ($contactUsers as $contact)
                            <p id="contact"
                                class="{{ $contact->conversation_id == session('last_conversation') ? 'active-contact' : '' }}"
                                value="{{ $contact->conversation_id }}">
                                {{ $contact->name }}
                            </p>
                        @endforeach
                    </div>
                    <x-window />
                </div>
            </details>
        </x-card-sec>
        {{-- </div> --}}
    @endif
    <button class="scrollToTopButton">
        <i class="fa-solid fa-circle-up arrow-up"></i>
    </button>

    {{-- footer --}}
    {{-- static bottom-0 w-full flex flex-col items-center justify-center mt-10 --}}
    {{-- mt-10 causes space under footer --}}
    <footer class="w-full flex flex-col items-center justify-center">
        {{-- top part --}}
        <section class="bg-background w-max rounded-t-lg  dropshadowF mt-10">
            <div class="w-full flex justify-center p-2">
                <a href="/" class="customLogo">Craftkeis</a>
            </div>
        </section>
        <section class="flex flex-col bg-background w-full pt-5 dropshadowFB">

            <hr class="border-accent w-3/4 mx-auto my-2">
            {{-- logo and icons on left --}}
            <div class="flex flex-row justify-center w-full mt-4">


                {{-- links from website --}}
                <div class="flex flex-row gap-24 mx-24 xl:mx-32">
                    <a href="/about">About Us</a>
                    <a href="/contact">Contact</a>
                </div>

                <div class="justify-center">

                    {{-- social media icons --}}
                    <div class="text-xl space-x-2">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-linkedin"></i>
                    </div>
                </div>

                <div class="flex flex-row gap-24 mx-24 xl:mx-32">
                    <a href="/services/index">Services</a>

                    @auth

                        <a href="/users/{{ auth()->user()->id }}">Account</a>
                    @else
                        <p class="text-disabled">Account</p>

                    @endauth
                </div>
            </div>

        </section>

        {{-- bootom copyright part --}}
        <section class="flex justify-center bg-background pt-4 space-x-6 space-y-2 w-full">
            <hr>
            <a href="/login-as-user/3" class="btn btn-primary">
                Login as Maus Kaetti
            </a>
            <a href="/login-as-user/2" class="btn btn-primary">
                Login as John Doe
            </a>
        </section>
    </footer>

</body>

</html>
