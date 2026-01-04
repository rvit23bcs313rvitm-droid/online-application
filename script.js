$(document).ready(function () {

    $('#full_name').on('input', function () {
        const val = $(this).val().trim();
        $('#previewName').text(val || 'Your Name');
    });

    $('#course').on('change', function () {
        const val = $(this).val();
        $('#previewCourse').text(val || '[Course]');
    });

    $('#applicationForm').on('submit', function (e) {
        $('.error').text('');
        let hasError = false;

        let name   = $('#full_name').val().trim();
        let email  = $('#email').val().trim();
        let phone  = $('#phone').val().trim();
        let course = $('#course').val();
        let gender = $('input[name="gender"]:checked').val();

        if (name === '') {
            $('#err_name').text('Name is required');
            hasError = true;
        }

        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            $('#err_email').text('Enter a valid email address');
            hasError = true;
        }

        let phonePattern = /^[0-9]{10}$/;
        if (!phonePattern.test(phone)) {
            $('#err_phone').text('Enter a 10-digit phone number');
            hasError = true;
        }

        if (!course) {
            $('#err_course').text('Please select a course');
            hasError = true;
        }

        if (!gender) {
            $('#err_gender').text('Please select gender');
            hasError = true;
        }

        if (hasError) e.preventDefault();
    });
});
