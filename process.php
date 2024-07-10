<?php
include "./model/Address.php";
include "./model/Person.php";

// ตัวอย่างข้อมูล (คุณอาจต้องดึงข้อมูลจากฐานข้อมูลในกรณีจริง)
session_start();
if (!isset($_SESSION['people'])) {
    $_SESSION['people'] = [
        new Person('John Doe', 30, new Address('123 Main St', 'Springfield', 'IL', '62701')),
        new Person('Jane Doe', 25, new Address('456 Elm St', 'Springfield', 'IL', '62702'))
    ];
}
$people = $_SESSION['people'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];

    $address = new Address($street, $city, $state, $postalCode);
    $person = new Person($name, $age, $address);

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $people[$id] = $person;
    } else {
        $people[] = $person;
    }

    $_SESSION['people'] = $people;
    header('Location: index.php');
    exit();
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    unset($people[$id]);
    $_SESSION['people'] = $people;
    header('Location: index.php');
    exit();
}
?>