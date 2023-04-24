$(document).ready(function () {
    $.post("../modules/header.php", function (data) {
        $("body").prepend(data)
    })
    $.post("../modules/footer.php", function (data) {
        $("body").append(data)
    })
    $.post("cartData.php", function (data) {
        if (data != "") {
            const obj = JSON.parse(data)
            let number = 0
            let price = 0
            for (let row of obj) {
                let str = "<tr id='" + number + "'><td><p>" + row[6] + "</p><p>Size: <span>" + row[3] + "</span></p><p>Màu: <span>" + row[4] + "</span></p></td>"
                str += '<td>' + row[2] + "</td>"
                str += '<td>' + row[5] + "</td>"
                str += '<td><button type="button" class="btn btn-warning" value="' + row[1] + '"onclick="remove(' + row[1] + ',' + number + ')">Bỏ khỏi giỏ</button></td></tr>'
                $("tbody").append(str)
                number++
                price += parseFloat(row[5])
            }
            $("#totalPrice").text(price)
        }
        else {
            $("#isNone").text("Không có sản phẩm nào trong giỏ")
            $("#paybegin").prop("disabled", true)
        }
    })
})
function remove(prod_id, rowNum) {
    let rowNo = "#" + rowNum
    let quantity = parseInt($(rowNo).children().eq(1).text())
    if (quantity == NaN) {
        alert("Vui lòng kiểm tra lại số lượng là một giá trị hợp lệ")
        return
    }
    let size = $(rowNo).children().first().children().eq(1).children().first().text()
    if (size == undefined || size == null || size == "") {
        alert("Vui lòng kiểm tra lại size là một giá trị hợp lệ")
        return
    }
    let color = $(rowNo).children().first().children().eq(2).children().first().text()
    if (color == undefined || color == null || color == "") {
        alert("Vui lòng kiểm tra xem màu là một giá trị hợp lệ")
        return
    }
    $.post("cartRemove.php", {
        prod_id: prod_id,
        quantity: quantity,
        size: size,
        color: color
    }, function (data) {
        alert(data)
        let price = parseFloat($("#totalPrice").text()) - parseFloat($(rowNo).children().eq(2).text())
        $("#totalPrice").text(price)
        $(rowNo).remove()
        let check = $("tbody").children()
        if (check.length == 0) {
            $("#isNone").text("Không có sản phẩm nào trong giỏ")
            $("#paybegin").prop("disabled", true)
        }
    })
}
$("#payment").submit(function (event) {
    event.preventDefault()
    let prod_list = []
    let rows = $("tbody tr")
    for (let row of rows) {
        let prod_id = parseInt($(row).children().last().children().first().val())
        if (prod_id == NaN) {
            alert("Vui lòng kiểm tra lại số lượng là một giá trị hợp lệ")
            return
        }
        let quantity = parseInt($(row).children().eq(1).text())
        if (quantity == NaN) {
            alert("Vui lòng kiểm tra lại số lượng là một giá trị hợp lệ")
            return
        }
        let size = $(row).children().first().children().eq(1).children().first().text()
        if (size == undefined || size == null || size == "") {
            alert("Vui lòng kiểm tra lại size là một giá trị hợp lệ")
            return
        }
        let color = $(row).children().first().children().eq(2).children().first().text()
        if (color == undefined || color == null || color == "") {
            alert("Vui lòng kiểm tra xem màu là một giá trị hợp lệ")
            return
        }
        let data = [
            prod_id,
            quantity,
            size,
            color
        ]
        prod_list.push(data)
    }
    $.post("../payment/paymentValidation.php", {
        prod_list: JSON.stringify(prod_list)
    }, function (data) {
        if (data == "Success") {
            window.location.href = "../payment/payment.php"
        }
        else if (data == "Full") {
            alert("Một sản phẩm nào đó trong giỏ đã không còn đủ số lượng bạn yêu cầu nữa. Chân thành xin lỗi và mong quý khách kiểm tra lại")
            return
        }
    })
})
$(document).ajaxError(function (event, xhr) {
    if (xhr.status == 403) {
        alert("Có vẻ bạn chưa đăng nhập. Vui lòng đăng nhập hoặc kiểm tra lại")
        location.href = "/btl/account/page/login.php"
    }
    else if (xhr.status == 400)
        alert("Có gì đó không ổn với danh sách hàng hoá được gửi đi của bạn. Vui lòng kiểm tra lại.")
    else if (xhr.status == 404) {
        alert("Có sản phẩm nào đó bị sai thông tin gửi đi hoặc không tồn tại. Vui lòng kiểm tra lại.")
        location.href = "/btl/page_not_found.html"
    }
    else if (xhr.status == 500)
        alert("Có gì đó không ổn. Vui lòng thử lại sau.")
})
