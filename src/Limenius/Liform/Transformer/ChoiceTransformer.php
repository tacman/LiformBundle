<?php

namespace Limenius\Liform\Transformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ChoiceList\View\ChoiceGroupView;

class ChoiceTransformer
{
    public function transform(FormInterface $form)
    {
        $formView = $form->createView();

        $choices = [];
        $titles = [];
        foreach ($formView->vars['choices'] as $choiceView) {
            if ($choiceView instanceof ChoiceGroupView) {
                foreach ($choiceView->choices as $choiceItem) {
                    $choices[] = $choiceItem->value;
                    $titles[] = $choiceItem->label;
                }
            } else {
                $choices[] = $choiceView->value;
                $titles[] = $choiceView->label;
            }
        }
        return [
            'enum' => $choices,
            'options' => ['enum_titles' => $titles],
            'type' => 'string'
            ];

    }
}
