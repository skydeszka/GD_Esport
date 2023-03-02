<?php
/** @var PDO $pdo */
$pdo = $_SERVER['DOCUMENT_ROOT'] . "/db.php";

class User{
    #region Properties

    private string      $id;
    private string      $username;
    private string      $hash;
    private string      $email;
    private string      $fullname;
    private string      $county;
    private DateTime    $birthdate;
    private bool        $activated;

    #endregion

    function __construct(
        string $id, string $username, string $hash, string $email,
        string $fullname, string $county, string $birthdate, bool $activated = false)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hash = $hash;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->county = $county;
        $this->birthdate = date_create($birthdate);
    }

    function GetAge(): int {
        $currentDate = date("d-m-Y");
    
        return date_diff($this->birthdate, date_create($currentDate))->y;
    }

    #region Get/Set

    function get_id(){
        return $this->id;
    }

    function get_name(){
        return $this->username;
    }

    function get_hash(){
        return $this->hash;
    }

    function get_email(){
        return $this->email;
    }

    function get_fullname(){
        return $this->fullname;
    }

    function get_county(){
        return $this->county;
    }

    function get_birthdate(){
        return $this->birthdate;
    }

    /**
     * Gets the ID of the team that this user belongs to.
     * @return string|bool String if the user is in a team, otherwise false
     */
    function GetTeamID(): string|bool {
        /** @var PDO $pdo */
        global $pdo;

        $query = 
            "SELECT `teamID`
            FROM `teammembers`
            WHERE `memberID` = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);

        if($stmt->rowCount() == 0)
            return false;

        return $stmt->fetch(PDO::FETCH_ASSOC)['teamID'];
    }

    /**
     * Gets the name of the team that this user belongs to.
     * @return string|bool String if the user is in a team, otherwise false
     */
    function GetTeamName(): string|bool {
        /** @var PDO $pdo */
        global $pdo;

        $query = 
            "SELECT `t`.`name`
            FROM `teammembers` as `m`
            INNER JOIN `teams` as `t`
                ON `t`.`ID` = `m`.`teamID`
            WHERE `memberID` = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);

        if($stmt->rowCount() == 0)
            return false;

        return $stmt->fetch(PDO::FETCH_ASSOC)['name'];
    }

    #endregion
}

?>