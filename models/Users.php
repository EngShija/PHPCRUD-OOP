<?php
class User
{
    private $database;
    private $name;
    private $email;
    private $password;

    function __construct(Database $database)
    {
        $this->database = $database->getconnection();
       
    }
    public function is_user_present($table){
        $sql = "SELECT * FROM $table";
        $result = $this->database->query($sql);
        return mysqli_num_rows($result) > 0;
    }
    public function set_name($name){
       return $this->name = $name;
    }
    public function set_email($email){
      return  $this->email = $email;
    }
    public function set_password($password){
       return $this->password = $password;
    }

    public function get_users()
    {
        $sql ="SELECT * FROM users";
        $result = $this->database->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_user_single_row()
    {
        $sql = "SELECT * FROM users";
        $result = $this->database->query($sql);
        return $result->fetch_assoc();
    }
    public function get_user_by_id($user_id){
        $sql = "SELECT * FROM users WHERE id = $user_id";
        $result = $this->database->query($sql);
        return $result->fetch_assoc();
    }

    public function register_user($name, $email, $password)
    {
        $sql = $this->database->prepare("INSERT INTO users(name,email, password) VALUES(?, ?, ?)");
        $sql->bind_param("sss", $name, $email, $password);
        return $sql->execute();
    }

    public function delete_user($user_id)
    {
        $deletesql = "DELETE FROM users WHERE id = $user_id";
        return $this->database->query($deletesql);        
    }
    public function update_user($user_id, $name, $email, $password){
        $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = $user_id";
        return $this->database->query($sql);
    }
}
 