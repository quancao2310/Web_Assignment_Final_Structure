let instock_qty = 0
$(document).ready(function () {
    $.post("productDetailData.php", { product_id: prod_id }, function (data) {
        let product_detail = JSON.parse(data)
        let prod_img = ""
        let prod_indicator = ""
        for (let count = 0; count < 5; count++) {
            if (product_detail[0][count + 8] != null) {
                if (count == 0)
                    prod_img += '<div class="carousel-item active">'
                else
                    prod_img += '<div class="carousel-item">'
                prod_img += '<img src="' + product_detail[0][count + 8] + '" alt="Big Photo Here!" width="300"></div>'
                prod_indicator += '<a href="#detail" data-bs-slide-to="' + count + '" aria-current="true" aria-controls="detail">'
                prod_indicator += '<img src="' + product_detail[0][count + 8] + '" width="40" alt="Indicator Photo Here!"></a>'
            }
        }
        $(".detailPhotos").html(prod_img)
        $(".detailIndicators").html(prod_indicator)
        $("#prod_name").html(product_detail[0][2])
        $("#prod_price").html(product_detail[0][6])
        let prod_size = product_detail[0][4].split(",")
        let prod_size_str = ""
        for (let size of prod_size) {
            prod_size_str += '<option value="' + size + '">' + size + '</option>'
        }
        $("#prod_size").html(prod_size_str)
        let prod_col = product_detail[0][3].split(",")
        let prod_col_str = ""
        for (let col of prod_col) {
            prod_col_str += '<div class="form-check form-check-inline">'
            prod_col_str += '<input class="form-check-input" type="radio" id="inlineRadio1" name="prod_col" value="' + col + '">'
            prod_col_str += '<label class="form-check-label" for="inlineradio1">' + col + '</label></div>'
        }
        $("#prod_col").html(prod_col_str)
        $("#prod_des").html(product_detail[0][5])
        if (parseInt(product_detail[0][7]) >= 15) {
            let str = "<p class='text-success'>Còn hàng</p>"
            $("#qty-status").html(str)
        }
        else if (parseInt(product_detail[0][7]) > 0) {
            let str = "<p class='text-danger'>Còn " + product_detail[0][7] + " sản phẩm</p>"
            $("#qty-status").html(str)
        }
        else {
            let str = "<p class='text-danger'>Hết hàng</p>"
            $("#qty-status").html(str)
            $("#add-to-cart").prop("disabled", true)
            $("#minus-q").prop("disabled", true)
            $("#add-q").prop("disabled", true)
        }
        instock_qty = product_detail[0][7]
    })
    $.post("productDetailRelevant.php", { product_id: prod_id }, function (data) {
        if (data != "") {
            const obj = JSON.parse(data)
            let itemNum = 0
            let slideStr = ""
            slideStr += '<div class="carousel slide" id="items" data-bs-ride="carousel">'
            slideStr += '<div class="carousel-inner">'
            for (let product of obj) {
                if (itemNum % 4 == 0) {
                    if (itemNum != 0) {
                        slideStr += '</div></div>'
                        slideStr += '<div class="carousel-item"><div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">'
                    } else
                        slideStr += '<div class="carousel-item active"><div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">'
                }
                slideStr += '<div class="col mb-4"><div class="card">'
                slideStr += '<img src="' + product[3] + '" class="card-img-top p-2" alt="Image">'
                slideStr += '<div class="card-body text-center"><p class="card-text text-truncate">' + product[1] + '</p>'
                slideStr += '<p class="card-text">Giá: ' + product[2] + '</p>'
                slideStr += '<form method="post" action="../productDetail/productDetail.php">'
                slideStr += '<button type="submit" class="btn btn-secondary" name="product_id" value="' + product[0] + '">'
                slideStr += 'Chi tiết</button></form></div></div></div>'
                itemNum++
            }
            slideStr += '</div></div></div></div>'
            slideStr += '<div class="d-flex justify-content-center my-3"><div class="btn-group" role="group" aria-label="item-set">'
            slideStr += '<button class="btn btn-outline-secondary" type="button" data-bs-target="#items" data-bs-slide="prev">Trang trước</button>'
            slideStr += '<button class="btn btn-outline-secondary" type="button" data-bs-target="#items" data-bs-slide="next">Trang tiếp</button>'
            slideStr += '</div></div>'
            $(".relevant").html(slideStr)
        }
        else {
            let str = "<p class='text-center'>Không có sản phẩm liên quan</p>"
            $(".relevant").html(str)
        }
    })
})

function changeQuantity(operator) {
    let quantity = document.getElementById("quantity")
    switch (operator) {
        case "+":
            if (parseInt(quantity.value) + 1 <= instock_qty) {
                quantity.value++
                return
            }
            else {
                alert("Số lượng bạn chọn vượt quá lượng hàng còn trong kho")
                return
            }
        case "-":
            if (quantity.value > 1)
                quantity.value--
            return
    }
}

function checkValid() {
    let quantity = document.getElementById("quantity")
    if (quantity.value <= 0)
        quantity.value = 1
    else if (quantity.value > instock_qty)
        quantity.value = instock_qty
}

function add(prod_id) {
    let quantity = parseInt($("#quantity").val())
    if (quantity == NaN || quantity <= 0) {
        alert("Vui lòng kiểm tra lại số lượng là một giá trị hợp lệ")
        return
    }
    else if (quantity > instock_qty) {
        alert("Số lượng bạn chọn vượt quá lượng hàng còn trong kho")
        return
    }
    let size = $("#prod_size").val()
    if (size == undefined || size == null || size == "") {
        alert("Vui lòng kiểm tra xem size đã được chọn chưa")
        return
    }
    if ($("input[name=prod_col]:checked").length == 0 || $("input[name=prod_col]:checked").val() == "") {
        alert("Vui lòng chọn màu để tiếp tục")
        return
    }
    $.post("/btl/cart/cartAdd.php", {
        prod_id: prod_id,
        quantity: quantity,
        size: size,
        color: $("input[name=prod_col]:checked").val()
    }, function (data) {
        alert(data)
    })
}

$(document).ajaxError(function (event, xhr) {
    if (xhr.status == 403) {
        alert("Có vẻ bạn chưa đăng nhập. Vui lòng đăng nhập hoặc kiểm tra lại")
        location.href = "/btl/account/page/login.php"
    }
    else if (xhr.status == 404) {
        alert("Có vẻ sản phẩm này không tồn tại, đã bị xoá hoặc sai thông tin. Vui lòng kiểm tra lại")
        location.href = "/btl/page_not_found.html"
    }
    else if (xhr.status == 500)
        alert("Có gì đó không ổn. Vui lòng thử lại")
})