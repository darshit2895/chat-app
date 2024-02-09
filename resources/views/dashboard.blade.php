<x-app-layout>

<div class="container-fluid chat-container">
        <!-- User List -->
        <div class="user-list">
            <h4 class="text-center mt-3">Users</h4>
            <ul class="list-group mt-3">
                @foreach($users as $user)
                    <li class="list-group-item user-list">
                        @if($user->image)
                            <img src="{{ $user->image}}" class="user-image cursour-pointer" >
                        @else 
                            <img src="{{ asset('images/dummy_image.jpg')}}" class="user-image cursour-pointer" >
                        @endif
                        {{ $user->name }} <span class="badge bg-success online-status" id="{{ $user->id }}-online">Online</span>
                        <span class="badge bg-danger offline-status hide" id="{{ $user->id }}-offline">Offline</span>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="chat-window click-user">
            
            <div class="bg-light p-3">
                <h4 class="text-center">Click On User to Chat!</h4>
            </div>
        </div>    

        <!-- Chat Window -->
        <div class="chat-window chat">
            
            <div class="bg-light p-3">
                <h4 class="text-center">Chat with User 1</h4>
            </div>
            <div class="chat-messages p-3">
                <!-- Example Message -->
                <div class="alert alert-primary" role="alert">
                    User 1: Hello there!
                </div>
            </div>
            <!-- Chat Input -->
            <div class="chat-input p-3">
                <form action="" id="chat-form">
                    <input type="text" class="form-control" placeholder="Type your message..." id="message" required>
                    <button class="btn btn-primary mt-2">Send</button>
                </form>
            </div>
        </div>
    </div>






    </div>

</x-app-layout>
