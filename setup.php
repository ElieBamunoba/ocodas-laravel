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
    private $skipNodeCheck = false;
    private $phpBinary;

    public function __construct()
    {
        // Get PHP binary path
        $this->phpBinary = PHP_BINARY;
        // Get command line arguments if running from CLI
        if (php_sapi_name() === 'cli') {
            global $argv;
            $this->skipNodeCheck = in_array('--skip-node', $argv);
        } else {
            // For web, check query parameter
            $this->skipNodeCheck = isset($_GET['skip-node']);
        }

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

        // Check Node.js and npm if not skipped
        if (!$this->skipNodeCheck) {
            $this->checkNodeNpmVersion();
        } else {
            $this->log("⚠️ Node.js check skipped. Some features may not work properly.");
        }

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
        // Try to download portable Node.js if not present
        if (!file_exists('node_modules/.node/bin/node')) {
            $this->log("Node.js not found. Downloading portable Node.js...");
            if (!$this->downloadPortableNode()) {
                $this->errors[] = "Node.js installation failed. Please run with --skip-node option";
                $this->displayContent();
                die();
            }
        }

        // Check Node.js version using the installed version
        $binPath = realpath('node_modules/.node/bin');
        if ($binPath) {
            $nodeCmd = $binPath . '/node';
            if (file_exists($nodeCmd)) {
                // Set necessary environment variables
                putenv("PATH=" . $binPath . PATH_SEPARATOR . getenv("PATH"));
                putenv("NODE_PATH=" . realpath('node_modules/.node/lib/node_modules'));

                $output = [];
                $returnVar = 0;
                exec($nodeCmd . ' --version 2>&1', $output, $returnVar);
                
                if ($returnVar === 0) {
                    $this->log("Node.js Version: " . trim($output[0]));
                    return;
                } else {
                    $this->log("Debug: Node.js check failed with output: " . implode("\n", $output));
                }
            }
        }

        // If we get here, something went wrong
        $this->errors[] = "Node.js verification failed. Please run with --skip-node option";
        $this->displayContent();
        die();
    }

    private function getSystemGlibcVersion() {
        $output = [];
        exec('ldd --version 2>&1', $output, $returnVar);
        $version = '2.17'; // Default to a very old version if we can't detect

        foreach ($output as $line) {
            if (preg_match('/GLIBC\s+(\d+\.\d+)/', $line, $matches)) {
                $version = $matches[1];
                break;
            }
        }
        return $version;
    }

    private function getCompatibleNodeVersion() {
        $glibcVersion = $this->getSystemGlibcVersion();
        $this->log("Debug: System GLIBC version: " . $glibcVersion);

        // Node.js version compatibility matrix
        if (version_compare($glibcVersion, '2.28', '>=')) {
            return '20.11.1'; // Latest LTS for newer systems
        } elseif (version_compare($glibcVersion, '2.24', '>=')) {
            return '16.20.2'; // LTS with broader compatibility
        } else {
            return '14.21.3'; // Very compatible version for older systems
        }
    }

    private function downloadPortableNode()
    {
        try {
            $platform = PHP_OS === 'WINNT' ? 'win' : (PHP_OS === 'Darwin' ? 'darwin' : 'linux');
            $arch = PHP_INT_SIZE === 8 ? 'x64' : 'x86';
            
            $nodeVersion = $this->getCompatibleNodeVersion();
            $this->log("Debug: Selected Node.js version: " . $nodeVersion);
            
            // Define download URLs for different platforms
            $nodeUrls = [
                'win' => "https://nodejs.org/dist/v{$nodeVersion}/node-v{$nodeVersion}-win-x64.zip",
                'linux' => "https://nodejs.org/dist/v{$nodeVersion}/node-v{$nodeVersion}-linux-x64.tar.gz",
                'darwin' => "https://nodejs.org/dist/v{$nodeVersion}/node-v{$nodeVersion}-darwin-x64.tar.gz"
            ];

            if (!isset($nodeUrls[$platform])) {
                throw new Exception("Unsupported platform for portable Node.js");
            }

            $url = $nodeUrls[$platform];
            $this->log("Downloading Node.js from: " . $url);

            // Create node_modules directory with debug info
            if (!is_dir('node_modules')) {
                $this->log("Debug: Creating node_modules directory");
                if (!mkdir('node_modules', 0755, true)) {
                    throw new Exception("Failed to create node_modules directory. Error: " . error_get_last()['message']);
                }
            }

            $nodeDir = 'node_modules/.node';
            if (!is_dir($nodeDir)) {
                $this->log("Debug: Creating $nodeDir directory");
                if (!mkdir($nodeDir, 0755, true)) {
                    throw new Exception("Failed to create $nodeDir directory. Error: " . error_get_last()['message']);
                }
            }

            // Download with status check
            if (function_exists('curl_init')) {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                $nodeArchive = curl_exec($ch);

                if (curl_errno($ch)) {
                    throw new Exception("Failed to download Node.js: " . curl_error($ch));
                }
                curl_close($ch);
            } else {
                throw new Exception("cURL is required for downloading Node.js");
            }

            $archiveFile = $nodeDir . '/node.' . ($platform === 'win' ? 'zip' : 'tar.gz');
            $this->log("Debug: Saving archive to: " . $archiveFile);
            
            if (file_put_contents($archiveFile, $nodeArchive) === false) {
                throw new Exception("Failed to save Node.js archive. Error: " . error_get_last()['message']);
            }

            $this->log("Debug: Archive size: " . filesize($archiveFile) . " bytes");

            if ($platform === 'win') {
                // Windows extraction code...
            } else {
                $this->log("Extracting Node.js...");
                $extractDir = $nodeDir . '/temp';
                if (!is_dir($extractDir)) {
                    mkdir($extractDir, 0755, true);
                }

                // Extract with detailed output
                $cmd = "cd " . escapeshellarg($nodeDir) . " && tar xzvf " . escapeshellarg(basename($archiveFile)) . " -C " . escapeshellarg('temp');
                $this->log("Debug: Running extract command: " . $cmd);
                
                $output = [];
                $returnVar = 0;
                exec($cmd . " 2>&1", $output, $returnVar);
                
                if ($returnVar !== 0) {
                    throw new Exception("Failed to extract Node.js archive:\nCommand: $cmd\nOutput: " . implode("\n", $output));
                }

                $this->log("Debug: Extraction complete. Looking for Node.js directory...");
                $extractedDirs = glob($extractDir . '/node-v*');
                if (empty($extractedDirs)) {
                    throw new Exception("Could not find extracted Node.js directory in: " . $extractDir);
                }
                
                $nodePath = $extractedDirs[0];
                $this->log("Debug: Found Node.js directory: " . $nodePath);

                // Create directory structure
                $binDir = $nodeDir . '/bin';
                $libDir = $nodeDir . '/lib';
                
                $this->log("Debug: Creating bin and lib directories");
                if (!is_dir($binDir)) mkdir($binDir, 0755, true);
                if (!is_dir($libDir)) mkdir($libDir, 0755, true);

                // Copy files with verification
                $this->log("Debug: Copying node executable");
                if (!copy($nodePath . '/bin/node', $binDir . '/node')) {
                    throw new Exception("Failed to copy node executable. Error: " . error_get_last()['message']);
                }
                chmod($binDir . '/node', 0755);

                $this->log("Debug: Copying npm modules");
                $this->rcopy($nodePath . '/lib/node_modules', $libDir . '/node_modules');

                // Create npm script with environment info
                $npmScript = "#!/bin/sh\n";
                $npmScript .= "export NODE_PATH=\"" . realpath($libDir . '/node_modules') . "\"\n";
                $npmScript .= "\"" . realpath($binDir . '/node') . "\" \"" . realpath($libDir . '/node_modules/npm/bin/npm-cli.js') . "\" \"$@\"";
                
                $this->log("Debug: Creating npm script");
                if (file_put_contents($binDir . '/npm', $npmScript) === false) {
                    throw new Exception("Failed to create npm script. Error: " . error_get_last()['message']);
                }
                chmod($binDir . '/npm', 0755);

                // Verify file existence
                $this->log("Debug: Verifying installed files:");
                $this->log("Node executable exists: " . (file_exists($binDir . '/node') ? 'Yes' : 'No'));
                $this->log("Npm script exists: " . (file_exists($binDir . '/npm') ? 'Yes' : 'No'));
                $this->log("Node modules exist: " . (is_dir($libDir . '/node_modules') ? 'Yes' : 'No'));

                // Clean up
                $this->log("Debug: Cleaning up temporary files");
                $this->rrmdir($extractDir);
                unlink($archiveFile);

                // Verify installation
                $this->log("Debug: Verifying Node.js installation");
                $output = [];
                $cmd = $binDir . '/node --version';
                exec($cmd . " 2>&1", $output, $returnVar);
                
                if ($returnVar !== 0) {
                    throw new Exception("Node.js verification failed.\nCommand: $cmd\nReturn code: $returnVar\nOutput: " . implode("\n", $output));
                }

                $this->log("Node.js Version: " . trim($output[0]));
                return true;
            }

        } catch (Exception $e) {
            $this->log("⚠️ Failed to download portable Node.js: " . $e->getMessage());
            return false;
        }
    }

    // Add rcopy function for recursive directory copying
    private function rcopy($src, $dst)
    {
        if (is_dir($src)) {
            if (!is_dir($dst)) {
                mkdir($dst, 0755, true);
            }
            $files = scandir($src);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $this->rcopy("$src/$file", "$dst/$file");
                }
            }
        } else if (file_exists($src)) {
            copy($src, $dst);
        }
    }

    private function isLinux()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'LIN';
    }

    private function isNodeInstalled()
    {
        exec('which node 2>&1', $output, $returnValue);
        return $returnValue === 0;
    }

    private function installNodeJs()
    {
        if ($this->isLinux()) {
            // Add NodeSource repository and install Node.js 20.x
            $commands = [
                'curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -',
                'sudo apt-get install -y nodejs'
            ];

            foreach ($commands as $command) {
                exec($command . " 2>&1", $output, $returnValue);
                if ($returnValue !== 0) {
                    $this->log("⚠️ Automatic Node.js installation failed. Please install manually or use --skip-node option.");
                    return false;
                }
            }
            return true;
        }
        return false;
    }

     private function executeCommand($command)
    {
        // Replace 'php' with actual PHP binary path in commands
        $command = preg_replace('/^php\s/', $this->phpBinary . ' ', $command);
        
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
                $this->log($outputText);
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

            // 2. Install Composer dependencies using absolute PHP path
            $this->log("Installing Composer dependencies...");
            $this->executeCommand($this->phpBinary . ' -d memory_limit=-1 composer.phar install --optimize-autoloader --no-dev');

            // 3. Add faker separately
            $this->log("Installing Faker for database seeding...");
            $this->executeCommand($this->phpBinary . ' -d memory_limit=-1 composer.phar require --optimize-autoloader fakerphp/faker');


            // 4. Create .env if it doesn't exist
            if (!file_exists('.env')) {
                $this->log("Creating .env file...");
                if (!copy('.env.example', '.env')) {
                    throw new Exception("Failed to create .env file");
                }
            }

            // 5. NPM installation and build (conditional)
            if (!$this->skipNodeCheck) {
                $nodeDir = realpath('node_modules/.node');
                $binDir = $nodeDir . '/bin';
                
                // Ensure PHP is in the path for npm scripts
                $currentPath = getenv("PATH");
                $phpDir = dirname(PHP_BINARY);
                $newPath = $phpDir . PATH_SEPARATOR . $binDir . PATH_SEPARATOR . $currentPath;
                
                putenv("PATH=" . $newPath);
                putenv("NODE_PATH=" . realpath($nodeDir . '/lib/node_modules'));

                $this->log("Installing npm dependencies using portable Node.js...");
                $this->executeCommand($binDir . '/npm install --legacy-peer-deps');

                $this->log("Building frontend assets...");
                $this->executeCommand($binDir . '/npm run build');
            } else {
                $this->log("⚠️ Skipping npm install and build steps...");
            }

            // 6. Generate application key
            $this->log("Generating application key...");
           $this->executeCommand($this->phpBinary . ' artisan key:generate --force');

            // 7. Create storage link
            $this->log("Creating storage link...");
            $this->executeCommand($this->phpBinary . ' artisan storage:link');

            // 8. Run fresh migrations with seeding
            $this->log("Running fresh migrations with seeding...");
            $this->executeCommand($this->phpBinary . ' artisan migrate:fresh --seed --force');

            // 9. Clear and optimize
            $this->log("Optimizing Laravel...");
            $this->executeCommand($this->phpBinary . ' artisan optimize:clear');
            $this->executeCommand($this->phpBinary . ' artisan optimize');

            // Cleanup
            if (is_dir($this->composerHome)) {
                $this->rrmdir($this->composerHome);
            }

            // Success!
            $this->isCompleted = true;
            $this->log("✅ Setup completed successfully!");
            if ($this->skipNodeCheck) {
                $this->log("⚠️ Note: Node.js steps were skipped. You may need to run 'npm install' and 'npm run build' manually.");
            }

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
