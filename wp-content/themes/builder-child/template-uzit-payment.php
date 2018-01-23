<?php /*
  Template Name: UZIT Donate Payment Page
 */ ?>

<?php
$donate_url = 'http://urbanzen.org/donate/';
$error_message = '';
//header( 'Location: '.$donate_url.'?error_message='.$error_message );

/* Process POST */
if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_a']) ) {
    //REQUIRED
    $amount = $_POST['x_amount'];
    if(!$amount){
        $error_message = 'Please enter an amount';
        header( 'Location: '.$donate_url.'?error_message='.$error_message );
    }
    
    $invoice_id = uniqid('donate_');
    
    $x_friend = $_POST['x_friend'];
    
}
elseif( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_b']) ) {
    require_once 'auth_net/config.php';
    
    $amount = $_POST['x_amount'];
    $invoice_id = $_POST['x_invoice_id'];
    
    if($_POST['x_friend']){
        $description = "Donate in friend's name: ".$_POST['x_friend'];
    }
    else{
        $description = "Donated $".$amount." under ".$_POST['x_first_name']." ".$_POST['x_last_name'];
    }
    
    if ($METHOD_TO_USE == "AIM") {
        $transaction = new AuthorizeNetAIM;
        $transaction->setSandbox(AUTHORIZENET_SANDBOX);
        $transaction->setFields(
            array(
                'amount' => $amount, 
                'card_num' => $_POST['x_card_num'], 
                'exp_date' => $_POST['x_exp_date'],
                'first_name' => $_POST['x_first_name'],
                'last_name' => $_POST['x_last_name'],
                'address' => $_POST['x_address'],
                'city' => $_POST['x_city'],
                'state' => $_POST['x_state'],
                'country' => $_POST['x_country'],
                'zip' => $_POST['x_zip'],
                'email' => $_POST['x_email'],
                'card_code' => $_POST['x_card_code'],
                'description' => $description,
                'invoice_num' => $invoice_id,  
            )
        );
        $response = $transaction->authorizeAndCapture();
        if ($response->approved) {
            // Transaction approved! Do your logic here.
            //header('Location: ?transaction_id=' . $response->transaction_id);
            $transaction_id = $response->transaction_id;
        } else {
            $auth_error = 1;
            $reason_code = $response->response_reason_code;
            $reason_text = $response->response_reason_text;
            
            //header('Location: ?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text);
        }
    }
    /*
    elseif (count($_POST)) {
        $response = new AuthorizeNetSIM;
        if ($response->isAuthorizeNet()) {
            if ($response->approved) {
                // Transaction approved! Do your logic here.
                // Redirect the user back to your site.
                $return_url = $site_root . 'thank_you_page.php?transaction_id=' .$response->transaction_id;
            } else {
                // There was a problem. Do your logic here.
                // Redirect the user back to your site.
                $return_url = $site_root . 'error_page.php?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text;
            }
            echo AuthorizeNetDPM::getRelayResponseSnippet($return_url);
        } else {
            echo "MD5 Hash failed. Check to make sure your MD5 Setting matches the one in config.php";
        }
    }
    */
}
else{
    /* IF NOT POST - REDIRECT */
    header( 'Location: '.$donate_url ); 
}
?>

<?php
/* overrides */
//$transaction_id = 1000;
?>

<?php
    $pageSlider = get_post_meta(get_the_ID(), 'pageSlider', true);
    $animation = get_post_meta(get_the_ID(), 'pageSliderAnimation', true);
    $controlNav = get_post_meta(get_the_ID(), 'pageSliderControlNav', true);
?>

<?php get_header(); ?>

<link rel='stylesheet'  href='/wp-content/themes/builder-child/stylesheets/custom/donate.css' type='text/css' media='all' />
<script type="text/javascript" src="/wp-content/themes/builder-child/js/custom/jquery.currency.js"></script>

<div id="Donate" class="container">
    
    <?php if(isset($transaction_id) && $transaction_id): ?>
    
    <div id="ThankYou" class="clearfix">
        <h1>Thank you for your donation.</h1>
        <p>
            Your transaction code is <strong><?php echo $transaction_id; ?></strong> and 
            Invoice # <strong><?php echo $invoice_id; ?></strong>. Save this for your records.
        </p>
        <p>A receipt will be emailed to <strong><?php echo $_POST['x_email']; ?></strong></p>
        
        <p>As a 501(c) 3 organization, Urban Zen Foundation is able to realize its mission only with your generous
        support. All levels of donation are welcome and tax deductible.</p>
        
    </div>
    <?php else: ?>
    
    <?php if($_GET['error_message']): ?>
    <div class="error_message">
        <p><?php echo $_GET['error_message']; ?></p>
    </div>
    <?php endif; ?>

    <?php if($auth_error): ?>
    <div class="error_message">
        <p>Error Code: <?php echo $reason_code; ?></p>
        <p>Error Code: <?php echo $reason_text; ?></p>
    </div>
    <?php endif; ?>
    
    <form id="DonateForm" class="payment-form" action="." method="POST">
        <input type="hidden" name="form_b" value="1" />
        <input type="hidden" name="x_amount" value="<?php echo $amount; ?>" />
        <input type="hidden" name="x_invoice_id" value="<?php echo $invoice_id; ?>" />
        <input type="hidden" name="x_friend" value="<?php echo $x_friend; ?>" />
        
        <h1>Payment Form</h1>
        
        <div class="field" style="float:left;">
            <h2>Donation Details</h2>
            <p>Donate Amount: <span class="currency"><?php echo $amount; ?></span></p>
            
            <?php if($x_friend): ?>
            <p>Donation under a friend: <?php echo $x_friend; ?></p>
            <?php endif; ?>
            
            <a href="/donate/">Change Donation Details</a>
        </div>
        
        <div class="field" style="float:left">
            <table cols="4" style="width:100%;">
        
                <tr>
                    <td colspan="4">
                        <label for="CCNum">Credit Card #</label>
                        <input id="CCNum" name="x_card_num" type="text" value="6011000000000012" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="ExpDate">Expiration (Example: 04/15)</label>
                        <input id="ExpDate" name="x_exp_date" type="text" value="04/15" placeholder="MM/YY"/>
                    </td>
                    <td colspan="2">
                        <label for="CardCode">Security Code</label>
                        <input id="CardCode" name="x_card_code" type="text" value="782" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="FirstName">First Name</label>
                        <input id="FirstName" name="x_first_name" type="text" value="John" />
                    </td>
                    <td colspan="2">
                        <label for="LastName">Last Name</label>
                        <input id="LastName" name="x_last_name" type="text" value="Doe" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <label for="Email">Email</label>
                        <input id="Email" name="x_email" type="text" value="vincentmdee@gmail.com" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <label for="BillingAddress">Billing Address</label>
                        <input id="BillingAddress" name="x_address" type="text" value="123 Four Street" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="BillingCity">City</label>
                        <input id="BillingCity" name="x_city" type="text" value="San Francisco" />
                    </td>
                    <td>
                        <label for="BillingState">State</label>
                        <input id="BillingState" name="x_state" type="text" value="CA" />
                    </td>
                    <td>
                        <label for="BillingZipCode">Zip Code</label>
                        <input id="BillingZipCode" name="x_zip" type="text" value="94133" />
                        <input type="hidden" name="x_country" value="US" />
                    </td>
                </tr>
            </table>
            
            <input id="DonateFormSubmitBtn" type="submit" value="PROCESS PAYMENT"/>
            <h1 style="margin-top:20px;">THANK YOU</h1>
        </div>
        
        
    </form>

    
    <?php endif; ?>

</div>

<script>
    jQuery('span.currency').each(function(){
        jQuery(this).currency();
    });
    jQuery('form#DonateForm').submit(function(){
        jQuery('input#DonateFormSubmitBtn').attr('disabled', 'disabled');
        jQuery('input#DonateFormSubmitBtn').val('Processing. Please Wait...');
    });
</script>

<?php get_footer(); ?>