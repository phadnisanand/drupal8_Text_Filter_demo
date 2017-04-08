<?php

/**
 * @file
 * Contains \Drupal\celebrate\Form\ModuleConfigurationForm.
 */

namespace Drupal\Celebrate\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'celebrate_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'celebrate.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
    $config = $this->config('celebrate.settings');
    $form['your_message'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your message'),
      '#default_value' => $config->get('your_message'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('celebrate.settings')
      ->set('your_message', $values['your_message'])
      ->save();
  }
}