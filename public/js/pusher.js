var pusher = new Pusher('d281fdee1f0c3a13520b', {
    cluster: 'ap2'
  });

  var channel = pusher.subscribe('ChirpChat-development');
  channel.bind('my-noti', function(data) {
    $.ajax({
        url: "/liveNotifications",
        type: "POST",
        data: {
            id: data
        },
        success: function (noti) {
            if (noti != 0) {
                $('#total').show();
                $('#total').html(noti);
            }
            else {
                $('#total').hide();
            }
        }
    });
    //$('#total').html(data);
    // console.log(data);
  });