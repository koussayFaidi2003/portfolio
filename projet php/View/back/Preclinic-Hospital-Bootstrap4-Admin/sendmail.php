<?php include 'bars.php'; ?>
<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Send an Email!!</title>
  <style>
        body {
            background: url('assets/images/home/sky2.jpg') center center fixed;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .wrapper {
        border: 2px solid transparent;
        background: transparent;
        backdrop-filter: blur(20px); 
        padding: 40px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        width: 450px;
        height: 380px;
        position: bottom;
        border-radius:10px;
        transform: translate(110%, 30%);
        text-align: center; 
        box-shadow: 0 0 50px rgba(255, 255, 255, 0.2);
        }
        .form-box {
            border: 2px solid #b7b5b5;
            font-family: "Verdana", sans-serif;
            color:rgba(91, 89, 89, 0.5);
            padding: 25px;
            width: 400px;
            height:50px;
            border-radius: 3px;
        }
    </style>
</head>
 
<body>
  <div class="wrapper">
    <form id="contact" action="mailoff.php" method="post">
      <h1>Contact Form</h1>
 
      <div class=form-box>
        <input placeholder="Your name" name="name" type="text" tabindex="1" autofocus>
      </div>
      <div class=form-box>
        <input placeholder="Your Email Address" name="email" type="email" tabindex="2">
        </div>
      <div class=form-box>
        <input placeholder="Type your subject line" type="text" name="subject" tabindex="4">
        </div>
      <div class=form-box>
        <textarea name="message" placeholder="Type your Message Details Here..." tabindex="5"></textarea>
        </div>
 
      <div class=form-box>
        <button type="submit" name="send" id="contact-submit">Submit Now</button>
      </div>
    </form>
  </div>
</body>
 
</html>