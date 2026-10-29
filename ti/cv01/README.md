# cv01 – Príkazový riadok a HTML

Technológie internetu, 2. týždeň. Teória, ukážky a prompt pre AI sú na stránke
[02 Príkazový riadok a HTML](https://beata.stehlikova.website.tuke.sk/ti/02.html).
Postupy krok za krokom sú v [Návodoch a nástrojoch](https://beata.stehlikova.website.tuke.sk/navody/).

## Úlohy

**Úloha 2.1: Zadanie a SFTP.** Prijmi zadanie cv01 v Classroom 50 a repozitár naklonuj do `~/web/ti/cv01` podľa návodu 04 Odovzdávanie. Rozšírenie SFTP sa v Kubeflow po reštarte niekedy stratí. Vráti ho tento príkaz v termináli:

```
code-server --install-extension Natizyskunk.sftp
```

Potom F1, *Developer: Reload Window*. Nastavenie pripojenia na sigmu zostáva, netreba ho robiť znova.

**Úloha 2.2: Pieskovisko.** V termináli v Kubeflow si vytvor `~/pieskovisko` a v ňom len príkazmi, bez myši, štruktúru `projekt/css`, `projekt/img` a prázdne súbory `projekt/index.html` a `poznamky.txt`. Jeden súbor skopíruj, jeden premenuj a jeden zmaž. Po každom kroku to over cez `ls -la`.

**Úloha 2.3: Vi.** V pieskovisku vytvor vo vi súbor `o-mne.txt` s tromi riadkami: meno, téma tvojho semestrálneho projektu, jedna vec, ktorú si sa dnes naučil. Ulož a odíď. Otvor ho znova, zmaž riadok cez `dd`, vráť ho cez `u` a odíď bez uloženia cez `:q!`. Cez `cat` over, že súbor má stále tri riadky.

**Úloha 2.4: História.** Na konci práce v termináli ulož históriu do súboru:

```
history > ~/pieskovisko/historia.txt
```

**Úloha 2.5: Stránka cez AI.** Prompt z Ukážky 4 na stránke 02 vlož do AI, na koniec doplň tému svojho projektu. Výsledok ulož do `~/web/ti/cv01` ako `index.html` a `style.css`. Obrázok pretiahni myšou z počítača do priečinka `cv01` v Exploreri a premenuj ho na `obrazok.jpg`. Stránku si pozri cez Five Server a čo nesedí, nechaj AI opraviť. Prečítaj komentáre v kóde: každý prvok musíš vedieť vysvetliť.

**Úloha 2.6: Odovzdanie.** Skopíruj do zadania súbory z pieskoviska:

```
cp ~/pieskovisko/historia.txt ~/pieskovisko/o-mne.txt ~/web/ti/cv01/
```

Potom commit a push podľa návodu 04 Odovzdávanie.

**Úloha 2.7: Kontrola na sigme.** Pripoj sa cez ssh na sigmu a skontroluj, že v `public_html/ti/cv01` sú tvoje súbory (Ukážka 3). Ak priečinok chýba, vytvor ho a vo VS Code klikni pravým tlačidlom na priečinok `cv01`, *SFTP: Upload Folder*. Nakoniec otvor v prehliadači `https://sigma.tuke.sk/student/meno.priezvisko/ti/cv01/`.

## Čo má byť v repozitári

```
cv01/
├── index.html
├── style.css
├── obrazok.jpg
├── o-mne.txt
└── historia.txt
```

## Hodnotenie

1 bod. V repozitári cv01 na GitHube aj na sigme je funkčná stránka, `historia.txt` a `o-mne.txt`, commit a push do konca cvičenia.
