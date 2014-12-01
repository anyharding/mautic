<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\InstallBundle\Configurator\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Misc Form Type.
 */
class MiscStepType extends AbstractType
{

    /**
     * @var
     */
    private $url;

    /**
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = (empty($options['data']->site_url)) ? $this->url : $options['data']->site_url;
        $builder->add('site_url', 'text', array(
            'label'      => false,
            'label_attr' => array('class' => 'control-label'),
            'attr'       => array(
                'class'       => 'form-control',
                'placeholder' => 'http://'
            ),
            'required'   => true,
            'data'       => $data
        ));


        $builder->add('cache_path', 'text', array(
            'label'      => 'mautic.install.form.cache_path',
            'label_attr' => array('class' => 'control-label'),
            'attr'       => array(
                'class'       => 'form-control'
            ),
            'required'   => true
        ));

        $builder->add('log_path', 'text', array(
            'label'      => 'mautic.install.form.log_path',
            'label_attr' => array('class' => 'control-label'),
            'attr'       => array(
                'class'       => 'form-control'
            ),
            'required'   => true
        ));

        $builder->add('send_server_data', 'button_group', array(
            'choice_list' => new ChoiceList(
                array(false, true),
                array('mautic.core.form.no', 'mautic.core.form.yes')
            ),
            'label'       => 'mautic.install.form.stats.send_stats',
            'expanded'    => true,
            'empty_value' => false
        ));

        $builder->add('buttons', 'form_buttons', array(
            'pre_extra_buttons' => array(
                array(
                    'name'  => 'next',
                    'label' => 'mautic.install.final.step',
                    'type'  => 'submit',
                    'attr'  => array(
                        'class' => 'btn btn-success pull-right btn-next',
                        'icon'  => 'fa fa-arrow-circle-right',
                        'onclick' => 'MauticInstaller.showWaitMessage(event);'
                    )
                )
            ),
            'apply_text'        => '',
            'save_text'         => '',
            'cancel_text'       => ''
        ));


        if (!empty($options['action'])) {
            $builder->setAction($options['action']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'install_misc_step';
    }
}