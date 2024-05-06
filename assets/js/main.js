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
            $('#registerModal').modal('show');
        });

		$('#login-link').click(function(e) {
			e.preventDefault();
            $('#loginModal').modal('show');
            $('#registerModal').modal('hide');
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
						title: 'User Registered Successfully',
						confirmButtonText: 'OK',
						timer: 2000
					}).then(() => {
						window.location.href = 'user-dashboard.php';
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
