<?php
	function SQLFindUsername($conn, $userName) {
		$query = "SELECT * FROM 
					(SELECT username, passwrd, NULL AS name, NULL AS description, type, NULL AS phone, NULL AS address, NULL as email FROM Administrator 
				  	UNION
				  	SELECT * FROM Client
				  	UNION
				  	SELECT * FROM Provider) AS T
				  WHERE username = '$userName';";

		$result = $conn->query($query);
		return $result;
	}

	function SQLRegisterClient($conn, $userName, $userPassword, $name, $userDescription, $userType, $userPhone, $userAddress, $userEmail) {
		$query = "INSERT INTO Client VALUES ('$userName', '$userPassword', '$name', '$userDescription', '$userType', '$userPhone', '$userAddress', '$userEmail');";
		return mysqli_query($conn, $query);
	}

	function SQLRegisterProvider($conn, $userName, $userPassword, $name, $userDescription, $userType, $userPhone, $userAddress, $userEmail) {
		$query = "INSERT INTO Provider VALUES ('$userName', '$userPassword', '$name', '$userDescription', '$userType', '$userPhone', '$userAddress', '$userEmail');";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllClients($conn) {
		$query = "SELECT * FROM Client;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetClientInfo($conn, $userName) {
		$query = "SELECT * FROM Client WHERE username = '$userName';";
		return mysqli_query($conn, $query);
	}

	function SQLGetAllProviders($conn) {
		$query = "SELECT * FROM Provider;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetProviderInfo($conn, $userName) {
		$query = "SELECT * FROM Provider WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateFullClient($conn, $username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
		$query = "UPDATE Client SET passwrd = '$userPassword', name = '$name', description = '$userDescription', type = 'client', phone = '$userPhone', address = '$userAddress', email = '$userEmail' WHERE username = '$username';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateClient($conn, $userName, $column, $value) {
		if (strtolower($column) == "username") {
			$query = "UPDATE Client
				  SET username = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "passwrd") {
			$query = "UPDATE Client
				  SET passwrd = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "name") {
			$query = "UPDATE Client
				  SET name = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "description") {
			$query = "UPDATE Client
				  SET description = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "type") { 
			$query = "UPDATE Client
				  SET type = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "phone") { 
			$query = "UPDATE Client
				  SET phone = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "address") { 
			$query = "UPDATE Client
				  SET address = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "email") { 
			$query = "UPDATE Client
				  SET email = '$value'
				  WHERE username = '$userName';";
		}

		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateFullProvider($conn, $username, $userPassword, $name, $userDescription, $userPhone, $userAddress, $userEmail) {
		$query = "UPDATE Provider SET passwrd = '$userPassword', name = '$name', description = '$userDescription', type = 'provider', phone = '$userPhone', address = '$userAddress', email = '$userEmail' WHERE username = '$username';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateProvider($conn, $userName, $column, $value) {
		if (strtolower($column) == "username") {
			$query = "UPDATE Provider
				  SET username = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "passwrd") {
			$query = "UPDATE Provider
				  SET passwrd = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "name") {
			$query = "UPDATE Provider
				  SET name = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "description") {
			$query = "UPDATE Provider
				  SET description = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "type") { 
			$query = "UPDATE Provider
				  SET type = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "phone") { 
			$query = "UPDATE Provider
				  SET phone = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "address") { 
			$query = "UPDATE Provider
				  SET address = '$value'
				  WHERE username = '$userName';";
		} else if (strtolower($column) == "email") { 
			$query = "UPDATE Provider
				  SET email = '$value'
				  WHERE username = '$userName';";
		}

		$result = $conn->query($query);
		return $result;
	}

	function SQLDeleteClient($conn, $userName) {
		$query = "DELETE FROM Client
				  WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLDeleteProvider($conn, $userName) {
		$query = "DELETE FROM Provider
				  WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllProducts($conn) {
		$query = "SELECT * FROM Product;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetProductIDFromName($conn, $productName) {
		$query = "SELECT ID FROM Product WHERE name = '$productName';";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		return $row['ID'];
	}

	function SQLRegisterProduct($conn, $productName, $productCategory, $productMeasure, $productPrice) {
		$query = "INSERT INTO Product VALUES (DEFAULT, '$productName', '$productCategory', '$productMeasure', '$productPrice');";
		return mysqli_query($conn, $query);
	}

	function SQLGetProductInfo($conn, $productID) {
		$query = "SELECT * FROM Product WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetProductInfoFromName($conn, $productName) {
		$productID = SQLGetProductIDFromName($conn, $productName);
		$query = "SELECT * FROM Product WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetProductName($conn, $productID) {
		$query = "SELECT name FROM Product WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateFullProduct($conn, $oldProductName, $newProductName, $productCategory, $productMeasure, $productPrice) {
		$productID = SQLGetProductIDFromName($conn, $oldProductName);
		$query = "UPDATE Product SET name = '$newProductName', category = '$productCategory', measure = '$productMeasure', price = '$productPrice' WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateProduct($conn, $productID, $column, $value) {
		if (strtolower($column) == "name") {
			$query = "UPDATE Product
				  SET name = '$value'
				  WHERE ID = '$productID';";
		} else if (strtolower($column) == "category") {
			$query = "UPDATE Product
				  SET category = '$value'
				  WHERE ID = '$productID';";
		} else if (strtolower($column) == "measure") {
			$query = "UPDATE Product
				  SET measure = '$value'
				  WHERE ID = '$productID';";
		} else if (strtolower($column) == "price") {
			$query = "UPDATE Product
				  SET price = '$value'
				  WHERE ID = '$productID';";
		}

		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateProductWithName($conn, $productName, $column, $value) {
		$productID = SQLGetProductIDFromName($conn, $productName);
		
		if (strtolower($column) == "name") {
			$query = "UPDATE Product
				  SET name = '$value'
				  WHERE ID = '$productID';";
		} else if (strtolower($column) == "category") {
			$query = "UPDATE Product
				  SET category = '$value'
				  WHERE ID = '$productID';";
		} else if (strtolower($column) == "measure") {
			$query = "UPDATE Product
				  SET measure = '$value'
				  WHERE ID = '$productID';";
		} else if (strtolower($column) == "price") {
			$query = "UPDATE Product
				  SET price = '$value'
				  WHERE ID = '$productID';";
		}

		$result = $conn->query($query);
		return $result;
	}

	function SQLDeleteProduct($conn, $productID) {
		$query = "DELETE FROM Product
				  WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLDeleteProductWithName($conn, $productName) {
		$productID = SQLGetProductIDFromName($conn, $productName);
		$query = "DELETE FROM Product
				  WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllTransactions($conn) {
		$query = "SELECT * FROM Purchases
				  UNION
				  SELECT * FROM Sales;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllPurchases($conn) {
		$query = "SELECT * FROM Purchases;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllSales($conn) {
		$query = "SELECT * FROM Sales;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllNonFinalizedTransactions($conn) {
		$query = "SELECT * FROM Purchases WHERE state = 0
				  UNION
				  SELECT * FROM Sales WHERE state = 0;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllNonFinalizedPurchases($conn) {
		$query = "SELECT * FROM Purchases WHERE state = 0;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllNonFinalizedSales($conn) {
		$query = "SELECT * FROM Sales WHERE state = 0;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllFinalizedTransactions($conn) {
		$query = "SELECT * FROM Purchases WHERE state = 1
				  UNION
				  SELECT * FROM Sales WHERE state = 1;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllFinalizedPurchases($conn) {
		$query = "SELECT * FROM Purchases WHERE state = 1;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetAllFinalizedSales($conn) {
		$query = "SELECT * FROM Sales WHERE state = 1;";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetPurchase($conn, $transactionID) {
		$query = "SELECT * FROM Purchases WHERE ID = '$transactionID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetSale($conn, $transactionID) {
		$query = "SELECT * FROM Sales WHERE ID = '$transactionID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetTransactionsWithClient($conn, $userName) {
		$query = "SELECT * FROM Sales WHERE client_username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetTransactionsWithProvider($conn, $userName) {
		$query = "SELECT * FROM Purchases WHERE prov_username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetTransactionsWithProduct($conn, $productID) {
		$query = "SELECT * FROM Purchases WHERE prod_id = '$productID'
				  UNION
				  SELECT * FROM Sales WHERE prod_id = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetTransactionsWithProductName($conn, $productName) {
		$productID = SQLGetProductIDFromName($conn, $productName);
		$query = "SELECT * FROM Purchases WHERE prod_id = '$productID'
				  UNION
				  SELECT * FROM Sales WHERE prod_id = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetPurchasesBetweenDates($conn, $firstDate, $secondDate) {
		$query = "SELECT * FROM Purchases WHERE transaction_date >= '$firstDate' and transaction_date <= '$secondDate';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLGetSalesBetweenDates($conn, $firstDate, $secondDate) {
		$query = "SELECT * FROM Sales WHERE transaction_date >= '$firstDate' and transaction_date <= '$secondDate';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLRegisterPurchase($conn, $providerUsername, $productID, $transactionDate, $state, $quantity, $description) {
		$query = "INSERT INTO Purchases VALUES (DEFAULT, '$providerUsername', '$productID', '$transactionDate', '$state', '$quantity', '$description');";
		$result = $conn->query($query);
		return $result;
	}

	function SQLRegisterSale($conn, $clientUsername, $productID, $transactionDate, $state, $quantity, $description) {
		$query = "INSERT INTO Sales VALUES (DEFAULT, '$clientUsername', '$productID', '$transactionDate', '$state', '$quantity', '$description');";
		$result = $conn->query($query);
		return $result;
	}

	function SQLPurchaseIsFinalized($conn, $purchaseID) {
		$query = "SELECT state FROM Purchases WHERE ID = '$purchaseID';";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();

		return $row['state'];
	}

	function SQLSaleIsFinalized($conn, $saleID) {
		$query = "SELECT state FROM Sales WHERE ID = '$saleID';";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();

		return $row['state'];
	}

	function SQLUpdateFullPurchase($conn, $purchaseID, $providerUsername, $productID, $transactionDate, $state, $quantity, $description) {
		$query = "UPDATE Purchases SET prov_username = '$providerUsername', prod_id = '$productID', transaction_date = '$transactionDate', state = '$state', quantity = '$quantity', description = '$description' WHERE ID = '$purchaseID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdateFullSale($conn, $saleID, $clientUsername, $productID, $transactionDate, $state, $quantity, $description) {
		$query = "UPDATE Sales SET client_username = '$clientUsername', prod_id = '$productID', transaction_date = '$transactionDate', state = '$state', quantity = '$quantity', description = '$description' WHERE ID = '$saleID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLUpdatePurchase($conn, $purchaseID, $column, $value) {
		// First verify that the transaction is not finalized
		if (SQLPurchaseIsFinalized($conn, $purchaseID)) {
			die("Error - No puedes modificar transacciones finalizadas!");
		} else if (strtolower($column) == "prov_username") {
			die("Error - No puedes modificar el proveedor de la compra.");
		} else if (strtolower($column) == "prod_id")  {
			die("Error - No puedes modificar el producto de la compra.");
		} else {
			// Transaction is not finalized, we can make the update
			if (strtolower($column) == "transaction_date") {
				$query = "UPDATE Purchases
					  SET transaction_date = '$value'
					  WHERE ID = '$purchaseID';";
			} else if (strtolower($column) == "state") { 
				$query = "UPDATE Purchases
					  SET state = '$value'
					  WHERE ID = '$purchaseID';";
			} else if (strtolower($column) == "quantity") { 
				$query = "UPDATE Purchases
					  SET quantity = '$value'
					  WHERE ID = '$purchaseID';";
			} else if (strtolower($column) == "description") { 
				$query = "UPDATE Purchases
					  SET description = '$value'
					  WHERE ID = '$purchaseID';";
			} else if (strtolower($column) == "type") { 
				$query = "UPDATE Purchases
					  SET type = '$value'
					  WHERE ID = '$purchaseID';";
			}

			$result = $conn->query($query);
			return $result;
		}
	}

	function SQLUpdateSale($conn, $saleID, $column, $value) {
		// First verify that the transaction is not finalized
		if (SQLPurchaseIsFinalized($conn, $purchaseID)) {
			die("Error - No puedes modificar transacciones finalizadas!");
		} else if (strtolower($column) == "client_username") {
			die("Error - No puedes modificar el cliente de la venta.");
		} else if (strtolower($column) == "prod_id")  {
			die("Error - No puedes modificar el producto de la venta.");
		} else {
			// Transaction is not finalized, we can make the update
			if (strtolower($column) == "transaction_date") {
				$query = "UPDATE Sales
					  SET transaction_date = '$value'
					  WHERE ID = '$saleID';";
			} else if (strtolower($column) == "state") { 
				$query = "UPDATE Sales
					  SET state = '$value'
					  WHERE ID = '$saleID';";
			} else if (strtolower($column) == "quantity") { 
				$query = "UPDATE Sales
					  SET quantity = '$value'
					  WHERE ID = '$saleID';";
			} else if (strtolower($column) == "description") { 
				$query = "UPDATE Sales
					  SET description = '$value'
					  WHERE ID = '$saleID';";
			} else if (strtolower($column) == "type") { 
				$query = "UPDATE Sales
					  SET type = '$value'
					  WHERE ID = '$saleID';";
			}
			
			$result = $conn->query($query);
			return $result;
		}
	}

	function SQLDeletePurchase($conn, $purchaseID) {
		$query = "DELETE FROM Purchases
				  WHERE ID = '$purchaseID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLDeleteSale($conn, $saleID) {
		$query = "DELETE FROM Sales
			      WHERE ID = '$saleID';";
		$result = $conn->query($query);
		return $result;
	}

	function SQLFinalizePurchase($conn, $purchaseID) {
		// Verify that the transaction is not finalized to begin with
		if (SQLPurchaseIsFinalized($conn, $purchaseID)) {
			die("Error - This transaction is already finalized!");
		} else {
			// Transaction is not finalized, we can finalize it
			$query = "UPDATE Purchases
					  SET state = 1
					  WHERE ID = '$purchaseID';";
			$result = $conn->query($query);
			return $result;
		}
	}

	function SQLFinalizeSale($conn, $saleID) {
		// Verify that the transaction is not finalized to begin with
		if (SaleIsFinalized($conn, $saleID)) {
			die("Error - This transaction is already finalized!");
		} else {
			// Transaction is not finalized, we can finalize it
			$query = "UPDATE Sales
					  SET state = 1
					  WHERE ID = '$saleID';";
			$result = $conn->query($query);
			return $result;
		}
	}

	function SQLReport($conn, $transactionDateStart, $transactionDateFinish, $transactionType, $username, $productName, $state) {
	    if (strtolower($transactionType) == "sale") {
	        // Cuando se selecciona que sean ventas o se selecciona a un username de un cliente (que incluye que $transactionType sea venta)
	        return SQLReportSales($conn, $transactionDateStart, $transactionDateFinish, $username, $productName, $state);
	    } else if (strtolower($transactionType) == "purchase") {
	        // Cuando se selecciona que sean compras o se selecciona a un username de un proveedor (que incluye que $transactionType sea compra)
	        return SQLReportPurchases($conn, $transactionDateStart, $transactionDateFinish, $username, $productName, $state);
	    } else {
	        // Si no se especifica ninguno (ni $transactionType ni $username)
	        return SQLReportGeneral($conn, $transactionDateStart, $transactionDateFinish, $productName, $state);
	    }
	}

	function SQLReportSales($conn, $transactionDateStart, $transactionDateFinish, $username, $productName, $state) {
		$query = "SELECT ID, client_username AS username, prod_id, transaction_date, state, quantity, description FROM Sales
				  WHERE transaction_date >= '$transactionDateStart' AND transaction_date <= '$transactionDateFinish'";
	    
	    if (strtolower($username) != "null") {
	        $query .= " AND client_username = '$username'";
	    }

	    if (strtolower($productName) != "null") {
	        $ID = SQLGetProductIDFromName($conn, $productName);
	        $query .= " AND prod_id = '$ID'";
	    }

	    if (strtolower($state) != "null") {
	        $query .= "AND state = '$state'";
	    }

	    $query .= ";";

		$result = $conn->query($query);
		return $result;
	}

	function SQLReportPurchases($conn, $transactionDateStart, $transactionDateFinish, $username, $productName, $state) {
		$query = "SELECT ID, prov_username AS username, prod_id, transaction_date, state, quantity, description FROM Purchases
				  WHERE transaction_date >= '$transactionDateStart' AND transaction_date <= '$transactionDateFinish'";
	    
	    if (strtolower($username) != "null") {
	        $query .= " AND prov_username = '$username'";
	    }
	    
	    if (strtolower($productName) != "null") {
	        $ID = SQLGetProductIDFromName($conn, $productName);
	        $query .= " AND prod_id = '$ID'";
	    }

	    if (strtolower($state) != "null") {
	        $query .= " AND state = '$state'";
	    }

	    $query .= ";";

		$result = $conn->query($query);
		return $result;
	}

	function SQLReportGeneral($conn, $transactionDateStart, $transactionDateFinish, $productName, $state) {
		$query = "SELECT * FROM 
	                (SELECT ID, prov_username AS username, prod_id, transaction_date, state, quantity, description FROM Purchases
	                UNION 
	                SELECT ID, client_username AS username, prod_id, transaction_date, state, quantity, description FROM Sales) AS T
	                WHERE transaction_date >= '$transactionDateStart' AND transaction_date <= '$transactionDateFinish'";

	    if ($productName != "null") {
	        $ID = SQLGetProductIDFromName($conn, $productName);
	        $query .= " AND prod_id = '$ID'";
	    }

	    if ($state != "null") {
	        $query .= " AND state = '$state'";
	    }

	    $query .= ";";

		$result = $conn->query($query);
		return $result;
	}
?>