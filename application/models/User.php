<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *  News_user
 *
 *      Add_user($login, $pass, $name, $firstname, $email)
 */


class User extends CI_Model

{
    protected $table = 'User';


    /**
     *  Ajoute un utilisateur.
     *
     *  @param string $login      Le login de l'utilisateur
     *  @param string $pass       Le mot de passe de l'utilisateur
     *  @param string $name       Le nom de l'utilisateur
     *  @param string $firstname  Le prenom de l'utilisateur
     *  @param string $email      L'email de l'utilisateur
     *  @return bool              Le résultat de la requête
		 */

	  
		public function Check_user_exists($login)
		{
			$this->db->select('login');
			$this->db->from('User');
			$this->db->where('login', $login);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				return false;
			}
			else
			{
				return true;
			}
		}


	
    public function Add_user($login, $password, $name, $firstname, $email)
		{
			
				 $passhash = password_hash($password, PASSWORD_DEFAULT);
      return   $this->db->set('login', $login)
                    ->set('password',  $passhash)
                    ->set('name',      $name)
                    ->set('firstname', $firstname)
                    ->set('email',     $email)
										->insert($this->table);

    }
		

    public function Check_user($login, $password)
		{
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('login', $login);
				$query = $this->db->get();
				$row = $query->row();
				if(isset($row))
				{
				  return password_verify($password, $row->password);
				}
		}

		public function getUsers()
		{
			$this->db->select('login');
			$this->db->from($this->table);
			return $this->db->get()->result();
		}

		public function remove($idUser)
		{
			$this->db->query("DELETE FROM $this->table WHERE login = '".$idUser."'");
		}
}



/* End of file news_model.php */

/* Location: ./application/models/news_model.php */
