# Polska Zobacz Więcej 2017
Szablon do serwisu [polskazobaczwiecej.pl][1] dla systemu Joomla! 3.7 wykonany na podstawie dotychczasowego szablonu opartego o system WebAdministrator CMS.

Specyficzne cechy szablonu:
* Ścisłe dopasowanie do projektu, konkretnych komponentów i rozwiazań (nie jest to uniwersalny szablon):
  * Wyszukiwarka: `mod_search` umieszczony w pozycji `header`.
  * Formularz kontaktowy: rozszerzenie [JU Contact][2].
* Zmiana stosowanej natywnie w Joomli hierarchii nagłówków celem uzyskania większej dostępności;
* Możliwość aktualizacji bezpośrednio z panelu administracyjnego (pobierany jest najnowszy release z tego repo);
* Wbudowana obsługa przełączenia w tryb wysokiego kontrastu.

Informacje dla osób dostosowujących komponenty do szablonu:
* W trybie wysokiego kontrastu tag `body` ma przypisaną klasę `high-contrast` a zwykłym trybie graficznym `low-contrast`.

Rozpoznane problemy:
* Konflikty z frameworkiem [Bootstrap][3] używanym w rozszerzeniach.

[1]:http://www.polskazobaczwiecej.pl
[2]:https://extensions.joomla.org/extension/contacts-and-feedback/contact-forms/ju-contact/
[3]:http://getbootstrap.com/
