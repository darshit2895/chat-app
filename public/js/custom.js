$.ajaxSetup({
    headers : {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('.list-group-item').on('click', function() {
        var getUserId = $(this).attr('data-id');
        receiver_id = getUserId;
        $('.click-user').hide();
        $('.chat-messages').append('');
        loadOldChats(sender_id, receiver_id);
        $('.chat').show();
    });


    // loadOldChats

    function loadOldChats() {
        $.noConflict();
        $.ajax({
            url: '/load-chats',
            type: 'POST',
            data: {
                sender_id: sender_id,
                receiver_id: receiver_id
            },
            success: function(res) {
                if(res.success) {
                    $('.chat-messages').append('');
                    if(res.data.length) {
                        let html = '';
                        for(let i = 0; i < res.data.length; i++) {
                            if(res.data[i].sender_id == sender_id) {
                                html+= `<div class="alert alert-danger current-user col-md-9 float-right" role="alert">${res.data[i].message}</div>`;
                            } else {
                                html+= `<div class="alert alert-primary distance-user col-md-9 float-left" role="alert">${res.data[i].message}</div>`;
                            }
                        }
                        $('.chat-messages').append(html);
                        toastr.success('Old Messages Loaded successfully.', `Loading`);
                    }
                } else {
                    $('.chat-messages').append('');
                    alert(res.msg);
                }
            }
        });
    }


    //save Chat
    $('#chat-form').submit(function(e) {
        e.preventDefault();
        var message = $('#message').val();
        if(message!= '' && receiver_id!= '' && sender_id!= '') {
            $.ajax({
                url: '/save-chat',
                type: 'POST',
                data: {
                    message: message,
                    receiver_id: receiver_id,
                    sender_id: sender_id
                },
                success: function(res) {
                    if(res.success) {
                        let html = `<div class="alert alert-danger current-user col-md-9 float-right" role="alert">${res.data.message}</div>`;
                        $('.chat-messages').append(html);
                    } else {
                        alert(res.msg);
                    }
                    $('#message').val('');
                }
            });
        }
    });
    
});


Echo.join('status-update')
.here((users) => {
    for(let i = 0; i < users.length; i++) {
        if(sender_id != users[i].id) {
            $("#"+users[i].id+'-online').show();
            $("#"+users[i].id+'-offline').hide();    
        }
    }
})
.joining((user) => {
    $("#"+user.id+'-online').show();
    $("#"+user.id+'-offline').hide();
})
.leaving((user) => {
    $("#"+user.id+'-online').hide();
    $("#"+user.id+'-offline').show();
})
.listen('UserStatusEvent',(user) => {
        
});



Echo.private('broadcast-message')
.listen('.getChatMessage', function(data) {
    if(sender_id == data.chat.receiver_id && receiver_id == data.chat.sender_id) {
        let html = `<div class="alert alert-primary distance-user col-md-9 float-left" role="alert">${data.chat.message}</div>`
        $('.chat-messages').append(html);
    }
    if(sender_id == data.chat.receiver_id && receiver_id == undefined) {
        toastr.success(data.chat.message, `New Message From ${data.sederName.name}`);
    }
})