jQuery(document).ready(function() {

	function updateInputValue(updateType) {

		return function(event) {

			// Stop acting like a button
			event.preventDefault();

			// Get targeted element name
			var targetedElementName = $(this).data('targeted-element-name');

			// Get targeted element, identifying by its name
			var targetedElement = $("input[name=" + targetedElementName + "]");

			// Get its current value
			var currentVal = parseInt(targetedElement.val());

			// If is not undefined (is number)
			if (!isNaN(currentVal)) {

				// Check the sign
				if (updateType === "increment") {

					// Increment until 100 is reached
					if (currentVal < 100) {

						// Increment the value
						targetedElement.val((currentVal + 1) + " %");
						targetedElement.attr("value", (currentVal + 1) + " %");

					} else {

						targetedElement.val(100 + " %");
						targetedElement.attr("value", 100 + " %");

					}

				}

				if (updateType === "decrement") {

					// Decrement until 0 is reached
					if (currentVal > 0) {

						// Decrement the value
						targetedElement.val((currentVal - 1) + " %");
						targetedElement.attr("value", (currentVal - 1) + " %");

					} else {

						targetedElement.val(0 + " %");
						targetedElement.attr("value", 0 + " %");

					}

				}

			} else {

				// Otherwise put a 0 there
				targetedElement.val(0 + " %");
				targetedElement.attr("value", 0 + " %");

			}
		}
	}

	$(".select2").select2({
		tags: true,
		placeholder: 'Enter criteria or select below...'
	});
	// This button will increment the value
	$('.qtyplus').on("click", updateInputValue("increment"));
	$('.qtyminus').on("click", updateInputValue("decrement"));
	$('.qtyplus1').on("click", updateInputValue("increment"));
	$('.qtyminus1').on("click", updateInputValue("decrement"));

});
