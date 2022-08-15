<?php

class Datatable_model extends CI_Model
{
    // ===========> USERS <===========
    function allposts_count_users()
    {   
        $query = $this
                ->db
                ->select('*, u.id as user_id, d.id as department_id')
                ->join('department_tbl d', 'u.department = d.id', 'left')
                ->where('u.archive', 0)
                ->get('users_tbl u');
    
        return $query->num_rows();  

    }
    
    function allposts_users($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->select('*, u.id as user_id, d.id as department_id')
                ->join('department_tbl d', 'u.department = d.id', 'left')
                ->where('u.archive', 0)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('users_tbl u');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search_users($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->select('*, u.id as user_id, d.id as department_id')
                ->join('department_tbl d', 'u.department = d.id', 'left')
                ->where('u.archive', 0)
                ->like('firstname',$search)
                ->or_like('lastname',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('users_tbl u');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count_users($search)
    {
        $query = $this
                ->db
                ->select('*, u.id as user_id, d.id as department_id')
                ->join('department_tbl d', 'u.department = d.id', 'left')
                ->where('u.archive', 0)
                ->like('firstname',$search)
                ->or_like('lastname',$search)
                ->get('users_tbl u');
    
        return $query->num_rows();
    } 

    // ===========> PROPERTY <===========
    function allposts_count_property($accountable,$date_added)
    {   
        $this->db
            ->select('p.id, pp.ppe_name as ppe_account_group, pp.id as ppe_id, ps.ppe_sub_name as ppe_sub_account_group, ps.id as ppe_sub_id, p.item, p.description,
                    p.purchase_date, p.old_property, p.property_no, p.unit_measure, p.unit_value, p.qty,  p.total_cost, p.qty_per_property_card,
                    p.qty_per_physical_count, concat(u1.firstname, " ", u1.lastname) as accountable, u1.id as accountable_id, d.department_name as location,
                    d.id as location_id, concat(u2.firstname, " ", u2.lastname) as user, u2.id as user_id, p.condition, p.remarks')
            ->join('users_tbl u1', 'u1.id = p.accountable_id', 'left')
            ->join('users_tbl u2', 'u2.id = p.user_id', 'left')
            ->join('department_tbl d', 'd.id = p.department_id', 'left')
            ->join('ppe_sub_tbl ps', 'ps.id = p.ppe_sub_id', 'left')
            ->join('ppe_tbl pp', 'pp.id = ps.ppe_id', 'left');

        if (!empty($accountable)) {
            $this->db->where('p.accountable_id', $accountable);
        }

        if (!empty($date_added)) {
            $date_added = str_replace("-", "",$date_added);
            $this->db->where('EXTRACT( YEAR_MONTH FROM p.date_added) =', $date_added);
        }

        $query = $this->db->where('p.archive', 0)
                ->get('property_tbl p');
    
        return $query->num_rows();  

    }
    
    function allposts_property($limit,$start,$col,$dir,$accountable,$date_added)
    {   
       $this->db
            ->select('p.id, pp.ppe_name as ppe_account_group, pp.id as ppe_id, ps.ppe_sub_name as ppe_sub_account_group, ps.id as ppe_sub_id, p.item, p.description,
                    p.purchase_date, p.old_property, p.property_no, p.unit_measure, p.unit_value, p.qty,  p.total_cost, p.qty_per_property_card,
                    p.qty_per_physical_count, concat(u1.firstname, " ", u1.lastname) as accountable, u1.id as accountable_id, d.department_name as location,
                    d.id as location_id, concat(u2.firstname, " ", u2.lastname) as user, u2.id as user_id, p.condition, p.remarks')
            ->join('users_tbl u1', 'u1.id = p.accountable_id', 'left')
            ->join('users_tbl u2', 'u2.id = p.user_id', 'left')
            ->join('department_tbl d', 'd.id = p.department_id', 'left')
            ->join('ppe_sub_tbl ps', 'ps.id = p.ppe_sub_id', 'left')
            ->join('ppe_tbl pp', 'pp.id = ps.ppe_id', 'left');

        if (!empty($accountable)) {
            $this->db->where('p.accountable_id', $accountable);
        }

        if (!empty($date_added)) {
            $date_added = str_replace("-", "",$date_added);
            $this->db->where('EXTRACT( YEAR_MONTH FROM p.date_added) =', $date_added);
        }

        $query = $this->db->where('p.archive', 0)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('property_tbl p');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search_property($limit,$start,$search,$col,$dir,$accountable,$date_added)
    {
        $this->db
            ->select('p.id, pp.ppe_name as ppe_account_group, pp.id as ppe_id, ps.ppe_sub_name as ppe_sub_account_group, ps.id as ppe_sub_id, p.item, p.description,
                    p.purchase_date, p.old_property, p.property_no, p.unit_measure, p.unit_value, p.qty, p.total_cost, p.qty_per_property_card,
                    p.qty_per_physical_count, concat(u1.firstname, " ", u1.lastname) as accountable, u1.id as accountable_id, d.department_name as location,
                    d.id as location_id, concat(u2.firstname, " ", u2.lastname) as user, u2.id as user_id, p.condition, p.remarks')
            ->join('users_tbl u1', 'u1.id = p.accountable_id', 'left')
            ->join('users_tbl u2', 'u2.id = p.user_id', 'left')
            ->join('department_tbl d', 'd.id = p.department_id', 'left')
            ->join('ppe_sub_tbl ps', 'ps.id = p.ppe_sub_id', 'left')
            ->join('ppe_tbl pp', 'pp.id = ps.ppe_id', 'left');
                
        if (!empty($accountable)) {
            $this->db->where('p.accountable_id', $accountable_id);
        }

        if (!empty($date_added)) {
            $date_added = str_replace("-", "",$date_added);
            $this->db->where('EXTRACT( YEAR_MONTH FROM p.date_added) =', $date_added);
        }

        $query = $this->db->where('p.archive', 0)
                        ->like('p.property_no',$search)
                        ->or_like('p.item',$search)
                        ->limit($limit,$start)
                        ->order_by($col,$dir)
                        ->get('property_tbl p');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count_property($search,$accountable,$date_added)
    {
        $this->db
            ->select('p.id, pp.ppe_name as ppe_account_group, pp.id as ppe_id, ps.ppe_sub_name as ppe_sub_account_group, ps.id as ppe_sub_id, p.item, p.description,
                    p.purchase_date, p.old_property, p.property_no, p.unit_measure, p.unit_value, p.qty,  p.total_cost, p.qty_per_property_card,
                    p.qty_per_physical_count, concat(u1.firstname, " ", u1.lastname) as accountable, u1.id as accountable_id, d.department_name as location,
                    d.id as location_id, concat(u2.firstname, " ", u2.lastname) as user, u2.id as user_id, p.condition, p.remarks')
            ->join('users_tbl u1', 'u1.id = p.accountable_id', 'left')
            ->join('users_tbl u2', 'u2.id = p.user_id', 'left')
            ->join('department_tbl d', 'd.id = p.department_id', 'left')
            ->join('ppe_sub_tbl ps', 'ps.id = p.ppe_sub_id', 'left')
            ->join('ppe_tbl pp', 'pp.id = ps.ppe_id', 'left');

        if (!empty($accountable)) {
            $this->db->where('p.accountable_id', $accountable_id);
        }

        if (!empty($date_added)) {
            $date_added = str_replace("-", "",$date_added);
            $this->db->where('EXTRACT( YEAR_MONTH FROM p.date_added) =', $date_added);
        }

        $query = $this->db->where('p.archive', 0)
                    ->like('p.property_no',$search)
                    ->or_like('p.item',$search)
                    ->get('property_tbl p');
    
        return $query->num_rows();
    } 

    // ===========> DEPARTMENT <===========
    function allposts_count_department()
    {   
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->get('department_tbl');
    
        return $query->num_rows(); 

    }
    
    function allposts_department($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('department_tbl');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search_department($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->like('department_name',$search)
                ->or_like('department_code',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('department_tbl');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count_department($search)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->like('department_name',$search)
                ->or_like('department_code',$search)
                ->get('department_tbl');
    
        return $query->num_rows();
    } 

    // ===========> PPE Account Group <===========
    function allposts_count_ppe()
    {   
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->get('ppe_tbl');
    
        return $query->num_rows(); 

    }
    
    function allposts_ppe($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('ppe_tbl');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search_ppe($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->like('ppe_name',$search)
                ->or_like('ppe_code',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('ppe_tbl');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count_ppe($search)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->like('ppe_name',$search)
                ->or_like('ppe_code',$search)
                ->get('ppe_tbl');
    
        return $query->num_rows();
    } 

    // ===========> PPE Sub-Account Group <===========
    function allposts_count_ppe_sub($ppe_id)
    {   
        $query = $this
                ->db
                ->select('*')
                ->where('ppe_id', $ppe_id)
                ->where('archive', 0)
                ->get('ppe_sub_tbl');
    
        return $query->num_rows(); 

    }
    
    function allposts_ppe_sub($limit,$start,$col,$dir,$ppe_id)
    {   
       $query = $this
                ->db
                ->select('*')
                ->where('ppe_id', $ppe_id)
                ->where('archive', 0)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('ppe_sub_tbl');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search_ppe_sub($limit,$start,$search,$col,$dir,$ppe_id)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('ppe_id', $ppe_id)
                ->where('archive', 0)
                ->like('ppe_sub_name',$search)
                ->or_like('ppe_sub_code',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('ppe_sub_tbl');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count_ppe_sub($search,$ppe_id)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('ppe_id', $ppe_id)
                ->where('archive', 0)
                ->like('ppe_sub_name',$search)
                ->or_like('ppe_sub_code',$search)
                ->get('ppe_sub_tbl');
    
        return $query->num_rows();
    } 

    // ===========> IP ADDRESS <===========
    function allposts_count_address()
    {   
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->get('address_tbl');
    
        return $query->num_rows(); 

    }
    
    function allposts_address($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('address_tbl');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search_address($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->like('ip_address',$search)
                // ->or_like('ppe_sub_code',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('address_tbl');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count_address($search)
    {
        $query = $this
                ->db
                ->select('*')
                ->where('archive', 0)
                ->like('ip_address',$search)
                // ->or_like('ppe_sub_code',$search)
                ->get('address_tbl');
    
        return $query->num_rows();
    } 
}
