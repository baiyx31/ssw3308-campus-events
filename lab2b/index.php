<?php
// SSW3308 Lab 2b — server-side form processing (PHP, no database).
//

$events = [
    'hackathon' => 'Tech Hackathon 2026',
    'music'     => 'Campus Music Festival',
    'sports'    => 'Sports Day',
];

$errors = [];
$old = ['name' => '', 'email' => '', 'event' => ''];
$submitted = false;
$registration = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read exactly the three named fields. Missing fields become ''.
    $old['name']  = trim((string) ($_POST['name'] ?? ''));
    $old['email'] = trim((string) ($_POST['email'] ?? ''));
    $old['event'] = (string) ($_POST['event'] ?? '');

    // --- Server-side validation (never trust the browser alone) ---
    if ($old['name'] === '') {
        $errors['name'] = 'Please enter your name.';
    } elseif (strlen($old['name']) > 100) {
        $errors['name'] = 'Name must be 100 characters or fewer.';
    }

    if ($old['email'] === '') {
        $errors['email'] = 'Please enter your email address.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if ($old['event'] === '') {
        $errors['event'] = 'Please choose an event.';
    } elseif (!array_key_exists($old['event'], $events)) {
        // Catches a made-up value sent by a crafted request.
        $errors['event'] = 'Please choose a valid event.';
    }

    if ($errors === []) {
        $submitted = true;
        $registration = [
            'name'  => $old['name'],
            'email' => $old['email'],
            'event' => $events[$old['event']],
        ];
    }
}

// Escape for HTML output. Used for every value that came from the user.
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Campus Events Portal</title>
    <!-- Bootstrap 5.3.8 CSS (official CDN, jsDelivr). Loaded BEFORE custom.css so our own rules can refine it. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link href="css/custom.css" rel="stylesheet" />
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark brand-nav" aria-label="Main navigation">
            <div class="container">
                <a class="navbar-brand" href="#">Campus Events Portal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                        aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#featured">Featured Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
                        <li class="nav-item"><a class="nav-link" href="#register">Register Interest</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4">

        <section id="about" class="mb-5">
            <h1 class="mb-3">Campus Events Portal</h1>
            <p class="lead">Welcome to our campus events portal. Students can browse and view all upcoming campus activities.</p>
            <h2>About</h2>
            <p>This portal publishes all campus events for university students.</p>
            <p>
                <a href="https://www.upm.edu.my">UPM</a>
                <br />
                <a href="#featured">Jump to Featured Events</a>
            </p>
            <img src="./images/upm.png" alt="This is the UPM school emblem." class="img-fluid emblem-img" />
        </section>

        <section id="featured" class="mb-5">
            <h2 class="mb-3">Featured Events</h2>
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">Tech Hackathon 2026 <span class="badge text-bg-danger">Hot</span></h3>
                            <p class="card-text">A 24 hours programming competition for students.</p>
                            <p class="card-text"><small class="text-body-secondary">Category: <span class="badge text-bg-primary">Coding</span></small></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">Campus Music Festival <span class="badge text-bg-success">New</span></h3>
                            <p class="card-text">Live music performance held at university hall.</p>
                            <p class="card-text"><small class="text-body-secondary">Category: <span class="badge text-bg-warning">Music</span></small></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">Sports Day <span class="badge text-bg-info">Annual</span></h3>
                            <p class="card-text">Inter-faculty sports competition.</p>
                            <p class="card-text"><small class="text-body-secondary">Category: <span class="badge text-bg-secondary">Sports</span></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="schedule" class="mb-5">
            <h2 class="mb-3">Event Schedule</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <caption>Upcoming campus events timetable</caption>
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Event</th>
                            <th scope="col">Venue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2026-11-08</td>
                            <td>09:00 - 17:00</td>
                            <td>Tech Hackathon 2026</td>
                            <td>Computer Centre Lab</td>
                        </tr>
                        <tr>
                            <td>2026-11-15</td>
                            <td>19:00 - 22:00</td>
                            <td>Campus Music Festival</td>
                            <td>University Hall</td>
                        </tr>
                        <tr>
                            <td>2026-11-22</td>
                            <td>08:00 - 18:00</td>
                            <td>Sports Day</td>
                            <td>Main Stadium</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="register" class="mb-5">
            <h2 class="mb-3">Register Your Interest</h2>

            <?php if ($submitted && $registration !== null): ?>
                <!-- Success: only shown after the server accepted the POST. -->
                <div class="alert alert-success" role="alert">
                    <h3 class="h5">Thank you, <?php echo e($registration['name']); ?>!</h3>
                    <p class="mb-1">Your interest has been received for <strong><?php echo e($registration['event']); ?></strong>.</p>
                    <p class="mb-0">A confirmation would be sent to <strong><?php echo e($registration['email']); ?></strong>. This Lab 2b version does not store registrations in a database.</p>
                </div>
                <p><a class="btn btn-primary" href="index.php">Register another interest</a></p>
            <?php else: ?>
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errors !== []): ?>
                    <div class="alert alert-danger" role="alert">
                        <p class="mb-1"><strong>Please fix the following and submit again:</strong></p>
                        <ul class="mb-0">
                            <?php foreach ($errors as $message): ?>
                                <li><?php echo e($message); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- method="post" + action="index.php": the browser sends the
                     named fields to this page, and the PHP block at the top
                     of this file processes $_POST. -->
                <form class="needs-validation" method="post" action="index.php" novalidate>
                    <div class="mb-3">
                        <label for="regName" class="form-label">Name</label>
                        <input type="text" class="form-control<?php echo isset($errors['name']) ? ' is-invalid' : ''; ?>" id="regName" name="name" value="<?php echo e($old['name']); ?>" <?php echo isset($errors['name']) ? 'aria-invalid="true"' : ''; ?> required />
                        <div class="invalid-feedback"><?php echo isset($errors['name']) ? e($errors['name']) : 'Please enter your name.'; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="regEmail" class="form-label">Email</label>
                        <input type="email" class="form-control<?php echo isset($errors['email']) ? ' is-invalid' : ''; ?>" id="regEmail" name="email" placeholder="name@example.com" value="<?php echo e($old['email']); ?>" <?php echo isset($errors['email']) ? 'aria-invalid="true"' : ''; ?> required />
                        <div class="invalid-feedback"><?php echo isset($errors['email']) ? e($errors['email']) : 'Please enter a valid email address.'; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="regEvent" class="form-label">Event</label>
                        <select class="form-select<?php echo isset($errors['event']) ? ' is-invalid' : ''; ?>" id="regEvent" name="event" <?php echo isset($errors['event']) ? 'aria-invalid="true"' : ''; ?> required>
                            <option value=""<?php echo $old['event'] === '' ? ' selected' : ''; ?> disabled>Choose an event...</option>
                            <?php foreach ($events as $value => $label): ?>
                                <option value="<?php echo e($value); ?>"<?php echo $old['event'] === $value ? ' selected' : ''; ?>><?php echo e($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?php echo isset($errors['event']) ? e($errors['event']) : 'Please choose an event.'; ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php endif; ?>
        </section>

    </main>

    <footer class="py-3 mt-4">
        <div class="container">
            <p class="mb-0 text-center"><small>&copy; 2026 Campus Events Portal. SSW3308 Lab 2b.</small></p>
        </div>
    </footer>

    <!-- Bootstrap 5.3.8 JS bundle (official CDN). Loaded ONCE, includes Popper. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        // Bootstrap form validation: show feedback when the form is submitted with invalid fields.
        // This is the browser-side check only. The PHP code at the top of
        // this file re-checks everything on the server.
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>
