(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });

    window.onload = function() {
        var currentURL = window.location.href;

        if (currentURL.includes("about-us.php") ||
            currentURL.includes("contact-us.php") ||
            currentURL.includes("single-lawyer.php") ||
            currentURL.includes("news-details.php") ||
            currentURL.includes("articles-details.php") ||
            currentURL.includes("user-profile.php") ||
            currentURL.includes("my-appointment.php")) {
            document.getElementById("searchForm").style.display = "none";
        }
    };



    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });




    $(document).ready(function () {

		$('.lawyer').click(function(e) {
			e.preventDefault();
            $('#loginModal').modal('show');
        });

		$('#login-link').click(function(e) {
			e.preventDefault();
            $('#registerModal').modal('show');
            $('#loginModal').modal('hide');
        });

		$('#register-form').submit(function(e) {
			e.preventDefault();

			var name = $("#name").val();
			var email = $("#email").val();
			var password = $("#password").val();
			var phone = $("#phone").val();
			var address = $("#address").val();
			var gender = $("input[name='gender']:checked").val();

			var isValid = true;
			if (!name) {
				$("#invalid-name").text("name cannot be empty!");
				isValid = false;
			}
			else {
				$("#invalid-name").text("");
			}

			//email validation
			var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			if (!email) {
				$("#invalid-email").text("Email cannot be empty!");
				isValid = false;
			}
			else if (!emailRegex.test(email)) {
				$("#invalid-email").text("Please enter valid email!");
				isValid = false;

			}
			else {
				$("#invalid-email").text("");
			}

			//password validation
			if (!password) {
				$("#invalid-password").text("Password cannot be empty!");
				isValid = false;
			}
			else {
				$("#invalid-password").text("");
			}

			//address validation
			if (!address) {
				$("#invalid-address").text("Password cannot be empty!");
				isValid = false;
			}
			else {
				$("#invalid-address").text("");
			}

			//phone validation
			if (!phone) {
				$("#invalid-phone").text("Contact cannot be Empty!");
				isValid = false;
			} else if (phone.length !== 10) {
					$("#invalid-phone").text("Contact number must be 10 digits long!");
					isValid = false;
			}else {
					$("#invalid-phone").text("");
			}

			//gender validation
			if (!gender) {
				$("#invalid-gender").text("Please select employee gender.");
				isValid = false;
			}
			else {
				$("#invalid-gender").text("");
			}

			if (!isValid) {
				return;
			}
			var formData = new FormData();

			formData.append("name", name);
			formData.append("email", email);
			formData.append("password", password);
			formData.append("address", address);
			formData.append("phone", phone);
			formData.append("gender", gender);

			$.ajax({
				url: 'user_register.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					Swal.fire({
						icon: 'success',
						title: 'User Registered Successfully ! Now You can log in',
						confirmButtonText: 'OK',
						timer: 2000
					}).then(() => {
						window.location.href = window.location.href;
					});
    			}
    		})
   		 });

			$("#name, #email, #password, #address, #phone").on("input", function () {
				var field = $(this).attr("id");
				$("#invalid-" + field).text("");
			});

			// Clear gender error when a gender option is selected
			$("input[name='gender']").on("change", function () {
				$("#invalid-gender").text("");
			});

			function validateFormData(formData) {
				if (!formData.date) {
					alert('Please select a date.');
					return false;
				}
				return true;
			}

			// Form submission
			$('#appointmentForm').on('submit', function(e) {
				e.preventDefault();

				// Get form data
				var formData = {
					'lawyer_id': $('input[name=lawyer_id]').val(),
					'user_id': $('input[name=user_id]').val(),
					'date': $('#date').val(),
					'description': $('#description').val()
				};

				if (!validateFormData(formData)) {
					return false;
				}

				$.ajax({
					type: 'POST',
					url: 'insert-appointment.php',
					data: formData,
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: 'Booking Sent Successfully',
							confirmButtonText: 'OK',
							timer: 3000
						}).then((result) => {
							window.location.href = 'user-dashboard.php';
						});
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					}
				});
			});

			// Disable past dates
			$('#date').attr('min', new Date().toISOString().split('T')[0]);

			// On change of date value, validate if it's not in the past
			$('#date').on('change', function() {
				var selectedDate = new Date($(this).val());
				var today = new Date();
				today.setHours(0, 0, 0, 0);

				if (selectedDate < today) {
					alert('Please select today\'s date or a future date.');
					$(this).val('');
				}
			});

   	});

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
})(jQuery);
