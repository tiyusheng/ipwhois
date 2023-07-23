<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>IP查询</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            width: 90%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-top: 20px;
            text-align: center;
        }

        p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>IP查询</h1>
        <form method="post">
            <label for="ip">请输入IP地址：</label>
            <input type="text" name="ip" id="ip" required>
            <button type="submit">查询</button>
        </form>

        <?php
        function getIPInfo($ip, $api_key) {
            $api_url = "http://ipinfo.io/{$ip}?token={$api_key}";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response, true);
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ip"])) {
            $ip = $_POST["ip"];
            $api_key = "YOUR_IPINFO_API_KEY"; // 在ipinfo.io注册并获取API密钥
            $ip_data = getIPInfo($ip, $api_key);

            if ($ip_data && isset($ip_data["ip"])) {
                echo "<h2>IP地址信息：</h2>";
                echo "<p><strong>IP地址：</strong> {$ip_data['ip']}</p>";
                echo "<p><strong>位置：</strong> {$ip_data['city']}, {$ip_data['region']}, {$ip_data['country']} ({$ip_data['postal']})</p>";
                echo "<p><strong>运营商：</strong> {$ip_data['org']}</p>";
            } else {
                echo "<p>无法获取IP信息，请检查IP地址是否正确。</p>";
            }
        } else {
            // Auto-detect visitor's IP address
            $visitor_ip = $_SERVER['REMOTE_ADDR'];
            $api_key = "YOUR_IPINFO_API_KEY"; // 在ipinfo.io注册并获取API密钥
            $ip_data = getIPInfo($visitor_ip, $api_key);

            if ($ip_data && isset($ip_data["ip"])) {
                echo "<h2>IP地址信息：</h2>";
                echo "<p><strong>IP地址：</strong> {$ip_data['ip']}</p>";
                echo "<p><strong>位置：</strong> {$ip_data['city']}, {$ip_data['region']}, {$ip_data['country']} ({$ip_data['postal']})</p>";
                echo "<p><strong>运营商：</strong> {$ip_data['org']}</p>";
            } else {
                echo "<p>无法获取IP信息，请检查IP地址是否正确。</p>";
            }
        }
        ?>
    </div>
</body>
</html>
