<link rel="stylesheet" href="<? echo get_stylesheet_directory_uri(); ?>/includes/donate_form/css/donate.css" type="text/css" media="screen" />
<script type="text/javascript" src="<? echo get_stylesheet_directory_uri(); ?>/includes/donate_form/js/jquery.currency.js"></script>
<script type="text/javascript" src="<? echo get_stylesheet_directory_uri(); ?>/includes/donate_form/js/jquery.numeric.js"></script>
<?php
/* Process POST */
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Sanitize Data
  $amount = sanitize($_POST['x_amount']);
  $amount = sanitize($_POST['x_own_amount']);
  $first_name = sanitize($_POST['x_first_name']);
  $last_name = sanitize($_POST['x_last_name']);
  $address = sanitize($_POST['x_address']);
  $city = sanitize($_POST['x_city']);
  $state = sanitize($_POST['x_state']);
  $country = sanitize($_POST['x_country']);
  $donate_dest = sanitize($_POST['x_donate_dest']);
  $zip_code = sanitize($_POST['x_zip']);
  $email = sanitize($_POST['x_email']);

  $card_num = sanitize($_POST['x_card_num']);
  $expiration_month = (int) sanitize($_POST['exp_month']);
  $expiration_year = (int) sanitize($_POST['exp_year']);
  $expiration_date = sprintf("%04d-%02d", $expiration_year, $expiration_month);
  $ccv = sanitize($_POST['x_card_code']);

  $invoice_id = uniqid('urban_zen_foundation_donate_');
  if($_POST['x_own_amount']){
    $amount = $_POST['x_own_amount'];
  }else{
    $amount = $_POST['x_amount'];
  }

  if (!validateCreditcard_number($card_num)){
    //$errors['credit_card'] = "Please enter a valid credit card number";
  }
  if (!validateCreditCardExpirationDate($expiration_month, $expiration_year)){
    $errors['expiration_month'] = "Please enter a valid expiration date for your credit card";
  }
  if (!validateCVV($card_num, $ccv)){
    $errors['ccv'] = "Please enter the security code (CVV number) for your credit card";
  }
  if (empty($first_name)){
    $errors['first_name'] = "Please provide the card holder's first name";
  }
  if (empty($last_name)){
    $errors['last_name'] = "Please provide the card holder's last name";
  }
  if (empty($address)){
    $errors['address'] = 'Please provide your billing address.';
  }
  if (empty($city)){
    $errors['city'] = 'Please provide the city of your billing address.';
  }
  if (empty($state)){
    $errors['state'] = 'Please provide the state for your billing address.';
  }
  if (empty($amount)){
    $errors['amount'] = 'Please provide an amount for your donation.';
  }
  if (!preg_match("/^\d{5}$/", $zip_code)){
    $errors['zip_code'] = 'Make sure your billing zip code is 5 digits.';
  }

  if($_POST['x_friend']){
    $description = "Donate in friend's name: ".$_POST['x_friend'];
  }
  else{
    $description = "Donated $".$amount." under ".$_POST['x_first_name']." ".$_POST['x_last_name'];
  }


  require_once "anet_php_sdk/vendor/autoload.php";
  require_once "anet_php_sdk/autoload.php";

    // use net\authorize\api\contract\v1 as net\authorize\api\contract\v1;
    // use net\authorize\api\controller as net\authorize\api\controller;

  define("AUTHORIZENET_LOG_FILE", "phplog");

  /* Create a merchantAuthenticationType object with authentication details
  retrieved from the constants file */
  $merchantAuthentication = new net\authorize\api\contract\v1\MerchantAuthenticationType();

  $merchantAuthentication->setName('462ReMMxNfRh');
  $merchantAuthentication->setTransactionKey('5aU3x8JL22hwb4W7');

  // Set the transaction's refId
  $refId = 'ref' . time();
  if (!count($errors)):
    // Create the payment data for a credit card
    $creditCard = new net\authorize\api\contract\v1\CreditCardType();
    $creditCard->setCardNumber($card_num);
    $creditCard->setExpirationDate($expiration_date);
    $creditCard->setCardCode($ccv);
    $paymentOne = new net\authorize\api\contract\v1\PaymentType();
    $paymentOne->setCreditCard($creditCard);
    $order = new net\authorize\api\contract\v1\OrderType();
    $order->setDescription($donate_dest);

    // Set the customer's Bill To address
    $customerAddress = new net\authorize\api\contract\v1\CustomerAddressType();
    $customerAddress->setFirstName($first_name);
    $customerAddress->setLastName($last_name);
    $customerAddress->setAddress($address);
    $customerAddress->setCity($city);
    $customerAddress->setState($state);
    $customerAddress->setZip($zip_code);
    $customerAddress->setCountry($country);

    // Set the customer's identifying information
    $customerData = new net\authorize\api\contract\v1\CustomerDataType();
    $customerData->setEmail($email);

    //Add values for transaction settings
    $duplicateWindowSetting = new net\authorize\api\contract\v1\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("600");

    // Create a TransactionRequestType object
    $transactionRequestType = new net\authorize\api\contract\v1\TransactionRequestType();
    $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerAddress);
    $transactionRequestType->setCustomer($customerData);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    $request = new net\authorize\api\contract\v1\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId( $refId);
    $request->setTransactionRequest( $transactionRequestType);
    $controller = new net\authorize\api\controller\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);

    if ($response != null)
    {
      if($response->getMessages()->getResultCode() == 'Ok')
      {
        $success = true;
        $tresponse = $response->getTransactionResponse();
        $transaction_id = $tresponse->getTransId();
        if ($tresponse != null && $tresponse->getMessages() != null)   
        {
          $reason_text.= " Transaction Response Code : " . $tresponse->getResponseCode() . "\n";
          $reason_text.= " Successfully created an authCapture transaction with Auth Code : " . $tresponse->getAuthCode() . "\n";
          $reason_text.= " Transaction ID : " . $tresponse->getTransId() . "\n";
          $reason_text.= " Code : " . $tresponse->getMessages()[0]->getCode() . "\n"; 
          $reason_text.= " Description : " . $tresponse->getMessages()[0]->getDescription() . "\n";
          $success = true;
        }
        else
        {
          $reason_text.= "Transaction Failed \n";
          if($tresponse->getErrors() != null)
          {
            $reason_text.= " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
            $reason_text.= " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";            
          }
        }
      }
      else
      {
        $failure = true;
        $reason_text.= "Transaction Failed \n";
        $tresponse = $response->getTransactionResponse();

        if($tresponse != null && $tresponse->getErrors() != null)
        {
          $reason_text.= " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
          $reason_text.= " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";                      
        }
        else
        {
          $reason_text.= " Error code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
          $reason_text.= " Error message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
        }
      }      
    }
    else
    {
      $reason_text.=  "No response returned \n";
    }
  endif; //If no errors
endif; //POST
?>

<?php if($success): ?>
  <script type="text/javascript">
    location.href = "#";
    location.href = "#thanks";
  </script>
  <div id="Donate" class="payment thankyou donate_form">
    <div class="inner-content container clearfix">
      <h3 id="thanks" style="font-size:25px;">THANK YOU.</h3>
      <p >Transaction ID: <?php echo $transaction_id; ?><br /> 
        You will receive a receipt in your email shortly.</p>
        <p>As a 501(c) 3 organization, Urban Zen Foundation is able to realize its mission only with your generous support. All levels of donation are welcome and tax deductible.</p>
      </div>
    </div>
  <?php else: ?>
    <div id="Donate" class="payment donate_form">

      <?php if(count($errors) || $auth_error || $failure): ?>
        <script type="text/javascript">
          location.href = "#";
          location.href = "#error";
        </script>
        <div class="error" id="error">
          <? echo $reason_text; ?>
          <h3>There was an error with your submission. Please make the necessary corrections and try again.</h3>
          <ul>
            <?php if($auth_error == 1): ?>
              <li>- <?php echo $reason_text; ?></li>
            <?php endif; ?>
            <?php foreach ($errors as $error): ?>
              <li>- <?php echo $error; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
    <?php endif; ?>

        <form action="." method="POST" class="billing-form">
          <div class="form-container">
            <table class="top-payment-info">
              <tr>
                <td colspan="6">
                  <label id="X_AMOUNT_LABEL" for="X_AMOUNT">I AM DONATING</label>
                  <div>
                    <select id="X_AMOUNT" name="x_amount" style="margin:0 0 15px 0;">
                      <option value="">Select an Amount</option>  
                      <option value="25.00">$25</option>
                      <option value="50.00">$50</option>
                      <option value="100.00">$100</option>
                      <option value="500.00">$500</option>      
                      <option value="1000.00">$1,000</option>
                      <option value="3500.00">$3,500</option>
                      <option value="5000.00">$5,000</option>
                      <option value="7500.00">$7,500</option>
                      <option value="10000.00">$10,000</option> 
                      <option value="25000.00">$25,000</option> 
                      <option value="50000.00">$50,000</option>                      
                    </select>
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="6">
                  <span>OR ENTER YOUR OWN DONATION AMOUNT</span>
                  <label>Enter Amount</label>
                  <input id="X_OWN_AMOUNT" type="text" name="x_own_amount" value="<?php echo $amount; ?>" autocomplete="off" />
                  <script>jQuery('#X_AMOUNT').numeric();jQuery('#X_OWN_AMOUNT').numeric();</script>
                </td>
              </tr>
              <tr>
                <td class="donation-info" colspan="2">
                  <div class="donation-info-text">
                    You're donating<span id="DonateCost"><?php echo ' ' . $amount; ?></span> by credit card.<img src="<? echo get_stylesheet_directory_uri(); ?>/includes/donate_form/images/credit-card-logos.png" />
                    <script>jQuery('#DonateCost').currency();</script>
                  </div>
                </td>
              </tr>

            </table>
            <div class="panel payment-form">
              <table style="width:100%;">
                <tr>
                  <td colspan="4" class="half-width-desktop">
                    <label for="FIRST_NAME">FIRST NAME</label>
                    <input id="FIRST_NAME" type="text" name="x_first_name" value="<?php echo $first_name; ?>" />
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="half-width-desktop">
                    <label for="LAST_NAME">LAST NAME</label>
                    <input id="LAST_NAME" type="text" name="x_last_name" value="<?php echo $last_name; ?>" />
                  </td>
                </tr>
                <tr>
                  <td colspan="4">
                    <label for="EMAIL_ADDRESS">EMAIL ADDRESS</label>
                    <input id="EMAIL_ADDRESS" type="text" name="x_email" value="<?php echo $email; ?>" />
                  </td>
                </tr>
                <tr>
                  <td colspan="4">
                    <label for="CC_NUMBER">CREDIT CARD #</label>
                    <input id="CC_NUMBER" type="text" name="x_card_num" value="<?php echo $card_num; ?>" autocomplete="off" />
                  </td>
                </tr>
                <tr>
                  <td style="width:100px;">
                    <label for="EXP_MONTH">EXP MONTH</label>
                    <div class="selectdropdown clearfix" style="position:relative;">
                      <select id="" name="exp_month">
                        <option value="01" <?php if($expiration_month == '01'):?>selected<?php endif;?>>1</option>
                        <option value="02" <?php if($expiration_month == '02'):?>selected<?php endif;?>>2</option>
                        <option value="03" <?php if($expiration_month == '03'):?>selected<?php endif;?>>3</option>
                        <option value="04" <?php if($expiration_month == '04'):?>selected<?php endif;?>>4</option>
                        <option value="05" <?php if($expiration_month == '05'):?>selected<?php endif;?>>5</option>
                        <option value="06" <?php if($expiration_month == '06'):?>selected<?php endif;?>>6</option>
                        <option value="07" <?php if($expiration_month == '07'):?>selected<?php endif;?>>7</option>
                        <option value="08" <?php if($expiration_month == '08'):?>selected<?php endif;?>>8</option>
                        <option value="09" <?php if($expiration_month == '09'):?>selected<?php endif;?>>9</option>
                        <option value="10" <?php if($expiration_month == '10'):?>selected<?php endif;?>>10</option>
                        <option value="11" <?php if($expiration_month == '11'):?>selected<?php endif;?>>11</option>
                        <option value="12" <?php if($expiration_month == '12'):?>selected<?php endif;?>>12</option>
                      </select>
                    </div>
                  </td>
                  <td>
                    <label for="EXP_YEAR" style="white-space: nowrap;">EXP YEAR</label>
                    <div class="selectdropdown clearfix" style="position:relative;">
                      <select id="EXP_YEAR" name="exp_year">
                        <option value="2017" <?php if($expiration_year == '2017'):?>selected<?php endif;?>>2017</option>
                        <option value="2018" <?php if($expiration_year == '2018'):?>selected<?php endif;?>>2018</option>
                        <option value="2019" <?php if($expiration_year == '2019'):?>selected<?php endif;?>>2019</option>
                        <option value="2020" <?php if($expiration_year == '2020'):?>selected<?php endif;?>>2020</option>
                        <option value="2021" <?php if($expiration_year == '2021'):?>selected<?php endif;?>>2021</option>
                        <option value="2022" <?php if($expiration_year == '2022'):?>selected<?php endif;?>>2022</option>
                        <option value="2023" <?php if($expiration_year == '2023'):?>selected<?php endif;?>>2023</option>
                        <option value="2024" <?php if($expiration_year == '2024'):?>selected<?php endif;?>>2024</option>
                        <option value="2025" <?php if($expiration_year == '2025'):?>selected<?php endif;?>>2025</option>
                      </select>
                    </div>
                  </td>

                </tr>
                <tr>
                  <td colspan="4" class="cvv-td">
                    <label for="CCV">CCV</label>
                    <input id="CCV" type="text" name="x_card_code" value="<?php echo $ccv; ?>" autocomplete="off"/>
                  </td>
                </tr>

                <tr>
                  <td colspan="4">
                    <label for="BILLING_ADDRESS">BILLING ADDRESS</label>
                    <input id="BILLING_ADDRESS" type="text" name="x_address" value="<?php echo $address; ?>" />
                  </td>
                </tr>
                <tr>
                  <td colspan="4">
                    <label for="CITY">CITY</label>
                    <input id="CITY" type="text" name="x_city" value="<?php echo $city; ?>" />
                  </td>
                </tr>
                <tr>
                  <td class="half-width-desktop">
                    <label for="STATE_PROVINCE">STATE/PROVINCE</label>
                    <div class="selectdropdown clearfix" style="position:relative;">
                      <select name="x_state">
                       <option value="AL">Alabama</option>
                       <option value="AK">Alaska</option>
                       <option value="AZ">Arizona</option>
                       <option value="AR">Arkansas</option>
                       <option value="CA">California</option>
                       <option value="CO">Colorado</option>
                       <option value="CT">Connecticut</option>
                       <option value="DE">Delaware</option>
                       <option value="DC">District Of Columbia</option>
                       <option value="FL">Florida</option>
                       <option value="GA">Georgia</option>
                       <option value="HI">Hawaii</option>
                       <option value="ID">Idaho</option>
                       <option value="IL">Illinois</option>
                       <option value="IN">Indiana</option>
                       <option value="IA">Iowa</option>
                       <option value="KS">Kansas</option>
                       <option value="KY">Kentucky</option>
                       <option value="LA">Louisiana</option>
                       <option value="ME">Maine</option>
                       <option value="MD">Maryland</option>
                       <option value="MA">Massachusetts</option>
                       <option value="MI">Michigan</option>
                       <option value="MN">Minnesota</option>
                       <option value="MS">Mississippi</option>
                       <option value="MO">Missouri</option>
                       <option value="MT">Montana</option>
                       <option value="NE">Nebraska</option>
                       <option value="NV">Nevada</option>
                       <option value="NH">New Hampshire</option>
                       <option value="NJ">New Jersey</option>
                       <option value="NM">New Mexico</option>
                       <option value="NY" selected>New York</option>
                       <option value="NC">North Carolina</option>
                       <option value="ND">North Dakota</option>
                       <option value="OH">Ohio</option>
                       <option value="OK">Oklahoma</option>
                       <option value="OR">Oregon</option>
                       <option value="PA">Pennsylvania</option>
                       <option value="RI">Rhode Island</option>
                       <option value="SC">South Carolina</option>
                       <option value="SD">South Dakota</option>
                       <option value="TN">Tennessee</option>
                       <option value="TX">Texas</option>
                       <option value="UT">Utah</option>
                       <option value="VT">Vermont</option>
                       <option value="VA">Virginia</option>
                       <option value="WA">Washington</option>
                       <option value="WV">West Virginia</option>
                       <option value="WI">Wisconsin</option>
                       <option value="WY">Wyoming</option>
                     </select>
                   </div>
                 </td>
                 <td class="half-width-desktop">
                  <label for="ZIP_CODE">ZIP CODE</label>
                  <input id="ZIP_CODE" type="text" name="x_zip" value="<?php echo $zip_code; ?>" />
                </td>
              </tr>

              <tr>
                <td colspan="4">
                  <label for="COUNTRY">COUNTRY</label>
                  <select name="x_country">
                    <option value="USA">United States</option>
                  </select>
                </td>
              </tr>

              <tr>
                <td colspan="4">
                  <label for="DONATE_DEST">PLEASE RESTRICT MY GIFT TO:</label>
                  <div class="selectdropdown clearfix" style="position:relative;">
                    <select name="x_donate_dest">
                      <option value="">--</option>
                      <option value="Urban Zen Foundation">Urban Zen Foundation</option>
                      <option value="Healthcare">Healthcare</option>
                      <option value="Education">Education</option>
                      <option value="Preservation of Cultures">Preservation of Cultures</option>
                      <option value="Sandy Gallin UCLA UZIT Program">Sandy Gallin UCLA UZIT Program</option>
                    </select>
                  </div>
                </td>
              </tr>
            </table>

            <table>
              <tr>
                <td colspan="1" style="width:30px;">
                  <input id="CheckGift" type="checkbox" name="" />
                </td>
                <td colspan="3">
                  <label for="CheckGift">MY GIFT TODAY IS TO HONOR SOMEONE</label>
                </td>
              </tr>
              <tr id="HonorOf" style="display:none;">
                <td colspan="2">
                  <label for="xFriend">In honor of:</label>
                  <input id="xFriend" type="text" name="x_friend" value="" />
                  <script>
                    jQuery('input#CheckGift').change(function(){
                      var is_checked = jQuery(this).is(':checked');
                      if(is_checked){
                        jQuery('#HonorOf').show();
                      }
                      else{
                        jQuery('#HonorOf').hide();
                      }
                    });
                  </script>
                </td>
              </tr>
              <tr>
                <td colspan="1" style="width:30px;">
                  <input id="CheckEmailUpdates" type="checkbox" name="" checked />
                </td>
                <td colspan="3">
                  <label for="CheckEmailUpdates">YES, I WOULD LIKE TO RECEIVE EMAIL UPDATES</label>
                </td>
              </tr>
            </table>
            <div class="clearfix" style="padding:10px 0;text-align:center;">
              <input style="height:50px !important;" class="button" type="submit" name="" value="PROCESS DONATION" />
            </div>
          </div>
        </div>
      </form> 
    </div>

  <?php endif; ?>
