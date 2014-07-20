# Vädret just nu

**NOTE:** All the comments and content in the files are in Swedish, since this is a Swedish website

Filerna ovan innehåller grunden för Vädret just nu, som är en vädertjänst med prognoser från [yr.no](http://yr.no/). Webbsidan är fortfarande i utveckling och förbättringar genomförs och buggar täpps till emellanåt. Följande saker är med i "att göra"-listan.

- Kunna skapa egna konton, för en mer personlig upplevelse
- Kunna se historik för en vald adress
- Kunna se en detaljerad statistik över alla platser och väderleksrapporter
- Bättre hantering av delning till Google+ och Facebook
- Kunna ladda upp bilder på hur vädret egentligen ser ut
- Kunna rösta hur bra väderleksrapporten stämmer överrens med verkligheten
- Lägga till ett alternativ, om att visa eller dölja spårning (dra linjer från där du började, till dit du är nu), när GPSn används
- Kunna se noggrannheten på kartan, med hjälp av en rund ring runt om markören
- Optimera tiden för sidladdningarna
- Lägga till ett meddelande, som berättar att enhetens GPS söker efter ens nuvarande plats. Just nu visas bara en grå ruta, som sedan ersätts av kartan. Detta meddelande ska endast visas när positioneringen sker. Aldrig medan webbsidan följer ens rörelse


### Vill du vara med och hjälpa till?
Du kan enkelt ladda hem filerna och arbeta med webbsidan lokalt, utan något stöd för någon databas. Se bara till att `$use_database` i `properties.php` är satt på `0`.

### Kända buggar
- Följande felmeddelande inträffar på alla sidor:
```
Error in event handler for extension.onRequest: undefined
Stack trace: undefined                 extensions::uncaught_exception_handler:9
handler                                extensions::uncaught_exception_handler:9
exports.handle                         extensions::uncaught_exception_handler:15
EventImpl.dispatch_                    extensions::event_bindings:384
EventImpl.dispatch                     extensions::event_bindings:403
publicClass.(anonymous function)       extensions::utils:89
messageListener                        extensions::messaging:190
EventImpl.dispatchToListener           extensions::event_bindings:397
publicClass.(anonymous function)       extensions::utils:89
EventImpl.dispatch_                    extensions::event_bindings:379
EventImpl.dispatch                     extensions::event_bindings:403
publicClass.(anonymous function)       extensions::utils:89
dispatchOnMessage                      extensions::messaging:304
```

- Detta är egentligen ingen bugg, men diagrammet för väderleksrapporten döljs när webbsidan har uppdaterat ens position. DIV-taggens höjd är densamma som diagrammet, så sidan hoppar inte längst ner, under tiden detta inträffar.
