window.onload = function () {
    tinymce.init({  selector:'#news-content',
                    height: 300,
                    theme: 'modern',
		    menubar: false,
                    plugins: [
                        'lists link image',
                    ],
                    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | lists link image',
                    });

    // let filter = $('#menuFilter');
    // let drag = $('.drag');
    //
    // if(filter.length!=0){
    //     filter.change(function () {
    //         location.replace(`/menu/items/${$(this).find('option:selected').val()}`);
    //     })
    // }
    //
    // if(drag.length!=0){
    //     drag.sortable({
    //         group: 'drag',
    //         flag : false,
    //         containerSelector : 'tbody',
    //         itemSelector : 'tr',
    //         placeholder : '<tr class="placeholder"></tr>',
    //         handle: '',
    //         onDrop: function ($item, container, _super) {
    //             if(!this.flag){
    //                 let sendButton = $('<span id="sendSort"></span>').text('Сохранить порядок').addClass('btn btn-danger');
    //                 sendButton.click(sendData)
    //                 $('.buttons:eq(0)').append(sendButton);
    //             }
    //
    //             _super($item, container);
    //             this.flag = true;
    //
    //             function sendData(dataJson) {
    //                 console.log(JSON.stringify(drag.sortable("serialize").get(), null, ' '));
    //                 $.ajax({
    //                     url : "/menu/items/sort",
    //                     data: {
    //                         json : JSON.stringify(drag.sortable("serialize").get(), null, ' ')
    //                     },
    //                     success : function (data) {
    //                         if(data.status) {
    //                             $("#message").removeClass('hide').text('Порядок сохранен');
    //                             setTimeout(function () {
    //                                 $("#message").addClass('hide').text('');
    //                             },4000)
    //                         }
    //                     }
    //                 })
    //             }
    //         }
    //     });
    // }


}