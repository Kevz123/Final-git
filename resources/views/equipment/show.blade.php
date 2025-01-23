@extends('layouts.app')

@section('title', 'Optic Clubs - Booking')


@section('content')


    {{-- Flash Message Display --}}
@if(session('success'))
    <div class="alert alert-success" style="color: green; padding: 30px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="color: red; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif

<style>
    * {
    scrollbar-width: none; /* For Firefox */
    -ms-overflow-style: none; /* For Internet Explorer and Edge */
}

/* For WebKit browsers (Chrome, Safari, etc.) */
*::-webkit-scrollbar {
    display: none;
}
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    h1 {
        color: #0066cc;
        text-align: center;
        margin-bottom: 20px;
        font-size: 36px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 30px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .location-info img {
        display: block;
        margin: 0 auto 20px;
        max-width: 100%;
        border-radius: 8px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    table thead tr {
        background-color: #0066cc;
        color: #ffffff;
        text-align: center;
        font-weight: bold;
    }

    table th, table td {
        padding: 15px;
        border: 1px solid #dddddd;
    }

    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    table button {
        background-color: #0066cc;
        color: #ffffff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    table button:hover {
        background-color: #005bb5;
    }

    table input[type="number"] {
        width: 60px;
        padding: 5px;
        border: 1px solid #cccccc;
        border-radius: 4px;
    }

    .alert {
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }

    /* Footer Styles */
    footer {
        background: linear-gradient(rgba(0, 0, 0, 0.5), #0066cc), url('{{ asset('images/background.jpeg') }}') no-repeat center center;
        background-size: cover;
        padding: 40px;
        color: white;
    }

    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        gap: 20px;
    }

    .footer-logo img {
        width: 150px;
        margin-right: 20px;
    }

    .footer-text {
        max-width: 600px;
    }

    .footer-text h1 {
        font-size: 24px;
        color: #ffcc00;
        margin-bottom: 10px;
    }

    .footer-text p {
        line-height: 1.6;
    }

    .social-media a {
        display: inline-block;
        margin: 5px;
        transition: transform 0.3s ease;
    }

    .social-media img {
        width: 30px;
        height: auto;
    }

    .social-media a:hover img {
        transform: scale(1.2);
    }
</style>


<div class="container">
    <div class="location-info">
        <h1>{{ $location->shop_name }}</h1>
        <img src="{{ asset('images/locations/' . $location->image) }}" alt="{{ $location->shop_name }}">
    </div>    
    <table>
        <thead>
            <tr>
                <th>Equipment Name</th>
                <th>Description</th>
                <th>Quantity Available</th>
                <th>Price Per Item</th>
                <th>Bookings</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($location->equipment as $equipment)
            <tr>
                <td>{{ $equipment->name }}</td>
                <td>{{ $equipment->description }}</td>
                <td>{{ $equipment->quantity_available }}</td>
                <td>{{ $equipment->price }}</td>
                <td>
                    @if ($equipment->quantity_available > 0)
                        <form method="POST" action="{{ route('bookings.store') }}">
                            @csrf
                            <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">
                            <input type="number" name="quantity_booked" min="1" max="{{ $equipment->quantity_available }}">
                            <button type="submit">Book</button>
                        </form>
                    @else
                        <span>Sold Out</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div><br>



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
