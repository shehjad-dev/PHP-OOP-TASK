<?php 

class UserValidator {

  private $data;
  private $errors = [];
  private static $fields = ['amount', 'buyer', 'receipt_id', 'items', 'email', 'note', 'city', 'phone', 'entry_by'];

  public function __construct($post_data){
    $this->data = $post_data;
  }

  public function validateForm(){
    //Check for any empty key in $fields
    foreach(self::$fields as $field){
      if(!array_key_exists($field, $this->data)){
        trigger_error("'$field' is not present in the data");
        return;
      }
    }

    //calling methods for validation
    $this->validateAmount();
    $this->validateBuyer();
    $this->validateReceiptId();
    $this->validateItems();
    $this->validateEmail();
    $this->validateNote();
    $this->validateCity();
    $this->validatePhone();
    $this->validateEditedBy();

    //return $errors array
    return $this->errors;

  }

  private function validateAmount() {
    $val = trim($this->data['amount']);

    if(empty($val)) {
      $this->addError('amount', 'Amount cannot be empty!');
    } 
    else {
      if(!preg_match('/^[0-9]{1,10}$/', $val)) {
        $this->addError('amount', 'Amount must be a number & not more than 10 characters!');
      }
    }
  }

  private function validateBuyer() {
    $val = trim($this->data['buyer']);

    if(empty($val)) {
      $this->addError('buyer', 'Buyer cannot be empty!');
    } 
    else {
      if(!preg_match('/^[a-zA-Z0-9 ?]{1,20}$/', $val)) {
        $this->addError('buyer', 'Buyer must be text, spaces, numbers & not more than 20 characters!');
      }
    }
  }

  private function validateReceiptId() {
    $val = trim($this->data['receipt_id']);

    if(empty($val)) {
      $this->addError('receipt_id', 'Receipt ID cannot be empty!');
    } 
    else {
      if(!preg_match('/^[a-zA-Z]{1,20}$/', $val)) {
        $this->addError('receipt_id', 'Receipt ID must be only text & not more than 20 chars!');
      }
    }
  }

  private function validateItems() {
    $val = trim($this->data['items']);

    if(empty($val)) {
      $this->addError('items', 'Items cannot be empty!');
    } 
    else {
      if(!preg_match('/^[a-zA-Z]+$/', $val)) {
        $this->addError('items', 'Items must be only text!');
      }
    }
  }

  private function validateEmail(){

    $val = trim($this->data['email']);

    if(empty($val)){
      $this->addError('email', 'Email cannot be empty!');
    } 
    else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addError('email', 'Email must be a valid email address!');
      }
    }

  }

  private function validateNote(){

    $val = trim($this->data['note']);

    if(empty($val)){
      $this->addError('note', 'Note cannot be empty');
    } 
    else {
      if(!preg_match('/^(\w*\W*){0,30}$/', $val)){
        $this->addError('note', 'Note can be anything but not more than 30 words');
      } 

    }

  }

  private function validateCity(){

    $val = trim($this->data['city']);

    if(empty($val)){
      $this->addError('city', 'City cannot be empty');
    } 
    else {
      if(!preg_match('/^[a-zA-Z ]{0,20}$/', $val)){
        $this->addError('city', 'City must be text with spaces and not more than 20 chars limit');
      }
    }

  }

  private function validatePhone(){

    $val = trim($this->data['phone']);

    if(empty($val)){
      $this->addError('phone', 'Phone cannot be empty');
    } 
    else {
      //bd phone number
      if(!preg_match('/^(\+)?(88)?01[0-9]{9}$/', $val)){
        $this->addError('phone', 'Phone can be only numbers & a valid BD phone number');
      }
      //any number
      /*
        if(!preg_match('/^[0-9]+$/', $val)){
        $this->addError('phone', 'phone must be a valid phone number');
      } */
    }

  }

  private function validateEditedBy(){

    $val = trim($this->data['entry_by']);

    if(empty($val)){
      $this->addError('entry_by', 'Entry by cannot be empty');
    } 
    else {
      if(!preg_match('/^[0-9]{1,10}$/', $val)){
        $this->addError('entry_by', 'Entry by must be a number');
      }

    }

  }

  //Method to add error
  private function addError($key, $val){
    $this->errors[$key] = $val;
  }

}

?>