$(document).ready(function() {
    $.post("../utilities/header.php", function(data) {
        $("body").prepend(data)
    })
    $.post("../utilities/footer.php", function(data) {
        $("body").append(data)
    })
    let typeGroup = Object.create(null)
    $.get("productListData.php", function(data) {
        let productData = JSON.parse(data)
        for (let row of productData) {
            if (!typeGroup[row[1]]) {
                typeGroup[row[1]] = new Array()
            }
            typeGroup[row[1]].push(row)
        }
        let typeStr = ""
        let slideStr = ""
        let count = 1
        for (let row in typeGroup) {
            let newType = true
            let itemNum = 0
            for (let product of typeGroup[row]) {
                if (newType) {
                    newType = false
                    typeStr += '<a class="list-group-item list-group-item-light list-group-item-action" href="#list-item-' + count + '">'
                    typeStr += row + '</a>'
                    slideStr += '<h4 id="list-item-' + count + '">' + row + '</h4>'
                    slideStr += '<div class="carousel slide" id="items' + count + '" data-bs-ride="carousel">'
                    slideStr += '<div class="carousel-inner">'
                }
                if (itemNum % 4 == 0) {
                    if (itemNum != 0) {
                        slideStr += '</div></div>'
                        slideStr += '<div class="carousel-item"><div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">'
                    } else
                        slideStr += '<div class="carousel-item active"><div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">'
                }
                slideStr += '<div class="col mb-4"><div class="card">'
                slideStr += '<img src="' + product[4] + '" class="card-img-top p-2" alt="Image">'
                slideStr += '<div class="card-body text-center"><p class="card-text text-truncate">' + product[2] + '</p>'
                slideStr += '<p class="card-text">Giá: ' + product[3] + '</p>'
                slideStr += '<form method="post" action="../productDetail/productDetail.php">'
                slideStr += '<button type="submit" class="btn btn-secondary" name="product_id" value="' + product[0] + '">'
                slideStr += 'Chi tiết</button></form></div></div></div>'
                itemNum++
            }
            slideStr += '</div></div></div></div>'
            slideStr += '<div class="d-flex justify-content-center my-3"><div class="btn-group" role="group" aria-label="item-set">'
            slideStr += '<button class="btn btn-outline-secondary" type="button" data-bs-target="#items' + count + '"data-bs-slide="prev">Trang trước</button>'
            slideStr += '<button class="btn btn-outline-secondary" type="button" data-bs-target="#items' + count + '"data-bs-slide="next">Trang tiếp</button>'
            slideStr += '</div></div>'
            count++
        }
        $(".productType").html(typeStr)
        $(".productSlide").html(slideStr)
    })
})