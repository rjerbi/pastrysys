<?php
  $page_title = 'Modifier fournisseur';
  require_once('includes/load.php');
  page_require_level(2);

  // Récupérer le fournisseur par ID
  $supplier = find_by_id('suppliers', (int)$_GET['id']);
  if (!$supplier) {
    $session->msg("d", "ID du fournisseur manquant.");
    redirect('suppliers.php');
  }

  // Lors de la soumission du formulaire
  if (isset($_POST['update_supplier'])) {
    $req_fields = array('supplier-name','supplier-email','supplier-phone','supplier-address','supplier-company');
    validate_fields($req_fields);

    if (empty($errors)) {
      $name     = remove_junk($db->escape($_POST['supplier-name']));
      $email    = remove_junk($db->escape($_POST['supplier-email']));
      $phone    = remove_junk($db->escape($_POST['supplier-phone']));
      $address  = remove_junk($db->escape($_POST['supplier-address']));
      $company  = remove_junk($db->escape($_POST['supplier-company']));

      $query  = "UPDATE suppliers SET ";
      $query .= "name='{$name}', email='{$email}', phone='{$phone}', address='{$address}', company='{$company}' ";
      $query .= "WHERE id='{$supplier['id']}'";

      $result = $db->query($query);
      if ($result && $db->affected_rows() === 1) {
        $session->msg('s', "Fournisseur mis à jour.");
        redirect('suppliers.php', false);
      } else {
        $session->msg('d', "Échec de la mise à jour.");
        redirect('edit_supplier.php?id=' . $supplier['id'], false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('edit_supplier.php?id=' . $supplier['id'], false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12"><?php echo display_msg($msg); ?></div>
</div>
<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong><span class="glyphicon glyphicon-pencil"></span> Modifier fournisseur</strong>
    </div>
    <div class="panel-body">
      <form method="post" action="edit_supplier.php?id=<?php echo (int)$supplier['id']; ?>">
        <div class="form-group">
          <label>Nom</label>
          <input type="text" class="form-control" name="supplier-name" value="<?php echo remove_junk($supplier['name']); ?>">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="supplier-email" value="<?php echo remove_junk($supplier['email']); ?>">
        </div>
        <div class="form-group">
          <label>Téléphone</label>
          <input type="text" class="form-control" name="supplier-phone" value="<?php echo remove_junk($supplier['phone']); ?>">
        </div>
        <div class="form-group">
          <label>Adresse</label>
          <input type="text" class="form-control" name="supplier-address" value="<?php echo remove_junk($supplier['address']); ?>">
        </div>
        <div class="form-group">
          <label>Entreprise</label>
          <input type="text" class="form-control" name="supplier-company" value="<?php echo remove_junk($supplier['company']); ?>">
        </div>
        <button type="submit" name="update_supplier" class="btn btn-primary">Mettre à jour</button>
      </form>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
