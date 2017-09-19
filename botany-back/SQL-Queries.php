<?php
	function FindUsername($conn, $userName) {
		$query = "SELECT * FROM 
					(SELECT username, passwrd, NULL AS name, NULL AS description, type, NULL AS phone, NULL AS address, NULL as email FROM Administrator 
				  	UNION
				  	SELECT * FROM Client
				  	UNION
				  	SELECT * FROM Provider)
				  WHERE username = '$userName';";

		$result = $conn->query($query);
		return $result;
	}

	function RegisterClient($conn, $userName, $userPassword, $name, $userDescription, $userType, $userPhone, $userAddress, $userEmail) {
		$query = "INSERT INTO Client VALUES ($userName, $userPassword, $name, $userDescription, $userType, $userPhone, $userAddress, $userEmail);";
		return mysqli_query($conn, $query);
	}

	function RegisterProvider($conn, $userName, $userPassword, $name, $userDescription, $userType, $userPhone, $userAddress, $userEmail) {
		$query = "INSERT INTO Provider VALUES ($userName, $userPassword, $name, $userDescription, $userType, $userPhone, $userAddress, $userEmail);";
		$result = $conn->query($query);
		return $result;
	}

	function GetClientInfo($conn, $userName) {
		$query = "SELECT * FROM Client WHERE username = '$userName';";
		return mysqli_query($conn, $query);
	}

	function GetProviderInfo($conn, $userName) {
		$query = "SELECT * FROM Provider WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function UpdateClient($conn, $userName, $column, $value) {
		$query = "UPDATE Client
				  SET $column = '$value'
				  WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function UpdateProvider($conn, $userName, $column, $value) {
		$query = "UPDATE Provider
				  SET $column = '$value'
				  WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function DeleteClient($conn, $userName) {
		$query = "DELETE FROM Client
				  WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function DeleteProvider($conn, $userName) {
		$query = "DELETE FROM Provider
				  WHERE username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function GetProductIDFromName($conn, $productName) {
		$query = "SELECT ID FROM Product WHERE name = '$productName';";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		return $row['ID'];
	}

	function RegisterProduct($conn, $productName, $productCategory, $productMeasure, $productPrice) {
		$query = "INSERT INTO Product VALUES ($productName, $productCategory, $productMeasure, $productPrice);";
		return mysqli_query($conn, $query);
	}

	function GetProductInfo($conn, $productID) {
		$query = "SELECT * FROM Product WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function GetProductInfoFromName($conn, $productName) {
		$productID = GetProductIDFromName($conn, $productName);
		$query = "SELECT * FROM Product WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}	

	function UpdateProduct($conn, $productID, $column, $value) {
		$query = "UPDATE Product
				  SET $column = '$value'
				  WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function UpdateProductWithName($conn, $productName, $column, $value) {
		$productID = GetProductIDFromName($conn, $productName);
		$query = "UPDATE Product
				  SET $column = '$value'
				  WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function DeleteProduct($conn, $productID) {
		$query = "DELETE FROM Product
				  WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function DeleteProductWithName($conn, $productName) {
		$productID = GetProductIDFromName($conn, $productName);
		$query = "DELETE FROM Product
				  WHERE ID = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function GetAllTransactions($conn) {
		$query = "SELECT * FROM Purchases
				  UNION
				  SELECT * FROM Sales;";
		$result = $conn->query($query);
		return $result;
	}

	function GetAllPurchases($conn) {
		$query = "SELECT * FROM Purchases;";
		$result = $conn->query($query);
		return $result;
	}

	function GetAllSales($conn) {
		$query = "SELECT * FROM Sales;";
		$result = $conn->query($query);
		return $result;
	}

	function GetAllNonFinalizedTransactions($conn) {
		$query = "SELECT * FROM Purchases WHERE state = 0
				  UNION
				  SELECT * FROM Sales WHERE state = 0";
		$result = $conn->query($query);
		return $result;
	}

	function GetAllFinalizedTransactions($conn) {
		$query = "SELECT * FROM Purchases WHERE state = 1
				  UNION
				  SELECT * FROM Sales WHERE state = 1";
		$result = $conn->query($query);
		return $result;
	}

	function GetTransactionsWithClient($conn, $userName) {
		$query = "SELECT * FROM Sales WHERE client_username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function GetTransactionsWithProvider($conn, $userName) {
		$query = "SELECT * FROM Purchases WHERE prov_username = '$userName';";
		$result = $conn->query($query);
		return $result;
	}

	function GetTransactionsWithProduct($conn, $productID) {
		$query = "SELECT * FROM Purchases WHERE prod_id = '$productID'
				  UNION
				  SELECT * FROM Sales WHERE prod_id = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function GetTransactionsWithProductName($conn, $productName) {
		$productID = GetProductIDFromName($conn, $productName);
		$query = "SELECT * FROM Purchases WHERE prod_id = '$productID'
				  UNION
				  SELECT * FROM Sales WHERE prod_id = '$productID';";
		$result = $conn->query($query);
		return $result;
	}

	function GetTransactionsBetweenDates($conn, $firstDate, $secondDate) {
		$query = "SELECT * FROM Purchases WHERE transaction_date >= $firstDate and transaction_date <= $secondDate";
		$result = $conn->query($query);
		return $result;
	}

	function RegisterPurchase($conn, $providerUsername, $productID, $transactionDate, $quantity, $description) {
		$query = "INSERT INTO Purchases VALUES ($providerUsername, $productID, $transactionDate, 0, $quantity, $description, 'Purchase');";
		$result = $conn->query($query);
		return $result;
	}

	function RegisterSale($conn, $clientUsername, $productID, $transactionDate, $quantity, $description) {
		$query = "INSERT INTO Purchases VALUES ($clientUsername, $productID, $transactionDate, 0, $quantity, $description, 'Sale');";
		$result = $conn->query($query);
		return $result;
	}

	function PurchaseIsFinalized($conn, $purchaseID) {
		$query = "SELECT state FROM Purchases WHERE ID = '$purchaseID';";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();

		return $row['state'];
	}

	function SaleIsFinalized($conn, $saleID) {
		$query = "SELECT state FROM Sales WHERE ID = '$saleID';";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();

		return $row['state'];
	}

	function UpdatePurchase($conn, $purchaseID, $column, $value) {
		// First verify that the transaction is not finalized
		if (PurchaseIsFinalized($conn, $purchaseID)) {
			die("Error - You cannot update finalized transactions!");
		} else {
			// Transaction is not finalized, we can make the update
			$query = "UPDATE Purchases
					  SET $column = '$value'
					  WHERE ID = '$purchaseID';";
			$result = $conn->query($query);
			return $result;
		}
	}

	function UpdateSale($conn, $saleID, $column, $value) {
		// First verify that the transaction is not finalized
		if (SaleIsFinalized($conn, $saleID)) {
			die("Error - You cannot update finalized transactions!");
		} else {
			// Transaction is not finalized, we can make the update
			$query = "UPDATE Sales
					  SET $column = '$value'
					  WHERE ID = '$saleID';";
			$result = $conn->query($query);
			return $result;
		}
	}

	function DeletePurchase($conn, $purchaseID) {
		$query = "DELETE FROM Purchases
				  WHERE ID = '$purchaseID';";
		$result = $conn->query($query);
		return $result;
	}

	function DeleteSale($conn, $saleID) {
		$query = "DELETE FROM Sales
			      WHERE ID = '$saleID';";
		$result = $conn->query($query);
		return $result;
	}

	function finalizePurchase($conn, $purchaseID) {
		// Verify that the transaction is not finalized to begin with
		if (PurchaseIsFinalized($conn, $purchaseID)) {
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

	function finalizeSale($conn, $saleID) {
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

?>