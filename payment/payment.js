$(document).ready(function () {
    $.post("../modules/header.php", function (data) {
        $("body").prepend(data)
    })
    $.post("../modules/footer.php", function (data) {
        $("body").append(data)
    })
    $.post("paymentData.php", function (data) {
        if (data != "") {
            const obj = JSON.parse(data)
            let totalPrice = 0
            for (let prod of obj) {
                let str = '<tr><td><div class="row justify-content-between"><div class="col-auto">'
                str += '<h6>' + prod[5] + '</h6>'
                str += '<p>' + prod[3] + '</p>'
                str += '<p>' + prod[2] + '</p>'
                str += '</div><div class="col-auto">'
                str += '<p>' + prod[4] + '</p>'
                str += '</div></div></td></tr>'
                $("table").append(str)
                totalPrice += parseFloat(prod[4])
            }
            $("#totalPrice").text(totalPrice)
            $("#finalPrice").text(totalPrice + 30000)
        }
    })
})

function isNull(input) {
    if (input == undefined || input == null || input == "")
        return true
    return false
}

const vietnameseNameRegex = /^[\p{L}\s]+$/u;
function validateVietnameseName(name) {
    return vietnameseNameRegex.test(name);
}

const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
function validateEmail(email) {
    return emailRegex.test(email);
}


$("#paymentInfo").submit(function (event) {
    event.preventDefault()
    let clientName = $("#clientName").val()
    if (isNull(clientName) || !validateVietnameseName(clientName)) {
        alert("Vui lòng nhập tên khách hàng theo đúng chuẩn tên tiếng Việt (hoặc tiếng Anh)")
        return
    }
    let address = $("#address").val()
    if (isNull(address)) {
        alert("Vui lòng nhập địa chỉ giao hàng!")
        return
    }
    let email = $("#email").val()
    if (!isNull(email) && !validateEmail(email)) {
        alert("Vui lòng chỉnh sửa lại email hoặc để trống nếu bạn không có hoặc không muốn cung cấp!")
        return
    }
    let phoneNumber = $("#phoneNumber").val()
    if (isNull(phoneNumber) || !(/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/.test(phoneNumber.toString()))) {
        alert("Vui lòng nhập số điện thoại!")
        return
    }
    let deliveryMethod = $("input[name=deliveryMethod]:checked").val()
    if (isNull(deliveryMethod)) {
        alert("Vui lòng chọn phương thức giao hàng nếu chưa chọn!")
        return
    }
    let paymentMethod = $("input[name=paymentMethod]:checked").val()
    if (isNull(paymentMethod)) {
        alert("Vui lòng chọn phương thức thanh toán nếu chưa chọn!")
        return
    }
    $.post("paymentAdd.php", {
        clientName: clientName,
        address: address,
        email: email,
        phoneNumber: phoneNumber,
        deliveryMethod: deliveryMethod,
        paymentMethod: paymentMethod
    }, function (data) {
        if (data == "Empty") {
            alert(`Có vẻ danh sách hàng hoá của bạn đang trống, hoặc bạn vừa xác nhận thanh toán cho cùng đơn hàng này. 
            Reload trang để kiểm tra lại, và vào giỏ hàng ấn thanh toán lại nếu bạn thật sự muốn đặt thêm một đơn tương tự`)
            return
        }
        else if (data == "Full") {
            alert("Một sản phẩm nào đó trong giỏ đã không còn đủ số lượng bạn yêu cầu nữa. Chân thành xin lỗi và mong quý khách kiểm tra lại")
            return
        }
        else if (data = "Success") {
            alert("Hoá đơn đã được thêm thành công và đang được xử lí")
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