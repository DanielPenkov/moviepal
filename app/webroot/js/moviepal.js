
function PopupCenterDual(url, title, w, h) {
    // Fixes dual-screen position   Most browsers   Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}



function addToWatchedList(movie_id) {

      var data = movie_id;
   
     $.ajax({
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            type: "POST",
            url: '/moviepal/movies/addMovieWatchedList',
            data: JSON.stringify({id: data}),
            success: function (data){

                if(data == 'inserted'){

                    swal('Movie added to "Watched List"',"", "success");
                }
                else{

                        swal({ title: "Are you sure?",text: "",   
                            type: "info",  showCancelButton: true,   confirmButtonColor: "#DD6B55",  
                            confirmButtonText: "Yes, move it!",   cancelButtonText: "No, cancel!", 
                            closeOnConfirm: false,   closeOnCancel: false }, 
                            function(isConfirm){  if (isConfirm) {   window.location = "/moviepal/users";   } });

                }

        
     }
            
        });


}

function addToWatchingList(movie_id) {

      var data = movie_id;

     $.ajax({
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            type: "POST",
            url: '/moviepal/movies/addMovieWatchingList',
            data: JSON.stringify({id: data}),
            success: function (data){
                swal('Movie added to "Watching List"',"", "success");

            }
        });

}

function addFriend(user_id) {

    console.log(user_id);

      var data = user_id;

     $.ajax({
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            type: "POST",
            url: '/moviepal/users/sendFriendRequest',
            data: JSON.stringify({user_id: data}),
            success: function (data){

                swal({ title: "Do you want to add "+data+" to your friendslist?", 
                    text: "", type: "success", 
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, add it!",  
                    closeOnConfirm: false }, function(){ swal("Added!", data + " has been added", "success"); });

            }
        });

}