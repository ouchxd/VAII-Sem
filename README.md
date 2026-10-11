# Systém pre spracovanie servisných požiadaviek autoservisu

Filip Zvonek

5ZYR31

## Stručný opis projektu
Webová aplikácia je určená pre zákazníkov a zamestnancov (technikov) autoservisu. Hlavným účelom systému je zjednodušiť a zrýchliť proces nahlasovania porúch, rezervácie servisných prehliadok a sledovania stavu opráv vozidiel v reálnom čase. Zákazníkom umožnuje spravovať svoje vozidlá a pohodlne ich objednávať na servis bez nutnosti telefonického kontaktovania.

Pre autoservis aplikácia predstavuje interný nástroj na evidenciu servisných tiketov, pridávanie použitých náhradných dielov, výpočet celkovej ceny opráv a správu zákazníkov. Systém tak nahrádza papierové zákazkové listy a znižuje chybovosť pri spracovaní serisov.

## Role v projekte
* **Návštevník:** Neregistrovaný používateľ, ktorý si môže prezerať cenník základných služieb, otváracie hodiny, kontakt a informácie o autoservise.
* **Zákazník:** Registrovaný používateľ, ktorý spravuje svoje vozidlá, vytvára nové servisné tikety, sleduje priebeh opráv a nahráva súbory(napr. fotky poškodenia).
* **Technik:** Zamestnanec autoservisu, ktorý spracováva prijaté požiadavky, upravuje stavy tiketov, priraďuje použité náhradné diely, spravuje katalóg dielov a má plný prístup ku všetkým evidovaným dátam.

## Prípady použitia podľa rolí
* **Návštevník:**
  * Vyhľadáva informácie o servise a cenník služieb.
  * Zaregistuje sa do systému.
* **Zákazník:**
  * Používateľ sa prihlási do svojho účtu.
  * Používateľ pridá nové vozidlo do svojho profilu
  * Používateľ vytvorí nový servisný tiket k vybranému vozidlu.
  * Používateľ si prezrie históriu a aktuálny stav svojich servisných tiketov.
  * Používateľ zruší čakajúci tiket.
* **Tecnik:**
  * Technik zmení stav servisného tiketu (napr. "Čaká", "V oprave", "Dokončené").
  * Technik pridá k servisnému tiketu použité náhradné diely a práce.
  * Technik vyhľadá a filtruje tikety podľa stavu, zákazníka alebo vozidla.

## Plánované entity
* **User:** Reprezentuje používateľa systému (zákazník alebo technik)
  * *Atribúty:* id, email, password, name, phone, role, created_at, active
* **Vehicle:** Reprezentuje vozidlo evidované zákazníkom
  * *Atribúty:* id, user_id, brand, model, lpn, year, vin
* **ServiceTicket:** Reprezentuje servisný tiket vytvorený zákazníkom
  * *Atribúty:* id, vehicle_id, status, priority, description, created_at, updated_at

## Vzťah medzi entitami
* **User:Vehicle => '1:N':** Jeden zákazník môže mať viacero vozidiel.
* **Vehicle:ServiceTicket => '1:N':** Jedno vozidlo môže mať viacero servisných tiketov.

## Hlavné stránky aplikácie
1. **Domovská stránka:** Prehľad služieb, kontaktné údaje, otváracie hodiny a výzva na prihlásenie/registráciu.
2. **Moje vozidlá:** Zoznam registrovaných vozidiel používateľa s možnosťou pridania nového vozidla alebo úpravy existujúceho.
3. **Vytvorenie servisného tiketu:** Formulár na vytvorenie nového tiketu s výberom vozidla, popisom poruchy a možnosťou nahrania súboru.
4. **Prehľad tiketov:** Zobrazenie priebehu konkrétnej opravy vrátane zoznamu použitých dielov a celkovej kalkulácie ceny.
5. **Admin dashboard:** Obrazovka pre zamestnancov na správu všetkých tiketov, zmenu ich stavov, priraďovanie dielov k tiketom.

## Rozdelenie funkcionality
* **Základné funkcie:**
  * Registrácia a prihlasovanie používateľov s podporou dvoch rolí (zákazník, technik).
  * CRUD správa pre entity "Vehicle" a "ServiceTicket".
  * Vytvorenie a zobrazenie servisných tiketov.
  * Nahrávanie súborov (fotky porúch / prílohy k tiketu) a ich ukladanie na server.
  * Zabezpečenie prístupu k citlivým dátam a operáciám na základe rolí používateľov.
  * AJAX (1): Dynamické filtrovanie tiketov v dashboarde podľa nastavených kritérií bez zmeny stránky.
  * AJAX (2): Zmena stavu tiketu priamo v tabuľke bez nutnosti prepínania na inú stránku alebo reloadu.
* **Rozšírujúce funkcie:**
  * Export servisného tiketu do PDF/tlačového zobrazenia.
  * Notifikácie pre zákazníkov o zmene stavu tiketu (napr. e-mail alebo SMS).
  * Možnosť pridania komentárov k servisným tiketom pre lepšiu komunikáciu medzi zákazníkom a technikom.