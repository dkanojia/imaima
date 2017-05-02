<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
     
     <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>


<script>
       function onSuccess(googleUser) {
           var profile = googleUser.getBasicProfile();
           gapi.client.load('plus', 'v1', function () {
               var request = gapi.client.plus.people.get({
                   'userId': 'me'
               });
               //Display the user details
               request.execute(function (resp) {
                   var profileHTML = '<div class="profile"><div class="head">Welcome ' + resp.name.givenName + '! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></div>';
                   profileHTML += '<img src="' + resp.image.url + '"/><div class="proDetails"><p><b>Name:</b>' + resp.displayName + '</p><p><b>Email:</b>' + resp.emails[0].value + '</p><p><b>Gender:</b>' + resp.gender + '</p><p><b>Id:</b>' + resp.id + '</p><p><a href="' + resp.url + '">View Google+ Profile</a></p></div></div>';
                   $('.userContent').html(profileHTML);
                   $('#gSignIn').slideUp('slow');
               });
           });
       }
       function onFailure(error) {
           alert(error);
       }
       function renderButton() {
           gapi.signin2.render('gSignIn', {
               'scope': 'profile email',
               'width': 240,
               'height': 50,
               'longtitle': true,
               'theme': 'dark',
               'onsuccess': onSuccess,
               'onfailure': onFailure
           });
       }
       function signOut() {
           var auth2 = gapi.auth2.getAuthInstance();
           auth2.signOut().then(function () {
               $('.userContent').html('');
               $('#gSignIn').slideDown('slow');
           });
       }
</script>

<script>
        window.fbAsyncInit = function () {
            // FB JavaScript SDK configuration and setup
            FB.init({
                appId: '1665306420442150', // FB App ID
                cookie: true,  // enable cookies to allow the server to access the session
                xfbml: true,  // parse social plugins on this page
                version: 'v2.8' // use graph api version 2.8
            });

            // Check whether the user already logged in
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    //display user data
                    getFbUserData();
                }
            });
        };

        // Load the JavaScript SDK asynchronously
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Facebook login with JavaScript SDK
        function fbLogin() {
            FB.login(function (response) {
                if (response.authResponse) {
                    // Get and display the user profile data
                    debugger;
                    getFbUserData();
                } else {
                    document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
                }
            }, { scope: 'email' });
        }

        // Fetch the user profile data from facebook
        function getFbUserData() {
            FB.api('/me', { locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture' },
            function (response) {
                debugger;
                document.getElementById('fbLink').setAttribute("onclick", "fbLogout()");
               // document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
                //document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.first_name + '!';
				registerwithfacebook(response.id,response.first_name,response.last_name,response.email);
                //document.getElementById('userData').innerHTML = '<p><b>FB ID:</b> ' + response.id + '</p><p><b>Name:</b> ' + response.first_name + ' ' + response.last_name + '</p><p><b>Email:</b> ' + response.email + '</p><p><b>Gender:</b> ' + response.gender + '</p><p><b>Locale:</b> ' + response.locale + '</p><p><b>Picture:</b> <img src="' + response.picture.data.url + '"/></p><p><b>FB Profile:</b> <a target="_blank" href="' + response.link + '">click to view profile</a></p>';
            });
        }

        // Logout from facebook
        function fbLogout() {
            FB.logout(function () {
                document.getElementById('fbLink').setAttribute("onclick", "fbLogin()");
                document.getElementById('fbLink').innerHTML = '<img src="fblogin.png"/>';
                document.getElementById('userData').innerHTML = '';
                document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
            });
        }


function registerwithfacebook(fbid,fname,lname,email)
{
//alert(fbid);
	document.getElementById('hidfname').value = fname;
    document.getElementById('hidlname').value = lname;
    document.getElementById('hidfacebookid').value = fbid;
    document.getElementById('hidemailid').value = email;
	var frm = document.getElementById('facebook_registerform');
	//alert(frm);
	frm.submit();
}
</script>
<div style="width:200px; float:left;">
    <!--facebook-->
        <div id="status"></div>

<!-- Facebook login or logout button -->
<a href="javascript:void(0);" onClick="fbLogin()" id="fbLink"><input type="button"  class="form_button" value="SignUp With FaceBook" /></a>

<!-- Display user profile data -->
<div id="userData"></div>
         <!-- facebook end--> 

          <!-- google-->
        <!-- HTML for render Google Sign-In button -->
<div id="gSignIn"></div>
<!-- HTML for displaying user details -->
<div class="userContent"></div>
         <!-- google end--> 
    </div>
    
    <div style="display:none;">
    	<form name="facebook_registerform" id="facebook_registerform" action="" method="post">
        <input type="hidden" id="hidfname" name="hidfname"  />
         <input type="hidden" id="hidlname" name="hidlname"  />
          <input type="hidden" id="hidfacebookid" name="hidfacebookid"  />
           <input type="hidden" id="hidemailid" name="hidemailid"  />     
           <input type="submit" name="btn_facebook_registerform" id="btn_facebook_registerform"  />      
        </form>
    </div>