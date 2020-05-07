@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Recent Updates</div>

                <div class="card-body">
                    <form action="" method="POST">
                        <textarea name="body" rows="3" class="form-control" placeholder="kolo ya waleed"></textarea>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
                <hr>
                <div class="card-body">
                    @foreach ($messages as $message)
                    <h5><a href="\u\{{ $message->user->id }}">{{$message->user->name}}</a></h5>
                    {{ $message->body }}
                    <br>

                    <small>{{ $message->created_at->diffForHumans() }}</small>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Notifications
                </div>
                <div class="card-body">
                    @foreach(Auth::user()->notifications as $notification)
                    <h5><a href="/u/{{$notification->data['user_id']}}">{{ $notification->data['user_name']}}</a>started
                        following you.</h5>
                    <p>{{ $notification->created_at->diffForHumans()}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection