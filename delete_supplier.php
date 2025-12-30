<?php
  require_once('includes/load.php');
  // Check what level the user has permission to view this page
  page_require_level(2);
?>

<?php
  // Find the supplier by ID from the URL parameter
  $supplier = find_by_id('suppliers', (int)$_GET['id']);
  if (!$supplier) {
    // If supplier not found, show an error message and redirect
    $session->msg("d", "Missing or invalid supplier ID.");
    redirect('suppliers.php');
  }
?>

<?php
  // Attempt to delete the supplier
  $delete_id = delete_by_id('suppliers', (int)$supplier['id']);
  if ($delete_id) {
    // Success message and redirect
    $session->msg("s", "Supplier deleted successfully.");
    redirect('suppliers.php');
  } else {
    // Failure message and redirect
    $session->msg("d", "Supplier deletion failed.");
    redirect('suppliers.php');
  }
?>
