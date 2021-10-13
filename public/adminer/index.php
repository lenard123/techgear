<?php
function adminer_object() {
    // required to run any plugin
    require_once "./plugins/plugin.php";
    require_once "./plugins/login-password-less.php";
    
    // enable extra drivers just by including them
    //~ include "./plugins/drivers/simpledb.php";
    
    $plugins = array(
        new AdminerLoginPasswordLess(password_hash("password", PASSWORD_DEFAULT))
    );
    
    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
    */
    
    return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer.php";
