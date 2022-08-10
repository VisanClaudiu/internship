<?php

namespace Drupal\internship_hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Returns responses for internship_search routes.
 */
class HelloForm extends FormBase {

  protected $emailValidator;

  public function getFormId() {
    return 'hello_form';
  }

  /**
   * Builds the response.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#title' => 'Name',
      '#type' => 'textfield',
      '#placeholder' => t('Enter your name'),
    ];

    $form['surname'] = [
      '#title' => 'Surname',
      '#type' => 'textfield',
      '#placeholder' => t('Enter your surname'),
    ];

    $form['email'] = [
      '#title' => 'Email',
      '#type' => 'email',
      '#placeholder' => t('Enter your email'),
    ];

    $form['phone'] = [
      '#title' => 'Phone number',
      '#type' => 'tel',
      '#placeholder' => t('Enter your phone number'),
    ];

    $form['gender'] = [
      '#title' => 'Gender',
      '#type' => 'select',
      '#options' => [
        '1' => $this
          ->t('Male'),
        '2' => $this
            ->t('Female'),
        ],
      '#placeholder' => t('Enter your phone number'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state){
    $email = $form_state->getValue('email');
    $phone = $form_state->getValue('phone');
    if ((strlen($phone) !== 10 && !preg_match('/^[07][0-9]{9}$/', $phone))) {
      $form_state->setErrorByName('phone', $this->t('Invalid phone number.'));
    }
    if (!\Drupal::service('email.validator')->isValid($email)) {
      $form_state->setErrorByName('email', t('Invalid email address.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::service('internship_dbselect.internshipdbselect')->dbAdd($form_state);

    $path = '/succes';
    $url = Url::fromUserInput($path);
    $form_state->setRedirectUrl($url);

    $messenger = \Drupal::messenger();
    $message=t('Hello, @name @surname', ['@name'=>$form_state->getValue('name'), '@surname'=>$form_state->getValue('surname') ]);
    $messenger->addMessage($message);
  }



}
