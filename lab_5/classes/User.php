<?php

class User
{
    const STATUS_ADMIN = 0;
    const STATUS_USER = 1;
    protected const USERS_JSON = "users.json";
    protected const USERS_XML = "users.xml";

    protected $username;
    protected $password;
    protected $fullName;
    protected $email;
    protected DateTime $dateCreated;
    protected int $status;

    /**
     * @param $username
     * @param $password
     * @param $fullName
     * @param $email
     */
    public function __construct($username, $password, $fullName, $email)
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->fullName = $fullName;
        $this->email = $email;
        $this->dateCreated = new DateTime();
        $this->status = self::STATUS_USER;
    }

    public function show()
    {
        echo $this->getUsername() . " " .
            $this->getFullName() . " " .
            $this->getEmail() . " " .
            $this->getDateCreated() . " " .
            "status " . $this->getStatus();
    }

    public static function showAllUsersFromJson()
    {
        $tab = json_decode(file_get_contents(self::USERS_JSON));
        foreach ($tab as $val) {
            echo "<p>" . $val->username . " " . $val->fullName . " " . $val->dateCreated . "</p>";
        }
    }

    public static function showAllUsersFromXml()
    {
        $allUsers = simplexml_load_file(self::USERS_XML);
        echo "<ul>";
        foreach ($allUsers as $user):
            $username = $user->username;
            $fullName = $user->fullName;
            $dateCreated = $user->dateCreated;
            echo "<li>$username, $fullName, $dateCreated</li>";
        endforeach;
        echo "</ul>";
    }

    function toArray(): array
    {
        return [
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "fullName" => $this->getFullName(),
            "email" => $this->getEmail(),
            "dateCreated" => $this->getDateCreated(),
            "status" => $this->getStatus()
        ];
    }

    function saveToJson()
    {
        $tab = json_decode(file_get_contents(self::USERS_JSON), true);
        array_push($tab, $this->toArray());
        file_put_contents(self::USERS_JSON, json_encode($tab));
    }

    function saveToXml()
    {
        $xml = simplexml_load_file(self::USERS_XML); // wczytujemy plik XML:
        $xmlCopy = $xml->addChild("user"); // dodajemy nowy element user (jako child)
        // do elementu dodajemy jego właściwości o określonej nazwie i treści
        $xmlCopy->addChild("username", $this->getUsername());
        $xmlCopy->addChild("password", $this->getPassword());
        $xmlCopy->addChild("fullName", $this->getFullName());
        $xmlCopy->addChild("email", $this->getEmail());
        $xmlCopy->addChild("dateCreated", $this->getDateCreated());
        $xmlCopy->addChild("status", $this->getStatus());
        $xml->asXML(self::USERS_XML); // zapisujemy zmodyfikowany XML do pliku:
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->dateCreated->format("Y-m-d");
    }

    /**
     * @param DateTime $dateCreated
     */
    public function setDateCreated(DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return false|string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param false|string|null $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}