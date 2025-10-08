# BulkSMSBD Laravel Package

This package allows easy integration with BulkSMSBD SMS gateway for Laravel.  
It supports single/bulk messaging and handles DLR (Delivery Report) via webhook events.

## Installation

```bash
composer require rihabrahman/bulksmsbd-laravel
```

## Configuration

Publish the config:
```bash
php artisan vendor:publish --tag=config
```

Add your credentials to `.env`:
```
BULKSMSBD_API_KEY=your_api_key
BULKSMSBD_SENDER_ID=your_sender_id
```

## DLR Webhook

BulkSMSBD will POST to `/bulksmsbd/dlr`.

### Events Fired
- `SmsDelivered`
- `SmsFailed`
