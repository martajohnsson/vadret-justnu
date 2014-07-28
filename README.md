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
- Bättre hantering vid sparning av plats för varje väderleksrapport (databashantering)
- Göra Vädret just nu snällare mot yr.nos server, som till exempel hämta aldrig hem ny data för en plats som redan finns i databasen, om inte datan är 30-45 minuter gammal.
- ~~Lagra anonym information om besökarna. Varje besökare får själv avgöra om detta ska göras, eller inte~~
- Lägga till "känns som"-temperaturen. Kalkyleringen sker med följande formel: http://www.smhi.se/kunskapsbanken/meteorologi/vindens-kyleffekt-1.259


### Vill du vara med och hjälpa till?
Du kan enkelt ladda hem filerna och arbeta med webbsidan lokalt, utan något stöd för någon databas. Se bara till att `$use_database` i `properties.php` är satt på `0`.

### Kända buggar
- Detta är egentligen ingen bugg, men diagrammet för väderleksrapporten döljs när webbsidan har uppdaterat ens position. DIV-taggens höjd är densamma som diagrammet, så sidan hoppar inte längst ner, under tiden detta inträffar.
- Appcache funkar inte som den ska. Detta beror på att jag inte vet exakt hur man ska göra, och har bara lagt till grunden.
- Detta är kanske på min egna telefon (Samsung Galaxy S III Mini), men GPSn är väldigt efter, och när jag åker i 80-90 km/h, så visar den max 25 km/h, och den ligger efter med kanske 300 meter, även om noggrannheten är 5 meter.
