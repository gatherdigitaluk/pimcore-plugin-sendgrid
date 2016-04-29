# pimcore-plugin-sendgrid
Simple SendGrid Integration for Pimcore

## Installation
Install via pimcore + composer :)

## Configuration
All configuration options are made available in "Website Settings"

## Usage
Call the factory to return a SendGrid client with the correct config options

```
$client = SendGrid\Factory::getDefaultClient();

...the rest of the standard Sendgrid stuff

```

