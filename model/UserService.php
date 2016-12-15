<?php
require_once 'model/IndexService.php';
require_once 'model/UserGateway.php';
require_once 'model/ValidationException.php';
require_once 'model/SVGateway.php';


class UserService {
    private $index = NULL;
    private $userGateway    = NULL;
    private $SVGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->userGateway = new UserGateway();
        $this->SVGateway = new SVGateway();
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

            if ($userTypeId == '4') {
                $res = $this->SVGateway->insert( rand(1, 100000), $email, $email, '', '' );
            }
            // sent email active link - later
            $resUser = $this->userGateway->selectById($res);
            //$this->verifiedEmail($resUser->email);/////////////////////////later email

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
                $headers = "From: adcskt@gmail.com" . "\r\n" .
                    "CC: toanktv.it@gmail.com";
                if (mail($email, $subject, $body, $headers)) {
                    echo ("Message successfully sent!");
                } else {
                    echo ("Message delivery failed...");
                }
            }
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
        }

    public function createGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $email) {
        try {
            $this->index->openDb();
            $this->validateParams($colMaGV);
            $res = $this->userGateway->insertGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $email);
            if ($res == 'USER_EXIST') {
                return $res;
            }
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function changePassUser($password, $userId) {
        try {
            $this->index->openDb();
            $res = $this->userGateway->changePassUser($password, $userId);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function createSinhVien($colMaSV, $colName, $colKhoaHoc, $colCTHoc, $colEmail) {
        try {
            $this->index->openDb();
            $this->validateParams($colMaSV);
            $res = $this->userGateway->insertSinhVien($colMaSV, $colName, $colKhoaHoc, $colCTHoc, $colEmail);
            if ($res == 'USER_EXIST') {
                return $res;
            }
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function getAllUser() {
        try {
            $this->index->openDb();
            $res = $this->userGateway->selectAllUser();
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function activeUserStatus($id) {
        try {
            $this->index->openDb();
            $res = $this->userGateway->activeUserStatus($id);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
}

?>
