<?php

namespace Drupal\internship_hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Code\Database\Database;
/**
 * Provides a 'My Template' block.
 *
 * @Block(
 *   id = "form_block",
 *   admin_label = @Translation("Form")
 * )
 */
class HelloBlock extends BlockBase {

   /**
   * {@inheritdoc}
   */

  

  public function build() {
    $query=\Drupal::database();
    /*$result = $query -> select('people','p') -> fields('p',['name','surname','email','phone','gender'])->execute()
                    ->fetchAll(\PDO::FETCH_OBJ);
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
    */
    $name = $query -> select('people','p') -> fields('p',['name'])->execute()
                     ->fetchField();
    $surname = $query -> select('people','p') -> fields('p',['surname'])->execute()
                     ->fetchField();
    $email = $query -> select('people','p') -> fields('p',['email'])->execute()
                     ->fetchField();
    $phone = $query -> select('people','p') -> fields('p',['phone'])->execute()
                     ->fetchField();
    $gender = $query -> select('people','p') -> fields('p',['gender'])->execute()
                     ->fetchField();
    if($gender==1){
      $gender="Male";
    }else{
      $gender="Female";
    }

    $renderable = [
      '#theme' => 'form_block',
      '#name'=> $name,
      '#surname'=> $surname,
      '#email'=> $email,
      '#phone'=> $phone,
      '#gender'=> $gender,
    ];

    return $renderable;
  }
}