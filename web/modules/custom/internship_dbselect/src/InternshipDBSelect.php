<?php

namespace Drupal\internship_dbselect;

class InternshipDBSelect {

    public function dbSelect() {

    $query = \Drupal::database();
    $result = $query -> select('people','p')
                     -> fields('p',['id', 'name', 'surname', 'email', 'phone', 'gender'])
                     -> execute()              
                     -> fetchAll();
   
    $data = [];
    foreach ($result as $row){
      $data[] = [
        'name' => $row -> name,
        'surname' => $row -> surname,
        'email' => $row -> email,
        'phone' => $row -> phone,
        'gender' => $row -> gender,
        'Delete' =>t("<a href='delete/$row->id'> Delete </a>")
      ];
     }         
        
     return $data;       
    } 

    public function dbAdd($form_state) {
      $postData = $form_state->getValues();
      unset($postData['save'], $postData['form_build_id'], $postData['form_token'],
            $postData['form_id'], $postData['op'], $postData['submit']);
  
      $query = \Drupal::database();
      $query -> insert('people')
             -> fields($postData)
             -> execute();
    }

    public function dbDelete($id)
    {
      $query = \Drupal::database();
      $query -> delete('people')
             -> condition('id',$id,'=')
             -> execute();

      $response = new \Symfony\Component\HttpFoundation\RedirectResponse('../');
      $response -> send();
    
    }
}