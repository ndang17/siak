<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function __getUserByEmailPU($emailpu)
    {
        $data = $this->db->query('SELECT ID,NIP,emailpu FROM db_employees.employees WHERE emailpu LIKE "'.$emailpu.'"');

        return $data->result_array();
    }

    public function __getUserAuth($ID,$NIP){
        $data = $this->db->query('SELECT e.*,

	d.ID AS IDDivision, d.Division, d.MenuNavigation,
	p.ID AS IDPosition, p.Position,
	
	d1.ID AS IDDivisionOther1, d1.Division AS DivisionOther1,
	p1.ID AS IDPositionOther1, p1.Position AS PositionOther1,
	
	d2.ID AS IDDivisionOther2, d2.Division AS DivisionOther2,
	p2.ID AS IDPositionOther2, p2.Position AS PositionOther2,
	
	d3.ID AS IDDivisionOther3, d3.Division AS DivisionOther3,
	p3.ID AS IDPositionOther3, p3.Position AS PositionOther3
	
	FROM db_employees.employees e
	LEFT JOIN db_employees.division d ON (d.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionMain, \'.\', 1), \'.\', -1))
	LEFT JOIN db_employees.position	p ON (p.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionMain, \'.\', -1), \'.\', 1))
	
	LEFT JOIN db_employees.division d1 ON (d1.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionOther1, \'.\', 1), \'.\', -1))
	LEFT JOIN db_employees.position	p1 ON (p1.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionOther1, \'.\', -1), \'.\', 1))
	
	LEFT JOIN db_employees.division d2 ON (d2.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionOther2, \'.\', 1), \'.\', -1))
	LEFT JOIN db_employees.position	p2 ON (p2.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionOther2, \'.\', -1), \'.\', 1))
	
	LEFT JOIN db_employees.division d3 ON (d3.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionOther3, \'.\', 1), \'.\', -1))
	LEFT JOIN db_employees.position	p3 ON (p3.ID = SUBSTRING_INDEX(SUBSTRING_INDEX(e.PositionOther3, \'.\', -1), \'.\', 1))
	WHERE e.NIP LIKE "'.$NIP.'" AND e.ID = "'.$ID.'" ');

        return $data->result_array();
    }

    public function __getTimePerCredits(){
        $data = $this->db->query('SELECT t.time FROM db_academic.time_per_credits t');
        return $data->result_array()[0];
    }

    public function __getauthUserPassword($NIP,$Password){
        $data = $this->db->query('SELECT e.ID,e.NIP FROM db_employees.employees e 
                                    WHERE e.NIP like "'.$NIP.'" AND e.Password = "'.$Password.'" ');

        return $data->result_array();
    }

    public function __getRuleUser($NIP){
        $data = $this->db->query('SELECT * FROM db_employees.rule_users WHERE NIP LIKE "'.$NIP.'"');
        return $data->result_array();
    }


}
