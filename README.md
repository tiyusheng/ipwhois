# ipwhois


IPWhois使用PHP结合第三方IP查询接口来获取IP相关信息。在这里，使用IPinfo（https://ipinfo.io/） 作为IP查询接口，当用户访问你的网站时ta能看到自己的IP信息或者查询其他IP信息。

首先，确保你的PHP服务器环境可用，并且可以使用cURL扩展。然后再将index.php文件保存到你的本地服务器运行。

在代码中，你需要将YOUR_IPINFO_API_KEY替换为你在ipinfo.io网站上注册账号并获取的API密钥。注意，ipinfo.io提供免费的API密钥，但有每天的请求限制和使用限制。如果需要更高级的使用，请查阅ipinfo.io的相关文档。

将修改后的index.php文件上传到你的PHP服务器。

当你访问index.php网页时，你将看到一个简单的表单，输入IP地址并提交查询后，它将显示IP地址的位置信息、IPAS号、IP运营商、AS号域名等信息。请注意，这个示例只是一个简单的演示，如果你需要更复杂或高级的功能，可以在此基础上进一步扩展。

# 关于开启CLoudflare无法获取真实IP解决方案。

当网站开启Cloudflare之后，可以通过解析Cloudflare提供的HTTP请求头来获取用户的真实IP地址。Cloudflare将用户真实IP地址存储在 $_SERVER['HTTP_CF_CONNECTING_IP'] 字段中。


在index.php 中加上这一段代码：

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



完整代码请查看 cf.php或者参考Cloudflare提供的文献资料。
