@extends('layouts.app')

@section('title', 'Optic Clubs - Home')

@section('content')
    @vite('resources/css/styles.css')
    @vite('resources/js/calendar.js')

    {{-- Flash Message Display --}}
    @if (session('status'))
    <div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
        {{ session('status') }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
    @endif

    <!-- Banner Section -->

    <style>
        #banner {
            background: linear-gradient(rgba(0,0,0,0.5), #128b9e94), url('{{ asset('images/home back.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .upcoming-events-container {
            width: 66%;
            background-color:rgb(249, 249, 249);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-card {
            flex: 0 0 auto; /* Ensures horizontal alignment */
            width: calc(33.33% - 20px); /* Ensures three cards fit in a row with spacing */
            background: linear-gradient(to bottom, #6fa3e4, #ffffff); /* Blue-to-white vertical gradient */
            border-radius: 10px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            padding: 15px;
            text-align: center;
        }

        .event-card img {
            width: 300px; /* Preserved width */
            height: 200px; /* Preserved height */
            object-fit: cover;
            border-radius: 5px;
        }

        .join-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .join-button:hover {
            background-color: #45a049;
        }

        /* Highlight days with events */
        .calendar-day.highlighted {
            background-color: #ffcc00;
            color: white;
            border-radius: 50%;
            font-weight: bold;
        }

        /* Tooltip style */
        .tooltip {
        position: absolute;
        background-color: #333;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        z-index: 1000;
        white-space: nowrap;
        }

        .slider {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            scrollbar-width: none; /* Hides scrollbar in Firefox */
            -ms-overflow-style: none; /* Hides scrollbar in IE */
        }

        .slider::-webkit-scrollbar {
            display: none; /* Hides scrollbar in Chrome and Safari */
        }

        


    </style>

    <section id="banner">
        <div class="navbar">
            <br><br><br><br>
        </div>

        <!-- Hero Section -->
        <div class="hero1">
            <p>Optic is your gateway to a vibrant community of sports enthusiasts, promoting all indoor and outdoor sports...</p>
        </div>

        <!-- Explore Button -->
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>
    <br>
    <br>

    <!-- Main Content -->
    <main>
        <div id="ex"></div>
        <div class="events-section" style="display: flex; justify-content: center; gap: 20px;">
    
            <!-- Calendar Container -->
            <div class="calendar-container" style="width: 30%; background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Calendar</h2>
                <br>
                <div class="calendar">
                    <div class="calendar-header">
                        <button onclick="prevMonth()">&#9664;</button>
                        <div id="month-year">October 2024</div>
                        <button onclick="nextMonth()">&#9654;</button>
                    </div>
                    <div class="calendar-weekdays">
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                        <div>Sun</div>
                    </div>
                    <div class="calendar-days" id="calendar-days">
                        <!-- JS will populate days -->
                    </div>
                </div>
            </div>
            
            <!-- Upcoming Events Container -->
            <div class="upcoming-events-container">
                <h1 style="margin-bottom: 20px;font-weight: bold; font-size: 1.5rem;">Upcoming Events</h1>
                <div class="slider">
                    @foreach($events as $event)
                    <div class="event-card">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_name }} Event"> <br>
                        <h3>{{ $event->event_name }}</h3>
                        <p><strong>Date:</strong> {{ $event->event_date->format('F j, Y') }}</p>
                        <p><strong>Time:</strong> {{ $event->start_time }}</p>
                        <p><strong>Venue:</strong> {{ $event->venue->venue_name ?? 'TBA' }}</p><br>

                        <a href="{{ route('events.show', $event->event_id) }}">
                            <button class="join-button" style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">View</button>
                        </a>

                        <!-- Only show remove button if the user is logged in and has role 2 -->
                        @if(Auth::check() && Auth::user()->role == 2)
                            <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="join-button" style="background-color:rgb(49, 92, 166); color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Remove</button>
                            </form>
                        @endif
                    </div>


                    @endforeach
                </div>
                <br>
                <br>
            </div>
        </div>
        
    </main>
    <br>
    <br>
    <br>


    <!-- Footer Section -->
    <footer style="background:linear-gradient(rgba(0,0,0,0.5),#0066cc), url('{{ asset('images/background.jpeg') }}'); padding: 60px; display: flex; justify-content: space-around;">
        <div class="footer-content" style="display: flex; justify-content: space-around; gap: 20px; width: 100%;">
            <!-- Footer Logo -->
            <div class="footer-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Optic Clubs Logo" class="logo" style="width: 150px; height: auto; margin-right: 100px;">
            </div>
    
            <!-- Footer Text -->
            <div class="footer-text" style="width: 40%; margin-left: -200px;">
                <h1>Terms & Conditions</h1><br>
                <p>"Welcome to Optic, your gateway to a vibrant community of sports enthusiasts! By accessing and using our platform, you agree to comply with the following terms and conditions, which are designed to ensure a safe, inclusive, and enjoyable experience for all users. Optic promotes participation in both indoor and outdoor sports, connecting individuals, teams, and clubs to foster a thriving community."</p>
            </div>
    
            <!-- Social Media Links -->
            <div class="social-media">
                <a href="#"><img src="{{ asset('images/instagram-removebg-preview.png') }}" class="logo1" alt="Instagram" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/facebook-removebg-preview.png') }}" class="logo1" alt="Facebook" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/twitter-removebg-preview.png') }}" class="logo1" alt="Twitter" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/youtube-removebg-preview.png') }}" class="logo1" alt="YouTube" style="width: 30px; height: auto;"></a>
            </div>
        </div>
    </footer>

    <!-- JavaScript for Calendar -->
    <script>
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth(); // Current month (0-11)
        let currentYear = currentDate.getFullYear(); // Current year (YYYY)

        const events = @json($events); // Pass the upcoming events to JavaScript

        function renderCalendar() {
            const monthYear = document.getElementById("month-year");
            const calendarDays = document.getElementById("calendar-days");

            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            monthYear.innerHTML = `${monthNames[currentMonth]} ${currentYear}`;

            calendarDays.innerHTML = "";

            const firstDay = new Date(currentYear, currentMonth, 1);
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const firstDayWeekday = firstDay.getDay();

            // Create empty day elements for the first week (if the month doesn't start on Sunday)
            for (let i = 0; i < firstDayWeekday; i++) {
                const emptyDay = document.createElement("div");
                emptyDay.classList.add("calendar-day");
                calendarDays.appendChild(emptyDay);
            }

            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement("div");
                dayElement.classList.add("calendar-day");
                dayElement.innerText = day;

                // Check if there is an event on this day
                const event = events.find(event => new Date(event.event_date).getDate() === day &&
                                                    new Date(event.event_date).getMonth() === currentMonth && 
                                                    new Date(event.event_date).getFullYear() === currentYear);

                if (event) {
                    dayElement.classList.add("highlighted"); // Add a class to highlight the day
                    dayElement.setAttribute("data-events", event.event_name); // Add event name as a data attribute
                }

                calendarDays.appendChild(dayElement);
            }
        }

        document.getElementById("calendar-days").addEventListener("mouseover", function (e) {
            if (e.target.classList.contains("calendar-day") && e.target.hasAttribute("data-events")) {
                const eventName = e.target.getAttribute("data-events");

                // Create tooltip
                const tooltip = document.createElement("div");
                tooltip.classList.add("tooltip");
                tooltip.innerText = eventName;
                document.body.appendChild(tooltip);

                // Position the tooltip dynamically
                const rect = e.target.getBoundingClientRect();
                tooltip.style.left = `${rect.left + window.scrollX + rect.width / 2 - tooltip.offsetWidth / 2}px`;
                tooltip.style.top = `${rect.top + window.scrollY - tooltip.offsetHeight - 10}px`;

                // Attach the tooltip element to the target
                e.target.tooltipElement = tooltip;
            }
        });

        document.getElementById("calendar-days").addEventListener("mouseout", function (e) {
            if (e.target.classList.contains("calendar-day") && e.target.tooltipElement) {
                e.target.tooltipElement.remove();
                delete e.target.tooltipElement;
            }
        });


        // Calendar navigation buttons
        // Calendar navigation buttons
        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            // Update the current date to match the updated month and year
            currentDate = new Date(currentYear, currentMonth, 1);
            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            // Update the current date to match the updated month and year
            currentDate = new Date(currentYear, currentMonth, 1);
            renderCalendar();
        }

        renderCalendar();
    </script>


@endsection
