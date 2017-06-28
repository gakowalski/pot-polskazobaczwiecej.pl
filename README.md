# Polska Zobacz Więcej 2017
Szablon do serwisu [polskazobaczwiecej.pl][1] dla systemu Joomla! 3.7 wykonany na podstawie dotychczasowego szablonu opartego o system WebAdministrator CMS.

![Podgląd szablonu](template_preview.png)

Specyficzne cechy szablonu:
* Ścisłe dopasowanie do projektu, konkretnych komponentów i rozwiazań (nie jest to uniwersalny szablon):
  * Moduł wyszukiwarka: `mod_search` umieszczony w pozycji `header`, ustawienie "Box text" wypełnione stosowną frazą, ukryty tytuł modułu; ustawienia "Search Button" oraz "Search Button Image" nie mają wpływu na działanie modułu.
  * Komponent wyszukiwarki: `com_search` z ustawieniem "Created Date" na wartośc "Hide"; szablon deaktywuje mozliwosc sterowania tytulem strony, ktory jest na sztywno ustalony jako "Wyniki wyszukiwania";
  * Formularz kontaktowy: rozszerzenie [JU Contact][2].
* Zmiana stosowanej natywnie w Joomli hierarchii nagłówków celem uzyskania większej dostępności;
* Możliwość aktualizacji bezpośrednio z panelu administracyjnego (pobierany jest najnowszy release z tego repo);
* Wbudowana obsługa przełączenia w tryb wysokiego kontrastu.

Informacje dla osób dostosowujących komponenty do szablonu:
* W trybie wysokiego kontrastu tag `body` ma przypisaną klasę `high-contrast` a zwykłym trybie graficznym `low-contrast`;
* Widok domyślnego menu dla danego języka przypisuje do tagu `body` klasę `frontpage` - pozostałe widoki otrzymują `not-frontpage`.

Rozpoznane problemy:
* Konflikty z frameworkiem [Bootstrap][3] używanym w rozszerzeniach.

[1]:http://www.polskazobaczwiecej.pl
[2]:https://extensions.joomla.org/extension/contacts-and-feedback/contact-forms/ju-contact/
[3]:http://getbootstrap.com/
