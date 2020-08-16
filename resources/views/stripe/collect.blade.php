<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Sample Direct charge</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description" content="Accept a payment with direct charges" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      
    <link rel="stylesheet" href="{{url('stripe/css/normalize.css')}}" />
    <link rel="stylesheet" href="{{url('stripe/css/global.css')}}" />
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{url('stripe/script.js')}}" defer></script>
  </head>

  <body>
    <div class="sr-root">
      <div class="sr-main">
        <h1>Accept a payment with direct charges</h1>
        <div class="spinner"></div>
        <!-- Section to display when no connected accounts have been created -->
        <div id="no-accounts-section" class="hidden">
          <div>You need to <a href="https://stripe.com/docs/connect/enable-payment-acceptance-guide#create-account">create an account</a> before you can process a payment.</div>
        </div>
        <!-- Section to display when no connected accounts have been created -->
        <div id="no-card-payments-section" class="hidden">
          <div>None of your recently created accounts have the <a href="https://stripe.com/docs/connect/capabilities-overview#card-payments"><code>card_payments</code> capability</a>. Either request <code>card_payments</code> on an account or consider using <a href="https://github.com/stripe-samples/connect-destination-charge">destination charges</a> instead.</div>
        </div>
        <!-- Section to display when connected accounts have been created, but none have charges enabled -->
        <div id="disabled-accounts-section" class="hidden">
          <div>None of your recently created accounts have charges enabled. <span class="express hidden">Log in to an Express account's dashboard to complete the onboarding process.</span><span class="custom hidden">Manage your Custom accounts and complete the onboarding process <a href="https://dashboard.stripe.com/test/connect/accounts/overview">in the dashboard.</a></span><span class="standard hidden">View your Standard accounts <a href="https://dashboard.stripe.com/test/connect/accounts/overview">in your platform's dashboard</a>, and use their credentials to log in to Stripe and complete the onboarding process.</span></div>
          <form id="disabled-accounts-form" class="hidden">
            <div class="sr-form-row">
              <label for="disabled-accounts-select">Disabled account</label>
              <!-- Options are added to this select in JS -->
              <select id="disabled-accounts-select" class="sr-select"></select>
            </div>
            <div class="sr-form-row">
              <button type="submit" class='full-width'>View Express dashboard</button>
            </div>
          </form>
        </div>
        <!-- Section to display when at least one connected account has charges enabled -->
        <div id="enabled-accounts-section" class="hidden">
          <form id="payment-form" class="sr-payment-form">
            <div class="sr-form-row">
              <label for="card-element">Enter your card details</label>
              <div class="sr-input sr-card-element" id="card-element"></div>
            </div>
            <div class="sr-form-row">
              <label for="enabled-accounts-select">Pay to</label>
              <select id="enabled-accounts-select" class="sr-select"></select>
            </div>
            <div class="sr-form-row">
              <div class="sr-field-error" id="card-errors" role="alert"></div>
              <button id="submit">
                <div class="spinner hidden" id="spinner"></div>
                <span id="button-text">Pay</span><span id="order-amount"></span>
              </button>
            </div>
          </form>
          <div class="sr-result hidden">
            <p>Payment completed<br /></p>
            <pre>
              <code></code>
            </pre>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>