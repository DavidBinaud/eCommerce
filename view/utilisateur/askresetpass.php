<form method="get" action="index.php">
  <fieldset>
    <legend>Mon formulaire de Reset Password:</legend>
    
    <p>
      <label for="login_id">Login</label> :
      <input type="text" value='<?php echo $login;?>' name="login" id="login_id" required>
    </p>
    <p>
      <input type='hidden' name='action' value='sendresetpass'>
      <input type='hidden' name='controller' value='utilisateur'>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset>
</form>