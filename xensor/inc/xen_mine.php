<?php
if ($_POST['oscimp_hidden'] == 'Y') {
  // Require API
  include(plugin_dir_path(__FILE__) . 'include/mojang-api.class.php');
  $user = ($_POST['user']) ? $_POST['user'] : 'alex';
  ?>
  <div class="updated">
    <p>
      <strong>
        <?php
        $uuid = MojangAPI::getUuid($user);
        if (!empty($uuid)) {
          echo ('UUID: <b>' . $uuid . '</b><br>');

          // Get his name history
          $history = MojangAPI::getNameHistory($uuid);
          echo ('First username: <b>' . reset($history)['name'] . '</b><br>');

          // Print player's head
          $img     = '<img src="' . MojangAPI::embedImage(MojangAPI::getPlayerHead($uuid)) . '" alt="Head of MTC">';
          echo ('Skin:<br>' . $img . '<br>');
        }
        else {
          echo ("User is not valid");
        }
        ?>
      </strong>
    </p>
  </div>
  <?php
}
else {

  ?>

  <?php
}
?>
<div class="wrap">

  <?php    echo "<h2>" . __( 'Minecraft Username Verify', 'oscimp_trdom' ) . "</h2>"; ?>

  <form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="oscimp_hidden" value="Y">
    <?php    echo "<h4>" . __( 'Minecraft Username', 'oscimp_trdom' ) . "</h4>"; ?>
    <p>
      <?php _e("Minecraft Username: " ); ?><input type="text" name="user" size="20"><?php _e(" ex: 25878" ); ?>
    </p>


    <p class="submit">
      <input type="submit" name="Submit" class="button-primary" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
    </p>
  </form>
</div>
