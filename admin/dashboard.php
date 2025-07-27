<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();
include('includes/header.php');

?>
<div class="container py-5">
  <div class="text-center">
    <h2 class="mb-4">Welcome to Your Admin Dashboard</h2>
    <p class="lead text-muted">Use the navigation links on the left to manage events, upload media, or customize your settings.</p>
    <p class="text-secondary">Everything you need is just a click away — build, edit, and grow your content seamlessly.</p>
    <i class="fas fa-arrow-left fa-2x text-info mt-3"></i>
    <p class="mt-2">Start by selecting a tool from the sidebar.</p>
  </div>
</div>



<?php

include('includes/footer.php');

?>
