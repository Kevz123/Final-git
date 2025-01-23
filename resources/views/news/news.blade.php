@extends('layouts.app')

@section('title', 'Optic Clubs - News')

@section('content')
@vite('resources/css/styles.css')

{{-- Flash Message Display --}}
    @if(session('success'))
    <div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" style="color: red; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
    @endif

    <style>
        #bannerdi {
            background: linear-gradient(rgba(0,0,0,0.5), #128b9e94), url('{{ asset('images/home back.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
        h1 {
            text-align: center;
            font-size: 2rem;
            color: #ffffff;
            margin-top: 20px;
        }
        .news-cards {
            display: flex; /* Use flexbox for horizontal layout */
            flex-wrap: nowrap; /* Prevent wrapping to the next line */
            gap: 20px; /* Horizontal gap between the cards */
            overflow-x: auto; /* Add horizontal scrolling if needed */
            margin-top: -80px;
            margin-left:-100px;
            margin-right:-100px;
            height: 600px;
        }

        .news-card {
            background-color: #ffffff;
            border-radius: 12px;
            border: 2px solid #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            overflow: auto;
            flex: 0 0 auto; /* Prevent cards from shrinking and allow them to stay side-by-side */
            width: 300px; 
            height: 500px;/* Optional: Set a fixed width for the cards */
        }


        .news-card:hover {
            transform: scale(1.05);
        }
        .news-card img {
            width: 300px;
            height: 200px;
            
        }
        .news-card-content {
            padding: 20px;
        }
        .news-card h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }
        .news-card p {
            margin: 5px 0;
            font-size: 1rem;
            color: #666;
        }

    </style>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event News Submission Form</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <section id="bannerdi">
        <div class="navbar">
            <br><br><br><br>
        </div>
        <div class="hero">
            <h1>Optic News</h1>
        </div>
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>

    <div id="ex"></div>

    <h1>Latest News</h1>
    <div class="container">
        
        @if($news->isEmpty())
            <p style="color: white;">- No news available -</p>
        @else
        @foreach($news as $item)
            <div class="news-card">
                @if($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="Event Image">
                @else
                    <img src="{{ asset('images/default-news.jpg') }}" alt="Default Image">
                @endif
                <div class="news-card-content">
                    <h2>{{ $item->title }}</h2>
                    <p><strong>Club Name:</strong> {{ $item->club_name }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
                    <p><strong>Date:</strong> {{ $item->date }}</p>
                    <p>{{ $item->description }}</p>
                    
                    <!-- Remove Button (Only visible to users with role 2) -->
                    @if(Auth::user() && Auth::user()->role == 2)
                        <form action="{{ route('news.remove', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this news?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="background-color: #e74c3c; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">
                                Remove
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        @endif
    </div>


    <!-- Footer Section -->
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
