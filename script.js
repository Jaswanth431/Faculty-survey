$(document).ready(function() {
    //login functionality
    $("#login").click(function() {
        var id = $("#id").val();
        var password = $("#password").val();
        if (id == "" || password == "") {
            $("#error-box").css("display", "block");
            $("#error-box").text("All fields are required!!!");
            return;
        } else {
            $("#error-box").css("display", "none");
            $("#error-box").text("");
            $.post("includes/login-inc.php", { id: id, password: password }, function(data) {
                $("#error-box").html(data);
            });
        }
    });
    //logout functionality
    $("#logout").click(function() {
        $.post("includes/login-inc.php", { logout: true }, function(data) {
            $(".logout-box").html(data);
        });
    });

    //getting faculty for selected subject
    $("#subject").change(function() {
        var section = $("#section").val();
        var subject = $("#subject").val();
        $("#survey-error-box").css("display", "none");
        $("#survey_form").html("");
        $("#submit_survey").css("display", "none");
        if (subject != "") {
            $("#faculty").load("includes/login-inc.php", { section: section, subject: subject });
        } else if (subject == "") {
            $("#faculty").html("<option value=''>Select Faculty</option>");
        }
    });

    // $("#q1").on("change", function(e) {
    //     e.preventDefault();
    //     console.log("jaswanth");
    // });

    $("#submit_survey").click(function() {
        var section = $("#section").val();
        var subject = $("#subject").val();
        var faculty = $("#faculty").val();
        var q1 = $("#q1").val();
        var q2 = $("#q2").val();
        var q3 = $("#q3").val();
        var q4 = $("#q4").val();
        var q5 = $("#q5").val();
        var q6 = $("#q6").val();
        var q7 = $("#q7").val();
        var q8 = $("#q8").val();
        var q9 = $("#q9").val();
        var q11 = $("#q11").val();
        var q10 = $("#q10").val();
        var q10 = $("#q10").val();
        if (
            section == "" ||
            subject == "" ||
            faculty == "" ||
            q1 == "" ||
            q2 == "" ||
            q3 == "" ||
            q4 == "" ||
            q5 == "" ||
            q6 == "" ||
            q7 == "" ||
            q8 == "" ||
            q9 == "" ||
            q10 == "" ||
            q11 == ""
        ) {
            $("#survey-error-box").css("display", "block");
            $("#survey-error-box").html("All fields are required !!");
            $(window).scrollTop(0);
        } else {
            $.post(
                "includes/login-inc.php",
                {
                    upload_section: section,
                    upload_subject: subject,
                    upload_faculty: faculty,
                    q1: q1,
                    q2: q2,
                    q3: q3,
                    q4: q4,
                    q5: q5,
                    q6: q6,
                    q7: q7,
                    q8: q8,
                    q9: q9,
                    q10: q10,
                    q11: q11
                },
                function(data) {
                    $("#survey-error-box").html(data);
                }
            );
        }
    });
    //to get the survey form
    $("#get-survey-btn").click(function() {
        var section = $("#section").val();
        var subject = $("#subject").val();
        var faculty = $("#faculty").val();
        var id = $("#clg_id").text();
        if (subject == "" || section == "" || faculty == "") {
            $("#survey-error-box").css("display", "block");
            $("#survey-error-box").html("Please select all fields !!");
        } else if (subject != "" && section != "" && faculty != "") {
            $("#survey-error-box").css("display", "none");
            $.post("includes/login-inc.php", { survey_subject: subject }, function(data) {
                $("#survey_form").html(data);
            });
        }
    });
});
