<?php
$configs = require "../../config.php";
$pdo = require $configs['root'] . "/db.php";
require_once $configs['paths']['types'] . "/user.php";


class Team{
    #region Properties
    private string      $name;          //string

    private int         $registered;    //date
    private bool        $activated;     //bool

    private User        $leader;        //user
    private array       $members;       //user array

    private int     $win;
    private int         $lose; 

    #endregion

    function __construct(string $name, User $leader, array $members, string $registered, int $win, int $lose, bool $activated = false)
    {
        $this->name = $name;
        $this->leader = $leader;
        $this->members = $members;

        $this->registered = strtotime($registered);
        $this->activated = $activated;

        $this->win = $win;
        $this->lose = $lose;
    }

    static function CreateFromID(string $id): Team|bool {
        /** @var PDO $pdo*/
        global $pdo;

        $query =
            "SELECT `t`.`name`, `t`.`registered`, `m`.`owner`, `u`.`username`, `u`.`ID`, `t`.`lose`, `t`.`win`
            FROM `teams` as `t`
            INNER JOIN `teammembers` as `m`
                ON `t`.`ID` = `m`.`teamID`
            INNER JOIN `users` as `u`
                ON `u`.`ID` = `m`.`memberID`
            WHERE `t`.`ID` = ?
            ORDER BY `m`.`owner` DESC;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        if($datas = $stmt->fetchAll(PDO::FETCH_ASSOC)){

            $members = [];
            $leader = null;
            $name = $datas[0]['name'];
            $registered = $datas[0]['registered'];
            $win = $datas[0]['win'];
            $lose = $datas[0]['lose'];

            foreach($datas as $data){
                $tempMember = new User($data['ID'], $data['username'], "Ismeretlen", "Ismeretlen", "Ismeretlen", "Ismeretlen", "0000-00-00");

                if($data['owner'] == 1)
                    $leader = $tempMember;

                array_push($members, $tempMember);
            }

            $team = new Team($name, $leader, $members, $registered, $win, $lose);
            return $team;
        }
        return false;
    }

    #region Get/Set

    function get_win(){
        return $this->win;
    }

    function get_lose(){
        return $this->lose;
    }

    function get_name(): string{
        return $this->name;
    }

    function get_leader(): User{
        return $this->leader;
    }

    function get_members(): array{
        return $this->members;
    }

    function get_registered(): int{
        return $this->registered;
    }

    function get_activated(): bool{
        return $this->activated;
    }

    #endregion

    function Registered(): string{
        return date("Y.m.d", $this->registered);
    }
}

?>