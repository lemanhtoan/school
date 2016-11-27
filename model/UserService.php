<?php
require_once 'model/IndexService.php';
require_once 'model/UserGateway.php';
require_once 'model/ValidationException.php';


class UserService {
    private $index = NULL;
    private $userGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->userGateway = new UserGateway();
    }

    public function getId($id) {
        try {
            $this->index->openDb();
            $res = $this->userGateway->selectById($id);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
        return $this->userGateway->find($id);
    }
    
    private function validateParams( $name ) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Email is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function create( $email, $password, $userTypeId, $other ) {
        try {
            $this->index->openDb();
            $this->validateParams($email);
            $res = $this->userGateway->insert($email, $password, $userTypeId, $other);
            if ($res == 'USER_EXIST') {
                return $res;
            }
            // sent email active link - later
            //$resUser = $this->userGateway->selectById($res);
            //$this->verifiedEmail($resUser->email);

            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $name) {
        try {
            $this->index->openDb();
            $this->validateParams($name);
            $res = $this->userGateway->update($id, $name);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    public function delete( $id ) {
        try {
            $this->index->openDb();
            $res = $this->userGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function login( $email, $password ) {
        try {
            $this->index->openDb();
            $res = $this->userGateway->login( $email, $password );
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function verifiedEmail($email)
    {
        $keyVerified = md5(uniqid("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", true));
        $emailSentFrom = 'adcskt@gmail.com';
        $emaiNameFrom = 'School manager';
        $data = array(
            "email" => $email,
            "active" => 0,
            "hash" => $keyVerified,
            "created_at" => date("Y-m-d H:i:s")
        );
        try {
            $this->index->openDb();
            $res = $this->userGateway->saveVerifiedEmail( $data );
            if (count($res)) {
                // send email
                $serverUrl = 'http://localhost/school/';
                $verificationLink = $serverUrl."activate.php?hash=" . $keyVerified;
                $body = "Hi customer, click to link active your account " . $verificationLink;
                $subject = "Email verify account";
                $headers = "From: $emailSentFrom" . "\r\n";
                if (mail($data['email'], $subject, $body, $headers)) {
                    echo ("Message successfully sent!");
                    die('1');
                } else {
                    echo ("Message delivery failed...");
                    die('0');
                }
            }
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
        }

    public function createGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $createId) {
        try {
            $this->index->openDb();
            $this->validateParams($colMaGV);
            $res = $this->userGateway->insertGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $createId);
            if ($res == 'USER_EXIST') {
                return $res;
            }
            // sent email active link - later
            //$resUser = $this->userGateway->selectById($res);
            //$this->verifiedEmail($resUser->email);

            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
}

?>
