@extends('frontend.main_master')    
@section('main')


@php
$userId = auth()->user()->id; // Get the currently authenticated user's ID
  $bookings = App\Models\Booking::where('user_id', $userId)->latest()->get();


  $bookings = App\Models\Booking::where('user_id', $userId)->latest()->get();
  $pending = App\Models\Booking::where('user_id', $userId)
    ->where('status', '0')
    ->get();
  $complete = App\Models\Booking::where('user_id', $userId)
      ->where('status', '1')
      ->get();
  $totalPrice = App\Models\Booking::sum('total_price');

  $today = Carbon\Carbon::now()->toDateString();
  $todayprice = App\Models\Booking::whereDate('created_at',$today)->sum('total_price');

  $allData = App\Models\Booking::orderBy('id','desc')->limit(10)->get();

@endphp
 <!-- Inner Banner -->
 <div class="inner-banner inner-bg6">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>User Dashboard </li>
                    </ul>
                    <h3>User Dashboard</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Service Details Area -->
        <div class="service-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                     <div class="col-lg-3">
                       @include('frontend.dashboard.user_menu')
                    </div>


                    <div class="col-lg-9">
                        <div class="service-article">
                            

                            <div class="service-article-title">
                                <h2>User Dashboard </h2>
                            </div>

                            <div class="service-article-content">
                            <div class="row">

        <div class="col-md-4">
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Total Booking</div>
  <div class="card-body">
   <h1 class="card-title" style="font-size: 45px;">{{ count($bookings) }} Total</h1>
    
  </div>
</div>                   
         </div> 

             <div class="col-md-4">
<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header">Pending Booking </div>
  <div class="card-body">
    <h1 class="card-title" style="font-size: 45px;">{{ count($pending) }} Pending</h1>
    
  </div>
</div>                   
         </div>


             <div class="col-md-4">
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header">Complete Booking</div>
  <div class="card-body">
    <h1 class="card-title" style="font-size: 45px;">{{ count($complete) }} Completed</h1>
    
  </div>
</div>                   
         </div>




                                
                            </div>    
                               
                            </div>
 
                            
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
        <!-- Service Details Area End -->

@endsection