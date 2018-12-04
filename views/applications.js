function authenticate() {
    // get input data
    let username = jQuery('#username').val();
    let password = jQuery('#password').val();
  
  
    console.log('username:', username, 'password', password);
    // make AJAX request
    jQuery.ajax({
      url: "/actions/login.php",
      data: {
        username,
        password
      },
      success: function (result) {
        result = JSON.parse(result);
        jQuery("#welcome-message").html(`Welcome ${result.firstname}`);
      },
      error: function (result) {
        console.log('error', result);
      }
    });
  
    // show login info
  
  }
  
  jQuery('#submit-button').bind('click', function (element, event) {
    authenticate();
  });