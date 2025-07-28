<?php
include('admin/includes/database.php');

if ($_POST && isset($_POST['register'])) {
    $event_id = $_POST['event_id'];
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    
    $check_query = "SELECT id FROM event_registrations WHERE event_id = '$event_id' AND email = '$email'";
    $check_result = mysqli_query($connect, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $error_message = "You are already registered for this event!";
    } else {
        $insert_query = "INSERT INTO event_registrations (event_id, name, email, phone) VALUES ('$event_id', '$name', '$email', '$phone')";
        if (mysqli_query($connect, $insert_query)) {
            $success_message = "Registration successful! We will contact you soon.";
        } else {
            $error_message = "Registration failed. Please try again.";
        }
    }
}

$events_query = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC";
$events_result = mysqli_query($connect, $events_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .event-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            background: #f9f9f9;
        }
        .event-date {
            color: #007bff;
            font-weight: bold;
        }
        .register-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
            display: none;
        }
        .register-form.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-4">Upcoming Events</h1>
                
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <?php if (mysqli_num_rows($events_result) > 0): ?>
                    <?php while ($event = mysqli_fetch_assoc($events_result)): ?>
                        <div class="event-card">
                            <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p class="event-date">
                                📅 <?php echo date('F j, Y', strtotime($event['event_date'])); ?>
                            </p>
                            <p class="text-muted">
                                📍 <?php echo htmlspecialchars($event['location']); ?>
                            </p>
                            <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                            
                            <button class="btn btn-primary" onclick="toggleRegistration(<?php echo $event['id']; ?>)">
                                Register for Event
                            </button>
                            
                            <div id="register-form-<?php echo $event['id']; ?>" class="register-form">
                                <h5>Register for: <?php echo htmlspecialchars($event['title']); ?></h5>
                                <form method="POST" action="">
                                    <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone">
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" name="register" class="btn btn-success">
                                            Submit Registration
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="toggleRegistration(<?php echo $event['id']; ?>)">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center">
                        <h4>No upcoming events at the moment.</h4>
                        <p>Please check back later for new events!</p>
                    </div>
                <?php endif; ?>
                
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-outline-primary">← Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleRegistration(eventId) {
            const form = document.getElementById('register-form-' + eventId);
            form.classList.toggle('active');
            
            const allForms = document.querySelectorAll('.register-form');
            allForms.forEach(function(otherForm) {
                if (otherForm.id !== 'register-form-' + eventId) {
                    otherForm.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>
