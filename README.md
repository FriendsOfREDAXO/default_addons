# nvDefaultAddons-AddOn für REDAXO 5

Redaxo 5 Addon zum Installieren von häufig benötigten Addons

## Features

- Installiert und aktiviert in einem Durchgang alle gewünschten Addons


## Konfiguration

Unter Konfiguration die gewünschten Addons in JSON-Notation eintragen.
Es muss immer mindestens der Key des Addons sowie optional die gewünschte Version angegeben werden. Wenn keine Version angegeben wird, wird immer die aktuellste installiert

## Beispielkonfiguration

```php
{
	"yrewrite": "2.6",
    "cronjob": ""
}
```


### Team

**Friends Of REDAXO**  
http://www.redaxo.org  
https://github.com/FriendsOfREDAXO

**Projekt-Lead**  
[Alexander Walther](https://github.com/alxndr-w)

### Danke an

- [Daniel Steffen](https://github.com/novinet-git)

### Lizenz

[MIT-Lizenz](https://github.com/FriendsOfREDAXO/pdfout/blob/master/LICENSE.md)
