<?php
include "./model/Address.php";
include "./model/Person.php";

// ตัวอย่างข้อมูล (คุณอาจต้องดึงข้อมูลจากฐานข้อมูลในกรณีจริง)
$people = [
    new Person('John Doe', 30, new Address('123 Main St', 'Springfield', 'IL', '62701')),
    new Person('Jane Doe', 25, new Address('456 Elm St', 'Springfield', 'IL', '62702'))
];

echo '<h1>List of People</h1>';
echo '<table border="1">';
echo '<tr><th>Name</th><th>Age</th><th>Address</th><th>Actions</th></tr>';
foreach ($people as $index => $person) {
    echo '<tr>';
    echo '<td>' . $person->getName() . '</td>';
    echo '<td>' . $person->getAge() . '</td>';
    echo '<td>' . $person->getAddress() . '</td>';
    echo '<td>';
    echo '<a href="edit.php?id=' . $index . '">Edit</a> | ';
    echo '<a href="process.php?action=delete&id=' . $index . '">Delete</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

echo '<br><a href="form.html">Add New Person</a>';
?>