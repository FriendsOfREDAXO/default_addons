# Default Addons für REDAXO 5

Redaxo 5-Addon zum Installieren von häufig benötigten Addons "in einem Rutsch".

## Konfiguration

Unter Konfiguration die gewünschten Addons in JSON-Notation eintragen.
Es muss immer mindestens der Key des Addons sowie optional die gewünschte Version angegeben werden. Wenn keine Version angegeben wird, wird immer die aktuellste installiert

## Beispielkonfiguration

### nv Original-Konfiguration

```json
{
    "phpmailer": "",
    "yform": "3.4",
    "yform_spam_protection": "",
    "yform_usability": "",
    "yrewrite": "2.6",
    "cronjob": "2.1.0",
    "emailobfuscator": "3.0.0",
    "mform": "5.3.1",
    "mblock": "3.1.0",
    "usage_check": "",
    "developer": "",
    "theme": "",
    "be_tools": "",
    "yrewrite_domain_settings": "",
    "nv_betheme": "",
    "nv_modulesettings": "",
    "seocheckup": "",
    "url": "",
    "quick_navigation": "",
    "adminer": "",
    "be_explorer": "",
    "bloecks": "",
    "cke5": "",
    "maintenance": "",
    "minibar": "",
    "uploader": "",
    "nv_rexhelper": "",
    "navbuilder":""
}
```

### @alxndr-w Empfehlungen

```JSON
{
  "accessdenied": "",
  "adminer": "",
  "auto_delete": "",
  "bloecks": "",
  "developer": "",
  "maintenance": "",
  "neues": "6.0.0",
  "project_manager": "",
  "quick_navigation": "",
  "url": "",
  "wenns_sein_muss": "",
  "yform": "4.2.1",
  "yform_field": "",
  "yform_spam_protection": "",
  "yrewrite": "",
  "yrewrite_metainfo": "",
  "zip_install": ""
}
```

### Team

**Friends Of REDAXO**  
<http://www.redaxo.org>  
<https://github.com/FriendsOfREDAXO>

**Projekt-Lead**  
[Alexander Walther](https://github.com/alxndr-w)

### Danke an

- [Daniel Steffen](https://github.com/novinet-git)

### Lizenz

[MIT-Lizenz](https://github.com/FriendsOfREDAXO/pdfout/blob/master/LICENSE.md)
