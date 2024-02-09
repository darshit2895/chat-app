<x-app-layout>

<div class="container-fluid chat-container">


         <!-- Notification Template -->
        <div id="notificationTemplate" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
            New Message
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- User List -->
        <div class="user-list">
            <h4 class="text-center mt-3">Users</h4>
            <ul class="list-group mt-3">
                @foreach($users as $user)
                    <li class="list-group-item" data-id="{{ $user->id }}">
                        @if($user->image)
                            <img src="{{ $user->image}}" class="user-image cursour-pointer" >
                        @else 
                            <img src="{{ asset('images/dummy_image.jpg')}}" class="user-image cursour-pointer" >
                        @endif
                        {{ $user->name }} <span class="badge bg-success online-status" id="{{ $user->id }}-online" style="display:none">Online</span>
                        <span class="badge bg-danger offline-status" id="{{ $user->id }}-offline">Offline</span>
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
                <h4 class="text-center">Chat Section</h4>
            </div>
            <div class="chat-messages p-3">
                <!-- Example Message -->
                <!-- <div class="alert alert-primary distance-user" role="alert">
                    User 1: Hello there!
                </div>

                <div class="alert alert-danger current-user" role="alert">
                    User 2: Hello there there!
                </div> -->
            </div>
            <!-- Chat Input -->
            <div class="chat-input p-3">
                <form action="" id="chat-form">
                    <input type="text" class="form-control" placeholder="Type your message..." id="message" required>
                    <button class="btn btn-primary mt-2 mr-5 float-right" type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>


    </div>

</x-app-layout>
