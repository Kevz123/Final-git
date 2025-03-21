@extends('layouts.app')

@section('title', 'Optic Clubs - Single Event Page')

@section('content')
@vite('resources/css/styles.css')

    
@if (session('success'))
<div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger" style="color: red; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 15px;">
    {{ session('error') }}
</div>
@endif


<style>
.img-center {
    display: flex;
    justify-content: center; 
    align-items: center;    
    height: 50vh;           
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem;
    background: #cce5ff;
    color: #333; 
}

h2, h3{
    font-weight: bold;
    font-size: 28px;
    color: #333;
}

.event-row {
  font-size: 20px;
  display: grid;
  grid-template-columns: 1fr 2fr;
  margin-bottom: 10px;
}

.event-label {
  font-weight: bold;
  text-align: right;
  padding-right: 10px;
}

.event-value {
  text-align: left;
  padding-left: 10px;
}
.club-header h1 {
    color: black;
    justify-content: right;
    font-size: 40px;
}
.club-content {
    display: flex;
    align-items: center;
    margin-top: 1rem;
}
.club-image3 img {
    border-radius: 10px;
    width: 500px;
    height: 300px;
}
/* Club Info Section */
.club-info {
    display: flex;
    gap: 1rem;
    margin-top: 10px
}

.club-info a {
    text-decoration: none;
    display: inline-block;
    padding: 0.5rem 1.5rem;
    border-radius: 5px;
    background-color:rgb(59, 107, 158);
    color: #fff;
    font-weight: bold;
    text-align: center;
    transition: background 0.3s ease;
}



.club-info a span {
    font-size: 1rem;
    font-family: Arial, sans-serif;
}
/* About Us Section */
.about-us {
    /* background-color:rgb(141, 193, 248); */
    background: linear-gradient(to left, #cce5ff,rgb(137, 190, 255), #cce5ff);
    padding: 1rem;
    width: 65%;
    margin-left: -600px;
    border-radius: 5px;
    margin-top: 1rem;
}
.reserve-btn {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    background-color: #007BFF;
    color: white;
    cursor: pointer;
}

.sold-out {
    color: red;
    font-weight: bold;
}
body {
    font-family: Arial, sans-serif;
    text-align: center;
}

table {
    width: 60%;
    margin: 20px auto;
    margin-right: -600px;
    border-collapse: collapse;
    color: black;
}
.Events {
    background: linear-gradient(to left, #cce5ff,rgb(137, 190, 255), #cce5ff);

}
.Events h2 {
    margin-top: -480px;
    margin-right: -900px;
}


th, td {
    border: 1px solid #ddd;
    padding: 20px;
    text-align: center;
    background-color:rgb(159, 200, 243);
}

th {
    background-color:rgb(117, 198, 249);
}


</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".reserve-btn");

    // Assuming this variable is set in the Blade template
    const isUserLoggedIn = {{ auth()->check() ? 'true' : 'false' }}; 

    buttons.forEach((button) => {
        button.addEventListener("click", (event) => {
            if (!isUserLoggedIn) {
                alert("You must be logged in to reserve an event.");
                window.location.href = "/login"; // Redirect to the login page
                return;
            }

            const row = button.closest("tr");
            const seatsCell = row.querySelector(".seats");
            let availableSeats = parseInt(seatsCell.textContent);

            if (availableSeats > 0) {
                const reservationCode = Math.floor(1000 + Math.random() * 9000);
                alert(`You have successfully reserved your spot! Your reservation code is: ${reservationCode}. Please bring in this code to purchase your reservation at the event.`);
                availableSeats--;

                if (availableSeats === 0) {
                    seatsCell.textContent = "Sold Out";
                    seatsCell.classList.add("sold-out");
                    button.disabled = true;
                } else {
                    seatsCell.textContent = availableSeats;
                }
            }
        });
    });
});

</script>
<body>
    <main>
        <section class="club-header">
            <h1>{{ $event->club->name }}</h1>
        </section>
        <section class="club-content">
            <div class="club-image3">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_name }}" class="img-center"/>
            </div>
        </section>

        <section class="club-info">
            <!-- <a href="#ex1"><span>About Event</span></a>
            <a href="#ex2"><span>Reserve Event</span></a> -->
        </section><br>

        <section class="about-us">
            <div id="ex1"></div>
            <h3>About Event</h3><br>
            
            <div class="event-row">
                <span class="event-label">Event Name :</span>
                <span class="event-value">{{ $event->event_name }}</span>
            </div>
            <div class="event-row">
                <span class="event-label">Event Description :</span>
                <span class="event-value">{{ $event->description }}</span>
            </div>
            <div class="event-row">
                <span class="event-label">Date :</span>
                <span class="event-value">{{ $event->event_date->format('F d, Y') }}</span>
            </div>
            <div class="event-row">
                <span class="event-label">Time :</span>
                <span class="event-value">{{ $event->start_time }}</span>
            </div>
            <div class="event-row">
                <span class="event-label">Venue :</span>
                <span class="event-value">{{ $event->venue->venue_name }}</span>
            </div><br>
        </section>

        <section class="Events"><br>
            <div id="ex2"></div>

            <h2>Event Reservation</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Price</th>
                            <th>Available Seats</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($event->price_ranges))
                            @foreach ($event->price_ranges as $price => $seats)
                                <tr>
                                    <td>${{ $price }}</td>
                                    <td class="seats">{{ $seats }}</td>
                                    <td>
                                    <form action="{{ route('events.reserve', ['event' => $event->event_id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="price" value="{{ $price }}">
                                        <button type="submit" class="reserve-btn">Reserve</button>
                                    </form>
                                    

                                        <!-- <form action="{{ route('events.reserve', $event->event_id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="price" value="{{ $price }}">
                                            <button type="submit" class="reserve-btn">Reserve</button>
                                        </form> -->
                                        
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No price ranges available for this event.</td>
                            </tr>
                        @endif
                    </tbody>


                </table> 
        </section>
    </main>
</main>
</body>


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
@endsection