<?php
session_start();
class Database
{
    private $servername = "mysql:host=localhost;dbname=olanggodb";
    private $username = "root";
    private $password = "";
    private $defaultFetch = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $conn;
    public function conn()
    {
        try {
            $this->conn = new PDO($this->servername, $this->username, $this->password, $this->defaultFetch);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            exit;
        }
    }

    public function register()
    {
        if (isset($_POST['register'])) {
            $roles = $_POST['roles'];
            $registerName = filter_input(INPUT_POST, 'registerName', FILTER_SANITIZE_STRING);
            $registerEmail = filter_input(INPUT_POST, 'registerEmail', FILTER_SANITIZE_EMAIL);
            $registerPass = filter_input(INPUT_POST, 'registerPass', FILTER_SANITIZE_STRING);
            $registerPassHash = password_hash($registerPass, PASSWORD_BCRYPT);

            $query = $this->conn()->prepare("INSERT INTO users(username, email, password, roles) VALUES (:username, :email, :password, :roles)");
            $query->execute([
                'username' => $registerName,
                'email' => $registerEmail,
                'password' => $registerPassHash,
                'roles' => $roles,
            ]);
        }
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $loginEmail = filter_input(INPUT_POST, 'loginEmail', FILTER_SANITIZE_EMAIL);
            $loginPass = filter_input(INPUT_POST, 'loginPass', FILTER_SANITIZE_STRING);

            $query = $this->conn()->prepare("SELECT user_id, password, roles FROM users WHERE email = :email");
            $query->execute([
                'email' => $loginEmail,
            ]);
            $user = $query->fetch();
            if ($user) {
                if (password_verify($loginPass, $user['password'])) {
                    if ($user['roles'] == 'admin') {
                        $_SESSION['admin_id'] = $user['user_id'];
                        header("Location: admin/admin.php");

                    } elseif ($user['roles'] == 'staff') {
                        $_SESSION['staff_id'] = $user['user_id'];
                        header("Location: staff/home.php");

                    } else {
                        $_SESSION['user_email'] = $loginEmail;
                        $_SESSION['user_id'] = $user['user_id'];
                        header("Location: ../index.php");
                    }
                }
            }

        }
    }

    public function get_places()
    {
        $query = $this->conn()->prepare("SELECT * FROM places");
        $query->execute();
        $places = $query->fetchAll();
        return $places;
    }

    public function get_activities()
    {
        $query = $this->conn()->prepare("SELECT * FROM activities");
        $query->execute();
        $activities = $query->fetchAll();
        return $activities;
    }

    public function get_place_categories()
    {
        $query = $this->conn()->prepare("SELECT * FROM place_categories");
        $query->execute();
        $place_categories = $query->fetchAll();
        return $place_categories;
    }

    public function get_categories()
    {
        $query = $this->conn()->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->fetchAll();
        return $categories;
    }

    public function get_monthly_users()
    {
        $query = $this->conn()->prepare("
                SELECT 
                    MONTH(created_at) as month,
                    COUNT(*) as user_count
                FROM users
                WHERE YEAR(created_at) = YEAR(CURDATE())
                GROUP BY MONTH(created_at)
                ORDER BY month
            ");
        $query->execute();
        return $query->fetchAll();
    }

    public function insert_place()
    {
        if (isset($_POST['add_place'])) {
            $user_id = $_SESSION['staff_id'];
            $place_name = filter_input(INPUT_POST, 'place_name', FILTER_SANITIZE_STRING);
            $nearest_index = filter_input(INPUT_POST, 'nearest_index', FILTER_SANITIZE_NUMBER_INT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_STRING);
            $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
            $img = $_FILES['place_image']['name'];
            $img_tmp_name = $_FILES['place_image']['tmp_name'];
            $img_folder = '../assets/images/' . $img;

            $query = $this->conn()->prepare("INSERT INTO places(user_id, place_name, nearest_index, description, duration, location, place_img) VALUES(?,?,?,?,?,?,?)");
            $query->execute([$user_id, $place_name, $nearest_index, $description, $duration, $location, $img]);
            move_uploaded_file($img_tmp_name, $img_folder);
        }
    }

    public function add_place_category()
    {
        if (isset($_POST["add_place_category"])) {

            $place_id = filter_input(INPUT_POST, 'place_id', FILTER_SANITIZE_NUMBER_INT);
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);

            $check_query = $this->conn()->prepare("SELECT * FROM place_categories WHERE place_id = ? AND category_id = ?");
            $check_query->execute([$place_id, $category_id]);

            if ($check_query->rowCount() > 0) {
                header("Location: add-place-category.php");
            } else {
                $query = $this->conn()->prepare("INSERT INTO place_categories(place_id, category_id) VALUES(?,?)");
                $query->execute([$place_id, $category_id]);
            }
        }
    }

    public function get_itineraries(){
        $query = $this->conn()->prepare("SELECT * FROM itineraries");
        $query->execute();
        $itineraries = $query->fetchAll();
        return $itineraries;
    }

    public function add_itinerary()
    {
        if (isset($_POST['add_itinerary'])) {
            $user_id = $_SESSION['user_id'];
            $place_id = $_GET['place_id'];
            if(isset($_SESSION['user_id'])){
            $query = $this->conn()->prepare('INSERT INTO itineraries(user_id, place_id) VALUES(?,?)');
            $query->execute([$user_id, $place_id]);
            }else{
                header("Location: login.php");
            }
        }
    }

    public function remove_itinerary(){
        if(isset($_POST['remove_itinerary'])){
            $place_id = $_GET['place_id'];
            $user_id = $_SESSION['user_id'];

            $query = $this->conn()->prepare("DELETE FROM itineraries WHERE place_id = ? AND user_id = ?");
            $query->execute([$place_id, $user_id]);
        }
    }
}
$data = new Database();
