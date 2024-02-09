$(document).ready(function() {

    $('.user-list').on('click', function() {
        $('.click-user').hide();
        $('.chat').show();
    });

    
});

Window.onLoad = function() {

Echo.join('status-update')
    .here((user) => {
        
    })
    .listen('UserStatusEvent', (e) => {
        console.log('hdadads');
    })
}