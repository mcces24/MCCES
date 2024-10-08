<?php
function logLoginAttempt($conn, $email, $portal, $type, $location, $completeAddress, $lat, $lon) {
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

    // Step 1: Delete old records if there are more than 30
    // $deleteStmt = $conn->prepare("DELETE FROM login_logs WHERE id NOT IN (SELECT id FROM (SELECT id FROM login_logs ORDER BY created_at DESC LIMIT 100) AS temp)");
    // $deleteStmt->execute();
    // $deleteStmt->close();

    // Step 2: Insert the new record
    $stmt = $conn->prepare("INSERT INTO login_logs (attemp, portal, type, location, com_location, lat, lon, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $email, $portal, $type, $location, $completeAddress, $lat, $lon, $currentDateTime);
    $stmt->execute();
    $stmt->close();
}


function getUserLocation() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $locationData = @file_get_contents("http://ip-api.com/json/{$ip}");

    if ($locationData === false) {
        return [
            'success' => false,
            'message' => "Error: Please try again later!",
            'data' => null
        ];
    }

    $locationData = json_decode($locationData, true);
    if (isset($locationData['status']) && $locationData['status'] === 'fail') {
        return [
            'success' => false,
            'message' => "System: Please try again later!",
            'data' => null
        ];
    }

    $lat = $locationData['lat'] ?? 0;
    $lon = $locationData['lon'] ?? 0;
    $location = $locationData['city'] . ', ' . $locationData['regionName'] . ', ' . $locationData['country'];

    return [
        'success' => true,
        'data' => [
            'lat' => $lat,
            'lon' => $lon,
            'location' => $location
        ]
    ];
}

function getCompleteAddress($lat, $lon) {

    if (isset($_COOKIE['latitude']) && !empty($_COOKIE['latitude']) && isset($_COOKIE['longitude']) && !empty($_COOKIE['longitude'])) {
        $lat = $_COOKIE['latitude'];
        $lon = $_COOKIE['longitude'];
    }
    
    $nominatimUrl = "https://nominatim.openstreetmap.org/reverse?lat={$lat}&lon={$lon}&format=json";
    $options = ["http" => ["header" => "User-Agent: MyApp/1.0 (myemail@example.com)\r\n"]];
    $context = stream_context_create($options);
    $nominatimData = @file_get_contents($nominatimUrl, false, $context);

    if ($nominatimData === false) {
        return [
            'success' => false,
            'message' => "Error fetching: Please try again later!",
            'address' => null
        ];
    }

    $nominatimData = json_decode($nominatimData, true);
    if (isset($nominatimData['address'])) {
        $addressParts = [
            $nominatimData['address']['road'] ?? 'N/A',
            $nominatimData['address']['neighbourhood'] ?? 'N/A',
            $nominatimData['address']['hamlet'] ?? 'N/A',
            $nominatimData['address']['city'] ?? 'N/A',
            $nominatimData['address']['region'] ?? 'N/A',
            $nominatimData['address']['postcode'] ?? 'N/A',
            $nominatimData['address']['country'] ?? 'N/A',
            $nominatimData['address']['country_code'] ?? 'N/A',
        ];
        $completeAddress = implode(', ', array_filter($addressParts));
        return [
            'success' => true,
            'address' => $completeAddress
        ];
    }

    return [
        'success' => false,
        'message' => "Error: Unable to retrieve!",
        'address' => null
    ];
}

?>
