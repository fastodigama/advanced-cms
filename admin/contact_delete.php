<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    set_message('Invalid contact ID.', 'warning');
    header('Location: contact.php');
    exit;
}
$id = (int)$_GET['id'];

$query = "DELETE FROM contact WHERE id=$id LIMIT 1";
if (mysqli_query($connect, $query)) {
    set_message('Contact entry deleted successfully!', 'confirmation');
} else {
    set_message('Error deleting contact entry.', 'warning');
}
header('Location: contact.php');
exit; 