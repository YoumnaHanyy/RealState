
<?php


require_once __DIR__ . '/../Config/db.php';
require_once __DIR__ . '/../Model/Property.php';

class HomeController {
    public function Dashboard() {
        include_once __DIR__ . '/../View/AdminDashboard.php';
    }
}
    ?>