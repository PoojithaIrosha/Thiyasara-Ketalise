function payment(evt) {
    evt.preventDefault();

    if (document.getElementById("accept_terms").checked) {
        // Read Data
        const form = new FormData(document.getElementById("checkout-form"));

        if (form.get("billing_first_name") === "") {
            alert("Please enter the first name");
        } else if (form.get("billing_last_name") === "") {
            alert("Please enter the last name");
        } else if (form.get("billing_email") === "") {
            alert("Please enter the email");
        } else if (form.get("billing_phone") === "") {
            alert("Please enter the mobile");
        } else if (form.get("billing_address_1") === "") {
            alert("Please enter the address line 1");
        } else if (form.get("billing_address_2") === "") {
            alert("Please enter the address line 2");
        } else if (form.get("billing_city") === '0') {
            alert("Please select a city")
        } else {
            const total = document.getElementById("billing_total").innerHTML;
            let invoiceId = "INV/" + Math.random().toString().substr(2, 9);
            let city = document.getElementById("city" + form.get("billing_city")).innerHTML

            // Payment completed. It can be a successful failure.
            payhere.onCompleted = function onCompleted(orderId) {

                const result = {
                    invoiceId: invoiceId,
                    total: total,
                    addressLine1: form.get("billing_address_1"),
                    addressLine2: form.get("billing_address_2"),
                    city: form.get("billing_city")
                };

                const resultForm = new FormData();
                resultForm.append("result", JSON.stringify(result));

                const req = new XMLHttpRequest();
                req.onreadystatechange = () => {
                    if (req.readyState === 4) {
                        if (req.responseText === "success") {
                            window.location = "invoice.php?inv=" + invoiceId;
                        }else {
                            alert(req.responseText);
                        }
                    }
                }
                req.open('post', 'process/check-out-process.php', true);
                req.send(resultForm);
            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
                alert("Payment dismissed");
            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                alert("Error:" + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1221937",    // Replace your Merchant ID
                "return_url": undefined,     // Important
                "cancel_url": undefined,     // Important
                "notify_url": "",
                "order_id": invoiceId,
                "items": invoiceId,
                "amount": total,
                "currency": "LKR",
                "first_name": form.get("billing_first_name"),
                "last_name": form.get("billing_last_name"),
                "email": form.get("billing_email"),
                "phone": form.get("billing_phone"),
                "address": form.get("billing_address_1") + ', ' + form.get("billing_address_2"),
                "city": city,
                "country": "Sri Lanka",
                "delivery_address": form.get("billing_address_1") + ", " + form.get("billing_address_2"),
                "delivery_city": city,
                "delivery_country": "Sri Lanka",
            };

            payhere.startPayment(payment);

        }
    } else {
        alert("Accept terms before place the order");
    }

}
