<?php
// setup.php - Place this file in your project root

// Prevent timeout
set_time_limit(0);

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

class LaravelSetup
{
    private $output = [];
    private $errors = [];
    private $composerHome;

    public function __construct()
    {
        // Display PHP version info
        echo "Current PHP Version: " . PHP_VERSION . "<br>";
        if (version_compare(PHP_VERSION, '8.2.0', '>=')) {
            echo "✅ PHP version is compatible<br><br>";
        } else {
            die("❌ PHP version " . PHP_VERSION . " is not compatible. PHP >= 8.2.0 required for Laravel 11<br>");
        }

        // Set up composer environment
        $this->composerHome = __DIR__ . '/tmp-composer';
        if (!is_dir($this->composerHome)) {
            mkdir($this->composerHome, 0755, true);
        }
        putenv("COMPOSER_HOME=" . $this->composerHome);
        putenv("HOME=" . $this->composerHome);
    }

    private function executeCommand($command)
    {
        $output = null;
        $returnValue = null;
        $this->log("Executing: $command");
        exec($command . " 2>&1", $output, $returnValue);
        
        if ($returnValue !== 0) {
            $errorMsg = "Error executing: $command\n" . implode("\n", $output);
            $this->errors[] = $errorMsg;
            $this->displayResults();
            die("❌ Setup failed. Please check the errors above.");
        }
        return $output;
    }

    public function run()
    {
        try {
            // 1. Download composer if not present
            if (!file_exists('composer.phar')) {
                $this->log("Downloading Composer...");
                $composer = file_get_contents('https://getcomposer.org/composer.phar');
                if ($composer === false) {
                    throw new Exception("Failed to download composer");
                }
                file_put_contents('composer.phar', $composer);
                chmod('composer.phar', 0755);
                $this->log("Composer downloaded successfully");
            }

            // 2. Install dependencies including faker for seeding
            $this->log("Installing Composer dependencies...");
            $this->executeCommand('php -d memory_limit=-1 composer.phar install --optimize-autoloader --no-dev');
            
            // Add faker separately
            $this->log("Installing Faker for database seeding...");
            $this->executeCommand('php -d memory_limit=-1 composer.phar require --optimize-autoloader fakerphp/faker');

            // 3. Create .env if it doesn't exist
            if (!file_exists('.env')) {
                $this->log("Creating .env file...");
                if (!copy('.env.example', '.env')) {
                    throw new Exception("Failed to create .env file");
                }
            }

            // 4. Generate application key
            $this->log("Generating application key...");
            $this->executeCommand('php artisan key:generate --force');

            // 5. Create storage link
            $this->log("Creating storage link...");
            $this->executeCommand('php artisan storage:link');

            // 6. Run fresh migrations with seeding
            $this->log("Running fresh migrations with seeding...");
            $this->executeCommand('php artisan migrate:fresh --seed --force');

            // 7. Clear and optimize
            $this->log("Optimizing Laravel...");
            $this->executeCommand('php artisan optimize:clear');
            $this->executeCommand('php artisan optimize');

            // Cleanup
            if (is_dir($this->composerHome)) {
                $this->rrmdir($this->composerHome);
            }

            // Success!
            $this->log("✅ Setup completed successfully!");
            
            // Try to remove this setup file
            @unlink(__FILE__);

        } catch (Exception $e) {
            $this->errors[] = "Error: " . $e->getMessage();
            $this->displayResults();
            die("❌ Setup failed. Please check the errors above.");
        }

        $this->displayResults();
    }

    private function log($message)
    {
        $this->output[] = $message;
        echo $message . "<br>";
        flush();
        ob_flush();
    }

    private function rrmdir($dir) {
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

    private function displayResults()
    {
        echo "<style>
            body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
            .success { color: green; }
            .error { color: red; }
            .output { margin: 10px 0; padding: 15px; background: #f5f5f5; border-radius: 5px; }
            .next-steps { margin-top: 20px; }
            .next-steps li { margin-bottom: 10px; }
        </style>";

        if (empty($this->errors)) {
            echo "<h2 class='success'>✅ Setup Completed Successfully!</h2>";
        } else {
            echo "<h2 class='error'>⚠️ Setup Failed</h2>";
            echo "<div class='output'><strong>Errors:</strong><br>";
            echo implode("<br>", $this->errors);
            echo "</div>";
        }

        echo "<div class='output'><strong>Setup Log:</strong><br>";
        echo implode("<br>", $this->output);
        echo "</div>";

        if (!empty($this->errors)) {
            echo "<div class='next-steps'>";
            echo "<p><strong>Next steps:</strong></p>";
            echo "<ol>";
            echo "<li>Review the errors above and try to resolve them</li>";
            echo "<li>Make sure you have proper permissions in your hosting environment</li>";
            echo "<li>Try running the problematic commands manually if possible</li>";
            echo "</ol>";
            echo "</div>";
        }
    }
}

// Run the setup
$setup = new LaravelSetup();
$setup->run();