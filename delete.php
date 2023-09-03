<?php
include('conn.php');

$status = '';
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['employeeNumber'])) {
    $employeeNumber_upd = $_GET['employeeNumber'];

    $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $query = $conn->prepare("DELETE FROM employees WHERE employeeNumber = :employeeNumber ");

    $query->bindParam(':employeeNumber', $employeeNumber_upd);
    
    if ($query->execute()) {
      $status = 'ok1';
    } else {
      $status = 'err1';
    }

    $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");
    header('Location: index.php?status=' . $status . '#employee');
  }
  if (isset($_GET['productLine'])) {
    $productLine_upd = $_GET['productLine'];
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $query = $conn->prepare("DELETE FROM productlines WHERE productLine = :productLine ");

    $query->bindParam(':productLine', $productLine_upd);

    if ($query->execute()) {
      $status = 'ok2';
    } else {
      $status = 'err2';
    }
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");
    header('Location: index.php?status=' . $status  . '#productlines');
  }
  if (isset($_GET['customerNumber'])) {
    $customerNumber_upd = $_GET['customerNumber'];
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $query = $conn->prepare("DELETE FROM customers WHERE customerNumber = :customerNumber");

    $query->bindParam(':customerNumber', $customerNumber_upd);

    if ($query->execute()) {
      $status = 'ok3';
    } else {
      $status = 'err3';
    }
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");
    header('Location: index.php?status=' . $status . '#customers');
  }
  if (isset($_GET['productCode'])) {
    $productCode_upd = $_GET['productCode'];
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $query = $conn->prepare("DELETE FROM products WHERE productCode = :productCode");
    $query->bindParam(':productCode', $productCode_upd);

    if ($query->execute()) {
      $status = 'ok4';
    } else {
      $status = 'err4';
    }
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");
    header('Location: index.php?status=' . $status . '#products');
  }
}

?>