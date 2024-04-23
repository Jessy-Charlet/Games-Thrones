<?php
class CrudUser {
    private $customer_id;
    private $lastname;
    private $firstname;
    private $email;
    private $phone;
    private $adress;
    private $postal_code;
    private $city;
    private $password;


    public function setCustomer_id($newId){
        $this->customer_id = $newId;
    }

    public function setFirstname($newFirstname){
        $this->firstname = $newFirstname;
    }

    public function getCustomer_id(){
        return $this->customer_id;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getAll($id){
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT * FROM customer WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $id
            )
        );
        $userData = $sql->fetch(PDO::FETCH_ASSOC);
        $sql->closeCursor();

        $sql = $conn->prepare("SELECT * FROM adress WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $id
            )
        );
        $adressData = $sql->fetch(PDO::FETCH_ASSOC);
        $sql->closeCursor();

        return array('userData' => $userData, 'adressData' => $adressData);
    }

    public function getLastname($customer_id){
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT `customer_last-name` FROM customer WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $customer_id
            )
        );
        $name = $sql->fetch(PDO::FETCH_ASSOC);
        $this->lastname = $name;
        return $name;
    }


    public function getEmail($customer_id){
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT email FROM customer WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $customer_id
            )
        );
        $email = $sql->fetch(PDO::FETCH_ASSOC);
        $this->email = $email;
        return $email;
    }

    public function getPhone($customer_id){
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT phone FROM customer WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $customer_id
            )
        );
        $phone = $sql->fetch(PDO::FETCH_ASSOC);
        $this->phone = $phone;
        return $phone;
    }

    public function getAdress($customer_id){
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT adress FROM adress WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $customer_id
            )
        );
        $adress = $sql->fetch(PDO::FETCH_ASSOC);
        $this->adress = $adress;
        return $adress;
    }

    public function getPostal_code($customer_id){
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT postal_code FROM adress WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $customer_id
            )
        );
        $postal_code = $sql->fetch(PDO::FETCH_ASSOC);
        $this->postal_code = $postal_code;
        return $postal_code;
    }

    public function getCity($customer_id){
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT city FROM adress WHERE customer_id = :customer_id");
        $sql->execute(
            array(
                'customer_id' => $customer_id
            )
        );
        $city = $sql->fetch(PDO::FETCH_ASSOC);
        $this->city = $city;
        return $city;
    }

    public function createUser(){
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->password = $passwordHash;

        $conn = Database::connect();
        
        $current_page_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $sql = $conn->prepare("SELECT email FROM customer WHERE email = :email");
        $sql->execute(
            array(
                'email' => $mail
            )
        );
        if($sql->rowCount() > 0){
            header('Location: '.$current_page_url.'?error=mailAlreadyUsed&name='.$name.'&firstname='.$firstname.'&phone='.$phone.'&adress='.$adress.'&postalCode='.$postalCode.'&city='.$city);
            exit();
        }
        $sql->closeCursor();

        $sql = $conn->prepare("SELECT phone FROM customer WHERE phone = :phone");
        $sql->execute(
            array(
                'phone' => $phone
            )
        );
        if($sql->rowCount() > 0){
            header('Location: '.$current_page_url.'?error=phoneAlreadyUsed&name='.$name.'&firstname='.$firstname.'&mail='.$mail.'&adress='.$adress.'&postalCode='.$postalCode.'&city='.$city);
            exit();
        }
        $sql->closeCursor();
        try {
            $conn->beginTransaction();
        
            // Insertion du client
            $insertCustomer = $conn->prepare("INSERT INTO customer (`customer_last-name`, `customer_first-name`, email, phone, password) VALUES (:customer_last_name, :customer_first_name, :email, :phone, :password)");
            $insertCustomer->execute(
                array(
                    'customer_last_name' => $this->lastname,
                    'customer_first_name' => $this->firstname,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'password' => $this->password
                )
            );
        
            // Récupération de l'ID du client inséré
            $customerId = $conn->lastInsertId();
            $sql = $conn->prepare("SELECT `customer_first-name` FROM customer WHERE customer_id = :id");
            $sql->execute(
                array(
                    'id' => $customerId
                )
            );
            $firstName = $sql->fetch(PDO::FETCH_ASSOC)['customer_first-name'];

            // Insertion de l'adresse
            $insertAddress = $conn->prepare("INSERT INTO adress (city, postal_code, adress, customer_id, postal_code_id) 
                                            SELECT :city, :postal_code, :adress, :customer_id, postal_code_id 
                                            FROM postal_code WHERE postal_code = :postal_code");
            $insertAddress->execute(
                array(
                    'city' => $this->city,
                    'postal_code' => $this->postal_code,
                    'adress' => $this->adress,
                    'customer_id' => $customerId
                )
            );

            $this->setCustomer_id($customerId);
            $this->setFirstname($firstName);
            // Commit des transactions
            $conn->commit();
        } catch(PDOException $e) {
            // En cas d'erreur, annulation des transactions
            $conn->rollback();
            throw $e;
        }
    }

    public function updateUser($id, $isEmailChanged, $isPhoneChanged, $isPasswordChanged, $isAddressChanged, $isNameChanged, $isFirstnameChanged, $isPostalCodeChanged, $isCityChanged){
        $conn = Database::connect();
        $current_page_url = strtok($_SERVER['REQUEST_URI'] ?? '', '?');

        if(isset($isPasswordChanged)){
            $passwordHash = password_hash($isPasswordChanged, PASSWORD_DEFAULT);
            $isPasswordChanged = $passwordHash;
        }

    
        $sql = $conn->prepare("SELECT email FROM customer WHERE customer_id = :id");
        $sql->execute(
            array(
                'id' => $id
            )
        );
        if($sql->fetch(PDO::FETCH_ASSOC)['email'] != $isEmailChanged){
            $sql2 = $conn->prepare("SELECT email FROM customer WHERE email = :email");
            $sql2->execute(
                array(
                    'email' => $isEmailChanged
                )
            );
            if($sql2->rowCount() > 0){
                header('Location: '.$current_page_url.'?error=mailAlreadyUsed');
                exit();
            }
            $sql2->closeCursor();
        }
        $sql->closeCursor();
    

        $sql = $conn->prepare("SELECT phone FROM customer WHERE customer_id = :id");
        $sql->execute(
            array(
                'id' => $id
            )
        );
        if($sql->fetch(PDO::FETCH_ASSOC)['phone'] != $isPhoneChanged){
            $sql2 = $conn->prepare("SELECT phone FROM customer WHERE phone = :phone");
            $sql2->execute(
                array(
                    'phone' => $isPhoneChanged
                )
            );
            if($sql2->rowCount() > 0){
                header('Location: '.$current_page_url.'?error=phoneAlreadyUsed');
                exit();
            }
            $sql2->closeCursor();
        }
        $sql->closeCursor();
        
        try {
            $conn->beginTransaction();

            // Mettre à jour les données de l'utilisateur
            $sql = $conn->prepare("UPDATE customer SET `customer_last-name` = :customer_last_name, `customer_first-name` = :customer_first_name, email = :email, phone = :phone, password = :password WHERE customer_id = :customer_id");
            $sql->execute(
                array(
                    'customer_last_name' => $isNameChanged,
                    'customer_first_name' => $isFirstnameChanged,
                    'email' => $isEmailChanged,
                    'phone' => $isPhoneChanged,
                    'password' => $isPasswordChanged,
                    'customer_id' => $id
                )
            );
            $sql->closeCursor();

            // Mettre à jour l'adresse de l'utilisateur
            $sql = $conn->prepare("UPDATE adress SET city = :city, postal_code = :postal_code, adress = :adress WHERE customer_id = :customer_id");
            $sql->execute(
                array(
                    'city' => $isCityChanged,
                    'postal_code' => $isPostalCodeChanged,
                    'adress' => $isAddressChanged,
                    'customer_id' => $id
                )
            );
            $sql->closeCursor();

            $conn->commit();
            //header('Location: '.$current_page_url.'?update=success');
        } catch(PDOException $e) {
            // En cas d'erreur, annulation des transactions
            $conn->rollback();
            //header('Location: '.$current_page_url.'?update=error');
            throw $e;
        }
    }

    public function delete($customer_id, $password){
        $conn = Database::connect();
        $sql = $conn->prepare("DELETE FROM customer WHERE customer_id = :customer_id AND password = :password");
        $sql->execute(
            array(
                'password' => $password,
                'customer_id' => $this->customer_id
            )
        );
        $sql->closeCursor();

        $sql = $conn->prepare("DELETE FROM adress WHERE customer_id = :customer_id AND password = :password");
        $sql->execute(
            array(
                'password' => $password,
                'customer_id' => $this->customer_id
            )
        );
    }

    public function connectionUser(string $mail, string $password){
        $conn = Database::connect();

        if(isset($password)){
            $passwordHash = sodium_crypto_pwhash_str(
                $password,
                SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,  // Nombre d'opérations pour la résistance aux attaques par force brute
                SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE // Limite de mémoire pour la résistance aux attaques par force brute
            );
            $password = $passwordHash;
        }

        try{
            $conn->beginTransaction();


            $sql = $conn->prepare("SELECT * FROM customer WHERE email = :mail AND password = :password");
            $sql->execute(
                array(
                    'mail' => $mail,
                    'password' => $password
                )
            );
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result){
                $id = $result['customer_id'];
                $firstName = $result['customer_first-name'];
                $_SESSION['user'] = $id;
                $_SESSION['userFirstName'] = $firstName;
                $conn->commit();
                return array('id' => $id, 'firstName' => $firstName);
            }
        }catch(PDOException $e) {
            // En cas d'erreur, annulation des transactions
            $conn->rollback();
            throw $e;
        }
    }
}