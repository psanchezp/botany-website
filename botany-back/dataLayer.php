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
            $result = SQLFindUsername($connection, $username);

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
            $result = SQLFindUsername($connection, $username);

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
            $result = SQLGetProductInfoFromName($connection, $productName);

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

    function verifyClientExists($userName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result =  SQLGetClientInfo($connection, $userName);

            if ($result->num_rows > 0) {
                $response = array("status" => "SUCCESS");
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "423");
            }
        } else {
            return array("status" => "500");
        }
    }

    function verifyProviderExists($userName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result =  SQLGetProviderInfo($connection, $userName);

            if ($result->num_rows > 0) {
                $response = array("status" => "SUCCESS");
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "427");
            }
        } else {
            return array("status" => "500");
        }
    }

    function verifyProductExists($productName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result = SQLGetProductInfoFromName($connection, $productName);

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

    function verifyTransactionExists($transactionID) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result = SQLGetPurchase($connection, $transactionID);

            if ($result->num_rows > 0) {
                $response = array("status" => "SUCCESS");
                $connection->close();
                return $response;
            } else {
                $result = SQLGetSale($connection, $transactionID);
                if ($result->num_rows > 0) {
                    $response = array("status" => "SUCCESS");
                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "437");
                }
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptRegisterClient($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
        $connection = connectionToDataBase();

		if ($connection != null) {
            if ($username != "" && $userPassword != "" && $name != "" && $userDescription != "") {

                $result = SQLRegisterClient($connection, $username, $userPassword, $name, $userDescription, 'client', $userPhone, $userAddress, $userEmail);

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

    function attemptUpdateClient($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
        $connection = connectionToDataBase();

        if ($connection != null) {
           if ($username != "" && $userPassword != "" && $name != "" && $userDescription != "") {

                $result = SQLUpdateFullClient($connection, $username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail);

                if ($result) {
                    $response = array("status" => "SUCCESS", "username" => $username, "passwrd" => $userPassword, "name" => $name, "description" => $userDescription, "type" => 'client', "phone" => $userPhone, "address" => $userAddress, "email" => $userEmail);
                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "422");
                }
            } else {
                $connection->close();
                return array("status" => "421");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptReadClient($userName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result = SQLGetClientInfo($connection, $userName);

            if ($result) {
                $response = array("status" => "SUCCESS", "username" = $result['username'], "passwrd" => $result['passwrd'], "name" => $result['name'], "description" => $result['description'], "type" => 'client', "phone" => $result['phone'], "address" => $result['address'], "email" => $result['email']);
                
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "424");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptDeleteClient($userName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
           
            $result = SQLDeleteClient($connection, $userName);

            if ($result) {
                $response = array("status" => "SUCCESS");
                
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "425");
            }
        } else {
            return array("status" => "500");
        }
    }
    
    function attemptGetAllClients() {
        $connection = connectionToDataBase();

        if ($connection != null) {
           
            $result = SQLGetAllClients($connection);

            $response = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($response, array("username" = $row['username'], "passwrd" => $row['passwrd'], "name" => $row['name'], "description" => $row['description'], "type" => 'client', "phone" => $row['phone'], "address" => $row['address'], "email" => $row['email']));
                }

                $connection->close();
                return array("status" => "SUCCESS", "clients" => $response);
            } else {
                $connection->close();
                return array("status" => "430");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptRegisterProvider($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
        $connection = connectionToDataBase();

		if ($connection != null) {
           if ($username != "" && $userPassword != "" && $name != "" && $userDescription != "") {
                
                $result = SQLRegisterProvider($connection, $username, $userPassword, $name, $userDescription, 'provider', $userPhone, $userAddress, $userEmail);

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

    function attemptUpdateProvider($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
        $connection = connectionToDataBase();

        if ($connection != null) {
           if ($username != "" && $userPassword != "" && $name != "" && $userDescription != "") {

                $result = SQLUpdateFullProvider($connection, $username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail);

                if ($result) {
                    $response = array("status" => "SUCCESS", "username" = $username, "passwrd" => $userPassword, "name" => $name, "description" => $userDescription, "type" => 'provider', "phone" => $userPhone, "address" => $userAddress, "email" => $userEmail);
                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "426");
                }
            } else {
                $connection->close();
                return array("status" => "421");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptReadProvider($userName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result = SQLGetProviderInfo($connection, $userName);

            if ($result) {
                $response = array("status" => "SUCCESS", "username" = $result['username'], "passwrd" => $result['passwrd'], "name" => $result['name'], "description" => $result['description'], "type" => 'provider', "phone" => $result['phone'], "address" => $result['address'], "email" => $result['email']);
                
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "428");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptDeleteProvider($userName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
           
            $result = SQLDeleteProvider($connection, $userName);

            if ($result) {
                $response = array("status" => "SUCCESS");
                
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "429");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptGetAllProviders() {
        $connection = connectionToDataBase();

        if ($connection != null) {
           
            $result = SQLGetAllProviders($connection);

            $response = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($response, array("username" = $row['username'], "passwrd" => $row['passwrd'], "name" => $row['name'], "description" => $row['description'], "type" => 'provider', "phone" => $row['phone'], "address" => $row['address'], "email" => $row['email']));
                }

                $connection->close();
                return array("status" => "SUCCESS", "providers" => $response);
            } else {
                $connection->close();
                return array("status" => "431");
            }
        } else {
            return array("status" => "500");
        }
    }
    
    function attemptRegisterProduct($productName, $productCategory, $productMeasure, $productPrice) {
        $connection = connectionToDataBase();

		if ($connection != null) {
           if ($productName != "" && $productCategory != "" && $productMeasure != "" && $productPrice != "") {

                $result = SQLRegisterProduct($connection, $productName, $productCategory, $productMeasure, $productPrice);

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

                $result = SQLUpdateFullProduct($connection, $oldProductName, $newProductName, $productCategory, $productMeasure, $productPrice);

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
           
            $result = SQLGetProductInfoFromName($connection, $productName);

            if ($result) {
                $response = array("status" => "SUCCESS", "name" => $result['name'], "category" => $result['category'], "measure" => $result['measure'], "price" => $result['price']);
                
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "419");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptDeleteProduct($productName) {
        $connection = connectionToDataBase();

        if ($connection != null) {
           
            $result = SQLDeleteProductWithName($connection, $productName);

            if ($result) {
                $response = array("status" => "SUCCESS");
                
                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "420");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptGetAllProducts() {
        $connection = connectionToDataBase();

        if ($connection != null) {
           
            $result = SQLGetAllProducts($connection);

            $response = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($response, array("name" => $row['name'], "category" => $row['category'], "measure" => $row['measure'], "price" => $row['price']));
                }

                $connection->close();
                return array("status" => "SUCCESS", "products" => $response);
            } else {
                $connection->close();
                return array("status" => "419");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptCreateSale($clientUsername, $productName, $transactionDate, $state, $quantity, $description) {
        $connection = connectionToDataBase();

        if ($connection != null) {

            $result = SQLRegisterSale($connection, $clientUsername, SQLGetProductIDFromName($connection, $productName), $transactionDate, $state, $quantity, $description);

            if ($result) {
                $response = array("status" => "SUCCESS", "username" => $clientUsername, "productName" => $productName, "transactionDate" => $transactionDate, "description" => $description, "state" => $state, "quantity" => $quantity, "transactionType" => "sale");

                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "433");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptCreatePurchase($providerUsername, $productName, $transactionDate, $state, $quantity, $description) {
        $connection = connectionToDataBase();

        if ($connection != null) {

            $result = SQLRegisterPurchase($connection, $clientUsername, SQLGetProductIDFromName($connection, $productName), $transactionDate, $state, $quantity, $description);

            if ($result) {
                $response = array("status" => "SUCCESS", "username" => $providerUsername, "productName" => $productName, "transactionDate" => $transactionDate, "description" => $description, "state" => $state, "quantity" => $quantity, "transactionType" => "purchase");

                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "434");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptUpdateSale($saleID, $clientUsername, $productName, $transactionDate, $state, $quantity, $description) {
        $connection = connectionToDataBase();

        if ($connection != null) {

            $result = SQLUpdateFullSale($connection, $saleID, $clientUsername, SQLGetProductIDFromName($connection, $productName), $transactionDate, $state, $quantity, $description);

            if ($result) {
                $response = array("status" => "SUCCESS", "id" => $saleID, "username" => $clientUsername, "productName" => $productName, "transactionDate" => $transactionDate, "description" => $description, "state" => $state, "quantity" => $quantity, "transactionType" => "sale");

                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "435");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptUpdatePurchase($purchaseID, $providerUsername, $productName, $transactionDate, $state, $quantity, $description) {
        $connection = connectionToDataBase();

        if ($connection != null) {

            $result = SQLUpdateFullPurchase($connection, $purchaseID, $providerUsername, SQLGetProductIDFromName($connection, $productName), $transactionDate, $state, $quantity, $description);

            if ($result) {
                $response = array("status" => "SUCCESS", "id" => $purchaseID, "username" => $providerUsername, "productName" => $productName, "transactionDate" => $transactionDate, "description" => $description, "state" => $state, "quantity" => $quantity, "transactionType" => "purchase");

                $connection->close();
                return $response;
            } else {
                $connection->close();
                return array("status" => "436");
            }
        } else {
            return array("status" => "500");
        }
    }

    function attemptDeleteTransaction($transactionID) {
        $connection = connectionToDataBase();

        if ($connection != null) {
            $result = SQLGetPurchase($connection, $transactionID);
            if ($result) {
                $result = SQLDeletePurchase($connection, $transactionID);
                if ($result) {
                    $response = array("status" => "SUCCESS", "id" => $transactionID);

                    $connection->close();
                    return $response;
                } else {
                    $connection->close();
                    return array("status" => "438");
                }
            } else {
                $result = SQLGetSale($connection, $transactionID);
                if ($result) {
                    $result = SQLDeleteSale($connection, $transactionID);
                    if ($result) {
                        $response = array("status" => "SUCCESS", "id" => $transactionID);

                        $connection->close();
                        return $response;
                    } else {
                        $connection->close();
                     return array("status" => "439");
                    }
                } else {
                    $connection->close();
                    return array("status" => "437");
                }
            }
        } else {
            return array("status" => "500");
        }
    }
?>
