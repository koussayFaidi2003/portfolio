<?php
include '../bars1.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <title>Document</title>

  <style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600);
 
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
 
    body {
        font-family: Arial, sans-serif;
        background-color: #e0e0e0;
        margin: 0;
        padding: 0;
    }
 
    .container {
      max-width: 400px;
      width: 100%;
      margin: 0 auto;
      position: relative;
    }
 
    #contact input {
    font: 400 12px/16px;
    width: 100%;
    border: 1px solid #CCC;
    background: #FFF;
    margin: 10px 5px;
    padding: 10px;
  }
 
    h1 {
      margin-bottom: 30px;
      font-size: 30px;
    }
 
    #contact {
      background: #F9F9F9;
      padding: 25px;
      margin: 50px 0;
    }
 
 
    fieldset {
      border: medium none !important;
      margin: 0 0 10px;
      min-width: 100%;
      padding: 0;
      width: 100%;
    }
 
    textarea {
      height: 100px;
      max-width: 100%;
      resize: none;
      width: 100%;
    }
 
    button {
      cursor: pointer;
      width: 100%;
      border: none;
      background: rgb(17, 146, 60);
      color: #FFF;
      margin: 0 0 5px;
      padding: 10px;
      font-size: 20px;
    }
 
    button:hover {
      background-color: rgb(15, 95, 42);
    }
  </style>
</head>
 
<body>

    
  <div class="container">
    <form id="contact" action="mail.php" method="post">
      <h1>Contact Form</h1>
 
      <fieldset>
        <input placeholder="Your Email Address" name="sender_email" type="email" tabindex="1" autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="Client's Email Address" name="receiver_email" type="email" tabindex="2">
      </fieldset>
      <fieldset>
        <input placeholder="Type your subject line" type="text" name="subject" tabindex="4">
      </fieldset>
      <fieldset>
        <textarea name="message" placeholder="Type your Message Details Here..." tabindex="5"></textarea>
      </fieldset>
 
      <fieldset>
        <button type="submit" name="send" id="contact-submit">Submit Now</button>
      </fieldset>
    </form>
  </div>
  
</body>
 
</html>