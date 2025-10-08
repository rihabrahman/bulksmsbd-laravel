
# 📦 BulkSMSBD Laravel Package

A simple and developer-friendly Laravel package for sending SMS via [BulkSMSBD](https://bulksmsbd.net) — built to make integration painless and clean for all Laravel versions.

---

## 🚀 Features

✅ Send SMS (one-to-many)  
✅ Send personalized messages (many-to-many)  
✅ Check credit balance  
✅ Handle Delivery Reports (DLR) via response code  
✅ Laravel Events for delivered & failed messages  
✅ Works with Laravel 7 – 13 and PHP 8+

---

## 🛠️ Installation

```bash
composer require rihabrahman/bulksmsbd-laravel
```

Then publish the config file:

```bash
php artisan vendor:publish --tag=bulksmsbd-config
```

---

## ⚙️ Configuration

In your `.env` file:

```env
BULKSMSBD_API_KEY=your_api_key_here
BULKSMSBD_SENDER_ID=your_sender_id_here
BULKSMSBD_TYPE=text
```

You can override config in `config/bulksmsbd.php`.

---

## 💬 Sending SMS

### 🔹 One-to-Many (Same Message to Many Numbers)

```php
use RihabRahman\BulkSmsBd\Facades\Sms;

Sms::send('8801712345678', 'Welcome to our service!');

// Multiple recipients (comma-separated)
Sms::send('8801712345678,8801912345678', 'Meeting starts at 3 PM.');
```

### 🔹 Many-to-Many (Different Messages to Different Numbers)

```php
$messages = [
    ['to' => '8801712345678', 'message' => 'Hello Mr. Rahman'],
    ['to' => '8801912345678', 'message' => 'Welcome Ms. Akter'],
];

Sms::sendBulk($messages);
```

---

## 💰 Checking Balance

```php
$balance = Sms::balance();
echo "Remaining Credits: " . $balance;
```

---

## 📡 Delivery Report (DLR)

BulkSMSBD sends the response of your request as **plain JSON text**.

Example response:

```json
{
  "response_code": 202,
  "message_id": 59432678,
  "success_message": "SMS Submitted Successfully",
  "error_message": ""
}
```

---

## 🧰 Example API Response Codes

| Code | Description |
|------|--------------|
| 202 | Success |
| 1001 | Invalid Number |
| 1002 | Sender ID incorrect |
| 1003 | Missing Fields |
| 1005 | Internal Error |
| 1007 | Balance Insufficient |
| 1011 | User Not Found |
| 1032 | IP Not Whitelisted |

---

### 🧑‍💻 Developed & Maintained By
**Rihab Rahman**  
🌐 [https://rihabrahman.com](https://rihabrahman.com)  
📧 Contact: cse.rihab@gmail.com

If you find this package helpful, consider giving it a ⭐ on [GitHub](https://github.com/rihabrahman/bulksmsbd-laravel)!


---

## ❤️ Contributing

Pull requests are welcome! Please fork the repo and submit a PR.
