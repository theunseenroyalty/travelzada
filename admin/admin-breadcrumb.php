<?php
// Function to get the current page name
function getCurrentPage() {
    return basename($_SERVER['PHP_SELF'], ".php");
}

// Define the breadcrumb items
$breadcrumbs = [
    'index' => 'Index',
    'login' => 'Login',
    'dashboard' => 'Dashboard',
    // Add more pages as needed
];

// Get the current page
$current_page = getCurrentPage();
?>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
        <?php if (isset($breadcrumbs[$current_page])): ?>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumbs[$current_page]; ?></li>
        <?php endif; ?>
    </ol>
</nav>
<!-- //breadcrumbs -->