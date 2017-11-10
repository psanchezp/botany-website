<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('Access-Control-Allow-Methods: GET, POST, PUT');
    require_once __DIR__ . '/dataLayer.php';

	$action = $_POST["action"];

	switch($action) {
        case "LOGIN"                 : loginUser();        break;
        case "LOGOUT"                : logoutUser();       break;

        case "GET_CURRENT_USER"      : getCurrentUser();     break;
        case "GET_CURRENT_USER_TYPE" : getCurrentUserType(); break;

        case "REGISTER_CLIENT"       : registerClient();   break;
        case "UPDATE_CLIENT"         : updateClient();     break;
        case "READ_CLIENT"           : readClient();       break;
        case "DELETE_CLIENT"         : deleteClient();     break;
        case "GET_CLIENTS"           : getAllClients();    break;

        case "REGISTER_PROVIDER"     : registerProvider(); break;
        case "UPDATE_PROVIDER"       : updateProvider();   break;
        case "READ_PROVIDER"         : readProvider();     break;
        case "DELETE_PROVIDER"       : deleteProvider();   break;
        case "GET_PROVIDERS"         : getAllProviders();  break;

        case "REGISTER_PRODUCT"      : registerProduct();  break;
        case "UPDATE_PRODUCT"        : updateProduct();    break;
        case "READ_PRODUCT"          : readProduct();      break;
        case "DELETE_PRODUCT"        : deleteProduct();    break;
        case "GET_PRODUCTS"          : getAllProducts();   break;

        case "CREATE_TRANSACTION"    : createTransaction();   break;
        case "UPDATE_TRANSACTION"    : updateTransaction();   break;
        case "DELETE_TRANSACTION"    : deleteTransaction();   break;
        case "FINALIZE_TRANSACTION"  : finalizeTransaction(); break;

        case "GET_TRANSACTIONS"                 : getAllTransactions();             break;
        case "GET_FINALIZED_TRANSACTIONS"       : getFinalizedTransactions();       break;
        case "GET_NONFINALIZED_TRANSACTIONS"    : getNonFinalizedTransactions();    break;
        case "GET_TRANSACTIONS_BY_CLIENT"       : getClientTransactions();          break;
        case "GET_TRANSACTIONS_BY_PROVIDER"     : getProviderTransactions();        break;

        case "GET_SESSION"           : getSession(); break;

        case "GENERATE_REPORT"       : generateReport(); break;
    }

    function getSession() {
        if (isset($_SESSION["username"]) && isset($_SESSION["type"])) {
            echo json_encode(array("status" => "SUCCESS", "username" => $_SESSION["username"], "type" => $_SESSION["type"]));
        } else {
            header('HTTP/1.1 406 Session not started');
            die("You haven't logged in! You will be redirected to the login page.");
        }
    }

    function loginUser() {
        $username     = $_POST["username"];
        $userPassword = $_POST["userPassword"];
        
        if ($username != "" && $userPassword != "") {
            $result = attemptLogin($username);

            if ($result["status"] == "SUCCESS") {
                $decryptedPassword = decryptPassword($result['passwrd']);
                
                if ($decryptedPassword === $userPassword) {
                    startSession($username, $result["type"]);
                    startCookie($username, $userPassword);
                    
                    echo json_encode($result);
                } else {
                    // Usuario correcto, contraseña incorrecta
                    errorHandling("407");
                }
            } else {
                // Usuario incorrecto
                errorHandling("407");
            } 
        } else {
            // Login con usuario y/o contraseña vacios
            errorHandling("406");
        }
    }

    function logoutUser() {
        session_start();
        if (isset($_SESSION["username"]) && isset($_SESSION["type"])) {
            unset($_SESSION["username"]);
            unset($_SESSION["type"]);
            session_destroy();
            echo json_encode(array("status" => "SUCCESS"));
        } else {
            errorHandling("408");
        }
    }

    function registerClient() {
        $username = $_POST["username"];
        
        $result = verifyUserDoesNotExist($username);

        if ($result["status"] == "SUCCESS") {
            $userPassword    = encryptPassword();
            $name            = $_POST["name"];
            $userDescription = $_POST["userDescription"];
            $userPhone       = $_POST["userPhone"];
            $userAddress     = $_POST["userAddress"];
            $userEmail       = $_POST["userEmail"];

            $result = attemptRegisterClient($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail);
			
            if ($result["status"] == "SUCCESS") {
				echo json_encode($result);
			} else {
                errorHandling($result["status"]);
            }  
		} else {
			errorHandling($result["status"]);
		}
    }

    function updateClient() {
        $username        = $_POST["username"];
        $userPassword    = encryptPassword();
        $name            = $_POST["name"];
        $userDescription = $_POST["userDescription"];
        $userPhone       = $_POST["userPhone"];
        $userAddress     = $_POST["userAddress"];
        $userEmail       = $_POST["userEmail"];
        
        $result = attemptUpdateClient($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail);

        if ($result["status"] == "SUCCESS") { 
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function readClient() {
        $username = $_POST["username"];

        $result = verifyClientExists($username);

        if ($result["status"] == "SUCCESS") {

            $result = attemptReadClient($username);

            if ($result["status"] == "SUCCESS") { 
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function deleteClient() {
        $username = $_POST["username"];

        $result = verifyClientExists($username);

        if ($result["status"] == "SUCCESS") {
            $result = attemptDeleteClient($username);

            if ($result["status"] == "SUCCESS") { 
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function getAllClients() {
        $result = attemptGetAllClients();

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function registerProvider() {
        $username = $_POST["username"];
        
        $result = verifyUserDoesNotExist($username);

        if ($result["status"] == "SUCCESS") {
			$userPassword    = encryptPassword();
            $name            = $_POST["name"];
            $userDescription = $_POST["userDescription"];
            $userPhone       = $_POST["userPhone"];
            $userAddress     = $_POST["userAddress"];
            $userEmail       = $_POST["userEmail"];
        
            $result = attemptRegisterProvider($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail);
			
            if ($result["status"] == "SUCCESS") { 
				echo json_encode($result);
			} else {
                errorHandling($result["status"]);
            }
		} else {
			errorHandling($result["status"]);
		}
    }

    function updateProvider() {
        $username        = $_POST["username"];
        $userPassword    = encryptPassword();
        $name            = $_POST["name"];
        $userDescription = $_POST["userDescription"];
        $userPhone       = $_POST["userPhone"];
        $userAddress     = $_POST["userAddress"];
        $userEmail       = $_POST["userEmail"];
        
        $result = attemptUpdateProvider($username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail);

        if ($result["status"] == "SUCCESS") { 
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function readProvider() {
        $username = $_POST["username"];

        $result = verifyProviderExists($username);

        if ($result["status"] == "SUCCESS") {

            $result = attemptReadProvider($username);

            if ($result["status"] == "SUCCESS") { 
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function deleteProvider() {
        $username = $_POST["username"];

        $result = verifyProviderExists($username);

        if ($result["status"] == "SUCCESS") {
            $result = attemptDeleteProvider($username);

            if ($result["status"] == "SUCCESS") { 
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function getAllProviders() {
        $result = attemptGetAllProviders();

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        }
        else {
            errorHandling($result["status"]);
        }
    }

    function registerProduct() {
        $productName = $_POST["productName"];

        $result = verifyProductDoesNotExist($productName);

        if ($result["status"] == "SUCCESS") {
            $productCategory = $_POST["productCategory"];
            $productMeasure  = $_POST["productMeasure"];
            $productPrice    = $_POST["productPrice"];

            $result = attemptRegisterProduct($productName, $productCategory, $productMeasure, $productPrice);

            if ($result["status"] == "SUCCESS") { 
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function updateProduct() {
        $oldProductName = $_POST["oldProductName"];
        $newProductName = $_POST["newProductName"];
        $productCategory = $_POST["productCategory"];
        $productMeasure  = $_POST["productMeasure"];
        $productPrice    = $_POST["productPrice"];

        $result = attemptUpdateProduct($oldProductName, $newProductName, $productCategory, $productMeasure, $productPrice);

        if ($result["status"] == "SUCCESS") { 
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function readProduct() {
        $productName = $_POST["productName"];

        $result = verifyProductExists($productName);

        if ($result["status"] == "SUCCESS") {

            $result = attemptReadProduct($productName);

            if ($result["status"] == "SUCCESS") { 
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function deleteProduct() {
        $productName = $_POST["productName"];

        $result = verifyProductExists($productName);

        if ($result["status"] == "SUCCESS") {
            $result = attemptDeleteProduct($productName);

            if ($result["status"] == "SUCCESS") { 
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function getAllProducts() {
        $result = attemptGetAllProducts();

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function createTransaction() {
        $productName = $_POST["productName"];
        $result = verifyProductExists($productName);

        if ($result["status"] == "SUCCESS") {
            $username        = $_POST["username"];
            $transactionType = $_POST["transactionType"];
            $transactionDate = $_POST["transactionDate"];
            $state           = $_POST["state"];
            $quantity        = $_POST["quantity"];
            $description     = $_POST["description"];

            if (strtolower($transactionType) == "sale") {
                $result = verifyClientExists($username);
                if ($result["status"] == "SUCCESS") {
                    
                    $result = attemptCreateSale($username, $productName, $transactionDate, $state, $quantity, $description);
                    if ($result["status"] == "SUCCESS") {
                        echo json_encode($result);
                    } else {
                        errorHandling($result["status"]);
                    }
                } else {
                    errorHandling($result["status"]);
                }
            } else if (strtolower($transactionType) == "purchase") {
                $result = verifyProviderExists($username);
                if ($result["status"] == "SUCCESS") {

                    $result = attemptCreatePurchase($username, $productName, $transactionDate, $state, $quantity, $description);
                    if ($result["status"] == "SUCCESS") {
                        echo json_encode($result);
                    } else {
                        errorHandling($result["status"]);
                    }
                } else {
                    errorHandling($result["status"]);
                }
            } else {
                errorHandling("432");
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function updateTransaction() {
        $transactionID = $_POST["transactionID"];
        $result = verifyTransactionExists($transactionID);
        if ($result["status"] == "SUCCESS") {
            $username        = $_POST["username"];
            $transactionType = $_POST["transactionType"];
            $productName     = $_POST["productName"];
            $transactionDate = $_POST["transactionDate"];
            $state           = $_POST["state"];
            $quantity        = $_POST["quantity"];
            $description     = $_POST["description"];

            $result = verifyProductExists($productName);

            if ($result["status"] == "SUCCESS") {
                if (strtolower($transactionType) == "sale") {
                    $result = verifyClientExists($username);
                    if ($result["status"] == "SUCCESS") {
                        
                        $result = attemptUpdateSale($transactionID, $username, $productName, $transactionDate, $state, $quantity, $description);
                        if ($result["status"] == "SUCCESS") {
                            echo json_encode($result);
                        } else {
                            errorHandling($result["status"]);
                        }
                    } else {
                        errorHandling($result["status"]);
                    }
                } else if (strtolower($transactionType) == "purchase") {
                    $result = verifyProviderExists($username);
                    if ($result["status"] == "SUCCESS") {

                        $result = attemptUpdatePurchase($transactionID, $username, $productName, $transactionDate, $state, $quantity, $description);
                        if ($result["status"] == "SUCCESS") {
                            echo json_encode($result);
                        } else {
                            errorHandling($result["status"]);
                        }
                    } else {
                        errorHandling($result["status"]);
                    }
                } else {
                    errorHandling("432");
                }
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function deleteTransaction() {
        $transactionID = $_POST["transactionID"];
        $result = verifyTransactionExists($transactionID);
        if ($result["status"] == "SUCCESS") {
            $result = attemptDeleteTransaction($transactionID);
            if ($result["status"] == "SUCCESS") {
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function finalizeTransaction() {
        $transactionID = $_POST["transactionID"];
        $result = verifyTransactionExists($transactionID);
        if ($result["status"] == "SUCCESS") {
            $result = attemptFinalizeTransaction($transactionID);
            if ($result["status"] == "SUCCESS") {
                echo json_encode($result);
            } else {
                errorHandling($result["status"]);
            }
        } else {
            errorHandling($result["status"]);
        }
    }

    function getAllTransactions() {
        $result = attemptGetAllTransactions();

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function getFinalizedTransactions() {
        $result = attemptGetFinalizedTransactions();

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function getNonFinalizedTransactions() {
        $result = attemptGetNonFinalizedTransactions();

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function getProviderTransactions() {
        $username = $_POST["username"];
        $result = attemptGetProviderTransactions($username);

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function getClientTransactions() {
        $username = $_POST["username"];
        $result = attemptGetClientTransactions($username);

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function generateReport() {
        $transactionDateStart = $_POST["transactionDateStart"];
        $transactionDateFinish = $_POST["transactionDateFinish"];
        $transactionType = $_POST["transactionType"];
        $transactionUsername = $_POST["transactionUsername"];
        $transactionProductName = $_POST["transactionProductName"];
        $transactionState = $_POST["transactionState"];

        $result = attemptGenerateReport($transactionDateStart, $transactionDateFinish, $transactionType, $transactionUsername, $transactionProductName, $transactionState);

        if ($result["status"] == "SUCCESS") {
            echo json_encode($result);
        } else {
            errorHandling($result["status"]);
        }
    }

    function startCookie($username, $userPassword) {
        setcookie("cookieUsername", $username, time() + 3600 * 24 * 20);
        setcookie("cookiePassword", $userPassword, time() + 3600 * 24 * 20);
    }

    function startSession($username, $userType) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["type"]     = $userType;
    }

    function getCurrentUser() {
        session_start();
        if (isset($_SESSION["username"])) {
            return $_SESSION["username"];
        } else {
            errorHandling("441");
        }
    }

    function getCurrentUserType() {
        if (isset($_SESSION["type"])) {
            return $_SESSION["type"];
        } else {
            errorHandling("441");
        }
    }

    function encryptPassword() {
        $userPassword = $_POST["userPassword"];

        $key       = pack('H*', "bcb04b7e103a05afe34763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $key_size  = strlen($key);
        $plaintext = $userPassword;
        $iv_size   = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv        = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);
        $ciphertext = $iv . $ciphertext;
        
        $userPassword = base64_encode($ciphertext);

        return $userPassword;
    }

    function decryptPassword($userPassword) {
        $key            = pack('H*', "bcb04b7e103a05afe34763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $iv_size        = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $ciphertext_dec = base64_decode($userPassword);
        $iv_dec         = substr($ciphertext_dec, 0, $iv_size);
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);
        $userPassword   = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
       
        $count = 0;
        $length = strlen($userPassword);

        for ($i = $length - 1; $i >= 0; $i--) {
            if (ord($userPassword{$i}) === 0){
                $count++;
            }
        } 

        $userPassword = substr($userPassword, 0,  $length - $count); 

        return $userPassword;
    }

	function errorHandling($errorStatus) {
		switch ($errorStatus) {
            case "500" : header("HTTP/1.1 500 No se ha conectado a la base de datos.");
                        die("El servidor esta caído, inténtelo nuevamente.");
						break;
            case "406" : header("HTTP/1.1 406 Usuario y/o contraseña vacíos.");
                        die("Ingrese un usuario y contraseña válidos.");
						break;
            case "407" : header('HTTP/1.1 407 Los datos ingresados no coinciden con los guardados.');
                        die("Los datos ingresados no coinciden con los guardados.");
                        break;
            case "408" : header('HTTP/1.1 408 Sesión expirada.');
                        die("Tu sesión ha expirado o no fue creada con anterioridad.");
                        break;
            case "409" : header("HTTP/1.1 409 Un cliente con ese nombre de usuario ya existe.");
                        die("Ya existe un cliente con el mismo nombre de usuario, eliga otro.");
                        break;
            case "410" : header("HTTP/1.1 410 Los datos están vacíos.");
                        die("Ingrese un usuario, contraseña, nombre y descripción válidos.");
                        break;
            case "411" : header("HTTP/1.1 411 No se ha podido crear el cliente");
                        die("No se ha podido crear el nuevo cliente.");
                        break;
            case "412" : header("HTTP/1.1 412 Un proveedor con ese nombre de usuario ya existe.");
                        die("Ya existe un proveedor con el mismo username, eliga otro.");
                        break;
            case "413" : header("HTTP/1.1 413 No se ha podido crear el proveedor");
                        die("No se ha podido crear el nuevo proveedor.");
                        break;
            case "414" : header("HTTP/1.1 414 Datos vacíos");
                        die("Ingrese un nombre, categoría, medida y precio válidos.");
                        break;
            case "415" : header("HTTP/1.1 415 No se ha podido crear el producto");
                        die("No se ha podido crear el nuevo producto.");
                        break;
            case "416" : header("HTTP/1.1 416 Un producto con ese nombre ya existe.");
                        die("Ya existe un producto con el mismo nombre, eliga otro.");
                        break;
            case "417" : header("HTTP/1.1 417 No existe un producto con ese nombre.");
                        die("No existe un producto con ese nombre.");
                        break;
            case "418" : header("HTTP/1.1 418 No se ha podido actualizar el producto");
                        die("No se ha podido actualizar la información del producto.");
                        break;
            case "419" : header("HTTP/1.1 419 No se ha podido leer la informacion del producto");
                        die("No se ha podido leer la información del producto.");
                        break;
            case "420" : header("HTTP/1.1 420 No se ha podido eliminar el producto");
                        die("No se ha podido eliminar el producto seleccionado.");
                        break;
            case "421" : header("HTTP/1.1 421 Datos vacíos");
                        die("Ingrese un usuario, contraseña, nombre, descripción, teléfono, dirección y correo válidos.");
                        break;
            case "422" : header("HTTP/1.1 422 No se ha podido actualizar el cliente");
                        die("No se ha podido actualizar la información del cliente.");
                        break;
            case "423" : header("HTTP/1.1 423 No existe un cliente con ese nombre de usuario.");
                        die("No existe un cliente con ese nombre de usuario.");
                        break;
            case "424" : header("HTTP/1.1 424 No se ha podido leer la informacion del cliente");
                        die("No se ha podido leer la informacion del cliente.");
                        break;
            case "425" : header("HTTP/1.1 425 No se ha podido eliminar el cliente");
                        die("No se ha podido eliminar el cliente seleccionado.");
                        break;
            case "426" : header("HTTP/1.1 426 No se ha podido actualizar el proveedor");
                        die("No se ha podido actualizar la información del proveedor.");
                        break;
            case "427" : header("HTTP/1.1 427 No existe un proveedor con ese nombre de usuario.");
                        die("No existe un proveedor con ese nombre de usuario.");
                        break;
            case "428" : header("HTTP/1.1 428 No se ha podido leer la informacion del proveedor");
                        die("No se ha podido leer la informacion del proveedor.");
                        break;
            case "429" : header("HTTP/1.1 429 No se ha podido eliminar el proveedor");
                        die("No se ha podido eliminar el proveedor seleccionado.");
                        break;
            case "430" : header("HTTP/1.1 430 No se han encontrado clientes");
                        die("No existen clientes dentro de la base de datos.");
                        break;
            case "431" : header("HTTP/1.1 431 No se han encontrado proveedores");
                        die("No existen proveedores dentro de la base de datos.");
                        break;
            case "432" : header("HTTP/1.1 432 Tipo de transaccion inválida.");
                        die("El tipo de transaccion seleccionado no es válido.");
                        break;
            case "433" : header("HTTP/1.1 433 No se ha podido registrar la venta.");
                        die("No se ha podido registrar la venta con el cliente.");
                        break;
            case "434" : header("HTTP/1.1 434 No se ha podido registrar la compra.");
                        die("No se ha podido registrar la compra con el proveedor.");
                        break;
            case "435" : header("HTTP/1.1 435 No se ha podido actualizar la venta.");
                        die("No se ha podido actualizar la venta con el cliente.");
                        break;
            case "436" : header("HTTP/1.1 436 No se ha podido actualizar la compra.");
                        die("No se ha podido actualizar la compra con el proveedor.");
                        break;
            case "437" : header("HTTP/1.1 437 No se ha encontrado la transacción.");
                        die("No se ha encontrado la transacción.");
                        break;
            case "438" : header("HTTP/1.1 438 No se ha podido eliminar la compra.");
                        die("No se ha podido eliminar la compra.");
                        break;
            case "439" : header("HTTP/1.1 439 No se ha podido eliminar la venta.");
                        die("No se ha podido eliminar la venta.");
                        break;
            case "440" : header("HTTP/1.1 440 No se ha podido finalizar la transacción.");
                        die("No se ha podido finalizar la transacción.");
                        break;
            case "441" : header("HTTP/1.1 441 No hay ninguna sesión iniciada.");
                        die("No hay ninguna sesión iniciada.");
                        break;
			case "ERROR" : header('HTTP/1.1 416 No existe un usuario registrado con los datos dados.');
                        die("Los datos ingresados no coinciden con un usuario registrado.");
						break;
            default : header('HTTP/1.1 417 Error en la aplicación.');
                      die("Error en la aplicación.");
                      break;
		}
	}
?>
