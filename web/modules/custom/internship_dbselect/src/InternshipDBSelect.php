<?php

namespace Drupal\internship_dbselect;

class InternshipDBSelect {

    public function dbSelect() {
    $query=\Drupal::database();
    $result = $query -> select('people','p')
     -> fields('p',['name','surname','email','phone','gender'])
     ->execute()              
     ->fetchAll();
   
    $data = [];
    foreach($result as $row){
      $data[]=[
        'name' => $row -> name,
        'surname' => $row -> surname,
        'email' => $row -> email,
        'phone' => $row -> phone,
        'gender' => $row -> gender,
      ];
     }         
        
     return $data;       
    } 


}