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

    public function session_user($location)
    {
        if (!$_SESSION['user_id']) {
            header("Location: $location");
        }
    }

    public function session_staff($location)
    {
        if (!$_SESSION['staff_id']) {
            header("Location: $location");
        }
    }

    public function register()
    {
        if (isset($_POST['register'])) {
            $roles = $_POST['roles'];
            $user_img = $_POST['user_img'];
            $registerName = filter_input(INPUT_POST, 'registerName', FILTER_SANITIZE_STRING);
            $registerEmail = filter_input(INPUT_POST, 'registerEmail', FILTER_SANITIZE_EMAIL);
            $registerPass = filter_input(INPUT_POST, 'registerPass', FILTER_SANITIZE_STRING);
            $registerPassHash = password_hash($registerPass, PASSWORD_BCRYPT);

            $check_query = $this->conn()->prepare("SELECT email FROM users WHERE email = ?");
            $check_query->execute([$registerEmail]);

            if( $check_query->rowCount() > 0) {
                header("Location: signup.php");
                exit();
            }else{
            $query = $this->conn()->prepare("INSERT INTO users(username, email, password, roles, user_img) VALUES (?,?,?,?,?)");
            $query->execute([
                $registerName,
                $registerEmail,
                $registerPassHash,
                $roles,
                $user_img
            ]);

            $getIdQuery = $this->conn()->prepare("SELECT user_id FROM users WHERE email = :email");
            $getIdQuery->execute(['email' => $registerEmail]);
            $user_id = $getIdQuery->fetchColumn();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $registerEmail;

            if($roles == 'user'){
                header("Location: add-profile.php");
                exit();
            }
        }
        }
    }

    public function addStaff()
    {
        if (isset($_POST['registerStaff'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $location_id = filter_input(INPUT_POST, 'location_id', FILTER_SANITIZE_NUMBER_INT);
            $img = $_FILES['staff_img']['name'];
            $img_tmp_name = $_FILES['staff_img']['tmp_name'];
            $img_folder = '../assets/images/' . $img;

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $check_query = $this->conn()->prepare("SELECT email FROM staff WHERE email = ?");
            $check_query->execute([$email]);

            if( $check_query->rowCount() > 0) {
                header("Location: signup.php");
            }
            else{
            $query = $this->conn()->prepare("INSERT INTO staff(username, email, password, location_id, staff_img) VALUES(?,?,?,?,?)");
            $query->execute([$username, $email, $passwordHash, $location_id, $img]);
            move_uploaded_file($img_tmp_name, $img_folder);
            }
        }
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $loginEmail = filter_input(INPUT_POST, 'loginEmail', FILTER_SANITIZE_EMAIL);
            $loginPass = filter_input(INPUT_POST, 'loginPass', FILTER_SANITIZE_STRING);

            $query = $this->conn()->prepare("SELECT user_id, user_img,password, roles FROM users WHERE email = :email");
            $query->execute([
                'email' => $loginEmail,
            ]);
            $user = $query->fetch();
            if ($user) {
                if (password_verify($loginPass, $user['password'])) {
                    if ($user['roles'] == 'admin') {
                        $_SESSION['admin_id'] = $user['user_id'];
                        header("Location: ../admin/dashboard.php");

                    } else {
                        $_SESSION['user_email'] = $loginEmail;
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['user_img'] = $user['user_img'];
                        header("Location: ../index.php");
                    }
                }
            }
        }
    }

    public function loginStaff()
    {
        if (isset($_POST['staffLogin'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $query = $this->conn()->prepare("SELECT staff_id, password, location_id FROM staff WHERE email = :email");
            $query->execute([
                'email' => $email,
            ]);
            $staff = $query->fetch();
            if ($staff) {
                if (password_verify($password, $staff['password'])) {
                        $_SESSION['staff_email'] = $email;
                        $_SESSION['staff_id'] = $staff['staff_id'];
                        $_SESSION['location_id'] = $staff['location_id'];
                        header("Location: dashboard.php");
                    } else {
                        header("Location: login.php");
                    }
                }
            }
        }
    
    public function insert_img_user(){
        if(isset($_POST['upload_img'])){
            $user_id = $_SESSION['user_id'];

            $img = $_FILES['user_img']['name'];
            $img_tmp_name = $_FILES['user_img']['tmp_name'];
            $img_folder = '../assets/images/' . $img;

            $query = $this->conn()->prepare("UPDATE users SET user_img = ? WHERE user_id = ?");
            $query->execute([$img, $user_id]);
            move_uploaded_file($img_tmp_name, $img_folder);
        }
    }

    public function get_places()
    {
        $query = $this->conn()->prepare("SELECT * FROM places");
        $query->execute();
        $places = $query->fetchAll();
        return $places;
    }

    public function get_locations(){
        $query = $this->conn()->prepare("SELECT * FROM locations");
        $query->execute();
        $locations = $query->fetchAll();
        return $locations;
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
            $user_id = $_SESSION['staff_id'];

            $check_query = $this->conn()->prepare("SELECT * FROM place_categories WHERE place_id = ? AND category_id = ?");
            $check_query->execute([$place_id, $category_id]);

            if ($check_query->rowCount() > 0) {
                header("Location: add-place-category.php");
            } else {
                $query = $this->conn()->prepare("INSERT INTO place_categories(user_id, place_id, category_id) VALUES(?,?,?)");
                $query->execute([$user_id, $place_id, $category_id]);
            }
        }
    }

    public function add_place_activity()
    {
        if (isset($_POST["add_place_activity"])) {
            $place_id = filter_input(INPUT_POST, 'place_id', FILTER_SANITIZE_NUMBER_INT);
            $activity_id = filter_input(INPUT_POST, 'activity_id', FILTER_SANITIZE_NUMBER_INT);
            $user_id = $_SESSION['staff_id'];

            $check_query = $this->conn()->prepare("SELECT * FROM place_activities WHERE place_id = ? AND activity_id = ?");
            $check_query->execute([$place_id, $activity_id]);

            if ($check_query->rowCount() > 0) {
                header("Location: add-place-activity.php");
            } else {
                $query = $this->conn()->prepare("INSERT INTO place_activities(user_id, place_id, activity_id) VALUES(?,?,?)");
                $query->execute([$user_id, $place_id, $activity_id]);
            }
        }
    }

    public function get_itineraries()
    {
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
            $location_id = $_POST['location_id'];
            if (isset($_SESSION['user_id'])) {
                $query = $this->conn()->prepare('INSERT INTO itineraries(user_id, place_id, location_id) VALUES(?,?,?)');
                $query->execute([$user_id, $place_id, $location_id]);
            } else {
                header("Location: login.php");
            }
        }
    }

    public function remove_itinerary()
    {
        if (isset($_POST['remove_itinerary'])) {
            $place_id = $_GET['place_id'];
            $user_id = $_SESSION['user_id'];

            $query = $this->conn()->prepare("DELETE FROM itineraries WHERE place_id = ? AND user_id = ?");
            $query->execute([$place_id, $user_id]);
        }
    }

    public function itineraries()
    {
        $query = "SELECT p.*, i.* 
            FROM places p
            JOIN itineraries i ON p.place_id = i.place_id
            WHERE i.user_id = ?";
        $stmt = $this->conn()->prepare($query);
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetchAll();
    }

    public function category_names($place_id)
    {
        $query = "SELECT pc.place_id, c.category_name, c.category_id
                  FROM place_categories pc
                  JOIN categories c ON c.category_id = pc.category_id
                  WHERE pc.place_id = ?";
        $stmt = $this->conn()->prepare($query);
        $stmt->execute([$place_id]);
        return $stmt->fetchAll();
    }

    public function activity_names($place_id)
    {
        $query = "SELECT pa.place_id, a.activity_name, a.activity_id
                  FROM place_activities pa
                  JOIN activities a ON a.activity_id = pa.activity_id
                  WHERE pa.place_id = ?";
        $stmt = $this->conn()->prepare($query);
        $stmt->execute([$place_id]);
        return $stmt->fetchAll();
    }
}
$data = new Database();
