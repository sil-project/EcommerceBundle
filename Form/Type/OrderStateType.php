<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\EcommerceBundle\Form\Type;

use Sylius\Component\Order\Model\OrderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Marcos Bezerra de Menezes <marcos.bezerra@libre-informatique.fr>
 */
class OrderStateType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = function(Options $options) {
            $choices = [
                OrderInterface::STATE_CART => 'librinfo.order_state.cart',
                OrderInterface::STATE_NEW => 'librinfo.order_state.new',
                OrderInterface::STATE_FULFILLED => 'librinfo.order_state.fulfilled',
                OrderInterface::STATE_CANCELLED => 'librinfo.order_state.cancelled',
            ];
            if ($options['no_cart'])
                unset($choices[OrderInterface::STATE_CART]);
            return $choices;
        };

        $resolver->setDefaults([
            'choices' => $choices,
            'no_cart' => false,
        ]);

        $resolver->setAllowedTypes('no_cart', 'bool');
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix()
    {
        return 'librinfo_type_order_state';
    }
}