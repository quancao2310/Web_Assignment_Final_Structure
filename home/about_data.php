<?php
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>

<nav aria-label="breadcrumb" class="bg-light p-2 py-lg-3">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="index.html" class="text-dark fw-bold text-decoration-none">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page" class="text-secondary">
      <?php
      if ($page == "") {
        echo "Giới thiệu";
      }
      else if ($page == "returnPolicy") {
        echo "Chính sách đổi trả";
      }
      else if ($page == "privacyPolicy") {
        echo "Chính sách bảo mật";
      }
      else if ($page == "termsOfService") {
        echo "Điều khoản dịch vụ";
      }
      else {
        die("404");
      }
      ?>
    </li>
  </ol>
</nav>
<div class="container-fluid py-2">
  <div div class="row justify-content-center justify-content-lg-start">
    <div class="sidebar col-11 col-lg-3 border border-dark border-opacity-25 ms-2 mb-3">
      <h5 class="text-uppercase text-primary text-center py-3 mx-3" id="sidebar-header">Danh mục giới thiệu</h5>
      <nav class="nav flex-column p-3" id="sidebar-menu">
        <a class="nav-link text-black fw-semibold px-0<?php if ($page == "") echo " active"; ?>" <?php if ($page == "") echo " aria-current='page'"; ?> href="about.html">Giới thiệu</a>
        <a class="nav-link text-black fw-semibold px-0<?php if ($page == "returnPolicy") echo " active"; ?>" <?php if ($page == "returnPolicy") echo " aria-current='page'"; ?> href="about.html?page=returnPolicy">Chính sách đổi trả</a>
        <a class="nav-link text-black fw-semibold px-0<?php if ($page == "privacyPolicy") echo " active"; ?>" <?php if ($page == "privacyPolicy") echo " aria-current='page'"; ?> href="about.html?page=privacyPolicy">Chính sách bảo mật</a>
        <a class="nav-link text-black fw-semibold px-0<?php if ($page == "termsOfService") echo " active"; ?>" <?php if ($page == "termsOfService") echo " aria-current='page'"; ?> href="about.html?page=termsOfService">Điều khoản dịch vụ</a>
      </nav>
    </div>
    <div class="col-lg-8 ms-3">

    <?php
    if ($page == "") {
    ?>
      <h1 class="text-primary fw-semibold mb-5">Giới thiệu</h1>
      <div class="d-flex justify-content-center w-100 mb-5">
        <img src="images/logo.png" alt="QN2H">
      </div>
      <h5>
        QN2H là local brand được thành lập và xuất hiện lần đầu tiên vào đầu tháng 02/2023. 
        QN2H chuyên bán về các loại quần áo dành cho giới trẻ, ví dụ như áo thun, áo khoác, jeans...,
        và cũng có thêm khá nhiều các sản phẩm khác như đồ mặc đi chơi, mặc đi làm, hay chơi thể thao. 
      </h5>
      <br>
      <br>
      <h5>
        Với nổ lực không ngừng, QN2H đã mang đến một góc nhìn khác hơn về giá thành của thương hiệu Việt.
        QN2H tự hào về sự đảm bảo tuyệt đối chất lượng đầu ra của thương hiệu với tiêu chí: "rẻ - đẹp - chất lượng".
      </h5>
      <br>
      <br>
      <h5>
        Chúng tôi sẽ không dừng lại ở những điều đó. QN2H sẽ mở rộng hơn các sản phẩm, dịch vụ xoay quanh nhu cầu của giới trẻ. 
        Trước mắt, chúng tôi dự định sẽ mở rộng về các mặt hàng về giày, dép, tất, mũ... Chúng tôi cũng sẽ càng ngày càng cải tiến
        chất lượng sản phẩm hơn nữa để không làm khách hàng thất vọng.
      </h5>
      <br>
      <br>
      <h5>
        Hãy cùng nhau đón chờ những sản phẩm mới nhất từ QN2H nhé. Cảm ơn các bạn đã tin tưởng dịch vụ của chúng mình!
      </h5>

    <?php
    }
    else if ($page == "returnPolicy") {
    ?>
      <h1 class="text-primary fw-semibold mb-5">Chính sách đổi trả</h1>
      <h5>Chúng tôi hy vọng bạn hài lòng với sản phẩm của chúng tôi! Tuy nhiên, trong trường hợp bạn không hài lòng 100%, chúng tôi đã có quy trình đổi trả dưới đây:</h5>
      <h6>1. Điều kiện đổi hàng</h6>
      <ul>
        <li>Khách hàng được đổi trả sản phẩm trong vòng 30 ngày kể từ ngày nhận được sản phẩm.</li>
        <li>Áp dụng với tất cả sản phẩm: chưa qua sử dụng và còn tem mác như ban đầu được đính kèm.</li>
        <li>Áp dụng đổi hàng trong trường hợp giao nhầm, thiếu sản phẩm trong đơn hàng.</li>
        <li>
          Với trường hợp sản phẩm bị cắt nhãn mác, trong vòng 7 ngày kể từ ngày nhận bưu phẩm, bạn hãy 
          gửi phản hồi về tụi mình để được giải quyết. Qua mốc thời gian 1 ngày chúng mình sẽ không giải quyết đơn đổi trả.
        </li>
        <li>Sản phẩm đổi phải có giá trị tương đương hoặc cao hơn sản phẩm được đổi. Vui lòng thanh toán chi phí chênh lệch giá trị sản phẩm nếu có.</li>
      </ul>
      <p>Lưu ý: Chúng tôi có quyền quyết định dừng việc hỗ trợ đổi trả lại cho khách hàng nếu phát hiện khách hàng sử dụng chính sách để trục lợi.</p>
      <br>
      <h6>2. Chi phí vận chuyển</h6>
      <p>a. Chi phí vận chuyển khi đổi hàng được hỗ trợ:</p>
      <ul>
        <li>1 chiều cho bạn đối với trường hợp bạn muốn đổi sang size khác theo mong muốn (lỗi không phải do nhà sản xuất).</li>
        <li>2 chiều đối với sản phẩm do lỗi sản xuất, giao nhầm (lỗi do nhà sản xuất).</li>
      </ul>
      <p>b. Chi phí vận chuyển không được hỗ trợ:</p>
      <p>Với sản phẩm trong chương trình khuyến mãi, nếu bạn muốn đổi sang sản phẩm khác phải tự chi trả chi phí vận chuyển.</p>
      <h6>3. Quy trình đổi hàng</h6>
      <p>
      Nhắn tin cho các kênh Mạng xã hội hoặc Shopee, Lazada hoặc Đường dây tiếp nhận phản hồi chính thức của QN2H 
      cung cấp thông tin địa chỉ của bạn: Họ tên, số điện thoại, địa chỉ HOẶC làm theo hướng dẫn dưới đây:
      </p>
      <ul>
        <li>Bước 1: ĐĂNG NHẬP TÀI KHOẢN BẰNG SỐ ĐIỆN THOẠI ĐÃ ĐẶT HÀNG.</li>
        <li>Bước 2: Tại mục TẤT CẢ ĐƠN HÀNG => Chọn sản phẩm cần ĐỔI TRẢ. Điền thông tin lý do đổi trả.</li>
        <li>Bước 3: Nhận cuộc gọi xác nhận từ QN2H qua số hotline 0123 456 789 về sản phẩm và thời gian nhận hàng. Ngay khi xác nhận chúng tôi sẽ gởi bạn đơn hàng mới.</li>
      </ul>
      <p>Mọi thứ sẽ được xử lý trong vòng 24 tiếng mà không hề có bất cứ khó khăn gì.</p>
      <p>
        Lưu ý: Đối với sản phẩm nằm trong chương trình giảm giá, bạn muốn đổi sang sản phẩm khác thì mọi khuyến mại,
        giảm giá sẽ không được giữ, sản phẩm mới sẽ được áp dụng giá tại website chính thức của QN2H tại thời điểm đổi,
        nếu có chênh lệch giá bạn vui lòng thanh toán phần chênh lệch đó và phí giao hàng phát sinh.
      </p>

    <?php
    }
    else if ($page == "privacyPolicy") {
    ?>
      <h1 class="text-primary fw-semibold mb-5">Chính sách bảo mật</h1>
      <p>
        Chính sách bảo mật này nhằm giúp quý khách hiểu về cách website thu thập 
        và sử dụng thông tin cá nhân của mình thông qua việc sử dụng trang web, 
        bao gồm mọi thông tin có thể cung cấp thông qua trang web khi quý khách đăng ký tài khoản,
        khi quý khách mua sản phẩm, dịch vụ, yêu cầu thêm thông tin dịch vụ từ chúng tôi.
      </p>
      <p>
        Chúng tôi sử dụng thông tin cá nhân của quý khách để liên lạc khi cần thiết 
        liên quan đến việc quý khách sử dụng website của chúng tôi, để trả lời các câu hỏi 
        hoặc gửi tài liệu và thông tin quý khách yêu cầu.
      </p>
      <p>
        Trang web của chúng tôi coi trọng việc bảo mật thông tin và sử dụng các biện pháp 
        tốt nhất để bảo vệ thông tin cũng như việc thanh toán của khách hàng.
      </p>
      <p>
        Mọi thông tin giao dịch sẽ được bảo mật ngoại trừ trong trường hợp cơ quan pháp luật yêu cầu.
      </p>

    <?php
    }
    else if ($page == "termsOfService") {
    ?>
      <h1 class="text-primary fw-semibold mb-5">Điều khoản dịch vụ</h1>
      <h6>1. Giới thiệu</h6>
      <p>
        Chào mừng quý khách hàng đến với website chúng tôi.
      </p>
      <p>
        Khi quý khách hàng truy cập vào trang website của chúng tôi có nghĩa là quý khách 
        đồng ý với các điều khoản này. Trang web có quyền thay đổi, chỉnh sửa, thêm hoặc 
        lược bỏ bất kỳ phần nào trong Điều khoản mua bán hàng hóa này, vào bất cứ lúc nào. 
        Các thay đổi có hiệu lực ngay khi được đăng trên trang web mà không cần thông báo trước. 
        Và khi quý khách tiếp tục sử dụng trang web, sau khi các thay đổi về Điều khoản 
        này được đăng tải, có nghĩa là quý khách chấp nhận với những thay đổi đó.
      </p>
      <p>Quý khách hàng vui lòng kiểm tra thường xuyên để cập nhật những thay đổi của chúng tôi.</p>
      <h6>2. Hướng dẫn sử dụng website</h6>
      <p>
        Khi vào trang web của chúng tôi, khách hàng phải đảm bảo đủ 18 tuổi, hoặc truy cập 
        dưới sự giám sát của cha mẹ hay người giám hộ hợp pháp. Khách hàng đảm bảo có đầy đủ 
        hành vi dân sự để thực hiện các giao dịch mua bán hàng hóa theo quy định hiện hành của pháp luật Việt Nam.
      </p>
      <h6>3. Thanh toán an toàn và tiện lợi</h6>
      <p>Người mua có thể tham khảo các phương thức thanh toán sau đây và lựa chọn áp dụng phương thức phù hợp:</p>
      <ul>
        <li>Cách 1: Thanh toán trực tiếp (người mua nhận hàng tại địa chỉ người bán)</li>
        <li>Cách 2: Thanh toán sau (COD - giao hàng và thu tiền tận nơi)</li>
        <li>Cách 3: Thanh toán online qua thẻ tín dụng, chuyển khoản</li>
      </ul>

    <?php
    }
    else {
      die("404");
    }
    ?>
    </div>
  </div>
</div>
