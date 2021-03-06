@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

        @if ( session('status') )
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Profile</div>
                <div class="card-body shadow-sm">
                    <div class="position-relative d-flex justify-content-between">
                        <div class="position-relative d-flex">
                            <div class="d-inline mr-4">
                                <img src="{{ asset('storage/profile_pictures/'.$user->profile_picture) }}" alt="No Image" srcset="" class="rounded-circle" style="width:120px; height:120px;">
                            </div>
                            <div class="d-inline">
                                <h3>{{ $user->username }}</h3>
                                <h6>{{ $user->email }}</h6>
                                <h6>{{ $user->address }}</h6>
                                <h6>{{ $user->birthday }}</h6>
                            </div>
                        </div>

                        <!-- validasi edit profile; tampilkan bila user sekarang adalah auth -->
                        @if(Auth::id() == $user->id)
                            <div class="d-inline">
                                <a class="btn btn-primary justify-content-end" href="/user/{{$user->id}}/update" role="button">Edit Profile</a>
                            </div>
                        @elseif( Auth::user()->role == "admin" )
                        <div class="d-inline">
                            <div class="d-block mb-1">
                                <a class="btn btn-primary justify-content-end" href="/admin/{{$user->id}}/edit" role="button">Edit {{ $user->username }}'s Profile</a>
                            </div>
                            <div class="d-block mb-1">
                                <a class="btn btn-success justify-content-end" href="{{ route('admin_view_user_questions', $user->id) }}" role="button">{{ $user->username }}'s Questions</a>
                            </div>
                            <div class="d-block">
                                <a class="btn btn-secondary justify-content-end" href="{{ route('admin_view_inbox', $user->id) }}" role="button">{{ $user->username }}'s Inbox</a>
                            </div>
                        </div>
                            
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <!-- validasi message; tampilkan bila user sekarang bukan auth -->
    @guest

    @else
        @if( Auth::id() == $user->id )

            @else
            <div class="row justify-content-center">
                <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Send Message to {{ $user->username }}</div>
                        <div class="card-body shadow-sm d-inline">
                            <form method="POST" action="{{ route('send_message', $user->id) }}">
                                @csrf
                                <textarea class="form-control d-inline" id="message_detail" rows="4" name="message_detail"></textarea>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Message') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endguest
</div>
@endsection
