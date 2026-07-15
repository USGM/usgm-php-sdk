# USGM PHP SDK

The official PHP SDK for the [US Global Mail Public API](https://docs.usglobalmail.com) — manage your virtual mailbox, scans, shipments, folders, addresses, and account programmatically.

## Requirements

PHP 8.1+

## Installation

```bash
composer require usgm/sdk
```

## Usage

```php
<?php

use Usgm\UsglobalmailClient;

$client = new UsglobalmailClient($token);

// List mail in your mailbox
$mail = $client->mails->list();
```

The client exposes a sub-client per resource: `$mails`, `$scans`, `$shipments`, `$folders`, `$addresses`, `$bankAccounts`, `$account`, and `$sandbox`.

## Authentication

Pass your API key as the `$token` constructor argument. Treat it like a password — keep it out of source control. See the [documentation](https://docs.usglobalmail.com) for details.

## Documentation

- Guides: https://docs.usglobalmail.com
- API reference: https://docs.usglobalmail.com/api

## License

MIT
