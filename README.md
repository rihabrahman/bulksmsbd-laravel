
# 📦 BulkSMSBD Laravel Package

A simple and developer-friendly Laravel package for sending SMS via [BulkSMSBD](https://bulksmsbd.net) — built to make integration painless and clean for all Laravel versions.

---

## 🚀 Features

✅ Send SMS (one-to-many)  
✅ Send personalized messages (many-to-many)  
✅ Check credit balance  
✅ Handle Delivery Reports (DLR) via webhook  
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

BulkSMSBD sends delivery reports to your callback URL as **plain text or query parameters**.

Example request:
```
https://yourdomain.com/bulksmsbd/dlr?code=202&messageid=998877&to=88017xxxxxxx
```

### Supported Response Codes

| Code | Meaning |
|------|----------|
| 202 | SMS Submitted Successfully |
| 1001 | Invalid Number |
| 1002 | Sender ID incorrect |
| 1007 | Balance Insufficient |
| 1032 | IP Not Whitelisted |

### Automatic Event Firing

| Code Range | Event Fired |
|-------------|-------------|
| 202 | `SmsDelivered` |
| 1001–1032 | `SmsFailed` |

### Example Listener

```php
namespace App\Listeners;

use RihabRahman\BulkSmsBd\Events\SmsDelivered;
use RihabRahman\BulkSmsBd\Events\SmsFailed;
use Illuminate\Support\Facades\Log;

class LogSmsDelivery
{
    public function handle($event)
    {
        Log::info('DLR Received', [
            'event' => class_basename($event),
            'data' => $event->data,
        ]);
    }
}
```

Register in your `EventServiceProvider`:

```php
protected $listen = [
    \RihabRahman\BulkSmsBd\Events\SmsDelivered::class => [
        \App\Listeners\LogSmsDelivery::class,
    ],
    \RihabRahman\BulkSmsBd\Events\SmsFailed::class => [
        \App\Listeners\LogSmsDelivery::class,
    ],
];
```

### 🧪 Test Locally

```bash
curl "http://localhost:8000/bulksmsbd/dlr?code=202&messageid=1234&to=88017xxxxxxx"
```

```bash
curl "http://localhost:8000/bulksmsbd/dlr?code=1001&messageid=5678&to=88019xxxxxxx"
```

---

## 📂 Folder Structure

```
bulksmsbd-laravel/
├── src/
│   ├── BulksmsbdServiceProvider.php
│   ├── Facades/Sms.php
│   ├── SmsManager.php
│   ├── Events/
│   │   ├── SmsDelivered.php
│   │   ├── SmsFailed.php
│   ├── Http/Controllers/DlrWebhookController.php
├── routes/webhook.php
├── config/bulksmsbd.php
├── composer.json
└── README.md
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

## 📜 License

MIT License © 2025 [Rihab Rahman](mailto:cse.rihab@gmail.com)

---

## ❤️ Contributing

Pull requests are welcome! Please fork the repo and submit a PR.
