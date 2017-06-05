/**
 * Created by Administrator on 05-Apr-17.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    var boxChat = $('.box-chat');
    //Thanh scroll luôn kéo xuống dưới cùng để hiện nội dụng mới nhất
    boxChat[0].scrollTop = boxChat[0].scrollHeight;

    $('#interview-message-send').click(function(event) {
        var msgContent = $('.message-content').val();
        $.post('chat',
            {
                msgContent: msgContent
            },
            function(data) {

            });
    });
    Echo.join('chatroom.' + 1)
    // lắng nghe sự kiện từ Event MessagePosted, e là Object trả về những dữ liệu chúng ta đã truyền trong __contruct, $message và $user
    //Vậy là chúng ta đã có tin nhắn va thông tin người gửi nhiệm vụ chúng ta bây giờ là append html vào box chat
        .listen('MessagePosted', (e) => {
        boxChat.append(e.message);
    boxChat[0].scrollTop = boxChat[0].scrollHeight;
})
});

