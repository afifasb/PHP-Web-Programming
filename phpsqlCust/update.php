<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['customerNumber'])) {
          //query SQL
          $custNum_upd = $_GET['customerNumber'];
          $query = "SELECT * FROM customers WHERE customerNumber = '$custNum_upd'";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerNumber = $_POST['customerNumber'];
    $customerName = $_POST['customerName'];
    $contactLastName = $_POST['contactLastName'];
    $contactFirstName = $_POST['contactFirstName'];
    $phone = $_POST['phone'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
    $creditLimit = $_POST['creditLimit'];
    //query SQL
      $sql = "UPDATE customers SET customerNumber='$customerNumber', customerName='$customerName', contactLastName='$contactLastName', contactFirstName='$contactFirstName', phone='$phone', addressLine1='$addressLine1', addressLine2='$addressLine2', city='$city', state='$state', postalCode='$postalCode', country='$country', salesRepEmployeeNumber='$salesRepEmployeeNumber', creditLimit='$creditLimit' WHERE customerNumber='$customerNumber'";

      //eksekusi query
      $result = mysqli_query(connection(),$sql);
      if ($result) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: index.php?status='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <title>Example</title>
    <!-- load css boostrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Pemrograman Web</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" style="margin-top:100px;">
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo "index.php"; ?>">Data Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form.php"; ?>">Tambah Data</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


          <h2 style="margin: 30px 0 30px 0;">Update Data Customers</h2>
          <form action="update.php" method="POST">
            <?php while($data = mysqli_fetch_array($result)): ?>
            <div class="form-group">
              <label>Customers Number</label>
              <input type="text" class="form-control" placeholder="Customers Number" name="customerNumber" value="<?php echo $data['customerNumber'];  ?>" required="required" readonly>
            </div>
            <div class="form-group">
              <label>Customers Name</label>
              <input type="text" class="form-control" placeholder="Customers Name" name="customerName" value="<?php echo $data['customerName'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Contact Last Name</label>
              <input type="text" class="form-control" placeholder="Contact Last Name" name="contactLastName" value="<?php echo $data['contactLastName'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Contact First Name</label>
              <input type="text" class="form-control" placeholder="ExtenContact First Namesion" name="contactFirstName" value="<?php echo $data['contactFirstName'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" placeholder="Phone" name="phone" value="<?php echo $data['phone'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Address Line 1</label>
              <input type="text" class="form-control" placeholder="Address Line 1" name="addressLine1" value="<?php echo $data['addressLine1'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Address Line 2</label>
              <input type="text" class="form-control" placeholder="Address Line 2" name="addressLine2" value="<?php echo $data['addressLine2'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $data['city'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>State</label>
              <input type="text" class="form-control" placeholder="State" name="state" value="<?php echo $data['state'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Postal Code</label>
              <input type="text" class="form-control" placeholder="Postal Code" name="postalCode" value="<?php echo $data['postalCode'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Country</label>
              <input type="text" class="form-control" placeholder="Country" name="country" value="<?php echo $data['country'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Sales Rep Employee Number</label>
              <input type="text" class="form-control" placeholder="Sales Rep Employee Number" name="salesRepEmployeeNumber" value="<?php echo $data['salesRepEmployeeNumber'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Credit Limit</label>
              <input type="text" class="form-control" placeholder="Credit Limit" name="creditLimit" value="<?php echo $data['creditLimit'];  ?>" required="required">
            </div>


            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>