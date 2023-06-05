fetch("./mailer/send_welcome_email.php")
  .then(() => console.log('email sent'))
  .catch((err) => console.error(err));