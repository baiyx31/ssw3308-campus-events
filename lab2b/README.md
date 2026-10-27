# Campus Events Portal — SSW3308 Lab 2b

## What I did

This is my Lab 2b homework. In Lab 2, the registration form did nothing
when I clicked Submit. In Lab 2b, I made the form really work.

Now when I fill in the form and click Submit, the form sends the data
to the server. The server checks it. If everything is OK, I see a green
box with what I filled in. If something is wrong, I see red messages,
and the form comes back with what I already typed still there.

I did not use a database in this lab. A good submission is only shown
on the page. It is not saved anywhere.

## What I changed

I only changed one file, `index.php`. The page looks the same as Lab 2.

At the top of the file, I added PHP code. It runs first, before the
page is shown. The form uses `method="post"` and sends to the same page.
Every input has a `name`: `name`, `email`, and `event`.

The PHP code checks three things:

1. The name cannot be empty.
2. The email must look like a real email address.
3. The event must be one of the three events on the page. I cannot
   type in a new event name.

When the page shows what I typed, it uses `htmlspecialchars()`. That
means typed text is shown as plain text. It does not run as code.

If the form has a mistake, the page shows the mistakes, marks the
wrong boxes, and keeps what I typed. If the form is OK, the page
shows a green box instead of the form.

## How I run it

I cannot just double-click `index.php`. I learned that the hard way.
When I did that, I only saw PHP code in the browser.

I need to use XAMPP:

1. Open XAMPP Control Panel and start Apache.
2. Copy the whole `lab2b` folder into `C:\xampp\htdocs\Lab\`, so the
   file is at `C:\xampp\htdocs\Lab\lab2b\index.php`.
3. Open my browser and go to `http://localhost/Lab/lab2b/index.php`.
4. Fill in the form and click Submit.

I need the internet too, because Bootstrap is loaded from the internet,
the same as in Lab 2.

## Problems I had

At first, I opened the file directly and saw a lot of PHP code. I
thought Apache was not running, but Apache was running. The problem
was the address in my browser. It started with `C:/`, not with
`http://localhost/`. That means I opened the file, not the page
from the server.

My folder is inside a folder called `Lab`, so the address must have
`Lab` in it: `http://localhost/Lab/lab2b/index.php`. If I leave
`Lab` out, I get a 404 page.

## What I learned from the videos

I watched two short videos to learn this lab.

The first one was about PHP form handling. It showed GET and POST,
`$_POST`, checking the input, and showing the input back safely.
All of that is in my `index.php`.

The second one was about PHP and MySQL INSERT. I only watched it
to learn. Lab 2b does not save anything to a database. That part
is for a later lab.

## Files

```
lab2b/
├── index.php             # The page, with the PHP code at the top
├── css/
│   └── custom.css        # Same as Lab 2, I did not change it
├── images/
│   └── upm.png           # UPM emblem, same one from Lab 1 and Lab 2
├── manual-test.md        # My test notes
└── README.md
```

## My branch

I made a new branch called `lab2b` from the `lab2` branch. I did
not change the `lab2` branch, so Lab 2 stays as it was.

```
git checkout lab2
git checkout -b lab2b
```

Then I copied the `lab2b` folder into the repo and pushed it:

```
git add lab2b
git commit -m "Lab 2b: PHP server-side form processing"
git push -u origin lab2b
```
