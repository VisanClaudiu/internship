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
    $form_state->setMethod('GET');

    $form['keyword'] = [
      '#type' => 'search',
      '#placeholder' => t('Search...'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'hidden',
      '#value' => $this->t('Search'),
      '#name' => '',
    ];

    $form['#after_build'][] = [get_class($this), 'afterBuild'];
    return $form;
  }

  public static function afterBuild(array $form, FormStateInterface $form_state) {
    unset($form['form_token']);
    unset($form['form_build_id']);
    unset($form['form_id']);
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state){
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $path = "/search?keyword={$form['keyword']}";
    $url = Url::fromUserInput($path);
    $form_state->setRedirectUrl($url);
  }

}
