@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid">
       
        <div class="card card-body blur shadow-blur ">
           
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ __('Notification ') }}
                    </h5>
                    
                </div>



            </div>
            <div class="card-body pt-4 p-3">
               @php auth()->user()->unreadNotifications()->update(['read_at' => now()]) @endphp
                @foreach (auth()->user()->notifications as $notification) 
                <div class="alert alert-secondary text-white" role="alert">
                    <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">You have new deficieneis</span>
                        <br>
                        <span class="font-weight-bold">{{$notification->data['note']}}</span>    
                        <br> created by {{$notification->data['user_created']}}
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        {{$notification->created_at}}
                    </p>
                </div>
                @endforeach
                @if(auth()->user()->notifications->count() == 0)
                <div class="alert alert-secondary text-white" role="alert">
                    <strong>EMPTY !</strong>
                    
                </div>
                @endif
            </div>
        </div>
       
    </div>
    
</div>
@endsection