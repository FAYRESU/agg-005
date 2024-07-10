<?php
include './model/Address.php';
include './model/Person.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = new Address($_POST['street'], $_POST['city'], $_POST['state'], $_POST['postalCode'], $_POST['address_id']);
    $address->save($dbh);
    
    $person = new Person($_POST['name'], $_POST['age'], $address, $_POST['id']);
    $person->save($dbh);
    echo "Person updated successfully!";
    echo '<br><a href="index.php">Back to list</a>';
} else {
    $id = $_GET['id'];
    $stmt = $dbh->prepare("SELECT p.id, p.name, p.age, a.id as address_id, a.street, a.city, a.state, a.postalCode 
                           FROM persons p 
                           JOIN addresses a ON p.address_id = a.id 
                           WHERE p.id = ?");
    $stmt->execute([$id]);
    $person = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo $person['id']; ?>">
    <input type="hidden" name="address_id" value="<?php echo $person['address_id']; ?>">
    Name: <input type="text" name="name" value="<?php echo $person['name']; ?>"><br>
    Age: <input type="number" name="age" value="<?php echo $person['age']; ?>"><br>
    Street: <input type="text" name="street" value="<?php echo $person['street']; ?>"><br>
    City: <input type="text" name="city" value="<?php echo $person['city']; ?>"><br>
    State: <input type="text" name="state" value="<?php echo $person['state']; ?>"><br>
    Postal Code: <input type="text" name="postalCode" value="<?php echo $person['postalCode']; ?>"><br>
    <input type="submit" value="Update">
</form>

<?php
}
?>
