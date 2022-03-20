<?php

require('../functions.inc.php');

function loginUserAS($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);
    if($uidExists == false){
        header("location: ../../login.php?error=wronglogin");
        exit();
    }

    if($uidExists['userStatus'] == 0){
        header("location: ../../login.php?error=deactivatedaccount");
        exit();
    }


    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd,$pwdHashed);

    if ($checkPwd == false){
        header("location: ../../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true){
        
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["username"] = $uidExists["usersName"];
        $_SESSION["userSurname"] = $uidExists["usersSurname"];
        $_SESSION["useremail"] = $uidExists["usersEmail"];
        $_SESSION["userrole"] = $uidExists["userRole"];
        $_SESSION["street"]=$uidExists["street"];
        $_SESSION["houseNo"]=$uidExists["houseNo"];
        $_SESSION["post"]=$uidExists["post"];
        $_SESSION["postNo"]=$uidExists["postNo"];
        
        if($_SESSION["userrole"] == 0 || $_SESSION["userrole"] == 1) {
            
            # Avtorizirani uporabniki (to navadno pride iz podatkovne baze)
            $authorized_users = ["Admin", "Seller"];
            
            

            # preberemo odjemačev certifikat
            $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
            
            # in ga razčlenemo
            $cert_data = openssl_x509_parse($client_cert);
            
            # preberemo ime uporabnika (polje "common name")
            $commonname = $cert_data['subject']['CN'];
            
            if($_SESSION["username"] == $commonname) {
                # Če se ime nahaja na seznam avtoriziranih uporabnikov prikažemo čas.
                if (in_array($commonname, $authorized_users)) {
                    header("location: ../../../index.php");
                }
                else {
                    echo "You must have valid certificate!";
                }
            }
            else {
                echo "You must have valid certificate!";
            }
            
        }
        else {
            
                header("location: ../../../login.php");

        }
       
                
        exit();
    }
}