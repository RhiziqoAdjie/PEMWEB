<?php
include('conn.php');

$status = '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['employeeNumber'])) {

    $employeeNumber_upd = $_GET['employeeNumber'];
    $query = $conn->prepare("SELECT * FROM employees WHERE employeeNumber = :employeeNumber");

    $query->bindParam(':employeeNumber',$employeeNumber_upd);
    $query->execute();
  }
  if (isset($_GET['productLine'])) {

    $productLine_upd = $_GET['productLine'];
    $query = $conn->prepare("SELECT * FROM productlines WHERE productLine = :productLine");

    $query->bindParam(':productLine',$productLine_upd);
    $query->execute();
  }
  if (isset($_GET['customerNumber'])) {

    $customerNumber_upd = $_GET['customerNumber'];
    $query = $conn->prepare("SELECT * FROM customers WHERE customerNumber = :customerNumber");

    $query->bindParam(':customerNumber',$customerNumber_upd);
    $query->execute();

  }
  if (isset($_GET['productCode'])) {

    $productCode_upd = $_GET['productCode'];
    $query = $conn->prepare("SELECT * FROM products WHERE productCode = :productCode");

    $query->bindParam(':productCode',$productCode_upd);
    $query->execute();
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['employee'])) {
      $employeeNumber = $_POST['employeeNumber'];
      $lastName = $_POST['lastName'];
      $firstName = $_POST['firstName'];
      $extension = $_POST['extension'];
      $email = $_POST['email'];
      $officeCode = $_POST['officeCode'];
      $reportsTo = $_POST['reportsTo'];
      $jobTitle = $_POST['jobTitle'];
  
      $query = $conn->prepare("UPDATE employees SET lastName=:lastName, firstName=:firstName, extension=:extension, email=:email, officeCode=:officeCode, reportsTo=:reportsTo, jobTitle=:jobTitle WHERE employeeNumber=:employeeNumber");

      $query->bindParam(':employeeNumber',$employeeNumber);
      $query->bindParam(':lastName',$lastName);
      $query->bindParam(':firstName',$firstName);
      $query->bindParam(':extension',$extension);
      $query->bindParam(':email',$email);
      $query->bindParam(':officeCode',$officeCode);
      $query->bindParam(':reportsTo',$reportsTo);
      $query->bindParam(':jobTitle',$jobTitle);

      $result = $query->execute();
      if ($result) {
        $status = 'ok1';
      } else {
        $status = 'err1';
      }
      header('Location: index.php?status=' . $status);
}
if (isset($_POST['productlines'])) {
    $productLine = $_POST['productLine'];
    $textDescription = $_POST['textDescription'];
    $htmlDescription = $_POST['htmlDescription'];
    $image = $_POST['image'];

    $query = $conn->prepare("UPDATE productlines SET textDescription=:textDescription, htmlDescription=:htmlDescription, image=:image WHERE productLine=:productLine");

    $query->bindParam(':productLine',$productLine);
    $query->bindParam(':textDescription',$textDescription);
    $query->bindParam(':htmlDescription',$htmlDescription);
    $query->bindParam(':image',$image);

    if ($query->execute()) {
        $status = 'ok2';
      } else {
        $status = 'err2';
      }
      header('Location: index.php?status=' . $status . '#productlines');
    }
    if (isset($_POST['customer'])) {
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

    $query = $conn->prepare("UPDATE customers SET customerName = :customerName, contactLastName = :contactLastName, contactFirstName = :contactFirstName, phone = :phone, addressLine1 = :addressLine1, addressLine2 = :addressLine2, city = :city, state = :state, postalCode = :postalCode, country = :country, salesRepEmployeeNumber = :salesRepEmployeeNumber, creditLimit = :creditLimit WHERE customerNumber = :customerNumber");

    $query->bindParam(':customerNumber',$customerNumber);
    $query->bindParam(':customerName',$customerName);
    $query->bindParam(':contactLastName',$contactLastName);
    $query->bindParam(':contactFirstName',$contactFirstName);
    $query->bindParam(':phone',$phone);
    $query->bindParam(':addressLine1',$addressLine1);
    $query->bindParam(':addressLine2',$addressLine2);
    $query->bindParam(':city',$city);
    $query->bindParam(':state',$state);
    $query->bindParam(':postalCode',$postalCode);
    $query->bindParam(':country',$country);
    $query->bindParam(':salesRepEmployeeNumber',$salesRepEmployeeNumber);
    $query->bindParam(':creditLimit',$creditLimit);

    if ($query->execute()) {
      $status = 'ok3';
    } else {
      $status = 'err3';
    }
    header('Location: index.php?status=' . $status . '#customers');
  }

  if (isset($_POST['product'])) {
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor = $_POST['productVendor'];
    $productDescription = $_POST['productDescription'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $MSRP = $_POST['MSRP'];

    $query = $conn->prepare("UPDATE products SET productName = :productName, productLine = :productLine, productScale = :productScale, productVendor = :productVendor, productDescription = :productDescription, quantityInStock = :quantityInStock, buyPrice = :buyPrice, MSRP = :MSRP WHERE productCode = :productCode");

    $query->bindParam(':productCode',$productCode);
    $query->bindParam(':productName',$productName);
    $query->bindParam(':productLine',$productLine);
    $query->bindParam(':productScale',$productScale);
    $query->bindParam(':productVendor',$productVendor);
    $query->bindParam(':productDescription',$productDescription);
    $query->bindParam(':quantityInStock',$quantityInStock);
    $query->bindParam(':buyPrice',$buyPrice);
    $query->bindParam(':MSRP',$MSRP);

    if ($query->execute()) {
      $status = 'ok4';
    } else {
      $status = 'err4';
    }
    header('Location: index.php?status=' . $status . '#products');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Data</title>
        <link rel="stylesheet" href="stylephp.css">
</head>

<body>
    <?php if (isset($_GET['employeeNumber'])) { ?>
        <form action="update.php" method="POST">
            <h2>Update Data Employee</h2>
        <?php while ($data = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="form-group">
                <label>Employee Number</label>
            <input type="number" name="employeeNumber"  value="<?php echo $data['employeeNumber']; ?>"
                required="required" readonly>
            </div>
            <div class="form-group">
                <label>Last Name</label>
            <input type="text" name="lastName" value="<?php echo $data['lastName']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>First Name</label>
            <input type="text" name="firstName" value="<?php echo $data['firstName']; ?>"
                required="required" autocomplete="off">
            </select>
            </div>
            <div class="form-group">
                <label>Extension</label>
            <input type="text" name="extension" value="<?php echo $data['extension']; ?>"
                required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Email</label>
            <input type="text" name="email" value="<?php echo $data['email']; ?>" required="required"
                autocomplete="off">
            </div>
                <label>Office Code</label>
            <select name="officeCode">
                <?php echo "<option value=" . $data['officeCode'] . ">" . $data['officeCode'] . "</option>"; ?>
                <?php
                $query1 = "SELECT officeCode FROM offices";
                $result1 = $conn->query($query1);
                $data1 = '';
                ?>
                <?php while ($data1 = $result1->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php echo "<option value=" . $data1['officeCode'] . ">" . $data1['officeCode'] . "</option>"; ?>
                <?php } ?>
        </select>
            </div>
            </div>
                <label>Reports to</label>
                <select name="reportsTo">
                <?php echo "<option value=" . $data['reportsTo'] . ">" . $data['reportsTo'] . "</option>"; ?>
                <?php
                $query2 = "SELECT employeeNumber FROM employees";
                $result2 = $conn->query($query2);
                $data2 = '';
                ?>
                <?php while ($data2 = $result2->fetch(PDO::FETCH_ASSOC)){ ?>
                <?php echo "<option value=" . $data2['employeeNumber'] . ">" . $data2['employeeNumber'] . "</option>"; ?>
                <?php } ?>
        </select>
            </div>
            <div class="form-group">
                <label>job title</label>
            <input type="text" name="jobTitle" value="<?php echo $data['jobTitle']; ?>" autocomplete="off">
            </div>
    <?php } ?>
        <button type="submit" name="employee">Simpan</button>
    </form>
    <?php } ?>
    <?php if (isset($_GET['productLine'])) { ?>
    <form action="update.php" method="POST">
        <h2>Update Data productlines</h2>
        <?php while ($data = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="form-group">
                <label>Product Line</label>
            <input type="text" name="productLine"  value="<?php echo $data['productLine']; ?>"
                required="required" readonly>
            </div>
            <div class="form-group">
                <label>Text Description</label>
            <input type="text" name="textDescription"  value="<?php echo $data['textDescription']; ?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Html Description</label>
            <input type="text" name="htmlDescription"  autocomplete="off" value="<?php echo $data['htmlDescription']; ?>">
            </div>
            <div class="form-group">
                <label>Image</label>
            <input type="text" name="image" autocomplete="off" value="<?php echo $data['image']; ?>">
            </div>
        <?php } ?>
        <button type="submit" name="productlines">Simpan</button>
    </form>
    <?php } ?>

    <?php if (isset($_GET['customerNumber'])) { ?>
    <form action="update.php" method="POST">
        <h2>Update Data Customer</h2>
        <?php while ($data = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="form-group">
                <label>Customer Number</label>
            <input type="number" name="customerNumber" value="<?php echo $data['customerNumber']; ?>"
                required="required" readonly>
            </div>
            <div class="form-group">
                <label>Customer Name</label>
            <input type="text" name="customerName" value="<?php echo $data['customerName']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>Contact Last Name</label>
            <input type="text" name="contactLastName" value="<?php echo $data['contactLastName']; ?>"
                required="required" autocomplete="off">
            </select>
            </div>
            <div class="form-group">
                <label>Contact First Name</label>
            <input type="text" name="contactFirstName" value="<?php echo $data['contactFirstName']; ?>"
                required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $data['phone']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>Adress Line 1</label>
            <input type="text" name="addressLine1" value="<?php echo $data['addressLine1']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>Adress Line 2</label>
            <input type="text" name="addressLine2" value="<?php echo $data['addressLine2']; ?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label>City</label>
            <input type="text" name="city" value="<?php echo $data['city']; ?>" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label>State</label>
            <input type="text" name="state" value="<?php echo $data['state']; ?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Postal Code</label>
            <input type="text" name="postalCode" value="<?php echo $data['postalCode']; ?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Country</label>
            <input type="text" name="country" value="<?php echo $data['country']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>Sales Rep Employee Number</label>
            <select name="salesRepEmployeeNumber">
                <?php echo "<option value=" . $data['salesRepEmployeeNumber'] . ">" . $data['salesRepEmployeeNumber'] . "</option>"; ?>
                <?php
            $query1 = "SELECT employeeNumber FROM employees";
            $result1 = $conn->query($query1);
            $data1 = '';
            ?>
                <?php while ($data1 = $result1->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php echo "<option value=" . $data1['employeeNumber'] . ">" . $data1['employeeNumber'] . "</option>"; ?>
                <?php } ?>
            </select>
            </div>
            <div class="form-group">
                <label>Credit Limit</label>
            <input type="number" name="creditLimit" value="<?php echo $data['creditLimit']; ?>" autocomplete="off">
            </div>
        <?php } ?>
        <button type="submit" name="customer">Simpan</button>
    </form>
    <?php } ?>

    <?php if (isset($_GET['productCode'])) { ?>
    <form action="update.php" method="POST">
        <h2>Update Data Product</h2>
        <?php while ($data = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="form-group">
                <label>Product Code</label>
            <input type="text" name="productCode" value="<?php echo $data['productCode']; ?>" required="required"
                readonly>
            </div>
            <div class="form-group">
                <label>Product Name</label>
            <input type="text" name="productName" value="<?php echo $data['productName']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>Product Line</label>
            <select name="productLine">
                <?php echo "<option value=" . $data['productLine'] . ">" . $data['productLine'] . "</option>"; ?>
                <?php
            $query1 = "SELECT productLine FROM productlines";
            $result1 = $conn->query($query1);
            ?>
                <?php while ($data1 = $result1->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php echo "<option value=" . "'" . $data1['productLine'] . "'" . ">" . $data1['productLine'] . "</option>"; ?>
                <?php } ?>
            </select>
            </div>
            <div class="form-group">
                <label>Product Scale</label>
            <input type="text" name="productScale" value="<?php echo $data['productScale']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>Product Vendor</label>
            <input type="text" name="productVendor" value="<?php echo $data['productVendor']; ?>" required="required"
                autocomplete="off">
            </div>
            <div class="form-group">
                <label>Product Description</label>
            <input type="text" name="productDescription" value="<?php echo $data['productDescription']; ?>"
                required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Quantity In Stock</label>
            <input type="number" name="quantityInStock" value="<?php echo $data['quantityInStock']; ?>"
                required="required">
            </div>
            <div class="form-group">
                <label>Buy Price</label>
            <input type="number" name="buyPrice" value="<?php echo $data['buyPrice']; ?>" required="required">
            </div>
            <div class="form-group">
                <label>MSRP</label>
            <input type="number" name="MSRP" value="<?php echo $data['MSRP']; ?>" required="required">
            </div>
            <?php } ?>
        <button type="submit" name="product">Simpan</button>
    </form>
    <?php } ?>
</body>

</html>