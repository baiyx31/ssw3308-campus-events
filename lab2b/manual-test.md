# Lab 2b — My test notes

I tested the form 7 times. I wanted to know if the server checks
the form by itself, not only in the browser.

These 7 tests were run on PHP 8.3.6, without using the browser.
I still need to run them on my own computer with XAMPP and Apache.

## 1. Everything is right

I filled in: name `Aina`, email `aina@example.com`, event `music`.

I expected a green box with "Aina", "aina@example.com", and
"Campus Music Festival". The form should be gone.

That is what I saw. It passed.

## 2. The name is empty

I filled in: name empty, email `aina@example.com`, event `music`.

I expected red messages saying I need to enter my name. The form
should come back, with my email and my event still there.

That is what I saw. It passed.

## 3. The email is wrong

I filled in: name `Aina`, email `not-an-email`, event `hackathon`.

I expected red messages saying the email is not right. My name
and my event should still be there.

That is what I saw. It passed.

## 4. No event is chosen

I filled in: name `Aina`, email `aina@example.com`, event empty.

I expected red messages saying I need to choose an event.

That is what I saw. It passed.

## 5. I made up an event

I filled in: name `Aina`, email `aina@example.com`, event `concert`.

I expected red messages saying the event is not right. The event
must be one of the three events on the page. I cannot make up
a new one.

That is what I saw. It passed.

## 6. I typed code in the name box

I filled in: name `<script>alert(1)</script>`, email
`aina@example.com`, event `sports`.

I expected the green box to show the code as plain text. The code
should not run.

That is what I saw. The code did not run. It passed.

## 7. I just opened the page

I opened the page with GET. I did not fill in anything.

I expected the normal page with an empty form. No red messages,
no green box.

That is what I saw. It passed.

All 7 tests passed.

## Two things I noticed

- If I refresh the green box page, my browser asks if I want to
  send the form again. That is normal for this lab.
- Nothing is saved. If I open the page again, the form is empty.
  That is right for Lab 2b, because I did not use a database.
