<!DOCTYPE html>
<html style="background-color: #cccccc; margin: 0; padding: 0; height: 100%;">

<head>
  <meta charset="utf-8">
  <title>Email</title>
</head>

<body style="background-color: #cccccc; margin: 0; padding: 0; height: 100%;">
  <div style="padding: 40px">
    <div
      style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 6px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);"
    >
      <h2 style="color: #333333; margin-bottom: 20px; font-weight: 600;">Hallo,</h2>

      <p style="color: #777777; margin-top: 0;">Vielen dank für deine Anmeldung bitte bestätige deine E-Mail Adresse:
      </p>
      <a
        href="{{ route('subscription.optin', ['token' => $token]) }}"
        style="color: #777777; margin-top: 0;"
      >{{ route('subscription.optin', ['token' => $token]) }}</p>
    </div>
  </div>
</body>

</html>
