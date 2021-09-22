<?php

import("components/AlertComponent");

class AlertMessage {

    public static function success($message)
    {
        $_SESSION["alert_status"] = AlertComponent::STATUS_SUCCESS;
        $_SESSION["alert_message"] = $message;
    }

    public static function failed($message)
    {
        $_SESSION["alert_status"] = AlertComponent::STATUS_FAILED;
        $_SESSION["alert_message"] = $message;
    }

    public static function render() {
        if (!isset($_SESSION['alert_message']) || !isset($_SESSION['alert_status'])) {
            return;
        }
        $status = $_SESSION["alert_status"];
        $message = $_SESSION['alert_message'];

        unset($_SESSION['alert_message']);
        unset($_SESSION["alert_status"]);
        
        $alert = new AlertComponent($status, $message);
        $alert->render();
    }

}
