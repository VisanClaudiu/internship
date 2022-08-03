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

    $renderable = [
      '#theme' => 'form_block',
      '#data' => $data
    ];

    return $renderable;
  }
}