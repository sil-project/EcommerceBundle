<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\EcommerceBundle\Form\Type;

use Sylius\Component\Core\OrderPaymentStates;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Marcos Bezerra de Menezes <marcos.bezerra@libre-informatique.fr>
 */
class PaymentStateType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = function(Options $options) {
            $choices = [
                OrderPaymentStates::STATE_CART => 'librinfo.payment_state.cart',
                OrderPaymentStates::STATE_AWAITING_PAYMENT => 'librinfo.payment_state.awaiting_payment',
                OrderPaymentStates::STATE_PARTIALLY_PAID => 'librinfo.payment_state.partially_paid',
                OrderPaymentStates::STATE_CANCELLED => 'librinfo.payment_state.cancelled',
                OrderPaymentStates::STATE_PAID => 'librinfo.payment_state.paid',
                OrderPaymentStates::STATE_PARTIALLY_REFUNDED => 'librinfo.payment_state.partially_refunded',
                OrderPaymentStates::STATE_REFUNDED => 'librinfo.payment_state.refunded',
            ];
            if ($options['no_cart'])
                unset($choices[OrderPaymentStates::STATE_CART]);
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
        return 'librinfo_type_payment_state';
    }
}