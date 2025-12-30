<?php
$page_title = 'Add Supplier';
require_once('includes/load.php'); // Load necessary files
page_require_level(2); // Check user permission

if (isset($_POST['add_supplier'])) {
    $req_fields = array('name', 'email', 'phone', 'address', 'company');
    validate_fields($req_fields);
    if (empty($errors)) {
        $name    = remove_junk($db->escape($_POST['name']));
        $email   = remove_junk($db->escape($_POST['email']));
        $phone   = remove_junk($db->escape($_POST['phone']));
        $address = remove_junk($db->escape($_POST['address']));
        $company = remove_junk($db->escape($_POST['company']));

        $query  = "INSERT INTO suppliers (name, email, phone, address, company) VALUES ('{$name}', '{$email}', '{$phone}', '{$address}', '{$company}')";
        if ($db->query($query)) {
            $session->msg('s', "Supplier added successfully.");
            redirect('add_supplier.php', false);
        } else {
            $session->msg('d', ' Sorry failed to add supplier!');
            redirect('suppliers.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_supplier.php', false);
    }
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-plus"></span>
                    <span>Ajouter un nouveau fournisseur</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" action="add_supplier.php" class="clearfix">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                <input type="text" class="form-control" name="name" placeholder="Nom fournisseur" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="Email fournisseur" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-phone"></i>
                                </span>
                                <input type="text" class="form-control" name="phone" placeholder="N° de téléphone du fournisseur" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-map-marker"></i>
                                </span>
                                <input type="text" class="form-control" name="address" placeholder="Addresse de fournisseur" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-briefcase"></i>
                                </span>
                                <input type="text" class="form-control" name="company" placeholder="Société fournisseur" required>
                            </div>
                        </div>
                        <button type="submit" name="add_supplier" class="btn btn-danger">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>