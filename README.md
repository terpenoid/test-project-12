# Simple CLI app

The script accepts the different data sources with array data, does some calculations, 
and out it as formatted table.

## Requirements

Tested on PHP v. 7.3 and higher

## Run

In general, use next command line syntax: 

```bash
php console.php import <json_file/php_file> <correct path to file>
```

Examples 

```bash
php console.php import json_file data/data.json
php console.php import php_file data/data.php
```

or for running via Docker (without php environment on your host) you can use

```bash
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli php console.php import json_file data/data.json 
```

Also, you can send json-data directly as parameter:

```bash
php console.php plaintext json '[{"asd":"fgh"},{"qwe":"rty"},{"asd":"123"},{"asd":"xxx","qwe":"ccc"}]'
```


## Design

Project has simple MVC structure.
(detailed phpDoc available in [phpDoc](phpDoc/index.html))

### console.php

console.php - the entry-point. just running the app 

---

### App

#### App.php
Service Locator for storing application components.

#### Controller.php
A base class for all controllers.

#### Kernel.php
Access the router and start the controller.

#### Model.php
A base class for all models.

#### Router.php
Simple router. Expects params in next order: &lt;controller&gt; &lt;action&gt; [extra params] If params does not exist - uses the default values

---

### Controllers

#### Man.php
Manual page.

#### Import.php
Accepts input data from file

#### Plaintext.php
Accepts input data as plain text from command line

---

### Models

#### DataSet.php
Main data-model Can be created from one array immediately.

---

### Views

#### ManIndexView.php
View for help-page

#### DataTableView.php
Common view for datatable display