<?php
namespace Drupal\celebrate\Plugin\Filter;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * @Filter(
 *   id = "filter_celebrate",
 *   title = @Translation("Celebrate Filter"),
 *   description = @Translation("Help this text format celebrate good times!"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class FilterCelebrate extends FilterBase {

	public function process($text, $langcode) {
	
	// $config1 = \Drupal::config('celebrate.settings');
     //print_r( $config1->get('your_message')); die;
		
		
    $invitation = $this->settings['celebrate_invitation'];
    $replace = '<span class="celebrate-filter">' . $this->t('Good Times! ' . $invitation) . ' </span>';
    $new_text = str_replace('[celebrate]', $replace, $text);

    $result = new FilterProcessResult($new_text);
    $result->setAttachments(array(
      'library' => array('celebrate/celebrate-shake'),
    ));

    return $result;
  }
  
  public function settingsForm(array $form, FormStateInterface $form_state) {
  
   $form['celebrate_invitation'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Invitation'),
      '#default_value' => $this->settings['celebrate_invitation'],
    );  

    return $form;
  }
  
}