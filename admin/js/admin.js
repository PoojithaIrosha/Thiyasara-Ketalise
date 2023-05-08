function admin_login() {
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const rememberMe = document.getElementById("remember_me");

    const form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt == "success") {
                document.querySelector("#error-msg").classList.add("d-none");
                window.location = "index.php";
            } else {
                document.querySelector("#error-msg").classList.remove("d-none");
                document.querySelector("#error-msg span").innerHTML = txt;
            }
        }
    }
    req.open('post', 'process/login_process.php', true);
    req.send(form);
}

const reset_password = (evt) => {
    document.getElementById("send-btn").disabled = true;
    const email = document.getElementById("email-address");

    const request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState == 4) {

            let txt = request.responseText;

            if (txt == "Message has been sent") {
                window.location = "login.php";
            } else {
                document.getElementById("fp-err").innerHTML = txt;
                document.getElementById("send-btn").disabled = false;
            }
            console.log(txt);
        }
    };
    request.open("GET", "send_reset_link.php?e=" + email.value, true);
    request.send();

    evt.preventDefault();
}

function addProductImage() {
    document.getElementById("images-container").innerHTML = null;
    const prodImg = document.getElementById("productImages");

    for (let i = 0; i < prodImg.files.length; i++) {
        let url = URL.createObjectURL(prodImg.files[i]);

        const div = document.createElement('div');
        const img = document.createElement('img');
        img.src = url;
        img.style.height = '150px';
        img.classList.add('border');
        img.alt = prodImg.files[i]["name"];
        div.appendChild(img);
        document.getElementById("images-container").appendChild(div);
    }
}

function addProduct() {
    const pname = document.getElementById("pname");
    const category = document.getElementById('category');
    const brand = document.getElementById('brand');
    const qty = document.getElementById('qty');
    const price = document.getElementById('price');
    const desc = document.getElementById('desc');
    const file = document.getElementById('productImages');

    const form = new FormData();
    form.append("pname", pname.value);
    form.append("category", category.value);
    form.append("brand", brand.value);
    form.append("qty", qty.value);
    form.append("price", price.value);
    form.append("desc", desc.value);
    let imagesId = [];
    for (let i = 0; i < file.files.length; i++) {
        form.append("file" + i, file.files[i]);
        imagesId.push("file" + i);
    }
    form.append("imageIds", JSON.stringify(imagesId));

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            if (req.responseText === "success") {
                window.location.reload();
            } else {
                alert(req.responseText);
            }
        }
    }
    req.open('post', 'process/add_new_product_process.php', true);
    req.send(form);
}

function changeProductStatus(pid) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            setTimeout(() => {
                alert("Product status changed");
            }, 200)
        }
    }

    req.open("get", "process/change_product_status.php?pid=" + pid, true);
    req.send();
}

function showUpdateProductModal(product) {
    document.getElementById("pid").value = product['pid'];
    document.getElementById("u-pname").value = product['title'];
    document.getElementById("u-category").value = product['cid'];
    document.getElementById("u-brand").value = product['bid'];
    document.getElementById("u-qty").value = product['qty'];
    document.getElementById("u-price").value = product['price'];
    document.getElementById("u-desc").value = product['description'];

    const container = document.getElementById("u-images-container");
    container.innerHTML = null;
    const div = document.createElement('div');
    const img = document.createElement('img');
    img.src = "../" + product['path'];
    img.style.height = '150px';
    img.classList.add('border');
    div.appendChild(img);
    container.appendChild(div);

    new bootstrap.Modal(document.getElementById("updateproduct")).show();
}

function updateProductImage() {
    document.getElementById("u-images-container").innerHTML = null;
    const prodImg = document.getElementById("u-productImage");

    for (let i = 0; i < prodImg.files.length; i++) {
        let url = URL.createObjectURL(prodImg.files[i]);

        const div = document.createElement('div');
        const img = document.createElement('img');
        img.src = url;
        img.style.height = '150px';
        img.classList.add('border');
        img.alt = prodImg.files[i]["name"];
        div.appendChild(img);
        document.getElementById("u-images-container").appendChild(div);
    }
}

function updateProduct() {
    const pid = document.getElementById("pid");
    const name = document.getElementById("u-pname");
    const cat = document.getElementById("u-category");
    const brand = document.getElementById("u-brand");
    const qty = document.getElementById("u-qty");
    const price = document.getElementById("u-price");
    const desc = document.getElementById("u-desc");
    const image = document.getElementById("u-productImage");

    const form = new FormData();
    form.append("pid", pid.value);
    form.append("name", name.value);
    form.append("cat", cat.value);
    form.append("brand", brand.value);
    form.append("qty", qty.value);
    form.append("price", price.value);
    form.append("desc", desc.value);
    form.append("image", image.files[0]);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('post', 'process/update_product_process.php', true);
    req.send(form);
}

function deleteProduct(pid) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                alert("Product deleted successfully");
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('get', 'process/delete_product_process.php?pid=' + pid, true);
    req.send();
}

function deleteUser(email) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                alert("User account deleted successfully");
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('get', 'process/delete_user_account.php?e=' + email, true);
    req.send();
}

function addNewBrand() {
    const brand = document.getElementById("brandname");

    const form = new FormData();
    form.append("name", brand.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('post', 'process/add_new_brand.php', true);
    req.send(form);
}

function showUpdateBrandModal(brand) {
    document.getElementById("bid").value = brand['id']
    document.getElementById("u-brandname").value = brand['b_name'];

    new bootstrap.Modal(document.getElementById("updateBrand")).show();
}

function updateBrand() {
    const bId = document.getElementById("bid");
    const bname = document.getElementById("u-brandname");

    const form = new FormData();
    form.append("id", bid.value);
    form.append("name", bname.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('post', 'process/update-brand.php', true);
    req.send(form);
}

function deleteBrand(id) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('get', 'process/delete_brand_process.php?bid=' + id, true);
    req.send();
}

function addNewCategory() {
    const category = document.getElementById("categoryname");

    const form = new FormData();
    form.append("name", category.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('post', 'process/add_new_category.php', true);
    req.send(form);
}

function showUpdateCategoryModal(cat) {
    document.getElementById("cat-id").value = cat['id']
    document.getElementById("u-categoryname").value = cat['name'];

    new bootstrap.Modal(document.getElementById("updatecategory")).show();
}

function updateCategory() {
    const id = document.getElementById("cat-id");
    const name = document.getElementById("u-categoryname");

    const form = new FormData();
    form.append("id", id.value);
    form.append("name", name.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('post', 'process/update-category.php', true);
    req.send(form);
}

function deleteCategory(id) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('get', 'process/delete_category_process.php?cid=' + id, true);
    req.send();
}

function searchOrder() {
    const text = document.getElementById("inv-search-input");
    const dateFrom = document.getElementById("date-from");
    const dateTo = document.getElementById("date-to");

    const form = new FormData();
    form.append("text", text.value);
    form.append("from", dateFrom.value);
    form.append("to", dateTo.value);

    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4) {
            let txt = request.responseText;
            document.getElementById("table-body").innerHTML = txt;
        }
    }

    request.open("POST", "process/search_order_process.php", true);
    request.send(form);
}

function changeOrderStatus(invId) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4) {
            let txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('get', 'process/change_order_status_process.php?invId=' + invId, true);
    req.send();
}