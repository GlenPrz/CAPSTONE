<?php
$msg = $_POST['message'] ?? "";
$contacts = $_POST['ContactNumStd'];

$contactNumbers = explode(',', $contacts);

$apiKey = '36c5d8f733da639166ae30e26020ab10'; // Replace with your Semaphore API key

$ch = curl_init();

foreach ($contactNumbers as $contactNumber) {
    $trimmedNumber = ltrim($contactNumber, '0');

    // Validate phone number format using regex
    if (preg_match('/^\d{10}$/', $trimmedNumber)) {
        $parameters = array(
            'apikey' => $apiKey,
            'number' => '+63' . $trimmedNumber,
            'message' => $msg,
            'sendername' => 'SEMAPHORE'
        );

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Send request to Semaphore API
        $output = curl_exec($ch);

        // Handle response or log as needed
        // echo $output;

    } else {
        // Invalid phone number, skip or handle accordingly
        echo "Invalid phone number: $contactNumber\n";
    }
}

curl_close($ch);
echo "Messages sent successfully!";
?>
