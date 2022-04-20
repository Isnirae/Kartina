<?php
require __DIR__ . '/partials/header.php';
$title = 'Paiment validé !';

require_once('./stripe/init.php'); // Ne pas oublier cte ligne +modifier lien vers la bonne librairie

\Stripe\Stripe::setApiKey("sk_test_51IdclQCkQm4xBprF5QqafnLNvqXXmO2CZMvvXPi4Ftr4CzrWHNirWuZ1k5FzRCg5H3Tz2NhSe2VT0OqGASYm6NS000QOYMnx87");

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $total = $_SESSION['total'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token,
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $total,
      'currency' => 'eur',
      'description' => 'Kartina By George Lucas',
      'receipt_email' => $email  
  ));

  echo '<h1 class="text-orange">Payment accepted!</h1>';
  unset($_SESSION['panier']);
?>

<?php require __DIR__ . '/partials/footer.php';
