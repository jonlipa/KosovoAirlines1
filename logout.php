<?php
session_start();

class LogoutHandler {
    public function __construct() {
        $this->logoutUser();
    }

    private function logoutUser() {
        // Vendos një flag për ta njohur që përdoruesi është logout
        $_SESSION['just_logged_out'] = true;

        // Fshin të gjitha variablat e sesionit
        session_unset();
        session_destroy();

        // Parandalon që faqja të ruhet në cache
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        
        // Krijon një mekanizëm për të bllokuar butonin "Back"
        echo "<script>
            sessionStorage.clear(); // Pastron çdo të dhënë të ruajtur në sesion
            localStorage.clear(); // Pastron local storage për më shumë siguri
            window.location.href = 'login.php';
        </script>";
        exit();
    }
}

// Ekzekuton logout-in
new LogoutHandler();
?>