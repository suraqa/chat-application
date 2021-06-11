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
                                    <li class=""> <!-- Add active class -->
                                        <a href="{{ route('conversation', $user['id']) }}">
                                            <div class="d-flex mt-3 align-items-center user-list-item">
                                                <div class="user-image bg-primary text-white text-center">
                                                    {{ getInitialsFromName($user->name) }}
                                                    <i class="fa fa-circle user-status-icon"></i>
                                                </div>
                                                <div class="user-name ml-3">
                                                    {{ $user->name }}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <div class="chat-section">
                        <div class="chat-header bg-white">
                            <div class="d-flex mt-3 align-items-center user-list-item">
                                <div class="user-image bg-primary text-white text-center">
                                    {{ getInitialsFromName($userToChat->name) }}
                                    <i class="fa fa-circle user-status-icon"></i>
                                </div>
                                <div class="user-name ml-3">
                                    <strong>{{ $userToChat->name }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="chat-body bg-white">
                            <div class="messages-list">
                                <div class="d-flex mt-3 align-items-center user-list-item">
                                    <div class="user-image bg-primary text-white text-center">
                                        {{ getInitialsFromName(Auth::user()->name) }}
                                        <i class="fa fa-circle user-status-icon"></i>
                                    </div>
                                    <div class="user-name ml-3">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <br>
                                        <span class="small" id="time" title="08-06-2021 10:00:00 PM">10:00 PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-input">
                            <div class="text-area bg-white" contenteditable></div>
                        </div>
                        <div class="chat-toolbar">

                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>

    {{-- @push('socket.io')
        <script src="https://cdn.socket.io/4.1.1/socket.io.min.js"></script>
        <script>
            // $(() => {
            //     const socket = io("127.0.0.1:3000");
            //     socket.on("connect", () => {
            //         console.log(socket.id);
            //     });
            //     // socket.emit("abc", 123)
            //     // socket.on("user_connected", id => {
            //     //     console.log(id)
            //     // })
            // })

        </script>
    @endpush --}}
@endsection
