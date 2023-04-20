<nav aria-label="breadcrumb" class="bg-light p-2 py-lg-3">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="index.html" class="text-dark fw-bold text-decoration-none">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page" class="text-secondary">Thông tin liên hệ</li>
  </ol>
</nav>
<div class="container-lg py-2">
  <div class="row mb-4">
    <h1 class="text-primary fw-semibold text-center">Thông tin liên hệ</h1>
  </div>
  <div class="row mb-4">
    <h6>1. Hotline: 1234.565656</h6>
    <h6>2. Email: abc@hcmut.edu.vn</h6>
    <h6>3. Địa chỉ: Ho Chi Minh City University of Technology - 268 Lý Thường Kiệt, phường 14, quận 10, TP.HCM</h6>
    <h6>4. Thông tin liên lạc của các thành viên:</h6>
  </div>
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-around">
  <?php
  $membersName = array('Đỗ Tín Nghĩa', 'Phạm Thế Hiểu', 'Cao Minh Quân', 'Dương Chí Hiếu');
  $membersID = array(2111837, 2111213, 2112109, 2111172);
  $membersEmail = array(
    'nghia.do06082003@hcmut.edu.vn', 
    'hieu.pham14022003@hcmut.edu.vn', 
    'quan.cao2310@hcmut.edu.vn', 
    'hieu.duongminv2705@hcmut.edu.vn'
  );
  for ($i = 0; $i < 4; $i++) {
  ?>
    <div class="col mb-3">
      <div class="card border-0 text-center">
        <div class="img-container" style="height: 200px">
          <img src="https://picsum.photos/200" alt="Employee" class="img-fluid" style="border-radius: 50%; height: 100%">
        </div>
        <div class="card-body pt-2">
          <h5 class="card-title"><?php echo $membersName[$i]; ?></h5>
          <p class="card-text text-muted mb-2"><?php echo ($i == 0) ? 'CEO' : 'Staff' ?></p>
          <p class="card-text mb-2">ID: <?php echo $membersID[$i]; ?></p>
          <p class="card-text mb-2 fs-6">Email: <?php echo $membersEmail[$i]; ?></p>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  </div>
</div>