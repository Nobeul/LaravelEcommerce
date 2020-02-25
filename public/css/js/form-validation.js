$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='registration']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        title: "required",
        description: "required",
        price: "required",
        quantity: "required",
        category: "required",
        product_image: "required"
      },
      // Specify validation error messages
      messages: {
        title: "Title is required",
        description: "Description is required",
        price: "Price is required",
        quantity: "Quantity is required",
        category: "Category is required",
        product_image: "Image is required"

      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });