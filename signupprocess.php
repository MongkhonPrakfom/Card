<?php
    include('connectiondb.php');
    session_start();

    if (isset($_POST['daftar'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
    
        if (empty($email) || empty($nama) || empty($password) || empty($password1)) {
            header('Location: signup.php?incomplete=yes');
            exit;
        } elseif (strlen($password) < 8) {
            echo "<script>alert('The password must be at least 8 characters long.'); window.history.back();</script>";
            exit;
        } elseif ($password !== $password1) {
            echo "<script>alert('The password does not match.'); window.history.back();</script>";
            exit;
        } else {
            $insertQuery = "INSERT INTO user (email, nama, password) VALUES('$email', '$nama', '$password')";
            if (mysqli_query($conn, $insertQuery)) {
                echo "<script>
                        alert('Succesfully');
                        window.location.href = 'login.php';  
                      </script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
        mysqli_close($conn);
    }
    