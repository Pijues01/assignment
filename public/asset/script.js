const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
    const li = item.parentElement;

    item.addEventListener("click", function () {
        allSideMenu.forEach((i) => {
            i.parentElement.classList.remove("active");
        });
        li.classList.add("active");
    });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

// Sidebar toggle işlemi
menuBar.addEventListener("click", function () {
    sidebar.classList.toggle("hide");
});

// Sayfa yüklendiğinde ve boyut değişimlerinde sidebar durumunu ayarlama
function adjustSidebar() {
    if (window.innerWidth <= 576) {
        sidebar.classList.add("hide"); // 576px ve altı için sidebar gizli
        sidebar.classList.remove("show");
    } else {
        sidebar.classList.remove("hide"); // 576px'den büyükse sidebar görünür
        sidebar.classList.add("show");
    }
}

// Sayfa yüklendiğinde ve pencere boyutu değiştiğinde sidebar durumunu ayarlama
window.addEventListener("load", adjustSidebar);
window.addEventListener("resize", adjustSidebar);

// Arama butonunu toggle etme
const searchButton = document.querySelector(
    "#content nav form .form-input button"
);
const searchButtonIcon = document.querySelector(
    "#content nav form .form-input button .bx"
);
const searchForm = document.querySelector("#content nav form");

searchButton.addEventListener("click", function (e) {
    if (window.innerWidth < 768) {
        e.preventDefault();
        searchForm.classList.toggle("show");
        if (searchForm.classList.contains("show")) {
            searchButtonIcon.classList.replace("bx-search", "bx-x");
        } else {
            searchButtonIcon.classList.replace("bx-x", "bx-search");
        }
    }
});

// Dark Mode Switch
const switchMode = document.getElementById("switch-mode");

switchMode.addEventListener("change", function () {
    if (this.checked) {
        document.body.classList.add("dark");
    } else {
        document.body.classList.remove("dark");
    }
});


function toggleMenu(menuId) {
    var menu = document.getElementById(menuId);
    var allMenus = document.querySelectorAll(".menu");


    allMenus.forEach(function (m) {
        if (m !== menu) {
            m.style.display = "none";
        }
    });

    if (menu.style.display === "none" || menu.style.display === "") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}


document.addEventListener("DOMContentLoaded", function () {
    var allMenus = document.querySelectorAll(".menu");
    allMenus.forEach(function (menu) {
        menu.style.display = "none";
    });
});

// user delete
$(document).on("click", ".delete-user", function () {
    let userId = $(this).data("user-id");
    let row = $(this).closest("tr"); // Get the table row

    if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
            url: "/users/delete", // Laravel route for deleting user
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                id: userId,
            },
            success: function (response) {
                // alert(response.success);
                row.fadeOut(500, function () {
                    $(this).remove(); // Remove row from table
                });
            },
            error: function (xhr) {
                alert("Error deleting user. Please try again.");
            },
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".side-menu li");
    menuItems.forEach((el) => el.classList.remove("active"));
    // const sections = document.querySelectorAll(".content-section");

    // Get stored active tab from localStorage
    let activeTab = localStorage.getItem("recenttab") || 1;
    // console.log(activeTab , typeof activeTab);
    if (activeTab == "1") {
        document.getElementById("first").classList.add("active");
        document.getElementById("assignment1").classList.add("displaycontent");
        document.getElementById("assignment2").classList.remove("displaycontent");
        document.getElementById("assignment2").classList.add("hidecontent");
        document.getElementById("assignment3").classList.remove("displaycontent");
        document.getElementById("assignment3").classList.add("hidecontent");
    } else if (activeTab == "2") {
        document.getElementById("second").classList.add("active");

        document.getElementById("assignment1").classList.remove("displaycontent");
        document.getElementById("assignment1").classList.add("hidecontent");
        document.getElementById("assignment3").classList.remove("displaycontent");
        document.getElementById("assignment3").classList.add("hidecontent");
        document.getElementById("assignment2").classList.remove("hidecontent");
        document.getElementById("assignment2").classList.add("displaycontent");
    } else {
        document.getElementById("third").classList.add("active");

        document.getElementById("assignment1").classList.remove("displaycontent");
        document.getElementById("assignment1").classList.add("hidecontent");
        document.getElementById("assignment2").classList.remove("displaycontent");
        document.getElementById("assignment2").classList.add("hidecontent");
        document.getElementById("assignment3").classList.remove("hidecontent");
        document.getElementById("assignment3").classList.add("displaycontent");
    }

function demo(elem) {
    const menuItems = document.querySelectorAll(".side-menu li");
    let activeTab = $(elem).attr('id');
    menuItems.forEach((el) => el.classList.remove("active"));
    if (activeTab == "first") {
        $(elem).addClass("active");
        localStorage.setItem("recenttab", 1);
        document.getElementById("assignment1").classList.add("displaycontent");
        document.getElementById("assignment1").classList.remove("hidecontent");
        document.getElementById("assignment2").classList.remove("displaycontent");
        document.getElementById("assignment2").classList.add("hidecontent");
        document.getElementById("assignment3").classList.remove("displaycontent");
        document.getElementById("assignment3").classList.add("hidecontent");
    } else if (activeTab == "second") {
        $(elem).addClass("active");
        localStorage.setItem("recenttab", 2);
        document.getElementById("assignment1").classList.remove("displaycontent");
        document.getElementById("assignment1").classList.add("hidecontent");
        document.getElementById("assignment3").classList.remove("displaycontent");
        document.getElementById("assignment3").classList.add("hidecontent");
        document.getElementById("assignment2").classList.remove("hidecontent");
        document.getElementById("assignment2").classList.add("displaycontent");

    } else {
        $(elem).addClass("active");
        localStorage.setItem("recenttab", 3);
        document.getElementById("assignment1").classList.remove("displaycontent");
        document.getElementById("assignment1").classList.add("hidecontent");
        document.getElementById("assignment2").classList.remove("displaycontent");
        document.getElementById("assignment2").classList.add("hidecontent");
        document.getElementById("assignment3").classList.remove("hidecontent");
        document.getElementById("assignment3").classList.add("displaycontent");
    }


}

// Audio
$(document).ready(function () {
    $("#audioForm").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "/get-audio-duration",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#audioDuration").text(response.duration);
                // $("#audioDuration").html(`<strong>${fileName}:</strong> ${response.duration}`);
                $("#audioForm").trigger("reset");
            },
            error: function (xhr) {
                alert("Error getting audio duration!");
            },
        });
    });
});

// Distance

$(document).ready(function () {
    $("#distanceForm").submit(function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "/calculate-distance",
            type: "POST",
            data: formData,
            success: function (response) {

                let km = parseFloat(response.distance_km); // Ensure it's a number
                let miles = (km * 0.621371).toFixed(2); // Convert KM to Miles and round to 2 decimal places

                $("#distanceResultKm").text(`${km}`);
                $("#distanceResultMiles").text(`${miles}`);

                $("#distanceForm")[0].reset(); // Reset the form after success
            },
            error: function (xhr) {
                alert("Error calculating distance! Please check your inputs.");
            },
        });
    });
});



$(document).ready(function () {
    let form = $("#updateUserForm");

    // Handle "Edit User" button click (Fix: Event Delegation)
    $(document).on("click", ".editform", function () {
        let userId = $(this).data("user-id");
        let username = $(this).data("username");
        let email = $(this).data("email");
        let phone = $(this).data("phone");
        let profileImg = $(this).data("profileimg");

        $("#oldpic").show();
        $('#editUserModalLabel').html('<b>Update User</b>');
        $('#piclabel').html('Add New Profile Picture');
        $("#user_id").val(userId);
        $("#name").val(username);
        $("#email").val(email);
        $("#contact").val(phone);
        $("#password").val("password"); // Clear password field
        $("#profilePreview").attr("src", profileImg);

        // Overwrite password field instead of appending multiple times
        $("#up_pass").html(`
            <div class="form-group">
                <label for="password">Make New Password:</label>
                <input class="form-control" id="password" name="password" type="text">
            </div>
        `);

        // Set action type
        form.attr("data-action", "update");
        form.attr("data-user-id", userId); // Store user ID
    });

    // Handle "Add User" button click
    $("#adduser").click(function () {
        $('#editUserModalLabel').html('<b>Add New User</b>');
        $('#piclabel').html('Add Profile Picture');
        form[0].reset();
        $("#oldpic").hide();

        // Set form action type
        form.attr("data-action", "create");
        form.removeAttr("data-user-id");

        // Overwrite password fields instead of appending
        $("#cr_pass").html(`
            <div class="form-group">
                <label for="password">Create Password:</label>
                <input class="form-control" id="password" name="password" placeholder="Create password" type="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" type="password">
            </div>
        `);
    });

    // Handle form submission dynamically
    form.submit(function (e) {
        e.preventDefault();

        let actionType = form.attr("data-action"); // Get action type
        let formData = new FormData(this);
        let userId = form.attr("data-user-id") || ""; // Fix: Ensure `userId` is not undefined
        let url = actionType === "create" ? "/users/create" : `/users/update`;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $("#editUserModal").modal("hide"); // Close modal

                if (actionType === "update") {
                    // **Update Existing Row**
                    let userRow = $("tr[data-user-id='" + response.user.id + "']");
                    userRow.find("td:nth-child(2)").text(response.user.username);
                    userRow.find("td:nth-child(3)").text(response.user.email);
                    userRow.find("td:nth-child(4)").text(response.user.phone);

                    if (response.user.profileimg) {
                        let newImgSrc = response.user.profileimg + "?t=" + new Date().getTime();
                        userRow.find("td:nth-child(5) img").attr("src", newImgSrc);
                    }
                } else {
                    let serialNo = $("tbody tr").length + 1;
                    // **Add New Row**
                    let newRow = `
                        <tr data-user-id="${response.user.id}">
                            <td>${serialNo}</td>
                            <td>${response.user.username}</td>
                            <td>${response.user.email}</td>
                            <td>${response.user.phone}</td>
                            <td><img src="${response.user.profileimg}" width="50"></td>

                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm editform"
                                    data-toggle="modal" data-target="#editUserModal"
                                    data-user-id="${response.user.id}"
                                    data-username="${response.user.username}"
                                    data-email="${response.user.email}"
                                    data-phone="${response.user.phone}"
                                    data-profileimg="${response.user.profileimg}"
                                    data-action="update">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm delete-user"
                                    data-user-id="${response.user.id}">
                                    Delete
                                </button>
                            </td>
                        </tr>`;
                    $("tbody").append(newRow); // Add new row to the table
                }

                // **Fix: Properly Reset Form After Submission**
                form[0].reset();
                $("#up_pass").html(""); // Clear dynamically added password fields
                $("#cr_pass").html("");
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    alert("Validation error! Please check your input.");
                }
            },
        });
    });
});





// Form Validation

    // document.addEventListener("DOMContentLoaded", function () {
    //     const updateUserForm = document.getElementById("updateUserForm");

    //     updateUserForm.addEventListener("submit", function (event) {
    //         let valid = true;

    //         const name = document.getElementById("name");
    //         const email = document.getElementById("email");
    //         const contact = document.getElementById("contact");
    //         const profileImg = document.getElementById("profileimg");

    //         const nameError = document.getElementById("name-error");
    //         const emailError = document.getElementById("email-error");
    //         const contactError = document.getElementById("contact-error");
    //         const profileImgError = document.getElementById("profileimg-error");

    //         // Reset errors
    //         nameError.style.display = "none";
    //         emailError.style.display = "none";
    //         contactError.style.display = "none";
    //         profileImgError.style.display = "none";

    //         // Name Validation
    //         if (name.value.trim().length < 3) {
    //             nameError.innerText = "Full Name must be at least 3 characters.";
    //             nameError.style.display = "block";
    //             valid = false;
    //         }

    //         // Email Validation
    //         const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    //         if (!emailPattern.test(email.value.trim())) {
    //             emailError.innerText = "Enter a valid email.";
    //             emailError.style.display = "block";
    //             valid = false;
    //         }

    //         // Contact Number Validation
    //         const phonePattern = /^[6-9]\d{9}$/;
    //         if (!phonePattern.test(contact.value.trim())) {
    //             contactError.innerText = "Enter a valid 10-digit mobile number starting with 6-9.";
    //             contactError.style.display = "block";
    //             valid = false;
    //         }




    //         // Profile Image Validation (Optional)
    //         if (profileImg.files.length > 0) {
    //             const file = profileImg.files[0];
    //             const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    //             if (!allowedTypes.includes(file.type)) {
    //                 profileImgError.innerText = "Only JPG, PNG images are allowed.";
    //                 profileImgError.style.display = "block";
    //                 valid = false;
    //             }
    //         }

    //         // If any validation fails, prevent form submission
    //         if (!valid) event.preventDefault();
    //     });

    //     // Image Preview
    //     document.getElementById("profileimg").addEventListener("change", function (event) {
    //         const file = event.target.files[0];
    //         if (file) {
    //             const reader = new FileReader();
    //             reader.onload = function (e) {
    //                 document.getElementById("profilePreview").src = e.target.result;
    //             };
    //             reader.readAsDataURL(file);
    //         }
    //     });
    // });

    document.addEventListener("DOMContentLoaded", function () {
        const updateUserForm = document.getElementById("updateUserForm");

        updateUserForm.addEventListener("submit", function (event) {
            let valid = true;

            // Input fields
            const name = document.getElementById("name");
            const email = document.getElementById("email");
            const contact = document.getElementById("contact");
            const profileImg = document.getElementById("profileimg");
            const password = document.getElementById("password");
            const passwordConfirmation = document.getElementById("password_confirmation");

            // Error message containers
            const nameError = document.getElementById("name-error");
            const emailError = document.getElementById("email-error");
            const contactError = document.getElementById("contact-error");
            const profileImgError = document.getElementById("profileimg-error");
            const passwordError = document.getElementById("password-error");
            const confirmPasswordError = document.getElementById("confirm-password-error");

            // Reset previous error messages
            document.querySelectorAll(".error-message").forEach(e => e.style.display = "none");

            // Name Validation
            if (name.value.trim().length < 3) {
                nameError.innerText = "Full Name must be at least 3 characters.";
                nameError.style.display = "block";
                valid = false;
            }

            // Email Validation
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email.value.trim())) {
                emailError.innerText = "Enter a valid email.";
                emailError.style.display = "block";
                valid = false;
            }

            // Contact Number Validation
            const phonePattern = /^[6-9]\d{9}$/;
            if (!phonePattern.test(contact.value.trim())) {
                contactError.innerText = "Enter a valid 10-digit mobile number starting with 6-9.";
                contactError.style.display = "block";
                valid = false;
            }

            // Profile Image Validation (Optional)
            if (profileImg.files.length > 0) {
                const file = profileImg.files[0];
                const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
                if (!allowedTypes.includes(file.type)) {
                    profileImgError.innerText = "Only JPG, PNG images are allowed.";
                    profileImgError.style.display = "block";
                    valid = false;
                }
                if (file.size > 2 * 1024 * 1024) { // 2MB limit
                    profileImgError.innerText = "File size must be less than 2MB.";
                    profileImgError.style.display = "block";
                    valid = false;
                }
            }


            if (password) {
                if (password.value.trim().length > 0 && password.value.trim().length < 6) {
                    passwordError.innerText = "Password must be at least 6 characters.";
                    passwordError.style.display = "block";
                    valid = false;
                }
                if (password.value !== passwordConfirmation.value) {
                    confirmPasswordError.innerText = "Passwords do not match.";
                    confirmPasswordError.style.display = "block";
                    valid = false;
                }
            }


            if (!valid) event.preventDefault();
        });



        document.getElementById("profileimg").addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("profilePreview").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });

// Audio form validate
document.addEventListener("DOMContentLoaded", function () {
    const audioForm = document.getElementById("audioForm");
    const audioInput = document.getElementById("audio");

    // Create an error message container
    const audioError = document.createElement("span");
    audioError.style.color = "red";
    audioError.style.display = "none";
    audioError.classList.add("error-message");
    audioInput.insertAdjacentElement("afterend", audioError);

    // Form submission validation
    audioForm.addEventListener("submit", function (event) {
        audioError.style.display = "none"; // Reset error message
        let valid = true;

        if (audioInput.files.length === 0) {
            audioError.innerText = "Please select an audio file.";
            audioError.style.display = "block";
            valid = false;
        } else {
            const file = audioInput.files[0];
            const allowedTypes = ["audio/mpeg", "audio/wav", "audio/ogg"];
            const maxSize = 5 * 1024 * 1024; // 5MB limit

            if (!allowedTypes.includes(file.type)) {
                audioError.innerText = "Only MP3, WAV, and OGG files are allowed.";
                audioError.style.display = "block";
                valid = false;
            }

            if (file.size > maxSize) {
                audioError.innerText = "File size must be less than 5MB.";
                audioError.style.display = "block";
                valid = false;
            }
        }

        if (!valid) event.preventDefault(); // Prevent form submission if validation fails
    });
});


