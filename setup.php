<?php
// setup.php - Place this file in your project root

// Prevent timeout
set_time_limit(0);

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

class LaravelSetup
{
    private $currentMessage = '';
    private $errors = [];
    private $composerHome;
    private $isCompleted = false;

    public function __construct()
    {
        // Clear any existing output buffers
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        // Display initial page structure
        $this->displayHeader();

        // Display PHP version info
        $this->log("Current PHP Version: " . PHP_VERSION);
        if (version_compare(PHP_VERSION, '8.2.0', '>=')) {
            $this->log("✅ PHP version is compatible");
        } else {
            $this->errors[] = "PHP version " . PHP_VERSION . " is not compatible. PHP >= 8.2.0 required for Laravel 11";
            $this->displayContent();
            die();
        }

        // Check Node.js and npm
        $this->checkNodeNpmVersion();

        // Set up composer environment
        $this->composerHome = __DIR__ . '/tmp-composer';
        if (!is_dir($this->composerHome)) {
            mkdir($this->composerHome, 0755, true);
        }
        putenv("COMPOSER_HOME=" . $this->composerHome);
        putenv("HOME=" . $this->composerHome);
    }

    private function checkNodeNpmVersion()
    {
        // Check Node.js version
        exec('node --version 2>&1', $nodeOutput, $nodeReturn);
        if ($nodeReturn !== 0) {
            $this->errors[] = "Node.js is not installed. Please install Node.js (recommended version 20.x)";
            $this->displayContent();
            die();
        }

        // Check npm version
        exec('npm --version 2>&1', $npmOutput, $npmReturn);
        if ($npmReturn !== 0) {
            $this->errors[] = "npm is not installed. Please install npm";
            $this->displayContent();
            die();
        }

        $this->log("Node.js Version: " . trim($nodeOutput[0]));
        $this->log("npm Version: " . trim($npmOutput[0]));
    }

    private function executeCommand($command)
    {
        $output = null;
        $returnValue = null;
        $this->log("Executing: " . $command);
        exec($command . " 2>&1", $output, $returnValue);

        // Only log non-empty output
        if (!empty($output)) {
            $outputText = implode("\n", $output);
            if ($returnValue !== 0) {
                $this->errors[] = $outputText;
                $this->displayContent();
                exit(1);
            } else {
                // Don't show the command again in the output
                $this->log($outputText, true);
            }
        }
        return $output;
    }

    private function formatConsoleOutput($text)
    {
        // Directly replace with HTML spans to ensure rendering
        $replacements = [
            // ANSI color code removal
            '/\033\[([\d;]+)m/' => '',

            // Status indicators with color
            '/\b(INFO)\b/' => '<span style="color: #0066cc">INFO</span>',
            '/\b(DONE)\b/' => '<span style="color: #28a745">DONE</span>',
            '/\b(RUNNING)\b/' => '<span style="color: #ffc107">RUNNING</span>',
            '/\b(ERROR)\b/' => '<span style="color: #dc3545; font-weight: 500">ERROR</span>',

            // Progress bars
            '/(\[[->=]+\])/' => '<span style="color: #6c757d">$1</span>',

            // Execution times
            '/(\d+\.\d+\s*ms)/' => '<span style="color: #6c757d">$1</span>',

            // SQL State errors
            '/SQLSTATE(.*)/' => '<span style="color: #dc3545; font-weight: 500">SQLSTATE$1</span>'
        ];

        // Apply all replacements
        foreach ($replacements as $pattern => $replacement) {
            $text = preg_replace($pattern, $replacement, $text);
        }

        return $text;
    }

    private function displayHeader()
    {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Laravel Setup</title>
            <style>
                body { 
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                    margin: 20px;
                    line-height: 1.6;
                    background: #f8f9fa;
                }
                .setup-container {
                    max-width: 1200px;
                    margin: 20px auto;
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    padding: 20px;
                }
                .success { color: #28a745; }
                .error { color: #dc3545; }
                .header {
                    font-size: 1.5rem;
                    font-weight: 600;
                    margin-bottom: 20px;
                    padding-bottom: 10px;
                    border-bottom: 2px solid #e9ecef;
                }
                .content {
                    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
                    font-size: 14px;
                    line-height: 1.6;
                    padding: 15px;
                    background: #f8f9fa;
                    border-radius: 6px;
                    margin-bottom: 20px;
                }
                .error-details {
                    background: #fff5f5;
                    border: 1px solid #dc3545;
                    padding: 15px;
                    margin: 15px 0;
                    white-space: pre-wrap;
                    overflow-x: auto;
                }
                .next-steps {
                    background: #e9ecef;
                    padding: 15px;
                    border-radius: 6px;
                    margin-top: 20px;
                }
                .next-steps li {
                    margin-bottom: 8px;
                }
            </style>
        </head>
        <body>
            <div class='setup-container'>
                <div class='header success'>⚙️ Setup in Progress...</div>
                <div id='content'>";
    }

    private function displayContent()
    {
        // Ensure we have a buffer
        if (ob_get_level() == 0) {
            ob_start();
        }

        // Only show the current message
        if (!empty($this->currentMessage)) {
            echo "<div class='content' style='white-space: pre-wrap; overflow-x: auto;'>";
            echo $this->formatConsoleOutput($this->currentMessage);
            echo "</div>";
        }

        // Error details if any
        if (!empty($this->errors)) {
            echo "<div class='error-details' style='white-space: pre-wrap; overflow-x: auto;'>";
            foreach ($this->errors as $error) {
                echo $this->formatConsoleOutput($error) . "\n";
            }
            echo "</div>";

            // Error handling
            if (ob_get_level() > 0) {
                ob_end_flush();
            }
            flush();
        }

        if (ob_get_level() > 0) {
            ob_end_flush();
        }
        flush();
    }

    private function log($message)
    {
        // Start output buffering if not already started
        if (ob_get_level() == 0) {
            ob_start();
        }

        $this->currentMessage = $message;
        $this->displayContent();
    }

    public function run()
    {
        try {
            // 1. Download composer if not present
            if (!file_exists('composer.phar')) {
                $this->log("Downloading Composer...");

                // Try using cURL first
                if (function_exists('curl_init')) {
                    $ch = curl_init('https://getcomposer.org/composer.phar');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                    $composer = curl_exec($ch);

                    if (curl_errno($ch)) {
                        throw new Exception("Failed to download composer: " . curl_error($ch));
                    }
                    curl_close($ch);

                    if ($composer === false) {
                        throw new Exception("Failed to download composer using cURL");
                    }
                } else {
                    // If cURL is not available, suggest manual download
                    throw new Exception(
                        "Neither allow_url_fopen nor cURL is available. Please download composer manually:\n" .
                            "1. Download from https://getcomposer.org/composer.phar\n" .
                            "2. Upload it to your server in the same directory as this script\n" .
                            "3. Run this setup script again"
                    );
                }

                if (file_put_contents('composer.phar', $composer) === false) {
                    throw new Exception("Failed to save composer.phar");
                }
                chmod('composer.phar', 0755);
                $this->log("Composer downloaded successfully");
            }

            // 2. Install Composer dependencies
            $this->log("Installing Composer dependencies...");
            $this->executeCommand('php -d memory_limit=-1 composer.phar install --optimize-autoloader --no-dev');

            // 3. Add faker separately
            $this->log("Installing Faker for database seeding...");
            $this->executeCommand('php -d memory_limit=-1 composer.phar require --optimize-autoloader fakerphp/faker');

            // 4. Create .env if it doesn't exist
            if (!file_exists('.env')) {
                $this->log("Creating .env file...");
                if (!copy('.env.example', '.env')) {
                    throw new Exception("Failed to create .env file");
                }
            }

            // 5. NPM installation and build
            $this->log("Installing npm dependencies...");
            $this->executeCommand('npm install');

            $this->log("Building frontend assets...");
            $this->executeCommand('npm run build');

            // 6. Generate application key
            $this->log("Generating application key...");
            $this->executeCommand('php artisan key:generate --force');

            // 7. Create storage link
            $this->log("Creating storage link...");
            $this->executeCommand('php artisan storage:link');

            // 8. Run fresh migrations with seeding
            $this->log("Running fresh migrations with seeding...");
            $this->executeCommand('php artisan migrate:fresh --seed --force');

            // 9. Clear and optimize
            $this->log("Optimizing Laravel...");
            $this->executeCommand('php artisan optimize:clear');
            $this->executeCommand('php artisan optimize');

            // Cleanup
            if (is_dir($this->composerHome)) {
                $this->rrmdir($this->composerHome);
            }

            // Success!
            $this->isCompleted = true;
            $this->log("✅ Setup completed successfully!");

            // Try to remove this setup file
            @unlink(__FILE__);
        } catch (Exception $e) {
            $this->errors[] = "Error: " . $e->getMessage();
            $this->displayContent();
            die("❌ Setup failed. Please check the errors above.");
        }

        echo "</div></body></html>";
    }

    private function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object))
                        $this->rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            rmdir($dir);
        }
    }
}

// Run the setup
$setup = new LaravelSetup();
$setup->run();
