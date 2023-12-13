<?php

// List of participants
$participants = [
    "User1",
    "User2",
    "User3",
    "User4",
    "User5",
    "User6"
];

// Check if the list of participants is empty
if (empty($participants)) {
    echo "Error: The list of participants is empty.";
    die;
}

// Shuffle the participants to randomize the order
shuffle($participants);

// Create a file for each participant
foreach ($participants as $index => $name_of_santa) {
    // Assign the next participant as the secret Santa
    $recipient_index = ($index + 1) % count($participants);

    // Create a file "[name].santa", this file will be the storage of secret Santa information
    $new_file = fopen($name_of_santa . ".santa", "w") or die("Error: Unable to open file");

    // Create the message
    $santa_msg = "Hey $name_of_santa, you are the secret Santa of " . $participants[$recipient_index] . "\n";
    
    // Remove commentary to display the result
    //print($santa_msg);

    // Write the message in the file
    fwrite($new_file, $santa_msg) or die("Error: Unable to write to the file: $new_file\n");

    // Close the file
    fclose($new_file) or die("Error: Unable to close the file: $new_file\n");
}

?>
