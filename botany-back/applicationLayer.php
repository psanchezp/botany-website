<?php
	header('Accept: application/json');
	header('Content-type: application/json');
	require_once __DIR__ . '/dataLayer.php';

	$action = $_POST["action"];

	switch($action) {
        case "LOGIN"             : loginUser();        break;
        case "LOGOUT"            : logoutUser();       break;
        case "REGISTER_CLIENT"   : registerClient();   break;
        case "REGISTER_PROVIDER" : registerProvider(); break;
        case "REGISTER_PRODUCT"  : registerProduct();  break;
        case "UPDATE_PRODUCT"    : updateProduct();    break;
        case "READ_PRODUCT"      : readProduct();      break;
        case "DELETE_PRODUCT"    : deleteProduct();    break;
    }

    function loginUser() {
        $username     = $_POST["username"];
        $userPassword = $_POST["userPassword"];
        $remember     = $_POST["rememberMe"];
        
        if ($username != "" && $userPassword != "") {
            $result = attemptLogin($username);

            if ($result["status"] == "SUCCESS") {
                $decryptedPassword = decryptPassword($result['password']);

                if ($decryptedPassword === $userPassword) {
                    startSession($username, $result["type"]);

                    if ($remember == "true") {
                        startCookie($username, $userPassword);
                    }

                    echo json_encode($result);
                } else {
                    // Usuario correcto, contraseña incorrecta
                    errorHandling("407");
                }
            } else {
                // Usuario incorrecto
                errorHandling($result["status"]);
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
                // al registrarse se hace login e inicia la sesion
                startSession($username, "client");

				echo json_encode($result);
			} else {
                errorHandling($result["status"]);
            }  
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
                // al registrarse se hace login e inicia la sesion
                startSession($username, "provider");
				echo json_encode($result);
			} else {
                errorHandling($result["status"]);
            }
		} else {
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
            errorHandling($response["status"]);
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
            errorHandling($response["status"]);
        }
    }

    function deleteProduct() {
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
            errorHandling($response["status"]);
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

    function encryptPassword() {
        $userPassword = $_POST["userPassword"];

        $key       = pack('H*', "bcb04b7e103a05afe34763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $key_size  = strlen($key);
        $plaintext = $uContrasena;
        $iv_size   = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv        = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);
        $ciphertext = $iv . $ciphertext;
        
        $uContrasena = base64_encode($ciphertext);

        return $uContrasena;
        
    }

    function decryptPassword($userPassword) {
        $key            = pack('H*', "bcb04b7e103a05afe34763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $iv_size        = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $ciphertext_dec = base64_decode($uContrasenaBD);
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
			case "ERROR" : header('HTTP/1.1 416 No existe un usuario registrado con los datos dados.');
                        die("Los datos ingresados no coinciden con un usuario registrado.");
						break;
            default : header('HTTP/1.1 417 Error en la aplicación.')
                      die("Error en la aplicación.")ñ
                      break;
		}
	}
?>