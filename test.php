<?php
$file = __DIR__ . '/App/Controller/SignupStrategy/SignupStrategyInterface.php';

if (file_exists($file)) {
    echo "✅ File exists: $file";
} else {
    echo "❌ File NOT FOUND at: $file";
}
