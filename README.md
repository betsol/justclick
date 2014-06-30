# JustClick API client

This PHP library provides you with tools needed to interact with [JustClick API][jc-api-docs].
It uses [Guzzle][guzzle] to send HTTP requests.

## Usage

```php
use Guzzle\Http\Client as HttpClient;
use Betsol\JustClick\Client;
use Betsol\JustClick\Entity\Order;

// Creating a Guzzle client.
$httpClient = new HttpClient;

// JustClick client configuration.
$config = [
    'username' => 'login',
    'secret' => '8b3e4e1f8236b6683235222d3034b317',
];

// Creating JustClick client.
$justClickClient = new Client($config, $httpClient);

// Creating a new order.
$order = new Order;

// Adding products to the order.
$order->addProduct('some-product');
$order->addProduct('another-product');

// You can specify custom price for a product.
$order->addProduct('yet-another-product', 700);

// Adding different fields to the order.
$order->setEmail('email@example.com');
$order->setNameFirst('Slava');
$order->setNameLast('Fomin');
$order->setCountry('Russia');
$order->setCity('Moscow');
$order->setAddress('Some address here');

// Issuing a query to JustClick API.
$response = $justClickClient->createOrder($order);

// Handling response.
$orderId = (int) $response['bill_id'];
```

## License

The MIT License (MIT)

Copyright (c) 2014 Better Solutions, Slava Fomin II

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.


[jc-api-docs]: http://support.justclick.ru/index.php?/Knowledgebase/List/Index/5/api
[guzzle]: http://guzzle.readthedocs.org/en/latest/