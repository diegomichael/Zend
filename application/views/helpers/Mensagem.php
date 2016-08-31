<?php

class Zend_View_Helper_Mensagem extends Zend_View_Helper_Abstract {

    public function mensagem() {
        /* $flashMessenger Zend_Controller_Action_Helper_FlashMessenger */
        $flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');

        // Sucesso
        if ($flashMessenger->hasMessages()) {
            ?>
            <ul class="msg">
              <?php foreach ($flashMessenger->getMessages() as $message) { ?>
                  <li><?php echo $message; ?></li>
              <?php } ?>
            </ul>
            <?php
        }
    }

}
