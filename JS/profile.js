 $(document).ready(function () {
            // Function to fetch user profile data
            function fetchUserProfile() {
                $.ajax({
                    type: "GET",
                    url: "PHP/profil.php", // Make a request to profile.php
                    dataType: "json",
                    success: function (data) {
                        if (data.success) {
                            // Display user-specific information
                            $("#welcome-message").text("Welcome, " + data.username + "!");
                            $("#username").text( data.username);
                            $("#dob").text( data.dob);
							$('#age').text(data.age);
							$('#contact').text(data.contact);
							$('#email').text(data.email);
                        } else {
                            // Handle errors or unauthorized access
                            $("#welcome-message").text("Unauthorized Access");
                        }
                    },
                    error: function () {
                        // Handle AJAX errors
                        $("#welcome-message").text("Error fetching user data");
                    }
                });
            }

            // Call the fetchUserProfile function when the page loads
            fetchUserProfile();
            // Logout button click event
            $("#logout-button").click(function () {
                $.ajax({
                    type: "POST",
                    url: "PHP/logout.php", // Make a request to logout.php
                    dataType: "json",
                    success: function (data) {
                        if (data.success) {
                            // Redirect to the login page or perform any other action after logout
                            window.location.href = "index.html";
                        }
						else{
							window.location,href="profil.html";
							die();
						}
                    },
                    error: function () {
                        // Handle AJAX errors
                        alert("Error logging out");
                    }
                });
            });
        });