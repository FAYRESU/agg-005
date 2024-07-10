<?php
include 'config.php';
include 'model/Address.php';
include 'model/Person.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $person_id = $_POST['id'];
    
    // Get the address ID before deleting the person
    $stmt = $dbh->prepare("SELECT address_id FROM persons WHERE id = ?");
    $stmt->execute([$person_id]);
    $address_id = $stmt->fetchColumn();
    
    Person::delete($dbh, $person_id);
    Address::delete($dbh, $address_id);
    
    echo "Person deleted successfully!";
    echo '<br><a href="index.php">Back to list</a>';
} else {
    $id = $_GET['id'];
?>

<form method="post" action="delete.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p>Are you sure you want to delete this person?</p>
    <input type="submit" value="Delete">
</form>

<?php
}
?>
