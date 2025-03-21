@extends('layouts.app')

@section('title', 'Optic Clubs - Non physical Clubs')

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
            background: linear-gradient(rgba(0,0,0,0.5), #128b9e94), url('{{ asset('images/nonphysical.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
    </style>

    <section id="bannerdi">
        <div class="navbar">
            <!-- <img src="{{ asset('images/logo.png') }}" alt="Optic Logo" class="logo"> -->
        </div>
        <div class="hero">
            <h1>Non Physical Clubs</h1>
        </div>
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>

    <div id="ex"></div>
    <br>
    <br>

    <div class="center-wrapper" style="display: flex; justify-content: center; padding: 20px; margin-top: -70px;">
        <div class="club-list">
            <h1 style="display: flex; justify-content: center;font-family: Arial, sans-serif; font-weight: bold; font-size: 2.5rem; margin-top: 40px; margin-bottom: 20px; color:rgb(255, 255, 255);">
                Non Physical Clubs
            </h1>

            <div class="search-container" style="text-align: center; margin-bottom: 20px;">
                <form action="{{ route('clubs.nonPhysical') }}" method="GET" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                    <input type="text" name="search" placeholder="Search for clubs..." value="{{ request('search') }}" 
                        style="padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
                    
                    <select name="sort" style="padding: 10px; width: 150px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
                        <option value="">Sort by Size</option>
                        <option value="small" {{ request('sort') == 'small' ? 'selected' : '' }}>Small</option>
                        <option value="medium" {{ request('sort') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="large" {{ request('sort') == 'large' ? 'selected' : '' }}>Large</option>
                    </select>
                    
                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px;">Search</button>
                </form>
            </div>


            <div class="clubsowner-container">
                @foreach($clubs as $club)
                    <div class="club-card">
                        <!-- Display Club Image or Fallback Text -->
                        
                            <img src="{{ asset('storage/' . $club->main_image) }}" alt="{{ $club->name }}" class="club-image">
                        
                        <!-- Club Name and Join Button -->
                        <h2>{{ $club->name }}</h2>
                        <form action="{{ route('clubs.show', ['club_id' => $club->club_id]) }}" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-primary">View</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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
@endsection