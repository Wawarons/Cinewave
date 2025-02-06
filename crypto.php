<?php
include('includes/header.php');
include('includes/contentQueries.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accumulation de Points Crypto</title>
    <style>
        .container {
    background: white;
    padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        .crypto-button {
    background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .crypto-button:hover {
    background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="crypto-title">Accumulation de Points Crypto</h1>
        <p class="coins"">Solde : <span id="cryptoBalance">0</span> CWcoins</p>
        <button class="crypto-button" onclick="earnPoints()">Transfert</button>
    </div>

    <script>
let balance = localStorage.getItem("cryptoBalance") || 0;
        document.getElementById("cryptoBalance").textContent = balance;

        function earnPoints() {
            balance = parseInt(balance) + Math.floor(Math.random() * 10) + 1;
            localStorage.setItem("cryptoBalance", balance);
            document.getElementById("cryptoBalance").textContent = balance;
        }
    </script>
</body>
</html>