<?php
$errors = [];
$success_message = "";
$username = $email = $password = $repeat_password = "";

// Xử lý khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lọc dữ liệu nhập vào
    $username = htmlspecialchars(trim($_POST["username"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $password = $_POST["password"] ?? "";
    $repeat_password = $_POST["repeat-password"] ?? "";

    // Kiểm tra Họ tên
    if (empty($username)) {
        $errors["username"] = "Vui lòng nhập họ tên.";
    }

    // Kiểm tra Email
    if (empty($email)) {
        $errors["email"] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email không hợp lệ.";
    }

    // Kiểm tra Mật khẩu
    if (empty($password)) {
        $errors["password"] = "Vui lòng nhập mật khẩu.";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Mật khẩu phải có ít nhất 6 ký tự.";
    }

    // Kiểm tra Xác nhận mật khẩu
    if ($repeat_password !== $password) {
        $errors["repeat-password"] = "Mật khẩu xác nhận không khớp.";
    }

    // Nếu không có lỗi, đăng ký thành công
    if (empty($errors)) {
        $success_message = "Chào mừng, $username! Bạn đã đăng ký thành công.";
        $username = $email = $password = $repeat_password = ""; // Xóa dữ liệu nhập
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Register Page</title>
</head>
<body>
    <div class="wrapper fade-in-down">
        <div id="form-content">
            <a href="/login.html">
                <h2 class="inactive underline-hover">Đăng nhập</h2>
            </a>
            <a href="/register.php">
                <h2 class="active">Đăng ký</h2>
            </a>

            <div class="fade-in first">
                <img src="avatar.png" id="avatar" alt="User Icon" />
            </div>

            <!-- Hiển thị thông báo thành công -->
            <?php if (!empty($success_message)): ?>
                <div class="success-message">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <!-- Hiển thị lỗi trên đầu form -->
            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <?php foreach ($errors as $error): ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="register.php">
                <input
                    type="text"
                    id="username"
                    class="fade-in first"
                    name="username"
                    placeholder="Họ tên"
                    value="<?php echo htmlspecialchars($username); ?>"
                />
                <input
                    type="email"
                    id="email"
                    class="fade-in second"
                    name="email"
                    placeholder="Email"
                    value="<?php echo htmlspecialchars($email); ?>"
                />
                <input
                    type="password"
                    id="password"
                    class="fade-in third"
                    name="password"
                    placeholder="Mật khẩu"
                />
                <input
                    type="password"
                    id="repeat-password"
                    class="fade-in fourth"
                    name="repeat-password"
                    placeholder="Xác nhận mật khẩu"
                />
                <input type="submit" class="fade-in five" value="Đăng ký" />
            </form>

            <div id="form-footer">
                <a class="underline-hover" href="#">Quên mật khẩu?</a>
            </div>
        </div>
    </div>
</body>
</html>