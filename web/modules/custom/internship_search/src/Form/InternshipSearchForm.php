<?php

namespace Drupal\internship_search\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Returns responses for internship_search routes.
 */
class InternshipSearchForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * 
   * The unique string identifying the form.
   */
  public function getFormId() {
    return 'internship_search_form';
  }

  /**
   * Builds the response.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['keyword'] = [
      '#type' => 'search',
      '#placeholder' => t('Search...'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search'),
      '#name' => '',
    ];

    return $form;
  }


  public function validateForm(array &$form, FormStateInterface $form_state){
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keyword = $form_state->getValue('keyword');
    $form_state->setRedirect('view.search.search', [], ['query' => ['keyword' => $keyword]]);
  }

}
