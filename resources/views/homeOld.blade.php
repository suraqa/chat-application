@extends('layouts.app')

@section('content')
    <section class="home-page">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="users">
                        <h3>Users</h3>
                        <ul class="list-group">
                            @if ($users->count())
                                @foreach ($users as $user)
                                    <li class="">
                                        <!-- Add active class -->
                                        <a href="{{ route('conversation', $user['id']) }}">
                                            <div class="d-flex mt-3 align-items-center user-list-item">
                                                <div class="user-image bg-primary text-white text-center">
                                                    {{ getInitialsFromName($user->name) }}
                                                </div>
                                                <div class="user-status-icon">
                                                    <i class="fa fa-circle"></i>
                                                </div>
                                                <div class="user-name ml-3">
                                                    {{ $user->name }}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    No users to chat with
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-6"></div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>
@endsection
