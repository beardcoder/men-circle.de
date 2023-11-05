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

      <p style="color: #777777; margin-top: 0;">Du hast eine neue Nachricht erhalten. Hier sind die Details:</p>

      <h5 style="margin-top: 30px; color: #555555; margin-bottom: 10px; font-weight: 500;">Name</h5>
      <p style="color: #777777; margin-top: 5px;">{{ $name }}</p>

      <h5 style="margin-top: 20px; color: #555555; margin-bottom: 10px; font-weight: 500;">Email</h5>
      <p style="color: #777777; margin-top: 5px;">{{ $email }}</p>
    </div>
  </div>
</body>

</html>
