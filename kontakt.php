<?php
if($_POST) {
    $fname = "";
    $email = "";
    $subject = "";
    $poruka = "<div>";
    $recipient = "kosmilos@gmail.com"

    if(isset($_POST['fname'])) {
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $poruka .= "<div>
                           <label><b>Ime:</b></label>&nbsp;<span>".$fname."</span>
                        </div>";
    }

    if(isset($_POST['lname'])) {
        $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
        $poruka .= "<div>
                           <label><b>Prezime:</b></label>&nbsp;<span>".$lname."</span>
                        </div>";
    }

    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $poruka .= "<div>
                           <label><b>Email:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }

    if(isset($_POST['subject'])) {
            $subject = htmlspecialchars($_POST['subject']);
            $poruka .= "<div>
                               <label><b>Poruka:</b></label>
                               <div>".$subject."</div>
                            </div>";
        }

        $poruka .= "</div>";

        $headers  = 'MIME-Version: 1.0' . "\r\n"
        .'Content-type: text/html; charset=utf-8' . "\r\n"
        .'From: ' . $email . "\r\n";

        if(mail($recipient, $poruka, $headers)) {
            echo "<p>Poštovani, $fname $lname, hvala na kontaktiranju.</p>";
        } else {
            echo '<p>Došlo je do greške.</p>';
        }

    } else {
        echo '<p>Došlo je do greške.</p>';
    }
    ?>
