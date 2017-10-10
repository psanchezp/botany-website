<?php

    require_once __DIR__ . '/SQL-Queries.php';

	function connectionToDataBase() {
		$servername = "localhost";
		$username   = "root";
		$passwrd    = "root";
		$dbname     = "botanychips";
        
		$conn = new mysqli($servername, $username, $passwrd, $dbname);
		
		if ($conn->connect_error) {
			return null;
		} else {
			return $conn;
		}
	}

    function attemptLogin($username) {
        $connection = connectionToDataBase();
		if ($connection != null) {
            $result = FindUsername($connection, $username);

            if ($result->num_rows > 0) {   
                while($row = $result->fetch_assoc()) {
                    $response = array("status" => "SUCCESS", "username" => $row['username'], "passwrd" => $row['passwrd'], "name" => $row['name'], "description" => $row['description'], "type" => $row['type'], "phone" => $row['phone'], "address" => $row['address'], "email" => $row['email']);
                }
            
                $connection->close();
                return $response;    
            } else {
                $connection->close();
				return array("status" => "ERROR");
            }
        } else {
			return array("status" => "500");
		}
    }

    function verifyUserDoesNotExist($username) {
    	$connection = connectionToDataBase();

        if ($connection != null) {
            $result = FindUsername($connection, $username);

			if ($result->num_rows == 0) {
                $response = array("status" => "SUCCESS");
				$connection->close();
				return $response;
            } else {
				$connection->close();
				return array("status" => "409");
			}
        } else {
        	return array("status" => "500");
        }
    }

    function verifyProductDoesNotExist($productName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result = GetProductInfoFromName($connection, $productName);

            if ($result->num_rows == 0) {
                $response = array("status" => "SUCCESS");
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "416");
            }
        } else {
            return array("status" => "500");
        }
    }

    function verifyProductExists($productName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result = GetProductInfoFromName($connection, $productName);

            if ($result->num_rows > 0) {
                $response = array("status" => "SUCCESS");
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "417");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptRegisterClient($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
        $connection = connectionToDataBase();

		if ($connection != null) {
            if ($username != "" && $userPassword != "" && $name != "" && $userDescription != "") {

                $result = RegisterClient($connection, $username, $userPassword, $name, $userDescription, 'client', $userPhone, $userAddress, $userEmail);

                if ($result) {
                    $response = array("status" => "SUCCESS", "username" => $username, "passwrd" => $userPassword, "name" => $name, "description" => $userDescription, "type" => 'client', "phone" => $userPhone, "address" => $userAddress, "email" => $userEmail);

                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "411");
                }
            } else {
				$connection->close();
				return array("status" => "410");
			}
        } else {
			return array("status" => "500");
		}
    }

    function attemptRegisterProvider($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
        $connection = connectionToDataBase();

		if ($connection != null) {
           if ($username != "" && $userPassword != "" && $name != "" && $userDescription != "") {
                
                $result = RegisterProvider($connection, $username, $userPassword, $name, $userDescription, 'provider', $userPhone, $userAddress, $userEmail);

                if ($result) {
                    $response = array("status" => "SUCCESS", "username" => $username, "passwrd" => $userPassword, "name" => $name, "description" => $userDescription, "type" => 'provider', "phone" => $userPhone, "address" => $userAddress, "email" => $userEmail);

                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "413");
                }
            } else {
				$connection->close();
				return array("status" => "410");
			}
        } else {
			return array("status" => "500");
		}
    }
    
    function attemptRegisterProduct($productName, $productCategory, $productMeasure, $productPrice) {
        $connection = connectionToDataBase();

		if ($connection != null) {
           if ($productName != "" && $productCategory != "" && $productMeasure != "" && $productPrice != "") {

                $result = RegisterProduct($conn, $productName, $productCategory, $productMeasure, $productPrice);

                if ($result) {
                    $response = array("status" => "SUCCESS", "name" => $productName, "category" => $productCategory, "measure" => $productMeasure, "price" => $productPrice);
                    
                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "415");
                }
            } else {
				$connection->close();
				return array("status" => "414");
			}
        } else {
			return array("status" => "500");
		}
    }

    function attemptUpdateProduct($oldProductName, $newProductName, $productCategory, $productMeasure, $productPrice) {
        $connection = connectionToDataBase();

        if ($connection != null) {
           if ($oldProductName != "" && $newProductName != "" && $productCategory != "" && $productMeasure != "" && $productPrice != "") {

                $result = UpdateFullProduct($conn, $oldProductName, $newProductName, $productCategory, $productMeasure, $productPrice);

                if ($result) {
                    $response = array("status" => "SUCCESS", "oldName" => $oldProductName, "newName" => $newProductName, "category" => $productCategory, "measure" => $productMeasure, "price" => $productPrice);
                    
                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "418");
                }
            } else {
                $connection->close();
                return array("status" => "414");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptReadProduct($productName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
           
            $result = GetProductInfoFromName($conn, $productName);

            if ($result) {
                $response = array("status" => "SUCCESS", "name" => $result['name'], "category" => $result['category'], "measure" => $result['measure'], "price" => $result['price']);
                
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "418");
            }
        } else {
            return array("status" => "500");
        }
    }
?>
