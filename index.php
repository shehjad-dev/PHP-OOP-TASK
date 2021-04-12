<?php

  //Requiring root url that is defined as a constant
  require('config/rooturlconfig.php');
  
  //Requiring UserValidator class for form validation
  require('./classes/user_validator.php');

  //Requiring Credentials class for getting client_ip and entry_at
  require('./classes/get_credentials.php');

  //Requiring classes for database related tasks
  require('./classes/db_h.php');
  require('./classes/store_reports.php');
  

  //When the form has been submitted
  if(isset($_POST['submit'])) {
    
    if($_POST['amount'] == '' || $_POST['buyer'] == '' || $_POST['buyer'] == '' || $_POST['receipt_id']== '' || $_POST['items']== '' || $_POST['email'] == '' || $_POST['note']== '' || $_POST['city']== '' || $_POST['phone']=='' ||  $_POST['entry_by']== '') {

        //Form validation
        $validation = new UserValidator($_POST);
        $errors = $validation->validateForm();

    } else {

        //Get IP and entry_at from a class 
        $automateddata = new Credentials();
        $client_ip = $automateddata->getClientIp();
        $entry_at = $automateddata->getEntryDate();
        
        //Store everything in DB
        $store = new StoreReports();
        extract($_POST);
        $store->saveReports($amount,  $buyer, $receipt_id, $items, $email, $client_ip,$note, $city, $phone, $entry_at, $entry_by);
        
        //Unset all the objects created after work done
        unset($store);
        unset($automateddata);
        unset($validation);
        
    }

  }
?>

<!--Getting header and navbar from components-->
<?php include('components/header.php'); ?>
<?php include('components/navbar.php'); ?>

<div class="container">
        
        <div class="card bg-secondary my-3 p-5">
            <div class="mx-auto"><h4><b>SUBMISSION FORM</b></h4></div>
            <hr class="my-1">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Amount</label>
                <input type="text" name="amount" class="form-control mb-1" value="<?php echo $_POST['amount'] ?? ''; ?>">
                <div class="<?php echo ($errors['amount']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['amount'] ?? ''; ?></div>
            </div>
            <div class="form-group">
                <label>Buyer</label>
                <input type="text" name="buyer" class="form-control mb-1" value="<?php echo $_POST['buyer'] ?? ''; ?>">
                <div class="<?php echo ($errors['buyer']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['buyer'] ?? ''; ?></div>
            </div>
            <div class="form-group">
                <label>Receipt ID</label>
                <input type="text" name="receipt_id" class="form-control mb-1" value="<?php echo $_POST['receipt_id'] ?? ''; ?>">
                <div class="<?php echo ($errors['receipt_id']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['receipt_id'] ?? ''; ?></div>
            </div>            
            <div class="form-group">
                <label>Items</label>
                <input type="text" name="items" class="form-control mb-1" value="<?php echo $_POST['items'] ?? ''; ?>">
                <div class="<?php echo ($errors['items']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['items'] ?? ''; ?></div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control mb-1" value="<?php echo $_POST['email'] ?? ''; ?>">
                <div class="<?php echo ($errors['email']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['email'] ?? ''; ?></div>
            </div>
            <div class="form-group">
                <label>Note</label>
                <input type="text" name="note" class="form-control mb-1" value="<?php echo $_POST['note'] ?? ''; ?>">
                <div class="<?php echo ($errors['note']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['note'] ?? ''; ?></div>
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control mb-1" value="<?php echo $_POST['city'] ?? ''; ?>">
                <div class="<?php echo ($errors['city']) ? 'py-2 px-1' : ''; ?>  alert-danger text-white"><?php echo $errors['city'] ?? ''; ?></div>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control mb-1" value="<?php echo $_POST['phone'] ?? ''; ?>">
                <div class="<?php echo ($errors['phone']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['phone'] ?? ''; ?></div>
            </div>
            <div class="form-group">
                <label>Entry by</label>
                <input type="text" name="entry_by" class="form-control mb-1" value="<?php echo $_POST['entry_by'] ?? ''; ?>">
                <div class="<?php echo ($errors['entry_by']) ? 'py-2 px-1' : ''; ?> alert-danger text-white"><?php echo $errors['entry_by'] ?? ''; ?></div>
            </div>
            

            <input type="submit" class="btn btn-info btn-lg" name="submit" value="submit">
            
            </form>
                
        </div>
        
</div>


<!--Getting footer from components-->
<?php include('components/footer.php'); ?>
    
    
