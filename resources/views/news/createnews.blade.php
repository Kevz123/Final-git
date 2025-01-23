@extends('layouts.app')

@section('title', 'Optic Clubs - Create News')


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
            background: linear-gradient(rgba(0,0,0,0.5), #128b9e94), url('{{ asset('images/createnews.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 650px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px; /* Adjust padding for more space */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column; /* Align children vertically */
            justify-content: center; /* Vertically center the form content */
            align-items: center; /* Horizontally center the form content */
            height: auto; /* Ensure container height adapts to content */
            min-height: 650px; /* Optional, to set a minimum height */
        }



        h1 {
            text-align: center;
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"], textarea, input[type="date"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
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
            <h1>Submit Event News</h1>
        </div>
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>

    <div id="ex"></div>
    <body>
        <div class="container">
            <h1>Event News Submission Form</h1>

            <form action="/submit-event" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">News Title:</label>
                    <input type="text" name="title" id="title" placeholder="Enter the event title" required>
                </div>

                <div class="form-group">
                    <label for="club_name">Club Name:</label>
                    <input type="text" name="club_name" id="club_name" placeholder="Enter the club name" required>
                </div>

                <div class="form-group">
                    <label for="status">Event Status:</label>
                    <select name="status" id="status" required>
                        <option value="upcoming">Upcoming Event</option>
                        <option value="completed">Completed Event</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Event Description:</label>
                    <textarea name="description" id="description" rows="4" placeholder="Write about the event..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="date">Event Date:</label>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="image">Upload Event Image:</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <button type="submit" class="submit-btn">Submit Event News</button>
            </form>
        </div>
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
