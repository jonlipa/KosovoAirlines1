<?php
class ErrorPage {
    private $title;
    private $stylesheet = "css/style.css";

    public function __construct($title) {
        $this->title = $title;
    }

    public function render() {
        $this->renderHeader();
        $this->renderContent();
        $this->renderStyles();
        $this->renderFooter();
    }

    private function renderHeader() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo "<title>{$this->title}</title>";
        echo "<link rel='stylesheet' href='{$this->stylesheet}'>";
        echo '</head>';
        echo '<body>';
    }

    private function renderContent() {
        echo '<div class="error-page">';
        echo '<h1>404</h1>';
        echo '<p>Oops! The page you’re looking for doesn’t exist.</p>';
        echo '<a href="index.php" class="btn">Go Back to Home</a>';
        echo '</div>';
    }

    private function renderStyles() {
        echo '<style>';
        echo '.error-page {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                text-align: center;
                background-color: #f9f9f9;
                font-family: Arial, sans-serif;
            }
            .error-page h1 {
                font-size: 8rem;
                color: #ff6b6b;
            }
            .error-page p {
                font-size: 1.5rem;
                color: #555;
                margin: 1rem 0;
            }
            .error-page .btn {
                text-decoration: none;
                background-color: #007bff;
                color: #fff;
                padding: 0.8rem 1.5rem;
                border-radius: 5px;
                transition: background-color 0.3s;
            }
            .error-page .btn:hover {
                background-color: #0056b3;
            }';
        echo '</style>';
    }

    private function renderFooter() {
        echo '</body>';
        echo '</html>';
    }
}

// Krijojmë objektin dhe shfaqim faqen
$page = new ErrorPage("404 - Page Not Found");
$page->render();
?>
