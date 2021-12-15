<?php

// List of participants
$participants = [
"User1"   ,
"User2"   ,
"User3"   ,
"User4"   ,
"User5"   ,
"User6"
];

// Check if the number of participants isn't a multiple of 2
if (count($participants) % 2 == 1) {
  echo "Error: Lol i haven't patch this error of algorithm.";
  die;
}

// Create a copy of participants' list
$participants_copy = $participants;

// Check if the list of participants or the copy list are empty
if ($participants == [] || $participants_copy == []) {
  echo "Error: The list of participants if empty.";
  die;
}

// Go through the array of participant and start the algorithm
foreach($participants as $index => $name_of_santa)
{
  // Create a file "[name].santa", this file will be the storage of secret santa 
  $new_file = fopen($name_of_santa.".santa", "w") or die("Error: Unable to open file");

  // Assign a random number by the number of participants in the copy list
  $random_number = array_rand($participants_copy);
  
  // Check if the random number is egal to the index of the donor, it's means the participant gonna be his own secret santa, error
  // Take a new random number
  if ($random_number == $index) {
    while($random_number == $index) {
      $random_number = array_rand($participants_copy);
    }
  }

  // Check if the name of donor is egal to the name of the recipient, it's means the participant gonna be his own secret santa, error
  // Take a new random number
  if ($name_of_santa == $participants_copy[$random_number]) {
    while($name_of_santa == $participants_copy[$random_number]) {
      $random_number = array_rand($participants_copy);
    }
  }

  // echo "DEBUG: ".$name_of_santa." Assign to ".$participants_copy[$random_number]. "\n\n";

  // Check if the list of 
  if (count($participants_copy) == 0) {
    echo "ERROR: ";
    fclose($new_file) or die("Error : Impossible to close the file ".$new_file."\n");
    die;
  }

  // Create the message
  $santa_msg = "Hey ".$name_of_santa.", you are the secret santa of ".$participants_copy[$random_number]."\n";
  
  // Write the message in the file
  fwrite($new_file, $santa_msg) or die("Error: Impossible to write something in the file : ".$new_file."\n");
  
  // Remove the assigned person of the list of participant
  array_splice($participants_copy, $random_number, 1);
  
  // Close the file
  fclose($new_file) or die("Error : Impossible to close the file ".$new_file."\n");
}

?>
