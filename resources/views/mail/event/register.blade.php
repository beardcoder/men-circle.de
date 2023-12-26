<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <title>Willkommen im Männerkreis</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      background-color: #f4f4f4;
      line-height: 1.6;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      color: #444;
      background-color: #B76F2B;
      padding: 10px 0;
      text-align: center;
    }

    .content {
      margin-top: 20px;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 0.8em;
      color: #666;
    }

    .button {
      display: inline-block;
      background-color: #B76F2B;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Willkommen im Männerkreis!</h1>
    </div>
    <div class="content">
      <p>Hallo {{ $name }},</p>
      <p>herzlich willkommen im Männerkreis! Wir freuen uns, dich in unserer Gemeinschaft begrüßen zu dürfen.</p>
      <p>Hier findest du Gleichgesinnte, mit denen du dich über Themen wie Persönlichkeitsentwicklung, Yoga, Meditation
        und vieles mehr austauschen kannst.</p>
      <p>Deine Registrierung ist erfolgreich abgeschlossen. Du kannst nun alle Funktionen unserer Plattform nutzen.</p>

      <p>Wenn du Fragen hast oder Unterstützung benötigst, zögere nicht, uns zu kontaktieren.</p>

      <a
        class="button"
        href="{{ $loginUrl }}"
      >Zum Login</a>

      <p>Viele Grüße,<br>Dein Team vom Männerkreis</p>
    </div>
    <div class="footer">
      <p>Diese E-Mail wurde automatisch erstellt. Bitte antworte nicht darauf.</p>
    </div>
  </div>
</body>

</html>
