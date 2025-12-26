$(document).ready(function () {
  // Handle form submit
  $("#contactForm").on("submit", function (e) {
    e.preventDefault();

    // Get form field values
    const name = $("input[name='name']").val().trim();
    const email = $("input[name='email']").val().trim();
    const subject = $("input[name='subject']").val().trim();
    const message = $("textarea[name='message']").val().trim();

    // Disable submit button to prevent multiple clicks
    const $submitBtn = $("#sendMessageButton");
    $submitBtn.prop("disabled", true);

    // Clear previous messages
    $("#success").html("");

    // Simple validation
    if (!name || !email || !subject || !message) {
      $("#success").html("<div class='alert alert-danger'>Please fill in all fields.</div>");
      $submitBtn.prop("disabled", false);
      return;
    }

    // Send AJAX request
    $.ajax({
      url: "contact.php",
      type: "POST",
      data: {
        name: name,
        email: email,
        subject: subject,
        message: message
      },
      success: function (response) {
        $("#success").html("<div class='alert alert-success'>" + response + "</div>");
        $("#contactForm")[0].reset();
      },
      error: function (xhr) {
        let errorMsg = xhr.responseText ? xhr.responseText : "Something went wrong. Please try again later.";
        $("#success").html("<div class='alert alert-danger'>" + errorMsg + "</div>");
      },
      complete: function () {
        $submitBtn.prop("disabled", false);
      }
    });
  });

  // Clear response message on input focus
  $("#contactForm input, #contactForm textarea").on("focus", function () {
    $("#success").html("");
  });
});
