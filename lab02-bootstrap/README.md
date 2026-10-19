# Campus Events Portal — SSW3308 Lab 2

## What I did

This lab is about redoing the Lab 1 page with Bootstrap 5. In Lab 1 I wrote
CSS by myself. In Lab 2 I need to use Bootstrap layout and components,
and keep the HTML semantic.

## My Bootstrap setup

- Version: 5.3.8 (the latest stable version on the official site)
- Method: CDN. I just added two link lines in the HTML, and the browser
  loads Bootstrap from the internet when the page opens. No download needed.
  At first I wanted to download it, but then I found CDN is simpler,
  so I chose this way.
- Note: Bootstrap CSS must be loaded before my own `custom.css`,
  otherwise my own styles cannot override it.
- The JS bundle is loaded only once, before `</body>`.
  It already includes Popper, so no separate Popper script is needed.

## Project structure

```
lab02-bootstrap/
├── index.html            # Main page: navbar, event cards, schedule table, form
├── css/
│   └── custom.css        # My own styles, about 30 lines: brand colors, focus outline
├── images/
│   └── upm.png           # UPM emblem, same one from Lab 1
├── evidence/
│   └── responsive/       # Three screenshots: phone / tablet / desktop widths
└── README.md
```

## Page features

1. Navbar: on narrow screens it becomes a hamburger menu. Click to expand.
2. Event cards: three events, one card each, with small badges.
   One card per row on phones, two on tablets, three on desktops.
3. Schedule table: event dates and venues. On very narrow screens only the
   table scrolls sideways, the whole page does not move.
4. Registration form: name, email, event selection, submit button.
   Empty required fields show red hints after submit.

## Problems I had

- At first I did not understand the difference between CDN and npm download.
  I tried npm and found out I need to install Node.js first.
  In the end I still submitted with CDN.
- The cards-per-row layout for the three screen widths took me a few tries
  to get right.
- The form validation JS is copied from the Bootstrap official docs. I cannot
  write it myself yet, but I understand what each line does now.

## How to run

No build step. Just double-click `index.html` to open it in a browser
(internet is needed, otherwise Bootstrap cannot load).
