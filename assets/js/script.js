function user_register() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const mobile = document.getElementById("mobile");
    const f = new FormData();

    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    const r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState === 4) {
            const txt = r.responseText;
            if (txt === "success") {
                window.location = "login.php";
            } else {
                document.getElementById("login_err_msg").classList.remove("d-none");
                document.getElementById("login_err_msg").innerHTML = txt;
            }
        }
    }
    r.open("POST", "process/user_register_process.php", true);
    r.send(f);
}

function show_forget_password_modal() {
    document.getElementById("forgot_pwd").classList.add("st-show");
}

function user_login() {
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const remember = document.getElementById("remember_me");
    const form = new FormData();

    form.append("email", email.value);
    form.append("password", password.value);
    form.append("remember", remember.checked);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            const txt = request.responseText;
            if (txt === "success") {
                window.location = "index.php";
            } else {
                document.getElementById("login_err_msg").classList.remove("d-none");
                document.getElementById("login_err_msg").innerHTML = txt;
            }
        }
    }
    request.open("POST", "./process/user_login_process.php", true);
    request.send(form);
}

function user_forgot_password() {
    const email = document.getElementById("fp_email");
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        const email_sending_div = document.getElementById("email_sending_div");
        const email_success_div = document.getElementById("email_success_div");
        const err_msg = document.getElementById("err_msg2");
        const err_msg_div = document.getElementById("err_msg2_div");

        if (request.readyState === 4) {
            email_sending_div.classList.add("d-none");
            let txt = request.responseText;
            if (txt === "success") {
                email.value = "";
                email_success_div.classList.remove("d-none");
                err_msg_div.classList.add("d-none");
                err_msg.innerHTML = '';
            } else {
                email_sending_div.classList.add("d-none");
                err_msg_div.classList.remove("d-none");
                err_msg.innerHTML = txt.trim();
            }
        } else {
            email_success_div.classList.add("d-none");
            err_msg_div.classList.add("d-none");
            email_sending_div.classList.remove("d-none");
        }
    }
    request.open("GET", "./process/user_send_forgot_pwd_process.php?e=" + email.value, true);
    request.send();
}

function user_reset_password(uid) {
    const new_pwd = document.getElementById("new_pwd");
    const confirm_pwd = document.getElementById("confirm_pwd");
    const form = new FormData();

    form.append("new_pwd", new_pwd.value);
    form.append("confirm_pwd", confirm_pwd.value);
    form.append("uid", uid);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            const txt = request.responseText;
            if (txt === "success") {
                window.location = "login.php";
            } else {
                const err_msg = document.getElementById("fp_err_msg");
                err_msg.classList.remove("d-none");
                err_msg.innerHTML = txt;
            }
        }
    }
    request.open("POST", "process/user_rest_pwd_process.php", true);
    request.send(form);
}

function add_cart(id) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            const txt = request.responseText;
            custom_alert(txt);
            update_header_cart();
        }
    }
    request.open("GET", "./process/addto_cart_process.php?id=" + id, true);
    request.send();
}

function add_wishlist(id) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            const txt = request.responseText;
            custom_alert(txt);
        }
    }
    request.open("GET", "process/addto_wishlist_process.php?id=" + id, true);
    request.send();
}

function user_update_profile() {
    const fname = document.getElementById("fn");
    const lname = document.getElementById("ln");
    const mobile = document.getElementById("mo");

    const form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("mo", mobile.value);

    const r = new XMLHttpRequest();
    r.onreadystatechange = () => {
        if (r.readyState === 4) {
            const t = r.responseText;
            if (t === "success") {
                custom_alert("User profile updated successfully!");
                setTimeout(() => {
                    window.location.reload();
                }, 2000)
            } else {
                const txt = r.responseText;
                custom_alert(txt);
            }
        }
    }
    r.open("POST", "process/user_update_profile_process.php", true);
    r.send(form);
}

function change_image(email) {
    const view = document.getElementById("viewimg");//image tag
    const file = document.getElementById("profileimg");//file chooser
    file.onchange = function () {
        const file1 = this.files[0];
        view.src = window.URL.createObjectURL(file1);
        let form = new FormData();

        form.append('email', email);
        form.append('image', file1);
        let request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if (request.readyState === 4) {
                let txt = request.responseText;
                custom_alert(txt);
            }
        }
        request.open('post', 'process/upload_profile_img_process.php', true)
        request.send(form);
    }
}

function printInvoice() {
    const page = document.getElementById("page").innerHTML;
    const restorePage = document.body.innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

function removeFromWatchlist(id) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            const text = request.responseText;
            if (text === "success") {
                let snackbar = document.getElementById("snackbar");
                snackbar.innerHTML = "Product removed successfully !";
                snackbar.className = "show";
                // After 3 seconds, remove the show class from DIV
                setTimeout(() => {
                    snackbar.className = snackbar.className.replace("show", "");
                    window.location.reload();
                }, 2000);
            } else {
                custom_alert(text);
            }
        }
    }
    request.open("GET", "process/remove_wishlist_process.php?id=" + id, true);
    request.send();
}

function placeOder() {
    alert("ok");
    window.location = "invoice.php";
}

function increment_prod_qty(id, isCart) {
    const prod_qty = document.getElementById('prod_qty' + id);
    const new_qty = parseInt(prod_qty.value) + 1;
    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            const result = JSON.parse(request.responseText);
            if (result["qty"] > 0) {
                document.getElementById("qty_err_msg" + id).innerHTML = "";
                prod_qty.value = result["qty"];

                if (isCart) {
                    let newAmount = parseInt(document.getElementById("cart-product-price" + id).innerHTML) * parseInt(result['qty']);
                    document.getElementById("cart-product-amount" + id).innerHTML = newAmount;

                    let subTotal = 0;
                    document.querySelectorAll(".cart-product-amount").forEach(e => {
                        subTotal += parseInt(e.innerHTML)
                    });
                    document.getElementById("sub-total").innerHTML = subTotal;
                    update_cart_total();
                }
            }

            if (result["message"]) {
                document.getElementById("qty_err_msg" + id).innerHTML = result["message"];
            }
        }
    }
    request.open('get', 'process/increment_product_qty_process.php?qty=' + new_qty + "&pid=" + id, true);
    request.send();
}

function decrement_prod_qty(id, isCart) {
    const prod_qty = document.getElementById('prod_qty' + id);
    const new_qty = parseInt(prod_qty.value) - 1;
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4) {
            const result = JSON.parse(req.responseText);
            if (result["qty"] > 0) {
                document.getElementById("qty_err_msg" + id).innerHTML = "";
                prod_qty.value = result["qty"];

                if (isCart) {
                    let newAmount = parseInt(document.getElementById("cart-product-price" + id).innerHTML) * parseInt(result['qty']);
                    document.getElementById("cart-product-amount" + id).innerHTML = newAmount;

                    let subTotal = 0;
                    document.querySelectorAll(".cart-product-amount").forEach(e => {
                        subTotal += parseInt(e.innerHTML)
                    });
                    document.getElementById("sub-total").innerHTML = subTotal;
                    update_cart_total();
                }
            }
            if (result["message"]) {
                document.getElementById("qty_err_msg" + id).innerHTML = result["message"];
            }
        }
    }

    req.open('get', 'process/decrement_product_qty_process.php?qty=' + new_qty + "&pid=" + id, true);
    req.send();
}

function change_prod_qty(pid, isCart) {
    const prod_qty = document.getElementById("prod_qty" + pid);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4) {
            let result = JSON.parse(req.responseText);

            if (result["message"] != "") {
                if (result["message"] == "negative") {
                    document.getElementById("qty_err_msg" + pid).innerHTML = "";
                    prod_qty.value = 1;
                } else {
                    document.getElementById("qty_err_msg" + pid).innerHTML = result["message"];
                }
            } else {
                document.getElementById("qty_err_msg" + pid).innerHTML = "";

                if (isCart) {
                    let newAmount = parseInt(document.getElementById("cart-product-price" + pid).innerHTML) * parseInt(prod_qty.value);
                    document.getElementById("cart-product-amount" + pid).innerHTML = newAmount.toString();

                    let subTotal = 0;
                    document.querySelectorAll(".cart-product-amount").forEach(e => {
                        subTotal += parseInt(e.innerHTML)
                    });
                    document.getElementById("sub-total").innerHTML = subTotal;
                    update_cart_total();
                }

            }
        }
    }
    req.open('get', 'process/change_product_qty_process.php?qty=' + prod_qty.value + '&pid=' + pid, true);
    req.send();
}

function update_cart_total() {
    const subTotoal = document.getElementById("sub-total");
    const deliveryFee = document.getElementById("delivery-fee");
    const total = document.getElementById("total");

    total.innerHTML = parseInt(subTotoal.innerHTML) + parseInt(deliveryFee.innerHTML);
}

function update_cart_prod_qty(id) {
    setTimeout(() => {
        let prod_qty = document.getElementById('prod_qty' + id)

        const form = new FormData();
        form.append('prod_qty', prod_qty.value);
        form.append('pid', id);

        const req = new XMLHttpRequest();
        req.open('post', 'process/update_cart_prod_qty_process.php', true);
        req.send(form);
    }, 500)
}

function custom_alert(text) {
    let snackbar = document.getElementById("snackbar");

    snackbar.innerHTML = text;
    snackbar.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(() => {
        snackbar.className = snackbar.className.replace("show", "");
    }, 2000);
}

function advanced_search(page) {
    const minp = document.getElementById("min_price");
    const maxp = document.getElementById("max_price");
    const brand = document.getElementById("brand");

    const form = new FormData();
    form.append('minp', minp.value);
    form.append('maxp', maxp.value);
    form.append("brand", brand.value);
    form.append("page", page);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4) {
            const txt = req.responseText;
            console.log(txt)
            document.getElementById("load-products").innerHTML = req.responseText;
        }
    }
    req.open('post', 'process/advanced_search_process.php', true);
    req.send(form);
}

function removeFromCart(pid) {
    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4) {
            let txt = req.responseText;
            if (txt === "success") {
                window.location.reload();
                const snackbar = document.getElementById("snackbar");
                snackbar.innerHTML = "Product removed successfully !";
                snackbar.className = "show";
                // After 3 seconds, remove the show class from DIV
                setTimeout(() => {
                    snackbar.className = snackbar.className.replace("show", "");
                    window.location.reload();
                }, 2000);
            } else {
                alert(txt);
            }
        }
    };
    req.open('get', 'process/remove_cart_process.php?pid=' + pid, true);
    req.send();
}

function update_delivery_fee() {
    let cityId = document.getElementById("billing_city").value;

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4) {
            if (req.responseText !== "") {
                document.getElementById("billing_delivery_fee").innerHTML = req.responseText;
                update_checkout_total(req.responseText);
            }
        }
    }
    req.open('get', 'process/update_deliver_fee_process.php?city=' + cityId, true);
    req.send();
}

function update_checkout_total(delivery) {
    const subTotal = document.getElementById("billing_sub_total").innerHTML;
    let total = parseInt(subTotal) + parseInt(delivery);

    document.getElementById("billing_total").innerHTML = total.toString();
}

function update_header_cart() {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let result = JSON.parse(req.responseText);
            document.getElementById("cart-count").innerHTML = result['no'];
            document.getElementById("cart-price").innerHTML = result['total'];
        }
    }
    req.open('get', 'process/load-header-cart-widget-process.php', true);
    req.send();
}