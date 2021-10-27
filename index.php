<?php
require 'vendor/autoload.php';

// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}



use ipinfo\ipinfo\IPinfo;
// Get your API token by signing up at <https://ipinfo.io/signup>
$access_token = "ceba6b332d8264";
// Create a new object from the IPinfo class, passing the token as a parameter
$client = new IPinfo($access_token);
// Declare a variable with the IP

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Simple ip-info Application</title>
</head>

<body>
    <h2 class="mb-4">Simple ip-info Application</h2>

    <div class="container mb-5">
        <div class="col-md-4">
            <form action="" method="get">
                <div class="input-group rounded">
                    <input name="input_ip" type="text" width="50px" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button class="btn btn-primary" type="submit" name="submit_btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    </div>
    <?php

    if (isset($_GET['submit_btn'])) {
        $input_ip=$_GET['input_ip'];
        if(strlen($input_ip)<=4){
            echo "Please Enter valid ip address";
            die();
        }
        // Call the getDetails() method from the IPinfo object passing the IP address
        $details = $client->getDetails($input_ip);
        $record = $details->all;
        echo "<pre>";
        print_r($record);
        echo "</pre>";
    }
    else{
        $user_ip_from_server = get_client_ip();
        $details = $client->getDetails($user_ip_from_server);
        $record = $details->all;
        die();
    }

    ?>
    <div class="container">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th scope="col">Ip address</th>
                    <td><?php echo $record['ip']; ?></td>
                </tr>

                <tr>
                    <th scope="col">Region</th>
                    <td><?php echo $record['region']; ?></td>
                </tr>
                <tr>
                    <th scope="col">Country</th>
                    <td><?php echo $record['country_name']; ?></td>

                </tr>
                <tr>
                    <th scope="col">City</th>
                    <td><?php echo $record['city']; ?></td>
                </tr>
                <tr>
                    <th scope="col">Organization</th>
                    <td><?php echo $record['org']; ?></td>
                </tr>
            </tbody>
        </table>


    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>