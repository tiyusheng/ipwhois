// Function to get visitor's real IP address (considering Cloudflare)
        function getRealIP() {
            if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
                // Cloudflare
                return $_SERVER['HTTP_CF_CONNECTING_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                // Proxy (may have multiple IP addresses in the list)
                $ip_array = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($ip_array[0]);
            } else {
                // Direct request (no proxy)
                return $_SERVER['REMOTE_ADDR'];
            }
        }
