## Introduction

This is a free, none commercial community package that allows to communicate with the public Wargaming.NET web api's in an abstract way. Community package means, that this package is developed for the community and by my selfe without any profit.

For more information about the public Wargaming.NET api and ordering an application id see there: [Wargaming.NET Developers](https://eu.wargaming.net/developers/)

Please also don't forget to read the Wargaming.NET API [Terms and Policies](https://eu.wargaming.net/developers/documentation/rules/rules/) and the [EULA](https://eu.wargaming.net/developers/documentation/rules/agreement/).

## Features

Actual the following api's are implemented:

* World of Tanks
* World of Warship
* Wargaming.NET Clans
* Wargaming.NET Accounts (coming soon...)

## Notices

Basic tests successfully done. Take a look at the **/tests** folder.

## Usage Example

##### Code

    $reader = new jpWargamingReaderWot('your-app-id', 'EU', 'en');
    $response = $reader->getAccountList('Metwurst', ['nickname', 'account_id'], 'exact')

##### Result

    {"status":"ok","meta":{"count":1},"data":[{"nickname":"Metwurst","account_id":500554376}]}
