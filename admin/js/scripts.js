//summer note config
$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true 
    });
  });

//checkbox config
$(document).ready(function(){
$('#selectAllBoxes').click(function(event){
  if(this.checked){
    $('.checkBox').each(function(){
      this.checked=true;
    });

  }else{
    $('.checkBox').each(function(){
      this.checked=false;
    });
  }
});

//  loading page to page
var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$("body").prepend(div_box);
$('#load-screen').delay(200).fadeOut(200, function(){
  $(this).remove();

});

  });
//load user online
  function loadUsersOnline() {
    $.get("function.php?onlineusers=result", function(data){

    $(".usersonline").text(data);

});
}

setInterval(function(){
  loadUsersOnline();

},500);
 
  