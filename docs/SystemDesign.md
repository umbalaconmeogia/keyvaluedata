# Yii2-KeyValueData design

## Overview

KeyValueData can be used in two ways.
1. To store values for a data set (used for an model's attribute).
2. To store values for configuration.

## Database definition

### ERD

```plantuml
' avoid problems with angled crows feet
skinparam linetype ortho

entity "keyvaluedata" as Schedule {
    * id : number <<generated>>
    * type: string
    --
    category: string
    key : string
    value : string
    name: string
    remarks: text
    display_order: integer
}
```

### Table "keyvaluedata"

|Column|Description|
|----|----|
|id|Record id|
|category||
|type|"dataset", "config", "string", "float", "integer"|
|key||
|value||
|name||
|remarks||
|display_order||

### Usage

There are 3 kinds of data store in this table.
1. A category (which type is "dataseet" or "config"). It's key is used as category for another kinds of data.
2. A dataset's value.
  "value" defined the value, and "name" is the name corresponding to that value.
4. A configuration's value.
  "key" is the configuration option, "value" is the setting value, "name" is the name corresponding to the value.