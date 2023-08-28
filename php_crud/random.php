<?php 
function randomname() {
    $maxNameLength = 15;
    $maxSurnameLength = 15;

    $firstNames = ["John", "Jane", "Michael", "Emily", "David", "Sarah", "Robert", "Olivia", "William", "Ava"];
    $lastNames = ["Smith", "Johnson", "Williams", "Brown", "Jones", "Miller", "Davis", "Garcia", "Martinez", "Taylor"];

    $randomFirstName = $firstNames[array_rand($firstNames)];
    $randomLastName = $lastNames[array_rand($lastNames)];

    // Truncate names if they exceed the maximum length
    $randomFirstName = mb_substr($randomFirstName, 0, $maxNameLength);
    $randomLastName = mb_substr($randomLastName, 0, $maxSurnameLength);

    return ucfirst($randomFirstName) . " " . ucfirst($randomLastName);
}

// $randomPersonName = randomname();
// echo $randomPersonName;

?>