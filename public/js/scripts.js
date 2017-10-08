$( document ).ready(function() {
    var postId = 0;
    var postBodyElement = null;
    $('.post .interaction .editPost-Btn').on('click', function (event) {
        event.preventDefault();
        var target = $(this);
        postBodyElement = target.closest('.post').find('.post-body');
        var postBody = postBodyElement.text();
        postId = target.closest('.post').data('id');
        $('#modal-postBody').val(postBody);
        $('#editPost-modal').modal();
    });

    $('#editPost-saveBtn').on('click', function () {
       $.ajax({
          method: 'POST',
           url: url,
           data: {
               body: $('#modal-postBody').val(),
               postId: postId,
               _token: token
          }
       })
        .done(function (msg) {
           $(postBodyElement).text(msg['new_body']);
            $('#editPost-modal').modal('hide');
        });
    });
});