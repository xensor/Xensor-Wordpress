<div class="wrap">

  <?php    echo "<h2>" . __( 'Minecraft Username Verify', 'oscimp_trdom' ) . "</h2>"; ?>

  <form id="form"  >

    <div class="form-row row">
      <span class="small-12 large-12 columns">
        <label>
          Minecraft Username :
        </label>
        <input id="user" name='user' type="text">

      </span>

      <span class="small-12 large-12 columns">
        <input type="button" id="submit" class="button-primary" value="submit">
         
      </span>
      <input type="hidden" name="action" value="<?php  $ajax_nonce = wp_create_nonce( 'my-special-string' ); echo $ajax_nonce; ?>"/>
    </div>
  </form>


  <div id="feedback"></div>

</div>

