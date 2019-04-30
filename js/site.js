$(function() {

    var url = window.location.href;
    console.log(url);
    element = $('ul.navbar-nav li a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();
    
    //validate register
    $('.register').click(function() {
        currentRegister = $(this).closest('.registerForm');
        if (validateRegister(currentRegister) == false) {
          return false;
        } 
      });
    
      function validateRegister(form) {
        validFormSection = true;
        $('input:required', form).each(function() {
            if($(this)[0].checkValidity() == false) {
              $(this).addClass('is-invalid');
              validFormSection = false;
            } 
        });
      
        if(validFormSection == false) {
            $('#registerError').fadeIn();
            return false;
        }
      
        $('#careerError').fadeOut();
      }

    $('.datepicker').each(function(){
      datepickerID = $(this).attr("id");
      if (datepickerID == "veteranDate") {
        $(this).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-70:",
          // maxDate: "-16Y",
          showButtonPanel: true,
          showAnim: "slideDown",
          dateFormat: 'yy-mm-dd'
        });
      }
      else if (datepickerID == "dob") {
        $(this).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-70:-16",
          maxDate: "-16Y",
          showButtonPanel: true,
          showAnim: "slideDown",
          dateFormat: 'yy-mm-dd'
        });
      }
    });
});