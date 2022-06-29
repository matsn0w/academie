<?php

include_once('class.serverdb.php');

$voornaam = $serverdb->real_escape_string($_GET['voornaam']);
$achternaam = $serverdb->real_escape_string($_GET['achternaam']);

$result = $serverdb->query('SELECT * FROM characters WHERE firstname = "' . $voornaam . '" AND lastname = "' . $achternaam . '"');

$identifiers = array();

$licenses = array();

$readable_licenses = array();

$bills = array();

$warrants = array();

$cars = array();

// strafblad

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $licenses_result = $serverdb->query('SELECT type FROM user_licenses WHERE owner = "' . $row['identifier'] . '"');

        while ($license = $licenses_result->fetch_assoc()) {
            array_push($licenses, $license);
        }

        foreach ($licenses as $license_type) {
            $license_readable = $serverdb->query('SELECT label FROM licenses WHERE type = "' . $license_type['type'] . '"');

            while ($license_rd = $license_readable->fetch_assoc()) {
                array_push($readable_licenses, $license_rd['label']);
            }
        }

        $bills_result = $serverdb->query('SELECT label, amount FROM billing WHERE identifier = "' . $row['identifier'] . '"');

        while ($bill = $bills_result->fetch_assoc()) {
            array_push($bills, $bill);
        }

        $warrant_result = $serverdb->query('SELECT * FROM warrants WHERE fullname = "' . $row['firstname'] . ' ' . $row['lastname'] . '"');

        while ($warrant = $warrant_result->fetch_assoc()) {
            array_push($warrants, $warrant);
        }

        $vehicle_result = $serverdb->query('SELECT * FROM owned_vehicles WHERE owner = "' . $row['identifier'] . '"');

        while ($car = $vehicle_result->fetch_assoc()) {
            array_push($cars, json_decode($car['vehicle'])->plate);
        }

        $identifiers[$row['identifier']] = array('firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'date_of_birth' => $row['dateofbirth'],
            'licenses' => $readable_licenses,
            'bills' => $bills,
            'warrants' => $warrants,
            'cars' => $cars);
    }
}

echo json_encode($identifiers);
