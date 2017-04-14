$(document).ready(function() {
  // Validate Form
  function validate(){
      var category_name = document.forms["frmCategory"]["category_name"];
      if(text_validate(category_name)){
       return true;
     }
     else {
       return false;
     }
     return false;
   }
  // Select all check box
    $('#selectall').click(function(event) { 
        if(this.checked) { 
            $('.checkbox').each(function() {
                this.checked = true;               
              });
          }else{
            $('.checkbox').each(function() {
                this.checked = false;                      
              });         
          }
    });

    // Show alert
    setTimeout(function(){
      $('.alert').fadeOut(function() {
        window.location = window.location.href;
      });
    }, 2000);

    // Open new tag
    $("#new_tag").change(function(){
      if(this.checked == true){
        $(".tag_text").css("display", "inline");
        $("input[name='tag']").attr('disabled',true);
      }
      else {
        $(".tag_text").css("display", "none");
        $("input[name='tag']").attr('disabled',false);
      }
    });

    // Tag cloud
    var colors = ['#61BD6D', '#1ABC9C', '#54ACD2', '#2C82C9', '#9365B8', '#475577', '#FAC51C', '#F37934', '#D14841', '#B8312F'];
    var minFontSize = 20;
    var maxFontSize = 40;
    $('span#tag a').each(function(e) {
      $(this).css("fontSize", randomNumberGenerator(minFontSize, maxFontSize));
      $(this).css("color", colors[Math.floor(Math.random() * colors.length)]);
    });
    $('span#tag a').hover(function(e) {
      $(this).css("color", "white");
    }, function(){
      $(this).css("color", colors[Math.floor(Math.random() * colors.length)]);
    });
    function randomNumberGenerator(min,max)
    {
      return Math.floor(Math.random()*(max-min+1)+min);
    }

	// Edit account
	function status(flag){
			$("#fullname").attr("disabled", flag);
			$("#username").attr("disabled", flag);
			$("#email").attr("disabled", flag);
			$("#update").attr("disabled", flag);
			$("#reset").attr("disabled", flag);
			if(flag == true){
				$("#password").css("display", "none");
			}else{
				$("#password").css("display", "inline");
			}
		}
		status(true);
		$("#checkbox").change(function(){
			if(this.checked == true){
				status(false);
				$("#fullname").focus();
			}
			else {
				status(true);
			}
		});
});