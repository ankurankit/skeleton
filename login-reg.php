                        <?php
                        include 'connection.php';
                        if (isset($_POST['logemail'])&isset($_POST['logpassword'])){
                          $uname = mysqli_real_escape_string($conn,htmlentities($_POST['logemail']));
                          $pword = mysqli_real_escape_string($conn,htmlentities($_POST['logpassword']));
                          $uname = htmlspecialchars($uname);
                          $pword = htmlspecialchars($pword);
                          $SQL = "SELECT * FROM users WHERE username = '$uname' OR email = '$uname' AND password = '$pword'";
                          $name2 = $conn->query($SQL);
                          $a = $name2->num_rows;
                          if ($a > 0) {
                            $row2 = $name2->fetch_assoc();
                            $uname = $row2['username'];
                            session_start();
                            $_SESSION['nameofuser'] = $uname;
                            echo "<script type='text/javascript'>window.location.href = 'init.php';</script>";
                          }
                          else
                          {
                            echo "<br>";echo "<br>";
                            echo ("Wrong Username or Password");
                          }
                        }
                        if (isset($_POST['regusername'])&isset($_POST['regemail'])&isset($_POST['regpassword'])) {
                          $username = mysqli_real_escape_string($conn,htmlentities($_POST['regusername']));
                          $pass = mysqli_real_escape_string($conn,htmlentities($_POST['regpassword']));
                          $email = mysqli_real_escape_string($conn,htmlentities($_POST['regemail']));
                          $check = "SELECT * FROM users WHERE username = "."'$username'";
                          $result = $conn->query($check);
                          $numofrow = mysqli_num_rows($result);
                          if ((int)$numofrow > 0) {
                            echo("<script>alert('Username already taken!! Please try some other username.')</script>");
                          }
                          else {
                            $check = "SELECT * FROM users WHERE email = "."'$email'";
                            $result = $conn->query($check);
                            $numofrow = mysqli_num_rows($result);
                            if ((int)$numofrow > 0) {
                              echo("<script>alert('Email already registered!!')</script>");
                            }
                            else {
                              $sql='INSERT INTO users'.'(username,email,password)'.'VALUES ("'.$username.'","'.$email.'","'.$pass.'");';
                              $update = $conn->query($sql);
                              session_start();
                              $_SESSION['nameofuser'] = $username;
                              $check2 = "SELECT * FROM users WHERE username = "."'$username'";
                              $result2 = $conn->query($check2);
                              $row = $result2->fetch_assoc();
                              $conn->query($sql);
                              echo "<script type='text/javascript'>window.location.href = 'init.php';</script>";
                            }
                          }
                        }
                        ?>