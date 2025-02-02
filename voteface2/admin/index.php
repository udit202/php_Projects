<?php
// Start session
session_start();

// Include database connection
require_once '../conn.php';

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (!empty($email) && !empty($password)) {
        // Prepare query to check user credentials
        $sql = "SELECT * FROM Admin WHERE gmail = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store session variables
                $_SESSION['admin_id'] = $user['unique_id'];
                $_SESSION['admin_name'] = $user['name'];

                // Redirect to the dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with this email.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}

// Close database connection
mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-sm-6 col-md-4 my-5">
                <div class="form_container my-5 shadow rounded p-4">
                    <div class="company_logo my-4 text-center">
                        <div class="text-center"><h2>Voting</h2></div>
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6"><a href="forget_password.php">Forgot Password</a></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
