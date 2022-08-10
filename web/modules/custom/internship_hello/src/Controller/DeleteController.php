<?php

namespace Drupal\internship_hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class DeleteController extends ControllerBase {

    public function delete($id){

       \Drupal::service('internship_dbselect.internshipdbselect')->dbDelete($id);
    }
}